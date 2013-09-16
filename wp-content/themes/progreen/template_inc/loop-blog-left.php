<?php

global $themeple_config;

do_action('themeple_excecute_query_var_action','loop-index');



if (have_posts()) :



    while (have_posts()) : the_post();



        $post_id    = get_the_ID();

        $title      = get_the_title();

        $content    = get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

                

        $post_format = get_post_format($post_id);

        if(strlen($post_format) == 0)

            $post_format = 'standart';

        $count = 0;

        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

        if(count($comment_entries) > 0){

            foreach($comment_entries as $comment){

                if($comment->comment_approved)

                    $count++;

            }

        }

        ?>

        

        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('row-fluid blog-article normal large-style'); ?>>                    

            <div class="span12">
         <?php if($post_format == 'standart'){
            $icon_class="pencil";
            }elseif($post_format == 'audio'){
                $icon_class="music";
            }elseif($post_format == 'soundcloud'){
                $icon_class="music";
            }elseif($post_format == 'video'){
                $icon_class="play-circle";
            }elseif($post_format == 'quote'){
                $icon_class="quote-left";
            }elseif($post_format == 'gallery'){
                $icon_class="picture";
            }elseif($post_format == 'image'){
                $icon_class="picture";
            }else
                $icon_class="pencil";


         ?>

                    
                                <div class="row-fluid">
                                    <dl  class="dl-horizontal">
                                                <dt><span class="blog-image-type type-<?php echo $post_format ?>-img"><i class="icon-<?php echo $icon_class ?>"></i></span><div class="date"><span class="month"><?php the_time('F'); ?></span><span class="day"><?php the_time('d'); ?></span></div> </dt>
                                                <dd>
                                                    <div class="row-fluid">
                                    <div class="span6">
                                        <div class="content">
                                            
                                                
                            <?php $tags = get_the_tags(); ?>
                                                
                               <?php if($post_format != 'quote'): ?>
                                                    <h4><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h4>
                                                    

                                                    

                                                    <div class="blog-content">        
                                                    <?php if(is_single()){ ?>

                                                                <?php the_content() ?>

                                                             <?php }else{

                                                                if($post_format == 'video' || $post_format == 'audio'){



                                                                    echo themeple_content(50);



                                                                }else

                                                                echo get_the_excerpt() ?>
                                                                
                                                                
                                                    <?php } ?>
                                                    </div>
                                   <?php endif; ?>
                               <?php if($post_format == 'quote'): ?>
                                                        <dl class="quote_container dl-horizontal "><dt><i class="icon-quote-left"></i></dt><dd><h2><?php echo get_the_content() ?></h2><h4><?php echo get_the_title() ?></h4></dd></dl>
                                
                                
                               <?php endif; ?>
                            

                                                  
                                                                                       
                                            
                                        </div>
                                    </div>
                                    <?php if($post_format == 'audio' || $post_format == 'gallery' || $post_format == 'video' || get_post_thumbnail_id()): ?>
                                    <div class="span6">
                                        
                                        <div class="media">
                            
                                            <?php if($post_format == 'audio'){ ?>

                                                


                                                <?php echo do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]'); ?>





                                            <?php }elseif($post_format == 'gallery'){ ?>

                                                  



                                                  <?php $slider = new themeple_slideshow(get_the_ID(), 'flexslider');

               

                                                  if($slider && $slider->slide_number > 0){

                                                        $sliderHtml = $slider->render_slideshow();

                                                        echo $sliderHtml;

                                                  }?>





                                            <?php }elseif($post_format == 'video'){ ?>



                                               

                                                <?php $video = ""; if(themeple_backend_is_file( get_the_excerpt(), 'html5video'))

                                                {

                                                    $video = themeple_html5_video_embed(get_the_excerpt());

                                                }

                                                else if(strpos(get_the_excerpt(),'<iframe') !== false)

                                                {

                                                    $video = get_the_excerpt();

                                                }

                                                else

                                                {

                                                    global $wp_embed;

                                                    $video = $wp_embed->run_shortcode("[embed]".trim(get_the_excerpt())."[/embed]");

                                                }

                                                

                                                if(strpos($video, '<a') === 0)

                                                {

                                                    $video = '<iframe src="'.get_the_excerpt().'"></iframe>';

                                                } 

                                                echo $video;

                                                ?>
                          
                            
                            

                             
                            
                                            <?php } elseif(get_post_thumbnail_id()){ ?>

                                           


                                               
                                                <img src="<?php echo themeple_image_by_id(get_post_thumbnail_id(), array('width' => 1200, 'height' => 1200), 'url') ?>" alt="">
                                            
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                    
                                
                                    
                                </div>
                                    </dd>
                                    </dl> 
                </div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="info">
                                                        <ul>
                                                            <li class="user">Posted by <?php echo get_the_author() ?></li>
                                                            <li class="tags"><?php echo count($tags).'&nbsp;'.__('Tags', 'themeple');  ?></li>
                                                            <li class="comments"><?php echo $count ?> Comments</li>
                                                        </ul>
                                                    <a href="<?php echo get_permalink() ?>" class="read_more pull-right base_btn"><?php echo __('Read More', 'themeple') ?></a>
                                                    <span class="border_style_color"></span>
                        </div>
                    </div>

                </div>
                </div>
        </article>




                            

                    

                

        

        

        <?php



    endwhile;

    themeple_pagination();

endif;

?>