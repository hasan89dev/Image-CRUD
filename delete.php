<?php
include "connect.php";
$getid=$_GET['delete_id'];
$getname=$_GET['delete_name'];
$delete="DELETE FROM person WHERE id=$getid";
$ex=mysqli_query($con,$delete);
unlink("image/$getname");
header('location:index.php');
?>