<?php
/*
Template Name: Archive
*/
global $themeple_config;
$themeple_config['multi_entry_page'] = true;
$themeple_config['current_sidebar'] = themeple_get_option('blog_sidebar_position');
$spancontent = 12;
    if($themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
$themeple_config['current_view'] = 'blog';
get_header();
            $subtitle = themeple_post_meta(themeple_get_post_id(), 'page_header_desc');
            $title = get_the_title();
            
        ?>

   <div class="header_page">
            <div class="container">
                <div class="row-fluid">
                    <div class="span6">
                        <h4>Archive!</h4>  <span class="subtitle">All the posts tagged with this name</span>
                    </div>
                    <div class="span6">
                        <h4 class="you_are_here">You are here:</h4>
                        <ul class="page_parents pull-right">
                            
                            <li><a href="http://localhost/green">Home</a>/</li>
                            
                                                        <li><a href="http://localhost/green/?page_id=41">Hi! This are our great Posts!</a></li>

                        </ul>
                    </div>
                    <span class="headgradient"></span>
                    <span class="headborder"></span>
                </div>
            </div>
            <div class="header_shadow"></div>
    </div>

<!-- Page Head -->
    
<section id="content">
        <div class="container" id="blog">
            <div class="row">
    <?php if($themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>   
        <div class="span<?php echo $spancontent ?>">
    <?php
        if($themeple_config['current_sidebar'] == 'fullsize'){
            get_template_part( 'template_inc/loop', 'blog-fullwidth' );
        }else
            get_template_part( 'template_inc/loop', 'index' );
    ?>

        </div>
<?php
    wp_reset_query();    
    
    if($themeple_config['current_sidebar'] == 'sidebar_right') get_sidebar();
?>

            </div>
        </div>
</section>
<?php
    get_footer();


?>
?>