


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Job | Jobs Portal</title>
    <?php 
    
   // include('header_link.php'); 
    include('dbconnect.php'); 
    



    ?>
</head>
<body>

<?php 
    
    include('header.php');

    if(!isset( $_SESSION['userid'] ) ){
      echo"<script> window.location.href = 'index.php' </script>";
      } 
      
    $jobid = $_GET['jobid'];
    $userid = $_SESSION['userid'];

    ?>

    <div class="container">


      <div class="single">
      <h1>Apply Jobs</h1>
            <div class="col-md-6">
                 <form action="apply.php" method="post" enctype="multipart/form-data">

                   <input type="hidden" value="<?=$jobid?>" name="jobid" >
                   <input type="hidden" value="<?=$userid?>" name="userid" >
     
                    <div class="form-group">
                    <input type="file"  name="file" class="form-control"> 
                    </div>
                    
                    <input type="submit"  name="applyjob" value="Apply Job" class="btn btn-primary">

                 </form>
              

            </div>

      </div>
 

       <?php 
 
           if(isset($_POST['applyjob']))
           {

        

            $userid = $_SESSION['userid'];
            $jobid = $_SESSION['jobid'];
            $date = date('d/m/y');
            

             $file = $_FILES['file']['name'];
             $tmp = $_FILES['file']['tmp_name'];


              move_uploaded_file($tmp, "uploads/$file");
print($userid);
           $sql = "INSERT INTO `application`(`userid`, `jobid`, `cv`, `date`) VALUES ('$userid','$jobid','$file','$date')";
           if(mysqli_query($con,$sql)){
           echo "<script>alert('Application submitted successfully')</script>";
           echo"<script> window.location.href = 'index.php' </script>";
        }
        else{
            echo "<script>alert('Application not submitted ')</script>";
        }
           

        }
        
?>

    
</div>

<br><br>
 <?php include('footer.php'); ?>


</body>
</html>