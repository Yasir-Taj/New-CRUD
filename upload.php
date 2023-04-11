<?php
include "connect.php";
$dir = "images/";
$folder = "files/";
$folder2 = "resume/";
$name = $_POST['fname'];
$class = $_POST['class'];
$section = $_POST['section'];
$pdfname = $_FILES['pdf']['name'];
$pdfTmp = $_FILES['pdf']['tmp_name'];
$pdfsize= $_FILES['pdf']['size'];
$cvname = $_FILES['cv']['name'];
$cvTmp = $_FILES['cv']['tmp_name'];
$cvsize= $_FILES['cv']['size'];
$imagename = $_FILES['image']['name'];
$imageTmp = $_FILES['image']['tmp_name'];
$size= $_FILES['image']['size'];
$path = $dir.$imagename;
$way = $folder.$pdfname;
$way2 = $folder2.$cvname;
move_uploaded_file($imageTmp,$path);
move_uploaded_file($pdfTmp,$way);
move_uploaded_file($cvTmp,$way2);
$sql="insert into `csv` (name,class,pdf,cv,image,section)
values ('$name','$class','$way','$way2','$path','$section')";
$result = mysqli_query($conn,$sql);
if($result){
    header("location:index.php");
}
?>