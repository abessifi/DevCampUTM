<?php
global $themeple_config;
do_action('themeple_excecute_query_var_action','loop-index');
//$metas = themeple_portfolio_custom_field(get_the_ID());
$metas = themeple_post_meta(get_the_ID());
$output = '';
?>


<div class="row-fluid single_content">
    <div class="span12">
        
            <div class="span4">
                <div class="row-fluid">
                    <div class="span12">
                        <h2><?php echo get_the_title() ?></h2>
                        <?php the_content() ?>
                   
                    
                        <?php 
                if(isset($metas['skills']) && count($metas['skills']) > 0 && isset($metas['skills_bool']) && $metas['skills_bool'] == 'yes'){ ?>
                <div class="row-fluid">
                    <div class="span12">
                        
                        <h2>Skills</h2>
                        <?php
                                foreach($metas['skills'] as $skill): ?>


                                <div class="skill">
                                    <span class="title"><?php echo $skill['title'] ?> <?php echo $skill['percentage'].'%' ?></span>
                                    <div class="progress progress-striped active">
                                        <div class="bar" style="width: <?php echo $skill['percentage'].'%;' ?>"></div>
                                    </div>
                                </div>




                            <?php endforeach; ?>
                            



                         
                    </div>

                     
                </div>
                <?php } ?>
                        <div class="row-fluid">
                            <div class="span12">
                                <ul class="single_info">
                                    <?php if(!empty($metas['client'])): ?>
                                    <li><span class="title">Client</span><?php echo $metas['client'] ?></li>
                                    <?php endif; ?>

                                    <li><span class="title">Date</span><?php echo get_the_date() ?></li>
                                    <?php if(!empty($metas['link'])): ?>
                                    <li><span class="title">Url</span><a href="<?php echo $metas['link'] ?>"><?php echo $metas['link'] ?></a></li>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </div>
                   
                </div>
            </div>
            </div>
            <div class="span8 slider_full">
        	<?php $slider = new themeple_slideshow(get_the_ID(), 'flexslider');
                       
                                      if($slider && $slider->slide_number > 0){
                                            $sliderHtml = $slider->render_slideshow();
                                            echo $sliderHtml;
                                      }
                       

             ?>
            </div>
        </div>

</div>





