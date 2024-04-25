
<?php 

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/20/2024
    Description: About page

****************/

include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> 
    <title>About Us</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- navigation -->
            <div class="col-md-3">
                <?php include('nav.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="content col-md-8" style="padding-top: 5%; ">
                    <h1>About Us</h1>
                    <br>
                    <p>The Winnipeg United Soccer Club is a dynamic community organization that aims to nurture youngsters,<br> 
                        promote soccer excellence, and give soccer fans of all ages a place to gather.<br>
                        Since its founding in 2024, the club has developed into a focal point for Winnipeg's soccer scene,<br>
                        planning leagues, competitions, practices, and social gatherings.</p> 
                    <p>The goal of the proposed Soccer Player Commenting Platform is to completely transform the way soccer fans<br> 
                        communicate and engage with their idols. Fans are keen to voice their thoughts, offer insights, and talk<br> 
                        about player performances in real time in the current digital era. Fans will have a consolidated, easily<br> 
                        navigable area to share highlights, rate players, write comments, and interact with other soccer fans that<br>  
                        share their interests on this platform. With this site, spectators will be able to comment on goals that win <br> 
                        games or assess individual players' performances, bringing them closer to the action.</p>
                </div>
                <!-- footer -->
                <?php include('footer.php'); ?>
            </div>
        </div>  
    </div>
</body>
</html>