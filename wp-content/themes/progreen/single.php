<?php

global $themeple_config;
$themeple_config['multi_entry_page'] = false;
$themeple_config['current_sidebar'] = themeple_get_option('single_post_sidebar_pos');
$spancontent = 12;
    if($themeple_config['current_sidebar'] == 'fullsize')
        $spancontent = 12;
    else
        $spancontent = 9;
get_header();
$themeple_config['current_view'] = 'blog';

    $highlight = themeple_post_meta(themeple_get_option('blogpage'), 'page_highlight');
    $title = get_the_title(themeple_get_option('blogpage'));
    $page_parents = page_parents();
    $blog_style = themeple_get_option('blog_style');
    $subtitle = themeple_post_meta(themeple_get_option('blogpage'), 'page_header_desc');
?>

    
   
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
     
    
   
    
    
<section id="content">
    <div class="container" id="blog">
        <div class="row">
    <?php if($themeple_config['current_sidebar'] == 'sidebar_left') get_sidebar() ?>   
        <div class="span<?php echo $spancontent ?>">
     

    <?php
        get_template_part( 'template_inc/loop', 'index' );
    ?>
    <?php wp_link_pages('before=<p class="post_nav">'.__('Pages:', 'themeple').'&after=</p>'); ?>
    <div class="row-fluid lines">
     
     <div class="span12">
    
      <div class="tagcloud span6">
      <?php the_tags('<p><span class="title">TAGS</span>', ''); ?>
      </div>
  
     <div class="span6">
     <div class="tagcloud">
      <?php $cats = wp_get_post_categories(get_the_ID()) ?>
      <p><span class="title">CATEGORIES</span>
        <?php foreach($cats as $cat): $cat = get_category( $cat ); ?>
        <a href="<?php echo esc_url(get_category_link($cat->cat_ID)) ?>" rel="category"><?php echo $cat->name ?></a>   
        <?php endforeach ?>
      </p>
      </div>

    </div>

      </div>
     </div>
 


        <?php comments_template( '/template_inc/comments.php');  ?>
	 
         </div> 
  
<?php
    wp_reset_query();    
    $themeple_config['current_view'] = 'blog';
    if($themeple_config['current_sidebar'] == 'sidebar_right') get_sidebar();
?>
       
            </div>
    
</section>
<?php
    get_footer();


?>