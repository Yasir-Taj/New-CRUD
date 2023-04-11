<?php
include "connect.php";
$folder = "files/";
$folder2 = "resume/";
$dir = "images/";
$id = $_POST["id"];
$name = $_POST["name"];
$class = $_POST["class"];
$section = $_POST["section"];
$pdfname = $_FILES['pdf']['name'];
$pdfTmp = $_FILES['pdf']['tmp_name'];
$cvname = $_FILES['cv']['name'];
$cvTmp = $_FILES['cv']['tmp_name'];
$imagename = $_FILES['image']['name'];
$imageTmp = $_FILES['image']['tmp_name'];

$path = $dir.$imagename;
$way = $folder.$pdfname;
$way2 = $folder2.$cvname;


if (!empty($imagename)) {

  $sql = "UPDATE csv SET name = '$name', class = '$class' ,image ='$path', section='$section' WHERE id = $id";
  mysqli_query($conn, $sql);
  move_uploaded_file($imageTmp,$path);
  header('location:index.php');

}elseif(!empty($pdfname)){
  
  $sql = "UPDATE csv SET name = '$name', class = '$class' ,pdf ='$way', section='$section' WHERE id = $id";
  mysqli_query($conn, $sql);
  move_uploaded_file($pdfTmp,$way);
  header('location:index.php');

}elseif(!empty($cvname)){
  
  $sql = "UPDATE csv SET name = '$name', class = '$class' ,cv ='$way2', section='$section' WHERE id = $id";
  mysqli_query($conn, $sql);
  move_uploaded_file($pdfTmp,$way);
  header('location:index.php');

}elseif(empty($pdfname)){

  $sql = "UPDATE csv SET name = '$name',class = '$class',section = '$section' WHERE id = $id";
  mysqli_query($conn, $sql);
  header('location:index.php');

}elseif(empty($imagename)){

  $sql = "UPDATE csv SET name = '$name',class = '$class', section = '$section' WHERE id = $id";
  mysqli_query($conn, $sql);
  header('location:index.php');

}elseif(empty($cvname)){

  $sql = "UPDATE csv SET name = '$name',class = '$class', section = '$section' WHERE id = $id";
  mysqli_query($conn, $sql);
  header('location:index.php');

}else{
 alert ("!!!!!!!!!---------Hello Dude---------!!!!!!!!!");
}

    
?>