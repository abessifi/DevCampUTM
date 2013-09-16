<?php
/*
Template Name: Left Navigation
*/
global $themeple_config;
$themeple_config['multi_entry_page'] = true;

$themeple_config['current_view'] = 'page';
get_header();
?>
<?php
            
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
<section id="content">
        <div class="container" id="page">
            <div class="row">
                    <div class="span3">
                            <ul class="side-nav">
                                <?php if(is_page('$post->post_parent')): ?><?php endif; ?>
                                <li <?php if(is_page($post->post_parent)): ?>class="current_page_item"<?php endif; ?>><a href="<?php echo get_permalink($post->post_parent); ?>" title="Back to Parent Page"><?php echo get_the_title($post->post_parent); ?></a></li>
                                <?php
                                if($post->post_parent)
                                $children = get_pages(array("child_of" => $post->post_parent));
                                else
                                $children = get_pages(array("child_of" => $post->ID));
                                if ($children) {
                                ?>
                                <?php 

                                    foreach($children as $c):
                                        ?>
                                        <li class="page_item page-item-<?php echo $c->ID ?> <?php if($c->ID == get_the_ID()): ?>current_page_item<?php endif; ?>"><a href="<?php echo get_permalink($c->ID) ?>"><?php echo get_the_title($c->ID) ?></a></li>
                                        <?php
                                    endforeach;

                                 ?>
                                <?php } ?>
                            </ul>
                    </div>

                    <div class="span9">
                        <?php the_content() ?>
                    </div>

            </div>
        </div>
</section>
<?php
    get_footer();


?>