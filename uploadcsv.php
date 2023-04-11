<?php
include "connect.php";
if(isset($_FILES["csvFile"]) && $_FILES["csvFile"]["error"] == 0) {
  $fileName = $_FILES["csvFile"]["name"];
  $fileTmpName = $_FILES["csvFile"]["tmp_name"];
  $fileType = $_FILES["csvFile"]["type"];

  $allowedTypes = array("text/csv", "application/vnd.ms-excel");
  if(in_array($fileType, $allowedTypes)) {
    $fileHandle = fopen($fileTmpName, "r");

    while(($data = fgetcsv($fileHandle, 1000, ",")) !== false) {
      $column1 = mysqli_real_escape_string($conn, $data[0]);
      $column2 = mysqli_real_escape_string($conn, $data[1]);
      $column3 = mysqli_real_escape_string($conn, $data[2]);

      $sql = "INSERT INTO csv (name, class,section) VALUES ('$column1', '$column2', '$column3')";
      mysqli_query($conn, $sql);
    }

    fclose($fileHandle);
    echo "File uploaded successfully.";
  }
  else {
    echo "Invalid file type. Please upload a CSV file.";
  }
}
else {
  echo "Please Select The File To Upload";
}



?>