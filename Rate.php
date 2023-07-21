
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Jobs | Jobs Portal</title>
    <?php 
    
   // include('header_link.php'); 
    include('dbconnect.php'); 
    



    ?>
</head>
<body>

<?php 
    
    include('header.php');
?>
      <?php
    if(!isset( $_SESSION['userid'] ) ){
        header('Location: login.php');
      } 
      
    $jobid = $_GET['jobid'];
    $userid = $_SESSION['userid'];

    ?>

    <div class="container">

    
      <div class="single">
      <h1>RATINGS!</h1>

            <div class="col-md-12">

                 <form action="Rate.php" method="post">
                 <input type="hidden" value="<?=$jobid?>" name="jobid" >
                   <input type="hidden" value="<?=$userid?>" name="userid" >
                    <div class="form-group">
                    <input type="number" name="rating" placeholder="Enter rating between 0 and 5" min="0" max="5" step="1" style="width: 300px;">

                    <!-- <input type="number" name="rating" placeholder="Enter rating between 0 and 5" min="0" max="5" step="1"> -->
                    </div>
                    <input type="submit" name="rate" value="Rate it!" class="btn btn-primary">

                 </form>
            </div>

      </div>

   <?php
        
        if(isset($_POST['rate']))
           {
           $rating=$_POST['rating'];
            $userid = $_SESSION['userid'];
            $jobid = $_SESSION['jobid'];
            // print($rating);

           $sql1 = "INSERT INTO `user_preferences`(`userid`,`jobid`,`rating`) VALUES ('$userid','$jobid','$rating')";
           if(mysqli_query($con,$sql1)){
           echo "<script>alert('Thankyou !!')</script>";
           //header('Location: index.php');
        }
        else{
            echo "<script>alert('error occured! ')</script>";
        } 
        }
        // else {
        //     echo"<script>alert('Rating not submitted! ')</script>";
        // }
        
?>

    
</div>

<br><br>
 <?php include('footer.php'); ?>


</body>
</html>