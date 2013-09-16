<?php

get_header();

?>

<!-- Page Head -->
    <div class="header_page">
            <div class="container">
            <h2>Theme shared on W P L O C K  E R . C O M - 404 - Not Found</h2>
            <ul class="page_parents pull-right">
                
                <li><a href="<?php echo home_url() ?>">Home</a>/</li>
                
            </ul>
            </div>
            
    </div> 
    <div class="header_shadow"></div> 


    <section id="not-found">
	    <section id="content">
	    	<div class="container" >
	                
	            	
	      	           
	            	<div class="row-fluid row-dynamic-el not_found_error">
	            			
	            			<h1>404</h1>
	            			<h3><?php echo themeple_get_option('404_error_message') ?></h3>
	            			<span class="big_shadow"></span>
	            	</div>
	        </div>
	    </section>
	</section>
<?php
get_footer();


?>