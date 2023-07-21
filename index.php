<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>HOME PAGE</title>
</head>
<body>
    <?php include('header.php')?>
    <?php include('dbconnect.php')?>;

    
    <div class="container">
        <div class="single">
            <div class="box_1">
                <h2>What we do</h2>
                <div class="col-md-5">
                    <img src="images/banner_p.jpg" class="img-responsive" alt="">
                </div>
                
                <div class="col-md-7 service_box1">
                    <h3>Welcome to Placement Assistance and Training Hub, your one-stop destination for all your placement and training needs.</h3>
                    <p></p>
                    <p>"We specialize in providing customized placement and training solutions to help job seekers find the right opportunities and businesses build strong, high-performing teams. Our services include job placement,skills training, and professional development. 
                        We are passionate about helping people succeed. We work closely with our clients to understand their unique needs and develop tailored solutions that deliver results. With our commitment to excellence, integrity, and customer satisfaction, we strive to be the trusted partner in success for our clients. "</p>
                    
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="box_2">
       	<h3>Latest Jobs</h3>
        
           <?php
                              
            $sql = "select jobs.jobid,jobs.name,categories.name as 'catname',
            jobs.description,jobs.date,jobs.salary,jobs.skill, jobs.timing,jobs.location
            from jobs
            inner join  categories on categories.catid = jobs.catid
            order by jobs.jobid desc limit 3";
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
				<p>Desc: <?= $jobdata['description']?> </p>
                <small> Skills: (<?= $jobdata['skill']?>) </small>
                <p>Timing: <?= $jobdata['timing']?> </p>
                <p>Location: <?= $jobdata['location']?> </p>
			</div>
		</div>
       	 
		
        <?php
            } 
        ?>
       	<div class="clearfix"> </div>
        <a href="viewjobs.php" class="btn btn-primary">View all Jobs</a>
    </div>


    </div>

    </div>


 

    <?php include('footer.php')?>
</body>
</html>