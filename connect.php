<?php
$conn = new mysqli("localhost","root","","csvfile");
if(!$conn){
    echo(mysqli_error($conn));
}
?>