
<?php
include('connect.php');
$username =  $_GET['uName'];
$password =  $_GET['passWord'];
$userID =  $_GET['userID'];

// mysqli_close($conn);
// if ($memberID=="") {
//     echo "No Select Member!";
// }else{
//     echo "Sync Success";
// }
$sqla = "select m_user,m_pass from member where m_user='".$username."' and m_pass='".sha1(sha1(md5($password)))."'";
$querya = mysqli_query($conn, $sqla);
if (mysqli_num_rows($querya) > 0) {
    $sql = "update member set lineid = '".$userID."' WHERE m_user='".$username."'";
    $query = mysqli_query($conn, $sql);
    // $jsonq = array();
    // while($resultq = mysqli_fetch_assoc($querya)) {    
    //     array_push($jsonq, $resultq);
    // }
    // echo json_encode($jsonq);
    echo 1;
}else{
    echo 0;
}

?>