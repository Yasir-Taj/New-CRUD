<?php
$student_id = $_POST["stuid"];
include "connect.php";
$sql = "SELECT * FROM csv WHERE id = {$student_id}";
$result = mysqli_query($conn, $sql);
$output = "";
if(mysqli_num_rows($result) > 0 ){
  while($row = mysqli_fetch_assoc($result)){
    $output .="<div class='modal fade' id='updateModal' data-bs-backdrop='static' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header d-flex justify-content-center'>
        <h3 style='color:green;'><b>Update User</b></h3>
      </div>
      <div class='modal-body'> 
      <form id='update_form' action='update.php'  method='post' enctype='multipart/form-data'>
      <tr>
        <td><h5>Name:</h5></td>
        <td><input class='form-control mt-2 mb-2' name='name' type='text' id='edit-name' value='{$row["name"]}' required>
        <input name='id' type='text' id='edit-id' hidden value='{$row["id"]}'>
        </td>
      </tr>
      <tr>
        <td><h5>Class:</h5></td>
        <td><input name='class' class='form-control mb-2' type='text' id='edit-place' value='{$row["class"]}' required></td>
      </tr>
      <tr>
        <td><h5>Result Card:</h5></td>
        <td><input name='pdf' class='form-control' accept='.pdf' type='file' id='edit-pdf' value='{$row["pdf"]}'></td>
      </tr>
      <tr>
        <td><h5>Resume:</h5></td>
        <td><input name='cv' class='form-control' accept='.pdf' type='file' id='edit-pdf' value='{$row["cv"]}'></td>
      </tr>
      <tr>
        <td><h5>Image:</h5></td>
        <td><input name='image' class='form-control' accept='.png,.jpg,.jpeg' type='file' id='edit-image' value='{$row["image"]}'></td>
      </tr><br>
      <tr>
        <td><h5>Section:</h5></td>
        <td><input name='section' class='form-control mb-2' type='text' id='edit-section' value='{$row["section"]}' required></td>
      </tr>
      <button type='submit' class='btn btn-outline-success form-control mb-2' id='updatebtn'>Update</button>
      <button type='button' class='btn btn-outline-danger form-control' data-bs-dismiss='modal'>Cancel</button>
      </form>
      </div>
    </div>
  </div>
</div>";
}
echo $output;

}else{
    echo "<h2>No Record Found.</h2>";
}

?>
