<?php
global $themeple_config;

get_header();

$themeple_config['current_sidebar'] = themeple_get_option('single_portfolio_sidebar_pos');
$title = get_the_title();

$metas = themeple_portfolio_custom_field(get_the_ID());
    $cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');

    $used_template = themeple_get_option_array('portfolio', 'portfolio_cats', $cats[0]->term_id, true);
    
    $title = get_the_title($used_template['portfolio_page']);
    
    $page_parents = page_parents();
    $subtitle = themeple_post_meta($used_template['portfolio_page'], 'page_header_desc');        
        ?>

   
    <!-- Page Head -->
    
    
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
     
    
   
    
    

<!-- Main Content -->
    <section id="content">
    	<div class="container">
        <?php if(have_posts()){ while (have_posts()) : the_post(); ?>
        
                <div class="row">
                    <div class="span12 portfolio_single">
                            
                        <?php
                            if($used_template['portfolio_single_style'] == 'bottom')
                                get_template_part('template_inc/loop', 'single_portfolio_bottom');
                            else if($used_template['portfolio_single_style'] == 'left')
                                get_template_part('template_inc/loop', 'single_portfolio_left');
                            else   
                                get_template_part('template_inc/loop', 'single_portfolio_right');
                         ?> 
                        
                         <?php
                        $used = themeple_post_meta($used_template['portfolio_dynamic_page']);
                        if(isset($used['layout'])){
                            $genDynamic = new GenerateDynamicTemplate($used['layout']);

                            $themeple_config['current_view'] = 'page';
                            $genDynamic->createView(); 
                            ?>
                            <section id="portfolio-single-widget-area">
                                
                                    <?php
                                    $genDynamic->display();
                                    ?>
                                
                            </section>   
                        <?php } ?>

                    </div>
                </div>


                
        <?php endwhile; } ?>
            
        </div>
    </section><!-- #content -->    
<?php get_footer() ?>