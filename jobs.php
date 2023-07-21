<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <titleJobs</title>
</head>
<body>
<?php include('header.php')?>
<?php include('dbconnect.php')?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="jobs.php" method="post">
                <div class ="section-title">
                    <h3>Jobs</h3>
                </div>
                <div class= "textbox-wrap">
                    <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <input type = "hidden" name= "jobid" value = "">
                        <input type ="text" required="required" value ="" name="name" class="form-control" placeholder="Name">

                    </div>

                    <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <textarea name = "description" id="" class="form-control" placeholder="Description"></textarea>
                    </div>

                    <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <input type ="text" required="required" value ="" name="skill" class="form-control" placeholder="Skill">

                    </div>
                    <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <input type ="text" required="required" value ="" name="timing" class="form-control" placeholder="Timing">

                    </div>
                   
                    </div>
                    <!-- <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <input type ="date" required="required" value ="" name="date" class="form-control" >
                        </div> -->
                    <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <input type ="text" required="required" value ="" name="salary" class="form-control" placeholder="Salary">

                    </div>

                    <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <textarea name = "location" id="" class="form-control" placeholder="Location"></textarea>
                    </div>

                   
                    <div class = "input-group">
                        <span class = "input-group-addon "><i class = "fa fa-user"></i></span>
                        <select name="catid" id="" class = "form-control">
                            <?php
                             $sql = "select * from categories ";
                             $data = mysqli_query($con,$sql); 
                             if(mysqli_num_rows($data) > 0){
                                while ($row= mysqli_fetch_array($data)) {
                                ?><option value = "<?= $row['catid']?>" > <?= $row['name'] ?> </option><<?php 
                                }
                            }
                            else{
                                ?><option> Category not added </option><?php
                            }
                            
                            ?>
                        </select>

                    </div>
                
                </div>
            
                <div class= "login-btn">
                <input type="submit"  name="addjob" value="Add Job" class="btn btn-primary">
                <input type="submit"  name="updatejob" value="Update Job" class="btn btn-info">

            </form>

        </div>
        
        <div class="col-md-6">
                 <div class="form-group">
                 <input type="text" id="myinput" placeholder="search ......" class="form-control">
                 </div>
               
                <table class="table">
                      <table>
                            <tr>
                                 <th>ID</th>
                                 <th>Name</th>
                                 <th>Categories</th>
                                 <th>Skill</th>
                                 <th>Description</th>
                                 <th>Salary</th>
                                 <th>Timing</th>
                                 <th>Date</th>
                              
                                 <!-- <th>Action</th> -->
                            </tr>
                      <!-- </table>

                      <tbody id="mytable"> -->
                           <?php
                              
                              $sql = "select jobs.jobid,jobs.name,categories.name as 'catname',
                                    jobs.description,jobs.date,jobs.salary,jobs.skill, jobs.timing,jobs.location
                                    from jobs
                                    inner join  categories on categories.catid = jobs.catid";
                              $rs = mysqli_query($con,$sql);
                              while($jobdata = mysqli_fetch_array($rs)){
                                
                                ?>

                                <tr>
                                      <td><?=$jobdata['jobid']?></td>
                                      <td><?=$jobdata['name']?></td>
                                      <td><?=$jobdata['catname']?></td>
                                      <td><?=$jobdata['skill']?></td>
                                      <td><?=$jobdata['description']?></td>
                                      <td><?=$jobdata['salary']?></td>
                                      <td><?=$jobdata['timing']?></td>
                                      <td><?=$jobdata['date']?></td>
                                      
                                      <!-- <td>
                                           <a href="upload.php?id=<?=$jobdata['jobid']?>" class="btn btn-info"> Edit</a>
                                           <a href="upload.php?id=<?=$jobdata['jobid']?>" class="btn btn-danger"> Delete</a>
                                      </td> -->
                                </tr>

                           <?php
                              }
                            ?>
                      <!-- </tbody> -->
                </table>

            </div>

      </div>
 


<?php include('footer.php')?>

<?php 

           if(isset($_POST['addjob'])){
            //$empid = $_SESSION['userid'];
            $name = $_POST['name'];
            $catid = $_POST['catid'];
            $description = $_POST['description'];
            //$categories = $_POST['categories'];
            $skill = $_POST['skill'];
            $date = date('d/m/y'); 
            $timing = $_POST['timing'];
            $location = $_POST['location'];
            $salary = $_POST['salary'];
            //print_r($_POST);
            $sql = "INSERT INTO `jobs`( `name`,  `description`,`skill`, `date`, `timing`, `salary`,`location`,`catid`) VALUES ('$name','$description','$skill','$date','$timing','$salary','$location','$catid')"; 
            if(mysqli_query($con,$sql)){
            echo "<script>alert('Job Added Successfully')</script>";
            }else{
            echo "<script>alert('Job Not Added')</script>";
            }

           //echo "<script>alert('Add Job')</script>";

        }
?>
</body>
</html>