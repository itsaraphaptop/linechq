<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<title>Line Alert</title>
	<link href="boostrap4/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="boostrap4/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="boostrap4/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="boostrap4/dist/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="boostrap4/dist/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="boostrap4/dist/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="boostrap4/dist/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
</head>
<body>
<?php
session_start();
require_once("LineLoginLib.php");
 
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");
 
/// ส่วนการกำหนดค่านี้สามารถทำเป็นไฟล์ include แทนได้
define('LINE_LOGIN_CHANNEL_ID','1657307016');
define('LINE_LOGIN_CHANNEL_SECRET','7d293348f448fef98e9918cdc9d4f798');
define('LINE_LOGIN_CALLBACK_URL','https://app.mesukdee.com/botpush/login_uselib_callback.php');
 
$LineLogin = new LineLoginLib(
    LINE_LOGIN_CHANNEL_ID, LINE_LOGIN_CHANNEL_SECRET, LINE_LOGIN_CALLBACK_URL);
     
if(!isset($_SESSION['ses_login_accToken_val'])){    
    $LineLogin->authorize(); 
    exit;
}
 
$accToken = $_SESSION['ses_login_accToken_val'];
// Status Token Check
if($LineLogin->verifyToken($accToken)){
    // echo $accToken."<br><hr>";
    // echo "Token Status OK <br>";  
}
 
 
// echo "<pre>";
// Status Token Check with Result 
//$statusToken = $LineLogin->verifyToken($accToken, true);
//print_r($statusToken);
 
 
//////////////////////////
// echo "<hr>";
// GET LINE USERID FROM USER PROFILE
$userID = $LineLogin->userProfile($accToken);
// echo "UserID".$userID;
 
//////////////////////////
// echo "<hr>";
// GET LINE USER PROFILE 
$userInfo = $LineLogin->userProfile($accToken,true);
if(!is_null($userInfo) && is_array($userInfo) && array_key_exists('userId',$userInfo)){
    // print_r($userInfo);
}
 
//exit;
// echo "<hr>";
 
if(isset($_SESSION['ses_login_userData_val']) && $_SESSION['ses_login_userData_val']!=""){
    // GET USER DATA FROM ID TOKEN
    $lineUserData = json_decode($_SESSION['ses_login_userData_val'],true);
    // print_r($lineUserData);
   

   
    // echo "<select id='compcode' class='form-control'>";
    // while($row = mysqli_fetch_array($result)) { 
    //     echo "<option value=".$row["compcode"].">".$row["company_name"] ."</option>";
        
    } ?>
    <br>
     <form>
     <div class="container-fluid">
        <div id="response">
            <input type="hidden" name="userID" id="user" value="<?=$lineUserData['sub'];?>">
            <!-- <select name="comp_code" id="compcode" class="form-control">
                <option value="">เลือกบริษัท</option>
               
            </select>
            <br>
            <select name="memID" id="member" class="form-control">
                <option value="">เลือกชื่อ</option>
            </select>
            <br> -->
                <!-- <br>
                <div class="text-center"><img class="rounded-circle" style="width:100px;" src="<?= $lineUserData['picture'];?>" /></div><br>
                <br>
                <div class="text-center"><p>เข้าบัญชีด้วยบัญชี</p></div>
                <div class="text-center"><h5>Line UserID: <?= $lineUserData['sub'];?></h5></div>
                <div class="text-center"><b><?= $lineUserData['name'];?></b></div>
                <br> -->
            
        </div>
    </div>
    </form>

<?php 
    // // echo "<tr>";
    // echo "<td>" .$row["compcode"] .  "</td> "; 
    // echo "<td>" .$row["company_name"] .  "</td> ";  
    // //แก้ไขข้อมูลส่่ง member_id ที่จะแก้ไขไปที่ฟอร์ม
    // echo "<td><a href='userupdateform.php?compcode=$row[0]'>edit</a></td> ";
    
    // //ลบข้อมูล
    // echo "<td><a href='UserDelete.php?compcode=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
    // // echo "</tr>";
    // }
    
    // echo "</select>";
    
    // echo "<a class='btn btn-success' href='#'>edit</a>";
    // echo "</table>";
    //5. close connection
    // Close DB
    // echo "<hr>";
    // echo "Line UserID: ".$lineUserData['sub']."<br>";
    // echo "Line Display Name: ".$lineUserData['name']."<br>";
    // echo '<img style="width:100px;" src="'.$lineUserData['picture'].'" /><br>';
 
// echo "<hr>";
// if(isset($_SESSION['ses_login_refreshToken_val']) && $_SESSION['ses_login_refreshToken_val']!=""){
//     echo '
//     <form method="post">
//     <button type="submit" name="refreshToken">Refresh Access Token</button>
//     </form>   
//     ';  
// }
if(isset($_SESSION['ses_login_refreshToken_val']) && $_SESSION['ses_login_refreshToken_val']!=""){
    if(isset($_POST['refreshToken'])){
        $refreshToken = $_SESSION['ses_login_refreshToken_val'];
        $new_accToken = $LineLogin->refreshToken($refreshToken); 
        if(isset($new_accToken) && is_string($new_accToken)){
            $_SESSION['ses_login_accToken_val'] = $new_accToken;
        }       
        $LineLogin->redirect("line_uselib.php");
    }
}
// Revoke Token
//if($LineLogin->revokeToken($accToken)){
//  echo "Logout Line Success<br>";   
//}
//
// Revoke Token with Result
//$statusRevoke = $LineLogin->revokeToken($accToken, true);
//print_r($statusRevoke);
?>
<?php
// echo "<hr>";
if($LineLogin->verifyToken($accToken)){
?>
<form method="post">
<!-- <button type="submit" name="lineLogout">Logout</button> -->
</form>
<?php }else{ ?>
<form method="post">
<button type="submit" name="lineLogin">LINE Login</button>
</form>   
<?php } ?>
<?php
if(isset($_POST['lineLogin'])){
    $LineLogin->authorize(); 
    exit;   
}
if(isset($_POST['lineLogout'])){
    unset(
        $_SESSION['ses_login_accToken_val'],
        $_SESSION['ses_login_refreshToken_val'],
        $_SESSION['ses_login_userData_val']
    );  
    echo "<hr>";
    if($LineLogin->revokeToken($accToken)){
        echo "Logout Line Success<br>";   
    }
    echo '
    <form method="post">
    <button type="submit" name="lineLogin">LINE Login</button>
    </form>   
    ';
    $LineLogin->redirect("line_uselib.php");
}
?>
<!-- <script src="script.js"></script> -->
<script src="boostrap4/dist/assets/plugins/global/plugins.bundle.js"></script>
<script src="boostrap4/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="boostrap4/dist/assets/js/scripts.bundle.js"></script>
<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script>
    var settings = {
    "url": "https://api.appsheet.com/api/v2/apps/8e8441a4-dd4e-495f-8e34-5d8be53df736/tables/0_Sale DB/Action?applicationAccessKey=V2-fUlze-cILgU-lt76u-BAZ3x-4IHcb-tY6xi-YjBVk-xJCYu",
    "method": "POST",
    "timeout": 0,
    "headers": {
        "Content-Type": "application/json"
    },
    "data": JSON.stringify({
        "Action": "find",
        "Properties": {
        "Locale": "en-US",
        "Location": "47.623098, -122.330184",
        "Timezone": "Pacific Standard Time"
        }
    }),
    };

    $.ajax(settings).done(function (response) {
    // console.log(response);
    // var json = JSON.parse(response);
    $.each(response, function (key, value) {
        if  (value.LineID == "<?= $lineUserData['sub'];?>"){
            console.log(value.LineID);
            var form = new FormData();
            var settings = {
                "url": "https://app.mesukdee.com/lineoa/api?line="+value.LineID+"&customercode="+value.PatientID+"&customername="+value.LIFF_CustomerName+"&buydate="+value.Display_Buy_Date+"&Frame="+value.LIFF_Frame+"&Lens="+value.LIFF_Lens+"&Final_RE="+value.Final_RE+"&Final_LE="+value.Final_LE,
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

            $.ajax(settings).done(function (response) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: value.LIFF_CustomerName,
                    text: "Your work has been Send",
                    showConfirmButton: false,
                    // timer: 3000
                });
            });
        }
        else{
            console.log("no data found");
        }
    })
    // var LineID = $.trim(response.LineID);
    // console.log(LineID);
    liff.closeWindow();
});
</script>
</body>
</html>

