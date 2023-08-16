<?php
include "connect.php";
$getid=$_GET['edit_id'];
$getname=$_GET['edit_name'];
$select="SELECT * FROM person WHERE id=$getid";
$ex=mysqli_query($con,$select);
$row=mysqli_fetch_array($ex);

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $dept=$_POST['dept'];
    $imgname=$_FILES['img']['name'];
    $temp_name=$_FILES['img']['tmp_name'];
$upload=move_uploaded_file($temp_name,'image/'.$imgname);
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
        <form action="" method="POST" enctype="multipart/form-data">
                    <input value="<?php echo $row['name'] ?>" type="text" class="form-control" name=name placeholder="enter name"><br>
                   
                    <input value="<?php echo $row['email'] ?>" type="text" class="form-control" name=email placeholder="enter email"><br>
                    
                    <input value="<?php echo $row['department'] ?>" type="text" class="form-control" name=dept placeholder="enter department"><br>
                    <img height=50 width=50 src="image/<?php echo $row['image'] ?>" alt=""><br><br>
                    
                    <input type="file" class="form-control" name=img placeholder="enter image" onchange="imgshow(event)"><br>
                    
                    
                    <img id="change" src="dimage.jpg" alt="" height=50 width=50><br><br>
                    <button class="btn btn-primary" name=submit>submit</button>
                    
                </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <script>

        function imgshow(event){
        var img=document.getElementById("change");
        img.src=URL.createObjectURL(event.target.files[0]);
        }
     </script>

  </body>
</html>