<?php global $themeple_config; ?>



<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php 



	 if (function_exists('themeple_favicon'))    { echo themeple_favicon(themeple_get_option('favicon')); } 

?>





<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>



<?php if(themeple_get_option('responsive_layout') == 'yes'): ?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php endif; ?>



        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        

        <!-- Base Css -->

        <link rel='stylesheet' id='bootstrap-css'  href='<?php echo get_stylesheet_directory_uri() ?>/css/bootstrap.css?ver=3.5' type='text/css' media='all' />

        <link rel='stylesheet' id='stylesheet-css'  href='<?php echo get_stylesheet_uri() ?>' type='text/css' media='all' />

        <link rel='stylesheet' id='bootstrap-responsive-css'  href='<?php echo get_stylesheet_directory_uri() ?>/css/bootstrap-responsive.css?ver=3.5' type='text/css' media='all' />		 

        

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

		<!--[if lt IE 9]>

		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

		<![endif]-->



<?php
    //Generated css from options
    get_template_part('template_inc/admin/register_styles'); 
    
    // Loaded all others styles and scripts.
    wp_head(); 	

?>

</head>

<body  <?php body_class(); ?>>

    <!-- Attention Grabber -->

	

<?php 





$layout = themeple_get_option('overall_layout'); if(( $layout == 'boxed' && !isset($_COOKIE['themeple_layout'])) || (isset($_COOKIE['themeple_layout']) && $_COOKIE['themeple_layout'] == 'boxed' )) { ?>

<div class="boxed_layout">

<?php } ?>

    <?php if( (themeple_get_option('top_widget') == 'yes' && !isset($_COOKIE['themeple_top_widget'])) || (isset($_COOKIE['themeple_top_widget']) && $_COOKIE['themeple_top_widget'] == 'yes') ): ?>
    <div class="top_nav">
        
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <div class="pull-left">
                        <?php dynamic_sidebar( "Top Header Left" ); ?>
                    </div>
                </div>
                <div class="span6">
                    <div class="pull-right">
                        <?php dynamic_sidebar( "Top Header Right" ); ?>
                    </div>
                </div>
               
            </div>
        </div>

    </div>
    <?php endif; ?>
    <!-- Header -->
    <div id="page-bg"></div>
    <?php $header_class = 'header_1'; if(isset($_COOKIE['themeple_header'])) $header_class = 'header_'.$_COOKIE['themeple_header'] ?>
    <header id="header" class="<?php echo $header_class ?>">
        <div class="container">
    	   <div class="row-fluid">
                <div class="span12">

                <!-- Logo -->
		      <?php $menu_pos = themeple_get_option('nav_pos'); ?>
                    <?php $menu_pos = (isset($_COOKIE['themeple_position'])?$_COOKIE['themeple_position']:$menu_pos); ?>    
                    <?php $css_class = ( ($menu_pos == 'right')?'':'centered_header'); ?>
                    <div id="logo" class="<?php echo $css_class ?>">

                        

                            <?php echo themeple_logo() ?>
		      
                    </div><!-- #logo -->
		    <?php if($css_class != 'centered_header'): ?>
		    <div class="pull-right header_widgetized">
                    <?php dynamic_sidebar( "Header Right Widgetized" ); ?>
                  </div>  
		    <?php endif; ?>
			<div id="navigation" class="nav_top pull-right nav_center <?php echo $css_class ?>">

                        	

            	            	<nav>

            	                	<?php 

                                            $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'themeple_fallback_menu');

                                            wp_nav_menu($args);  

                                    ?>

                                  

            	                </nav>





                            

                     </div><!-- #navigation -->

		    	
            
                </div>
            </div>
        	   
            

            

            

        

        </div>

    </header>

    <div class="top_wrapper">
    <?php $header_top = themeple_post_meta(themeple_get_post_id(), 'header_top'); ?>
    <div class="header_headline <?php if(!empty($header_top)) echo 'larger_height'; ?>"><div class="container"><h2><?php echo $header_top; ?></h2></div></div>
    


        
    <?php
                        wp_reset_postdata();
                        
                        if(( is_home() || is_page()) && !is_single() ){

                         $slider = new themeple_slideshow(themeple_get_post_id());

                         if($slider && $slider->slide_number > 0 && $slider->slide_type != ''){

                             if($slider->options['slideshow_layout'] == 'fixed'){

                                

                        



                                ?>

                            <span class="slider-img"></span>

                            <section id="slider-fixed" class="slider">



                                

                            <div class="container">

                                <div class="row">

                                    <div class="span12">

                            <?php

                            }elseif($slider->options['slideshow_layout'] == 'fullwidth'){

                                ?>

                                <span class="slider-img"></span>

                                <section id="slider-fullwidth"  class="slider">
                                       
                                <?php

                            }

                             

                             echo $slider->display();

                            ?>



                            <?php

                             

                             if($slider->options['slideshow_layout'] == 'fixed'){

                                ?>

                                            </div>    

                                    </div>

                                    <?php if($slider->slide_type == 'flexslider'): ?>



                                    



                                    <?php endif; ?>


                                    <div class="bottom_shadow"></div>
                                </div>

                               
                                 
                            </section>
                           
                            <?php

                            }else{

                                ?>
                                    


                                </section>

                                <?php

                            }

                        



                        }

                    }





                     ?>   

    
	<div class="wrapper_background">
        <?php if(isset($slider) && $slider->options['slideshow_layout'] == 'fixed'): ?>
        <div class="container">
        <?php endif; ?>
        <div class="header_content <?php echo themeple_post_meta(themeple_get_post_id(), 'header_type').'_style' ?>">

            <?php if(themeple_post_meta(themeple_get_post_id(), 'header_type') == 'v1'): ?>
                <div class="container">
                    <div class="row-fluid v1_header">
                        <div class="span6">
                            <h1><?php echo themeple_post_meta(themeple_get_post_id(), 'biggest_title') ?></h1>
                            <h2><?php echo themeple_post_meta(themeple_get_post_id(), 'second_title') ?></h2>
                        </div>
                        <div class="span6">
                            <p><?php echo themeple_post_meta(themeple_get_post_id(), 'right_description') ?></p>
                            <span class="divider"></span>
                            <a href="<?php echo themeple_post_meta(themeple_get_post_id(), 'link_href') ?>"><?php echo themeple_post_meta(get_the_ID(), 'link_title') ?></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(themeple_post_meta(get_the_ID(), 'header_type') == 'v2'): ?>
                <div class="container">
                    <div class="row-fluid v1_header">
                        <div class="span3">
                            <div class="circle"><i class="<?php echo themeple_post_meta(themeple_get_post_id(), 'icon_1') ?>"></i></div>
                            <h4><?php echo themeple_post_meta(themeple_get_post_id(), 'title_1') ?></h4>
                        </div>
                        <div class="span3">
                            <div class="circle"><i class="<?php echo themeple_post_meta(themeple_get_post_id(), 'icon_2') ?>"></i></div>
                            <h4><?php echo themeple_post_meta(themeple_get_post_id(), 'title_2') ?></h4>
                        </div>
                        <div class="span3">
                            <div class="circle"><i class="<?php echo themeple_post_meta(themeple_get_post_id(), 'icon_3') ?>"></i></div>
                            <h4><?php echo themeple_post_meta(themeple_get_post_id(), 'title_3') ?></h4>
                        </div>
                        <div class="span3">
                            <div class="circle"><i class="<?php echo themeple_post_meta(themeple_get_post_id(), 'icon_4') ?>"></i></div>
                            <h4><?php echo themeple_post_meta(themeple_get_post_id(), 'title_4') ?></h4>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <span class="headborder"></span><span class="fullshadow"></span>

        </div>
        <?php if(isset($slider) && $slider->options['slideshow_layout'] == 'fixed'): ?>
        </div>
        <?php endif; ?>
	<div id="style-switcher">
        <h3 id="switcher-head">
            Style Selector
            
        </h3>
        <a href="#" id="reset">Reset Style</a>
        <div id="switcher-content">
            <form action="#">
		  <div class="el">
                <div class="sub-head">Choose Your Layout Style</div>
                <select name="layout" id="layout">
                    <option value="fullwidth">Wide Layout</option>
                    <option value="boxed">Boxed Layout</option>
                    
                </select>
		  </div>
		  <div class="el">
                <div class="sub-head">Image Processing</div>
                <select name="image-processing" id="image-processing">
                    <option value="image-none">None</option>
                    <option value="image-desaturate">Desaturate</option>
                </select>
		  </div>
                <div class="el">
                <div class="sub-head">Menu Position</div>
                <select name="menu-position" id="menu-position">
                    <option value="right">Right</option>
                    <option value="center">Center</option>
                </select>
		  </div>
		   <div class="el">
                <div class="sub-head">Top Widgetized Area</div>
                <select name="top-widget" id="top-widget">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
		  </div>

		  <div class="el">	
                <div id="color-skin">
                    <div class="sub-head">Color Skin</div>
                    <ul>
                        <li><a href="#" data-value="blue"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-1.png" alt="Blue"></a></li>
                        <li><a href="#" data-value="orange"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-2.png" alt="Pink"></a></li>
                        <li><a href="#" data-value="red"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-3.png" alt="Green"></a></li>  
                        <li><a href="#" data-value="yellow"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-4.png" alt="Violet"></a></li>
                        <li><a href="#" data-value="green"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-5.png" alt="Violet"></a></li>
                        <li><a href="#" data-value="purple"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-6.png" alt="Violet"></a></li>
                        <li><a href="#" data-value="dark_blue"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-7.png" alt="Violet"></a></li>
			   <li><a href="#" data-value="brown"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-8.png" alt="Violet"></a></li>
                        <li><a href="#" data-value="turquoise"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-9.png" alt="Violet"></a></li>
			   <li><a href="#" data-value="black"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/skin-10.png" alt="Violet"></a></li>

                    </ul>
                </div>
		  </div>
		  <div class="el">
                <div id="bgimage">
                    <div class="sub-head">Background Image</div>
                    <ul>
                        <li><a href="#" data-src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/bkgd1.jpg"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/image-1.png" alt="Image 1"></a></li>
                        <li><a href="#" data-src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/bkgd3.jpg"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/image-2.png" alt="Image 2"></a></li>
                        <li><a href="#" data-src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/bkgd4.jpg"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/image-3.png" alt="Image 3"></a></li>
                        <li><a href="#" data-src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/bkgd2.jpg"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/image-4.png" alt="Image 4"></a></li>
                    </ul>
                </div>
		  </div>
                <div class="el">
                <div id="bgpattern">
                    <div class="sub-head">Background Pattern</div>
                    <ul>
                        <li><a href="#" data-class="pattern-1"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-1.png" alt="Pattern 1"></a></li>
                        <li><a href="#" data-class="pattern-2"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-2.png" alt="Pattern 2"></a></li>
                        <li><a href="#" data-class="pattern-3"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-3.png" alt="Pattern 3"></a></li>
                        <li><a href="#" data-class="pattern-4"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-4.png" alt="Pattern 4"></a></li>
                        <li><a href="#" data-class="pattern-5"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-5.png" alt="Pattern 5"></a></li>
                        <li><a href="#" data-class="pattern-6"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-6.png" alt="Pattern 6"></a></li>
                        <li><a href="#" data-class="pattern-7"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-7.png" alt="Pattern 7"></a></li>
                        <li><a href="#" data-class="pattern-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/pattern-8.png" alt="Pattern 8"></a></li>
                    </ul>
                </div>
		  </div>
		  <div class="el">
                <div id="bgcolor">
                    <div class="sub-head">Background Color</div>
                    <ul>
                        <li><a href="#" data-class="color-1"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-1.png" alt="Color 1"></a></li>
                        <li><a href="#" data-class="color-2"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-2.png" alt="Color 2"></a></li>
                        <li><a href="#" data-class="color-3"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-3.png" alt="Color 3"></a></li>
                        <li><a href="#" data-class="color-4"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-4.png" alt="Color 4"></a></li>
                        <li><a href="#" data-class="color-5"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-5.png" alt="Color 5"></a></li>
                        <li><a href="#" data-class="color-6"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-6.png" alt="Color 6"></a></li>
                        <li><a href="#" data-class="color-7"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-7.png" alt="Color 7"></a></li>
                        <li><a href="#" data-class="color-8"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/switcher/color-8.png" alt="Color 8"></a></li>
                    </ul>
                </div>
		  </div>
            </form>
        </div>
    </div>

    <!-- .header -->        

