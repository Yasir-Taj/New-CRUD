<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Upload csv files</title>
</head>
<body>
    <div class="main" style="background-image: url('images/7.png'); background-size: cover,cover;background-attachment: fixed; background-repeat: no-repeat;">
        
        <div class="container">
<div class="text-center">
    <img src="images/1.png" class="mt-4" alt="" style="width:130px">
</div>
<!-- Button trigger modal -->
<div class="text-center">
    <button type="button" class="btn btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Student
</button>
</div>

<form id="csv-upload-form" method="post" enctype="multipart/form-data">
    <input type="file" class="mb-2" name="csvFile"><br>
    <button type="submit" class="btn btn-dark mb-2">Upload</button>
</form>

<!-- <div class="download text-end">
  <button class="btn btn-dark">
<a href="download.php" class="text-decoration-none text-white mb-5">Download Data</a>
</button>
</div> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add the Student</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

      <form action="upload.php" method="post" enctype="multipart/form-data">

                <label for="name">Name</label>
                <input type="text" name="fname" class="form-control" required>
                <label for="name">Class</label>
                <input type="text" name="class" class="form-control mb-2" required>
                <label for="image"><h5>Profile Image:</h5></label>
                <input type="file" name="image" accept=".png,.jpg,.jpeg" class="form-control" id="image" required>
                <!-- <p style="color:red; font-weight:400;">Only png , jpg and jpeg image allowed;</p> -->
                <label for="pdf"><h5>Result Card</h5></label>
                <input type="file" name="pdf" accept=".pdf" class="form-control" id="pdf" required>  
                <label for="cv"><h5>Resume</h5></label>
                <input type="file" name="cv" accept=".pdf" class="form-control" id="cv" required>
                <br>
                <label for="section">Choose a Section:</label>
                
                <select id="section" name="section">
                 <option value="A">A</option>
                 <option value="B">B</option>
                 <option value="C">C</option>
                </select><br><br>

                <input class="form-control" type="submit">

          </form>
        </div>
    </div>
  </div>
</div>

<?php
include "connect.php";
    $table='<table id="example" class="table table-hover mt-3 text-black">
    <thead class="">

      <tr>
        <th scope="col">Sr No.</th>
        <th scope="col">Name</th>
        <th scope="col">Class</th>
        <th scope="col">Result Card</th>
        <th scope="col">Resume</th>
        <th scope="col">Profile Image</th>
        <th scope="col">Section</th>
        <th scope="col">Operations</th>
      </tr>

    </thead>';

    $sql = "Select * from `csv`";
    $result = mysqli_query($conn,$sql);
    $number=1;

    while($row=mysqli_fetch_assoc($result)){

        $id = $row['id'];
        $name = $row['name'];
        $class = $row['class'];
        $pdf = $row['pdf'];
        $cv = $row['cv'];
        $image = $row['image'];
        $section = $row['section'];
        $table.='<tr class="">
        <td scope="row">'.$number.'</td>
        <td>'.$name.'</td>
        <td>'.$class.'</td>
        <td><embed class="" src="'.$pdf.'" style="width:50px; height:50px;"></td>
        <td><embed class="" src="'.$cv.'" style="width:50px; height:50px;"></td>
        <td><img class="rounded-3" src="'.$image.'" style="width:50px; height:50px;"></td>
        <td>'.$section.'</td>
        <td class="d-
        flex justify-content-center">
        
        <button style="height:50px;" class="btn text-success" data-bs-toggle="modal" data-bs-target="#update" id="editdata" data-id='.$id.' title="Update"><span class="fa fa-edit"></span></button>

        <button class="btn text-danger" data-toggle="tooltip" title="Delete" id="deldata" data-id='.$id.'><span class="fa fa-trash"></span></button>

        <button class="btn text-info" title="View" data-bs-toggle="modal" id="viewdata" data-bs-target="#viewmodal" data-id='.$id.'><span class="fa fa-eye"></span></button>

      </td>
      </tr>';
      $number++;
    }
    $table.='</table>';
    echo $table;
?>  
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {
        $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           'csv','excel','pdf','print'
        ]
    } );
    $('#csv-upload-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'uploadcsv.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
            }
        });
    });
        ///// <--------Update Data---------> ///////

        $(document).on("click","#editdata",function(){       
          var stuid = $(this).data('id');
          // alert(stuid);
          // die();
            $.ajax({
              url: "display-update.php",
              type: "POST",
              cashe:false,
              data: {stuid},
              success:function(data){
              $(data).modal('show');
            }
          });
        });

           ///// <--------Delete Data---------> ///////

           $(document).on("click","#deldata",function(){
            var stuid = $(this).data('id');
            // alert(stuid);
            var element=this;
            $.ajax({
              url:"delete.php",
              type:"POST",
              data:{id : stuid},
              success:function(data){
                if(data==1){
                  $(element).closest("tr").fadeOut(1500);
                }else{
                  alert("Can't delete the data");
                }
              }
            });
        });
            
        ///////////////  View Details //////////////////

              $(document).on("click","#viewdata",function(){
          var stuid = $(this).data('id');
          var newelement = this;
          $.ajax({
            url:"view.php",
            type:"POST",
            data:{stuid},
            success:function(data){
              $(data).modal('show');
            } 
          
          });
        });
});
    </script>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
  </body>
</body>
</html>