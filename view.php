<?php
include "connect.php";
$student_id = $_POST["stuid"];
$sql = "SELECT * FROM csv WHERE id = {$student_id}";
$result = mysqli_query($conn, $sql);
$output = "";
if(mysqli_num_rows($result) > 0 ){
  while($row = mysqli_fetch_assoc($result)){
    $output .= "<div class='modal fade' id='viewModal' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header d-flex justify-content-center'>
          <h3 style='color:green;'><b>Details</b></h3>
        </div>
        <div class='modal-body'> 
        <div class='row'> 
        <div class='col-6'> 
        <form id='update_form' method='post' enctype='multipart/form-data'>
        <tr>
          <td><h5>Name:</h5></td>
          <td>{$row["name"]}
          <input name='id' type='text' id='edit-id'hidden value='{$row["id"]}'>
          </td>
        </tr>
        <tr>
          <td><h5 class='mt-2'>Class:</h5></td>
          <p>{$row["class"]}</p>
        </tr>
        <tr>
        <td><h5>Result Card:</h5></td>
        <embed  src='{$row["pdf"]}' style='width:50px; height:50px;'>
    
      </tr><br>
      <tr>
        <td><h5>Resume:</h5></td>
        <embed  src='{$row["cv"]}' style='width:50px; height:50px;'>
    
      </tr><br>
        <tr>
          <td><h5 class='mt-2'>Section:</h5></td>
          <p>{$row["section"]}</p>
        </tr>
        <button type='button' class='btn btn-outline-success form-control mx-5 mt-2' data-bs-dismiss='modal'>OK</button>
        </form>
        </div>
        <div class='col-6'>
        <tr>
        
          <img class='rounded-3' src='{$row["image"]}' style='width:180px; height:250px;'>
          
        </tr><br>
        </div>
        </div>
      </div>
    </div>
  </div>";}

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>

