<?php
global $themeple_config;
do_action('themeple_excecute_query_var_action','loop-index');
//$metas = themeple_portfolio_custom_field(get_the_ID());
$metas = themeple_post_meta(get_the_ID());
$output = '';
?>


<div class="row-fluid single_content">
    <div class="span12">
            <div class="span9 slider_full">
            <?php $slider = new themeple_slideshow(get_the_ID(), 'flexslider');
                       
                                      if($slider && $slider->slide_number > 0){
                                            $sliderHtml = $slider->render_slideshow();
                                            echo $sliderHtml;
                                      }
                       

             ?>
            </div>
            <div class="span3">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="project_title"><h6><?php echo get_the_title() ?></h6><span class="border_style_color"></span>
			   <ul class="portfolio_single_nav pull-right">
                
                                    <?php if(is_object(get_previous_post())): ?>
                                      <li class="prev"><a href="<?php echo get_permalink(get_previous_post()->ID); ?>" title="Previous"><i class="icon-angle-left"></i></a></li>
                                    <?php endif; ?>
                                     
                                    <?php if(is_object(get_next_post())): ?>
                                      <li class="next"><a href="<?php echo get_permalink(get_next_post()->ID); ?>"  title="Next"><i class="icon-angle-right"></i></a></li>
                                    <?php endif; ?>

                        </ul>
			   </div>
                        <?php the_content() ?>
                   
                    
                        <?php 
                if(isset($metas['skills']) && count($metas['skills']) > 0 && isset($metas['skills_bool']) && $metas['skills_bool'] == 'yes'){ ?>
                <div class="row-fluid">
                    <div class="span12">
                        
                        <div class="project_title skills_title"><h6>Our Skills</h6><span class="border_style_color"></span></div>
                        <?php
                                foreach($metas['skills'] as $skill): ?>


                                <div class="skill">
                                    <div class="percentage_circle"><span class="circle2"><span class="circle3"><span class="circle4"></span></span></span><span class="circle5"><span><?php echo $skill['percentage'] ?>%</span></span></div>
                                    <span class="title"> </span>
                                    <div class="progress progress-striped active">
                                        <div class="bar" style="width: <?php echo $skill['percentage'].'%;' ?>"></div>
                                        <span class=""><?php echo $skill['title'] ?></span>
                                    </div>
                                </div>




                            <?php endforeach; ?>
                            



                         
                    </div>

                     
                </div>
                <?php } ?>
                        
                   
                </div>
            </div>
            </div>
            
        </div>

</div>





