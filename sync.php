
<?php
include('connect.php');
$username =  $_GET['uName'];
$password =  $_GET['passWord'];
$userID =  $_GET['userID'];
// $sql = "update member set lineid = '".$_GET['userID']."' WHERE m_code='".$_GET['memberID']."'";
// $query = mysqli_query($conn, $sql);
// mysqli_close($conn);
// if ($memberID=="") {
//     echo "No Select Member!";
// }else{
//     echo "Sync Success";
// }
$sqla = "select m_user,m_pass from member where m_user='".$username."' and m_pass='".$password."'";
$querya = mysqli_query($conn, $sqla);
if ($querya->num_rows > 0) {
    // $jsonq = array();
    // while($resultq = mysqli_fetch_assoc($querya)) {    
    //     array_push($jsonq, $resultq);
    // }
    // echo json_encode($jsonq);
    echo "login success";
}else{
    echo "login fail";
}

?>