
<?php
include('connect.php');
$memberID =  $_GET['memberID'];
$userID =  $_GET['userID'];
$sql = "update member set lineid = '".$_GET['userID']."' WHERE m_code='".$_GET['memberID']."'";
$query = mysqli_query($conn, $sql);
// mysqli_close($conn);
// if ($memberID=="") {
//     echo "No Select Member!";
// }else{
//     echo "Sync Success";
// }
$sqla = "select * from member where m_code='".$_GET['memberID']."'";
$querya = mysqli_query($conn, $sqla);
$jsonq = array();
while($resultq = mysqli_fetch_assoc($querya)) {    
    array_push($jsonq, $resultq);
}
echo json_encode($jsonq);
?>