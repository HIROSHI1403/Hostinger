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
        	
        	@media (max-width: 480px){
        		.swiper-container {
		        width: 100%;
		        height: 200px;
		        background: #eee;
		        }
        	}
        	@media (min-width: 480px){
        		.swiper-container {
		        width: 100%;
		        height: 600px;
		        background: #eee;
		    	}
        	}
		    
		    .swiper-slide {
		        text-align: center;
		        font-size: 18px;
		        background: #fff;
		        /* Center slide text vertically */
		        display: -webkit-box;
		        display: -ms-flexbox;
		        display: -webkit-flex;
		        display: flex;
		        -webkit-box-pack: center;
		        -ms-flex-pack: center;
		        -webkit-justify-content: center;
		        justify-content: center;
		        -webkit-box-align: center;
		        -ms-flex-align: center;
		        -webkit-align-items: center;
		        align-items: center;
				    
		    }
/* 		    .swiper-slide:nth-child(2n) { */
/* 		        width: 60%; */
/* 		    } */
/* 		    .swiper-slide:nth-child(3n) { */
/* 		        width: 40%; */
/* 		    } */
	    </style>
        
        
    </head>

    <body>
    
			<?php 
				userheader();
	// 			userlistgroup_demo();
	// 			userpanel_n_demo();
			?>
			
			
			<!-- <div style="padding-left: 10px;padding-right: 10px;"> -->
			<div class="container">
			
			<?php
				userbreadcrumbs_demo(); 
			?>
			
			<?php 
				usercompadopt();
			?>	
				
			
    	</div>
    
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>
        
        
        <script src="js/swiper.min.js"></script>
        <script>     
	        var swiper = new Swiper('.swiper-container', {
	            pagination: '.swiper-pagination',
	            paginationClickable: true
	        });
	        
        </script>

    </body>

</html>
