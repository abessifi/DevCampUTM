<?php

global $controller;

$options = $controller->options;

$styles = $options['themeple'];

if(isset($_COOKIE['themeple_skin'])){

	include(THEMEPLE_BASE.'/template_inc/admin/register_skins.php');

	if(is_array($predefined[$_COOKIE['themeple_skin']]) && count($predefined[$_COOKIE['themeple_skin']]) > 0 ){

		foreach($predefined[$_COOKIE['themeple_skin']] as $el_id => $value){

			$styles[$el_id] = $value;

		}

	}

}

extract($styles);

?>



<style type="text/css">

	body{background: <?php if(isset($_COOKIE['themeple_layout']) && $_COOKIE['themeple_layout'] == 'boxed' ) echo "d2d1d0"; else  echo $bg_color ?> 

	<?php if($bg_img != 'none' && $bg_your_img == '' && ((themeple_get_option('overall_layout') == 'boxed' && !isset($_COOKIE['themeple_layout'])) || (isset($_COOKIE['themeple_layout']) && $_COOKIE['themeple_layout'] == 'boxed' ))){ ?>

		url('<?php echo get_template_directory_uri(); ?>/img/patterns/<?php echo $bg_img ?>.png') repeat;

	<?php }

	if($bg_your_img != ""){ ?>

		url('<?php echo $bg_your_img ?>') repeat;



	<?php } ?>

	}

	input,button,select,textarea,body,span, aside .widget_twitter li{font-family: <?php if($font_page == 'standart') echo '"Helvetica Neue", Helvetica, Arial, sans-serif'; else echo $font_page ?>; font-size: <?php echo $font_size_page ?>px; color:<?php echo $body_font_color ?> }

	h1,h2,h3,h4,h5,h6, nav .menu li a{font-family: <?php if($font_headings == 'standart') echo '"Helvetica Neue", Helvetica, Arial, sans-serif'; else echo $font_headings ?>}

	

	h1{font-size: <?php echo $font_size_1 ?>px}

	h2{font-size: <?php echo $font_size_2 ?>px}

	h3{font-size: <?php echo $font_size_3 ?>px}

	h4{font-size: <?php echo $font_size_4 ?>px}
	nav .menu li{font-size:13px}
	h5{font-size: <?php echo $font_size_5 ?>px}

	h6{font-size: <?php echo $font_size_6 ?>px}

	nav .menu li.current-menu-item{border-bottom:5px solid <?php echo $base_color ?>; color:<?php echo $base_color ?>}
  nav .menu li.current-menu-item a, footer .widget_recent_posts ul li a:hover, .blog-article h4 a:hover, .blog-article .date, .blog-article .date span, aside ul li:hover a, .page_parents li a:hover, #portfolio-filter ul li.active a, .services_medium h4 a:hover, .services_small a:hover,  #faq-filter ul li.active a, footer a:hover, #dynamic_testimonial li .stars i.colored, .carousel_blog li.blog-article .content h6 a:hover, .carousel_blog li.blog-article .content h5 a:hover, .header_content.v2_style .circle i, .comment dl dd ul li a:hover, #respond a:hover, .recent_news .news-article h5 a:hover, .color_skin{color:<?php echo $base_color ?>;}
  .blog-article .blog-image-type, .blog-article .date:hover, .blog-article .border_style_color, .base_btn, .tpl2 .center-bar a.link:hover, .tpl2 .center-bar a.lightbox:hover, #portfolio-preview-items .portfolio-item .project:hover, .border_style_color,  .skill .percentage_circle .circle4, .services_medium .icon_medium, .services_small dt:hover, .social_icons li:hover, .carousel_blog li.blog-article dt .v2_type:hover, .carousel_blog li.blog-article:hover .date_dyn, .header_content, .tagcloud a:hover, .more-large, .services_list dt:hover, nav .menu li ul li:hover, .recent_news .news-article .date:hover, .recent_news .news-article .blog-image-type, .slider_overlay{background:<?php echo $base_color ?>;}
  .services_medium a.link:hover{background:<?php echo $base_color ?> !important;}
  nav .menu li a{color:<?php echo $nav_font_color ?>;}
  .footer_wrapper{border-top:5px solid <?php echo $base_color ?>;}
  .widget_flickr img:hover{border-color:<?php echo $base_color ?>;}
  .header_page .container{ border-bottom:10px solid <?php echo $base_color ?>;}
  .slideshow_container{ border-bottom:18px solid <?php echo $base_color ?>;}
  #portfolio-filter ul li.active a, #faq-filter ul li.active a{border-bottom:3px solid <?php echo $base_color ?>;}
  .row-dynamic-el .pagination a:hover{border:1px solid <?php echo $base_color ?>;}
  .header_content.v2_style .circle{border:3px solid <?php echo $base_color ?>;}
  
  <?php $rgb = HexToRGB($base_color); ?>
  .header_content.v2_style .span3{border-left:2px solid rgba(<?php echo $rgb['r'] ?>, <?php echo $rgb['g']+35 ?>, <?php echo $rgb['b'] ?>, 0.25)}
  .header_content.v2_style .span3{border-right:2px solid rgba(<?php echo $rgb['r']-60 ?>, <?php echo $rgb['g']-15 ?>, <?php echo $rgb['b'] ?>, 0.3)}  

  .textbar .container{border-top:7px solid <?php echo $base_color ?>;}
  .textbar.with_image .img_div{border:7px solid <?php echo $base_color ?>;}
  .portfolio_sc_item img:hover {border:2px solid <?php echo $base_color ?>; }
  .in_head, .progress-striped .bar,  #respond input[type="submit"]{background-color:<?php echo $base_color ?>;}
  aside .tagcloud a:hover{color:<?php echo $base_color ?>;}
  .footer_social_icons li:hover {background-color:<?php echo $base_color ?> ;}
  footer .footer_social_icons li i:hover{background-color:<?php echo $base_color ?>; color:<?php echo $base_color; ?>;}
  .social_ a, #mc_signup_submit{background:<?php echo $base_color ?>;}
  .themeple_sc .themeple_blockquote{border-left-color: <?php echo $base_color ?>;}
  .footer .price_button {background-color:<?php echo $base_color ?>;}
  .price_1_col.level-max {border-color:<?php echo $base_color ?>;}
  nav .menu li:hover ul{border-top:3px solid <?php echo $base_color ?>}
  .row-dynamic-el .header h3, .themeple_sc .header h3{color: <?php echo $dynamic_el_title_color ?>} 
  .side-nav li.current_page_item{background: <?php echo $base_color ?>;}
  .side-nav li.current_page_item a{color:#fff}
  .portfolio_single_nav li:hover a i{color:<?php echo $base_color ?>}
  .portfolio_single_nav li:hover{border:1px solid <?php echo $base_color ?>}
  a:hover{color:<?php echo $base_color ?>}
  
  .top_nav{background:<?php echo $topnav_background_color ?>; color:<?php echo $topnav_font_color?>}
  
  .services_list dt i{font-size: <?php echo $services_list_icon_size ?>; line-height: <?php echo $services_list_icon_height ?>;color: <?php echo $services_list_icon_color ?>;}
  .services_list dt{background:<?php echo $services_list_icon_bg ?>;}

  .services_small i{color:<?php echo $services_small_icon_color ?>; font-size:<?php echo $services_small_icon_size ?>}
  
  footer#footer{background:<?php echo $footer_bg_color ?>; color:<?php echo $footer_font_color ?>}  
  #copyright{background:<?php echo $footer_copyright_bg ?>}  
  .header_3 .top_nav, .header_4 .top_nav{background:<?php echo $base_color ?>}
  <?php if(isset($arrow_image) && !empty($arrow_image)): ?> 
    .accordion-heading {background-image:url('<?php echo $arrow_image ?>'); background-position: left center; background-repeat: no-repeat;}
  <?php endif; ?>

  <?php if(isset($arrow_active_image) && !empty($arrow_active_image)): ?>
    .in_head{background-image: url('<?php echo $arrow_active_image ?>'); background-position: left center; }
  <?php endif; ?>
  
  <?php if(isset($headborder_image) && !empty($headborder_image)): ?>
    .headborder{background:url('<?php echo $headborder_image ?>') no-repeat; }
    .header_content .headborder{background: url('<?php echo $headborder_image ?>') repeat-y;}
  <?php endif; ?>
  
  <?php if(isset($select_arrow_image) && !empty($select_arrow_image)): ?>
    aside select, footer select, .dyn_widget select  {background:url('<?php echo $select_arrow_image ?>') no-repeat 174px;}
  <?php endif; ?>
 </style>


 		<?php $font = themeple_get_option('font_page');  ?>

        <?php $font_head = themeple_get_option('font_headings');  ?>



        <?php if($font != 'standart'): ?>

        <link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", $font) ?>:400,300,500,600,300italic' rel='stylesheet' type='text/css' />

        <?php endif; ?>

        <?php if($font_head != 'font_headings'): ?>

        <link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(" ", "+", $font_head) ?>:400,300,500,600,700,300italic' rel='stylesheet' type='text/css' />

 		<?php endif; ?>

 		<?php if($font == 'standart' || $font_head == 'standart'): ?>
        <style type="text/css">
        /*@font-face {
            font-family: 'MS5';
            src: url('../fonts/museo_slab_500-webfont.eot');
            src: local('☺'), url('../fonts/museo_slab_500-webfont.woff') format('woff'), url('../fonts/museo_slab_500-webfont.ttf') format('truetype'), url('../fonts/museo_slab_500-webfont.svg#webfont6ROMXS1F') format('svg');
            font-weight: normal;
            font-style: normal;
        }*/
        @font-face {
            font-family: 'Helvetica Neue';
            src: url('<?php echo get_stylesheet_directory_uri() ?>/css/Helvetica_Neue.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;

        }

        @font-face {
            font-family: 'Helvetica Neue';
            src: url('<?php echo get_stylesheet_directory_uri() ?>/css/Helvetica_Neue_Bold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;

        }

        </style>


        <?php endif; ?> 
	