<?php
include "connect.php";
$err_name=$err_email=$err_dept=$err_img='';


if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $dept=$_POST['dept'];
    $imgname=$_FILES['img']['name'];
    $temp_name=$_FILES['img']['tmp_name'];

    if(empty($name)){
        $err_name="name is required";
    }
    else if(empty($email)){
        $err_email="email is required";
    }
    else if(empty($dept)){
        $err_dept="department is required";
    }
    else if(empty($imgname)){
        $err_img="image is required";
    }
    else{
        $upload=move_uploaded_file($temp_name,'image/'.$imgname);

        $insert="INSERT INTO person (name,email,department,image) 
        VALUES ('$name','$email','$dept','$imgname')";

        $ex=mysqli_query($con,$insert);
    }

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
            <h1 class="text-white bg-dark text-center">IMAGE CRUD</h1>
            <div class="col-lg-5">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" name=name placeholder="enter name"><br>
                    <span class="text-warning"><?php echo $err_name ?></span>
                    <input type="text" class="form-control" name=email placeholder="enter email"><br>
                    <span class="text-warning"><?php echo $err_email ?></span>
                    <input type="text" class="form-control" name=dept placeholder="enter department"><br>
                    <span class="text-warning"><?php echo $err_dept ?></span>
                    <input type="file" class="form-control" name=img placeholder="enter image" onchange="imgshow(event)"><br>
                    <span class="text-warning"><?php echo $err_img ?></span>
                    <img id="change" src="dimage.jpg" alt="" height=100 width=100><br><br>
                    <button class="btn btn-primary" name=submit>submit</button>
                </form>
            </div>
            <div class="col-lg-7">
                <table class="table">
                    <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>department</th>
                        <th>image</th>
                        <th><button>edit</button></th>
                        <th><button>delete</button></th>
                    </thead>

                    <tbody>
                        <?php
                         $select="SELECT * FROM person";
                         $exe=mysqli_query($con,$select);

                         while($row=mysqli_fetch_array($exe)){?>

                         <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['department'] ?></td>
                            <td><img height=50 width=50 src="image/<?php echo $row['image'] ?>" alt=""></td>
                            <td><a href="edit.php?edit_id=<?php echo $row['id'] ?> & edit_name=<?php echo $row['name'] ?>"><button class="btn btn-success">edit</button></a></td>
                            <td><a href="delete.php?delete_id=<?php echo $row['id'] ?> & delete_name=<?php echo $row['name'] ?> "><button class="btn btn-warning">delete</button></a></td>
                         </tr>

                         <?php }

                        ?>
                    </tbody>
                </table>
            </div>
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