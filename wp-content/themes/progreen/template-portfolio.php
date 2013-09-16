<?php

global $themeple_config;
    
    get_header();
    
    if(empty($themeple_config['current_portfolio']['portfolio_columns'])) $themeple_config['current_portfolio']['portfolio_columns'] = 3;
    $portfolio_layout = $themeple_config['current_portfolio']['portfolio_layout'];
    $spancontent = 12;
    $themeple_config['current_sidebar'] = $portfolio_layout;
    if($portfolio_layout =='fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
    $categoriesArray = "";
	if(isset($themeple_config['new_query']['tax_query'][0]['terms'])) 
        $categoriesArray = $themeple_config['new_query']['tax_query'][0]['terms'];
	$themeple_config['current_view'] = 'portfolio';
    
    $portfolio_columns = $themeple_config['current_portfolio']['portfolio_columns'];
	$args = array(
	
		'taxonomy'	=> 'portfolio_entries',
		'hide_empty'=> 0,
		'include'	=> $categoriesArray
	
	);
    $themeple_config['multi_entry_page'] = true;
	$categories = get_categories($args);
            
            $title = get_the_title();
            $page_parents = page_parents();
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
    
    <!-- Main Content -->
    <section id="content" class="content_portfolio layout-<?php echo $portfolio_layout ?>">
    	<div class="container">
        	<div class="row-fluid">
    <?php
    if(count($categories) > 0){
        echo '<!-- Portfolio Filter --><nav id="portfolio-filter" class="span12">';
            echo '<ul class="">';
                echo '<li class="active all"><a href="#"  data-filter="*">'.__('View All', 'themeple').'</a><span></span></li>';
                
            foreach($categories as $cat):
                
                    echo '<li class="other"><a href="#" data-filter=".'.$cat->category_nicename.'">'.$cat->cat_name.'</a><span></span></li>';    
                
            endforeach;
            
            echo '</ul>';
        echo '</nav>';
    }
            echo '</div>';
    $grid = 'three-cols';
    switch($portfolio_columns){
        case '3':
            $grid = 'three-cols';
            break;
        case '2':
            $grid = 'two-cols';
            break;
        case '4':
            $grid = 'four-cols';
            break;
        case '1':
            $grid = 'one-cols';
            break;
    }
    ?>
        <div class="row-fluid">
        <?php if($portfolio_layout == 'sidebar_left') get_sidebar() ?>
            <section id="portfolio-preview-items" class="<?php echo $grid ?> span<?php echo $spancontent ?>">
            <?php
                get_template_part('template_inc/loop', 'portfolio-grid');
                wp_reset_query();
                
            ?>
            </section>
        <?php if($portfolio_layout == 'sidebar_right') get_sidebar() ?>
<?php
    echo '</div></div></section>';
    get_footer();
?>