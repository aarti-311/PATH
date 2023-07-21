<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>View Jobs</title>
</head>
<body>
    <?php include('header.php')?>
    <?php include('dbconnect.php')?>;

    
    <div class="container">
       <div class ="row">
       	<h2>All Jobs</h2>
           <?php
            $jobid = $_GET['jobid'];                  
            $sql = "select jobs.jobid,jobs.name,categories.name as 'catname',
            jobs.description,jobs.date,jobs.salary,jobs.skill, jobs.timing,jobs.location
            from jobs
            inner join  categories on categories.catid = jobs.catid
            where jobs.jobid = '$jobid'";
            $rs = mysqli_query($con,$sql);
            while($jobdata = mysqli_fetch_array($rs)){
                $_SESSION['jobid']=$jobid;
        ?>                        

       	<div class="col-md-4 icon-service">
           	<div class="icon">
				<i class="fa fa-calendar"></i>
			</div>
       			<h4><?= $jobdata['name']?></h4>
                <small> Category: (<?= $jobdata['catname']?>) </small>
				<p>Desc: <?= $jobdata['description']?> </p>
                <small> Skills: (<?= $jobdata['skill']?>) </small>

                <p>Timing: <?= $jobdata['timing']?> </p>
                <p>Location: <?= $jobdata['location']?> </p>
                <p>Apply On: <?= $jobdata['date']?> </p>
                <div class="col-sm-2">
                    <?php
                    if(isset($_SESSION['roletype'])){
                        if($_SESSION['roletype'] ==2) {
                   echo ' <a href="apply.php" class="btn btn-primary">Apply Now</a>';
                   echo ' <a href="rate.php" class="btn btn-primary">Rate Jobs</a>';
                      }
                    }
                      else {
                        echo '<a href="login.php" class="btn btn-primary">Login</a><br><br>';
                        echo '<a href="register.php" class="btn btn-primary">Register</a>';
                      }
                    
                    ?>
               
			    </div>
		    </div>
       	 
		
        <?php
            } 
        ?>
       	<div class="clearfix"> </div>
        
       </div>
    </div>
    


 

    <?php include('footer.php')?>
</body>
</html>