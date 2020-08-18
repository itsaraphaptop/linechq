$(function(){
    var compcode = $('#compcode');
    var memberID = $('#member');
    var syncs = $('#syncs');
    var lineinfo = $('#lineinfo');
    // on change province
    compcode.on('change', function(){
        var compID = $(this).val();
        console.log(compID);
        memberID.html('<option value="">เลือกชื่อ</option>');
 
        $.get('get_member.php?comp_code=' + compID, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                memberID.append(
                    $('<option></option>').val(item.m_code).html(item.m_name)
                );
            });
        });
    });
    lineinfo.hide();
    syncs.on('click', function(){
        // var memberID =  $('#member').val();
        var userID =  $('#user').val();
        var username = $("#username").val();
        var password = $("#password").val();
        var response = $("#response");
        
        $("#syncs").hide();
        // response.html('<div class="text-center"><h3>Please Wait Connect...</h3></div>');
        $.get('sync.php?uName=' + username +'&passWord='+ password + '&userID=' + userID, function(data){
            if (data!=0) {
                response.html('<div class="text-center"><h3> Sync Success </h3></div>');
                lineinfo.show();
            } else {
                $("#error").html("Login Fail");
                $("#syncs").show();
            }
            // var result = JSON.parse(data);
            // $.each(result, function(index, item){
            //     response.html('<div class="text-center"><h3> Sync Success </h3></div>');
            // });
            
        });
        // window.location.href = "http://stackoverflow.com";
    });

    

    console.log('ddddd');
});