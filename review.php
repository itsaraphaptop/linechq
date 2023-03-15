<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิว</title>
    <style>
        .center {
           
            background-color: black;
        }
        .res{
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body class="center">
    <?php 
        $getid = $_GET['id'];
           include('connect.php');
           if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
           } 
           
           //2. query ข้อมูลจากตาราง: 
           $sql = "select * from review where id = '".$_GET['id']."'" or die("Error:" . mysqli_error()); 
           //3. execute the query. 
           $query = mysqli_query($conn, $sql); 
           print_r($query);
           if ($query->num_rows > 0) {
            while($row = $query->fetch_assoc()) {
                echo $row['title'];
    ?>
    <img class="res" src="./images/<?=$row['image']?>" alt="screencapture-facebook-concepteyebrows-posts-pfbid0-Rc-G6-U6-Qj-SJ7gs7z-Hoj-D8q72-Jbs-Pm-QDBD8pd3-Xf" border="0">
   <?php }
    }else{
        echo "0 results";
   }?>

   <?php  mysqli_close($conn);?>
</body>
</html>