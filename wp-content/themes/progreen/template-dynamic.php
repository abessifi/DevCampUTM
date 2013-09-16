<?php
global $themeple_config;
$post_id = themeple_get_post_id();
$used_template = themeple_post_meta($post_id);
$genDynamic = new GenerateDynamicTemplate($used_template['layout']);

$themeple_config['current_view'] = 'page';
$genDynamic->createView();
get_header();
do_action( 'themeple_excecute_query_var_action' , 'template-dynamic' );

    $themeple_config['current_sidebar'] = $genDynamic->layout;
    
    $spancontent = 12;
    if($themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
    ?>
    
<?php
            
            $title = get_the_title();
            $page_parents = page_parents();
            $blog_style = themeple_get_option('blog_style');
            $subtitle = themeple_post_meta(themeple_get_post_id(), 'page_header_desc');
        ?>

    <?php if(themeple_post_meta(themeple_get_post_id(), 'page_header_bool') == 'yes'): ?>
    <!-- Page Head -->
    
    <div class="header_page">
            <div class="container">
                <div class="row-fluid">
                    <div class="span6">
                        <h4><?php echo $title ?></h4>  <span class="subtitle"><?php echo $subtitle; ?></span>
                    </div>
                    <div class="span6">
                        <h4 class="you_are_here"><?php _e('You are here:', 'themeple'); ?></h4>
                        <ul class="page_parents pull-right">
                            
                            <li><a href="<?php echo home_url() ?>">Home</a>/</li>
                            
                            <?php for($i = count($page_parents) - 1; $i >= 0; $i-- ){ ?>

                            <li><a href="<?php echo get_permalink($page_parents[$i]) ?>"><?php echo get_the_title($page_parents[$i]) ?> </a>/</li>

                            <?php }  ?>
                            <li><a href="<?php echo get_permalink() ?>"><?php echo $title ?></a></li>

                        </ul>
                    </div>
                    <span class="headgradient"></span>
                    <span class="headborder"></span>
                </div>
            </div>
            <div class="header_shadow"></div>
    </div> 
     
    
    <?php endif; ?>

    <section id="content" class="page-<?php echo $genDynamic->template_type ?>">
        <div class="container">
            <div class="row">
        <?php if($themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>
               
            
               <div class="span<?php echo $spancontent ?>">
               
        <?php
            $genDynamic->display();
        ?>
                
                </div>
             
        <?php if($themeple_config['current_sidebar'] == 'sidebar_right') get_sidebar() ?>
            </div>
        </div>
    </section>
<?php

get_footer();
    
?>