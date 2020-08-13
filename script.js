$(function(){
    var compcode = $('#compcode');
    var memberID = $('#member');
    var syncs = $('#syncs');
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
   
    syncs.on('click', function(){
        var memberID =  $('#member').val();
        var userID =  $('#user').val();
        var response = $("#response");
        console.log(memberID);
        
        $("#syncs").hide();
        $("#response").html('<div class="response"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>');
        $.get('sync.php?memberID=' + memberID + '&userID=' + userID, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                response.html("Sync Success :");
            });
            
        });
    });



    console.log('ddddd');
});