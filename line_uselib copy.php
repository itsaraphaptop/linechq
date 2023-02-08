<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- <script src="dist/plugins/jquery/jquery.min.js"></script> -->
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
    print_r($lineUserData);
   die();
    // connect DB
    include('connect.php');

    //2. query ข้อมูลจากตาราง: 
    $sql = "select * from member where lineid = '".$lineUserData['sub']."'" or die("Error:" . mysqli_error()); 
    //3. execute the query. 
    $query = mysqli_query($conn, $sql); 
   
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
                <?php while($result = mysqli_fetch_assoc($query)){ ?>
                    <option value="<?=$result['compcode']?>"><?=$result['company_name']?></option>
                <?php } ?>
            </select>
            <br>
            <select name="memID" id="member" class="form-control">
                <option value="">เลือกชื่อ</option>
            </select>
            <br> -->
            <?php if (mysqli_num_rows($query) > 0) {?>
                <br>
                <div class="text-center"><img class="rounded-circle" style="width:100px;" src="<?= $lineUserData['picture'];?>" /></div><br>
                <br>
                <div class="text-center"><p>เข้าบัญชีด้วยบัญชี</p></div>
                <!-- <div class="text-center"><h5>Line UserID: <?= $lineUserData['sub'];?></h5></div> -->
                <div class="text-center"><b><?= $lineUserData['name'];?></b></div>
                <br>
            <?php }else{?>
                <br>
                <div class="text-center"><h3>CM Login</h3></div>
                <br>
                <div id="error"><span></span></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" id ="password">
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-block btn-lg" id="syncs">เข้าสู่ระบบ</button>
            <?php }?>
        </div>
        <div id="lineinfo">
            <br>
            <div class="text-center"><img class="rounded-circle" style="width:100px;" src="<?= $lineUserData['picture'];?>" /></div><br>
            <br>
            <div class="text-center"><p>เข้าบัญชีด้วยบัญชี</p></div>
            <!-- <div class="text-center"><h5>Line UserID: <?= $lineUserData['sub'];?></h5></div> -->
            <div class="text-center"><b><?= $lineUserData['name'];?></b></div>
            <br>
            
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
    mysqli_close($conn);
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
<script src="script.js"></script>
</body>
</html>

