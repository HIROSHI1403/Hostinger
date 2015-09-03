<?php 
	require_once 'userfunctions.php';
?>

<html>

    <head>
		<meta charset="utf-8">		
		
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="css/swiper.min.css">
        <style>

	    </style>        
    </head>

    <body>
    
    		<?php 
				$usercal_result = RUN_SQLI_DEFAULTLOGIN("SELECT * FROM adopt_info;");
    			if (!isset($_GET['cal'])){
    				echo<<<EOT
    				<style>
        				.swiper-container {
						    width: 600px;
						    height: 300px;
						}   
        			</style>
    				<div class="swiper-container">
					    <!-- Additional required wrapper -->
					    <div class="swiper-wrapper">
					        <!-- Slides -->
					        <div class="swiper-slide">Slide 1</div>
					        <div class="swiper-slide">Slide 2</div>
					        <div class="swiper-slide">Slide 3</div>
					    </div>
					    <!-- If we need pagination -->
					    <div class="swiper-pagination"></div>
					    
					    <!-- If we need navigation buttons -->
					    <div class="swiper-button-prev"></div>
					    <div class="swiper-button-next"></div>
					    
					    <!-- If we need scrollbar -->
					    <div class="swiper-scrollbar"></div>
					</div>
    				<script>
	    				$(document).ready(function() {
	    					// This command is used to initialize some elements and make them work properly
	    					$.material.init();
	    				});
    				</script>
    				<script>
	    				 var mySwiper = new Swiper ('.swiper-container', {
						    // Optional parameters
						    direction: 'vertical',
						    loop: true,
						    
						    // If we need pagination
						    pagination: '.swiper-pagination',
						    
						    // Navigation arrows
						    nextButton: '.swiper-button-next',
						    prevButton: '.swiper-button-prev',
						    
						    // And if we need scrollbar
						    scrollbar: '.swiper-scrollbar',
						  })        
    				</script>
EOT;
    			}elseif ($_GET['cal']=="cal1"){
    				
    			}elseif ($_GET['cal']=="cal2"){
    				
    			}elseif ($_GET['cal']=="cal3"){
    				
    			}else{
    			}
    		
    		?>
				
    
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>

    </body>

</html>
