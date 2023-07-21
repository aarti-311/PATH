<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View ALL Jobs | Jobs Portal</title>
    <?php 
    
    //include('header_link.php'); 
    include('dbconnect.php'); 
    
   
   

    ?>
</head>
<body>

<?php 
    
    include('header.php'); 
   
    if(!isset( $_SESSION['userid'] ) ){
      echo"<script> window.location.href = 'login.php' </script>";
      } 



    ?>
    <div class="container">
    


      <div class="single">
     

            <div class="col-md-12">
                 <div class="form-group">
                 <input type="text" id="myinput" placeholder="search ......" class="form-control">
                 </div>
               
                 <table class="table">
                      <thead>
                            <tr>
                                 <th>ID</th>
                                 <th>Job</th>
                                 <th>Category</th>
                                 <th>User</th>
                                 <th>Date</th>
                                 <th>CV</th>
                                
                            </tr>
                      </thead>

                      <tbody id="mytable">
                           <?php
                               
                              $sql = "select application.appid, jobs.name,user.name as 'username',categories.name as 'catname', application.date, application.cv
                              from application
                              INNER join jobs on jobs.jobid = application.jobid
                              INNER join categories on categories.catid = jobs.catid
                              INNER join user on user.userid = application.userid
                    
                              ";
                              $rs = mysqli_query($con,$sql);
                              while($data = mysqli_fetch_array($rs)){
                           ?>

                                <tr>
                                      <td><?=$data['appid']?></td>
                                      <td><?=$data['name']?></td>
                                      <td><?=$data['catname']?></td>
                                      <td><?=$data['username']?></td>
                                      <td><?=$data['date']?></td>
                                      <td><a href="uploads/<?=$data['cv']?>" class="btn btn-warning" target="_blank">view cv></a></td>
                                     
                                     
                                </tr>

                           <?php
                              }
                              ?>
                      </tbody>
                 </table>

            </div>

      </div>
 


</div>

<script>
$(document).ready(function(){
  $("#myinput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>

<br><br>
 <?php include('footer.php'); ?>


</body>
</html>