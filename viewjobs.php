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
       	<h3>All Jobs</h3>
           <?php
                              
            $sql = "select jobs.jobid,jobs.name,categories.name as 'catname',
            jobs.description,jobs.date,jobs.salary,jobs.skill, jobs.timing,jobs.location
            from jobs
            inner join  categories on categories.catid = jobs.catid
            order by jobs.jobid desc";
            $rs = mysqli_query($con,$sql);
            while($jobdata = mysqli_fetch_array($rs)){
        ?>                        

       	<div class="col-md-4 icon-service">
       		<div class="icon">
				<i class="fa fa-calendar"></i>
			</div>
			<div class="icon-box-body">
				
                <h4><?= $jobdata['name']?></h4>
                <small> Category: (<?= $jobdata['catname']?>) </small>
				<!-- <p>Desc: <?= $jobdata['description']?> </p>
                <small> Skill: <?= $jobdata['skill']?> </small>

                <p>Timing: <?= $jobdata['timing']?> </p> -->
                <p>Location: <?= $jobdata['location']?> </p>
                
                <!-- <div class="col-sm-2"> -->
                <a href="single.php?jobid=<?= $jobdata['jobid']?>" class="btn btn-primary">More Detail</a>
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