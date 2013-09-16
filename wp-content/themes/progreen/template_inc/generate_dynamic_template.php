<?php

/**
 * GenerateDynamicTemplate
 * 
 * @package   
 * @author 
 * @copyright oni12
 * @version 2012
 * @access public
 */
class GenerateDynamicTemplate{
    
    var $template_type;
    var $post_id;
    var $template_elements = array();
    var $template_layout;
    var $layout;
    var $temp_name = "";
    var $output = array();
    /**
     * GenerateDynamicTemplate::GenerateDynamicTemplate()
     * 
     * @return
     */
    function GenerateDynamicTemplate($template = false){
        global $controller, $post;
        if($template != false){
            $ar = explode("-", $template);
            $this->temp_name = $ar[1];
            $this->template_type = $template;
            $this->post_id = themeple_get_post_id();
            $this->template_elements = $this->getTemplateElements();
        }
    }
    
    /**
     * GenerateDynamicTemplate::getTemplateElements()
     * 
     * @return
     */
    function getTemplateElements(){
        global $controller;
        $elements = array();
       
        if(isset($controller->options['builder']))
            $controller->options['builder'] = themeple_entity_decode($controller->options['builder']);
        
        foreach($controller->page_elements as $key => $element){
            
            if('dynamic_template-'.$element['slug'] == $this->template_type && isset($element['dynamic'])){
                
                if(isset($controller->options['builder'][$element['id']])){
                    $controller->page_elements[$key]['saved'] = $controller->options['builder'][$element['id']];
                    
                }
                $elements[] = $controller->page_elements[$key];
            }
        }
        
        return $elements;
        
    }
    /**
     * GenerateDynamicTemplate::getTemplateOption()
     * 
     * @return
     */
    function getTemplateOption($option_id){
        global $controller;
        
        $option = false;
        if(isset($controller->options['builder']) && isset($controller->options['builder'][$this->temp_name.$option_id])){
            $option = themeple_entity_decode($controller->options['builder'][$this->temp_name.$option_id]);
        }
        
        return $option;
    }
    /**
     * GenerateDynamicTemplate::setLayout()
     * 
     * @return
     */
    function setLayout($layout = ""){
        global $themeple_config;
        
        $this->getTemplateOption('dynamic_page_layout');
        if(!$layout)
            $layout = $this->getTemplateOption('dynamic_page_layout');
        if(!$layout)
            $layout = "fullsize";
        if(isset($themeple_config['layout']) )    
            $themeple_config['layout']['current_layout'] = $themeple_config['layout'][$layout];
        $this->layout = $layout;
        
    }
    /**
     * GenerateDynamicTemplate::createView()
     * 
     * @return
     */
    function createView(){
        $this->setLayout();
        $size = 0;
        
        
        foreach($this->template_elements as $element)
		{
			if(method_exists($this, $element['dynamic']))
			{			
                if(isset($element['saved']))
				{

                    $test = '';

                    if($element['dynamic'] == 'head_text')
                        $test = ' style="margin-bottom:-40px;" ';
                        
                    
					if($size == 0)
                        $this->output[] = '<div class="row-fluid row-dynamic-el"'.$test.'>';
                    
                    
                    $size += $element['saved'][0]['dynamic_size'];
                    if($size <= 12)
                        $this->output[] = $this->$element['dynamic']($element);
                    if($size == 12){
                        $this->output[] = '</div>';
                        $size = 0;
                    }
                    
                    
                    
                    
				}
			}		
            
		}


                

        
		$this->setLayout();
    }
    /**
     * GenerateDynamicTemplate::display()
     * 
     * @return
     */
    function display(){
        global $controller;
        echo implode("\n\n", $this->output);
       
    }
    
    function testimonials($element){
        extract($element['saved'][0]);
        $output = '';
        
        $output = '<div class="span'.$dynamic_size.'">';
        
        $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';   
                              
        $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'testimonial' );                          
        $output .= '<div class="row-fluid">';
        $output .= ' <ul id="dynamic_testimonial">';
        $loop = new WP_Query($query_post);
                     if($loop->have_posts()){

                        while($loop->have_posts()){
                            
                            $loop->the_post();  
                            $stars = themeple_post_meta(get_the_ID(), 'stars_');
                            
                            $no_stars = 5-$stars;
                            $stars_html = '';
                            for($i = 1; $i <= $stars; $i++)
                                $stars_html .= '<i class="icon-star colored"></i>';
                            $no_stars_html = '';
                            for($i = 1; $i <= $no_stars; $i++)
                                $no_stars_html .= '<i class="icon-star"></i>';                                  

                                    		  $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 120, 'height' => 140), 'url');
							  $img_html = '' ;
							  if(isset($image_bool) && $image_bool == 'yes')
								$img_html = '<img src="'.$featured.'" alt="" />';
                                                   $output .= '<li class="'.( (isset($image_bool) && $image_bool == 'yes')?"with_img":"" ).'">'.$img_html.'<div class="content">'.get_the_content().' <div class="stars">'.$stars_html.$no_stars_html.'</div></div><span class="arrow"></span><span class="author">'.get_the_title().'</span><span class="position">'.themeple_post_meta(get_the_ID(), 'staff_position_' ).'</span></li>';
                                                                  
                                                 
                                    
                        }
                    }
        wp_reset_query();
        $output .= '</ul>';
        $output .= '</div></div>';
        return $output;
    }


    function column($element){
        extract($element['saved'][0]);
        $data = array();
        $query = array();
        $output = '<div class="span'.$dynamic_size.'">';
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['title'] = $dynamic_content_title;
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['title'] = get_the_title();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_query();
        }


        if(count($data) > 0){

            $output .='<div class="services-col">';
            if($dynamic_icon_req  == 'yes'){
                $output .= '<div class="icon"><span style="background-image:url(\''.$dynamic_icon.'\');"></span><span style="background-image:url(\''.$dynamic_icon_hover.'\');"></span></div>';
            }
                
            $output .='<div class="content">';
                $output .= '<h3><a href="'.$data['link'].'">'.$data['title'].'</a></h3>';
                $output .= '<p>'.$data['description'].'</p>';
                $output .= '<div class="sep_div"><span class="separator"></span></div>';
                $output .= '<a href="'.$data['link'].'" class="read-more">Read More</a>';
            $output .='</div>';


        
            
        }
        
        $output .= '</div>';
        $output .= '</div>';
        return $output;

    }



    function clients($element){
        extract($element['saved'][0]);
	 $cycle = 'cycle_client';
	 $dynamic_cycle = (isset($dynamic_cycle)?$dynamic_cycle:'');
        $cycle = 'cycle_client';
        $clients = themeple_get_option('client-logo');
        $output = '<div class="span'.$dynamic_size.' clients-container">';
        if(!empty($dynamic_title))
            $output .= '<div class="row-fluid"><div class="span12"><div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div></div></div>';  
        
        
        $output .= '<section class="row-fluid clients '.$cycle.'">';
        
        foreach($clients as $client):                            

                $output .= '                    <div class="item">
                                                    <a href="'.$client['link'].'">
                                                        <img src="'.$client['logo'].'" alt="">
                                                        <img src="'.$client['logo_hover'].'" alt="">
                                                    </a>
                                                </div>';
        endforeach;
                                    
        $output .= '</section>';
        

        $output .= '</div>';

        return $output;

    }


    function contact_info($element){
        extract($element['saved'][0]);
       
        $output = '<div class="span'.$dynamic_size.'">';
        if(!empty($dynamic_title))
            $output .= '<div class="row-fluid"><div class="span12"><div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div></div></div>';  
        
        
        $output .= '<section class="row-fluid">';
        
                                  
            $output .= '<div class="span12 contact_info">';
                $social_icons = themeple_get_option('social_icons');
                
                if(!empty($address))
                    $output .= '<p class="address">'.$address.'</p>';
                if(!empty($phone))
                    $output .= '<p>'.$phone.'</p>';
                if(!empty($fax))
                    $output .= '<p>'.$fax.'</p>';
                if(!empty($web))
                    $output .= '<p>'.$web.'</p>';

                $output .= '<ul class="social_icons">';
                    foreach($social_icons as $icon):



                        $output .= '<li class="'.$icon['social'].'"><a href="'.$icon['link'].'"><i class="icon-'.$icon['social'].'"></i></a></li>';



                    endforeach;



                $output .= '</ul>';


            $output .= '</div>';
        
                                    
        $output .= '</section>';
        

        $output .= '</div>';

        return $output;
    }




    

    
 
   



    function latest_blog($element){
        extract($element['saved'][0]);
        if($style == 'v1')
        	$posts_per_page = 9999;
	 elseif($style == 'v2'){
		if($desc_bool == 'yes'){
			$posts_per_page = 3;
		}else
			$posts_per_page = 4;
	 }

        $output = '<div class="span'.$dynamic_size.' latest_blog">';
	 if($style == 'v1') 
        	$output .= '<div class="row-fluid"><div class="span12"><div class="header"><h3>'.$dynamic_title.'</h3><div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next" title="Next"></a></div><span class="border_style_color"></span></div></div></div>';   
    	 else
		$output .= '<div class="row-fluid"><div class="span12"><div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div></div></div>'; 
	if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post' );                          
        }else{
    	   $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 
    	}
        	$size_span_class = '';
            if($desc_bool == 'yes'):
			   $size_span_class = 'little_small';
                        $output .= '<div class="row-fluid">';
                            $output .= '<div class="span3">';
                                $output .= '<h6 class="desc_title">'.$desc_title.'</h6>';
                                $output .= '<p>'.$desc_desc.'</p>';
                                if(isset($button_bool) && $button_bool == 'yes'):
                                    $output .= '<a class="button_left_desc" href="'.$button_link.'"><i class="'.$button_icon.'"></i> <span>'.$button_title.'</span></a>';
                                endif;
                            $output .= '</div>';
                            $output .= '<div class="span9">';

                     endif; 
            $output .= '<div class="row">';
                $output .= '<div class="span12">';
                    $output .= '<ul class="carousel carousel_blog">';
                        
                        $loop = new WP_Query($query_post);
                                    
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();

                                            $post_id = get_the_ID();      
                                                $post_format = get_post_format($post_id);

                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';

                                                if($post_format == 'standart'){
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
            }     

                                                $output .= '<li class="blog-article '.$size_span_class.'">';
                                                    
                                                $output .= '    <div class="row-fluid">';

                                                $output .= '        <div class="span12">';


                                                $output .= '            <div class="media">';


                                            if($style == 'v1'){
                                                if($post_format == 'audio'){
                                                    
                                                    $output .= do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]');




                                                }elseif($post_format == 'gallery'){

                                                      



                                                    $slider = new themeple_slideshow(get_the_ID(), 'flexslider_with_thumbnails');

                   

                                                    if($slider && $slider->slide_number > 0){

                                                        $sliderHtml = $slider->render_slideshow();

                                                        $output .= $sliderHtml;

                                                    }





                                                }elseif($post_format == 'video'){



                                                   

                                                    $video = ""; if(themeple_backend_is_file( get_the_excerpt(), 'html5video'))

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

                                                    $output .= $video;

                                                    





                                                    } elseif(get_post_thumbnail_id()){

                                                


                                                   
                                                    $output .= '<img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'featured_blog', 'url').'" alt="">';
                                                	   
                                                    }
							   $output .= '<div class="date"><span class="month">'.get_the_time('M').'</span><span class="day">'.get_the_time('d').'</span></div> ';
                                            $output .= '</div>';
                                        $output .= '</div>';
                                }else if($style == 'v2'){
					


	     


                                    $output .= '<img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'featured_blog', 'url').'" alt="">';
                                    $output .= '<div class="date_dyn"><span class="day">'.get_the_time('d').'</span><span class="month">'.get_the_time('M').'</span></div>';
                                    $output .= '<div class="type type-'.$post_format.'-img"><i class="icon-'.$icon_class.'"></i></div>';

                                }
                                $output .= '</div>';

                                $output .= '<div class="row-fluid">';
                                    $output .= '<div class="span12">';
                                        $output .= '<div class="content">';
                                            if($style == 'v1'):
                                            $output .= '<dl class="dl-horizontal">';
                                                $output .= '<dt><div class="v2_type type-'.$post_format.'-img"><i class="icon-'.$icon_class.'"></i></div></dt>';
                                                $output .= '<dd>';
                                                    $output .= '<h6 class="helvetica"><a href="'.get_permalink().'">'.get_the_title().'</a></h6>';
                                                    $output .= '<span class="inf">'.get_comments_number().' Comments</span>';
                                                $output .= '</dd>';
                                            $output .= '</dl>';
                                            endif;
                                            if($style == 'v2'):
                                                    $output .= '<h5 class="helvetica"><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
                                            endif;
                                                                                       

                                            

                                                        if($post_format == 'video' || $post_format == 'audio'){



                                                            $output .= themeple_content(13);



                                                        }else

                                                        $output .= themeple_content(13);
                                                        
                                            

                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';


                                $output .= '</li>';
                                           
                                            
                                        };
                                    };
                                    wp_reset_postdata();
                                    if($desc_bool == 'yes'):
                                        $output .= '</div>';
                                        $output .= '</div>';    

                                     endif;
                    $output .= '</div>';       
                
                
                


                
            $output .= '</div>';
        
        

        $output .= '</div>';


        return $output;
    }







    function recent_news($element){
        extract($element['saved'][0]);
        
        

        $output = '<div class="span'.$dynamic_size.' recent_news">';
        $output .= '<div class="row-fluid"><div class="span12"><div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div></div></div>';  
        if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post' );                          
        }else{
           $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 
        }
        

            $output .= '<div class="row-fluid">';
                $output .= '<div class="span12">';
                    	   
                        
                        $loop = new WP_Query($query_post);
                                    
                                     if($loop->have_posts()){
                                        while($loop->have_posts()){
                                            $loop->the_post();     
                                            $post_id = get_the_ID();      
                                                $post_format = get_post_format($post_id);

                                                if(strlen($post_format) == 0)
                                                    $post_format = 'standart';
						      if($post_format == 'standart'){
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
		    					}
                                                $output .= '<dl class="news-article dl-horizontal">';
                                                    
                                                    $output .= '<dt>';
                                                        $output .= '<div class="date"><span class="month">'.get_the_time('M').'</span><span class="day">'.get_the_time('d').'</span></div>';
                                                        $output .= '<div class="blog-image-type type-'.$post_format.'-img"><i class="icon-'.$icon_class.'"></i></div>';
                                                    $output .= '</dt>';
                                                    $output .= '<dd>';
                                                    $output .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
                                                    $output .= themeple_content(20);
                                                    $output .= '</dd>';

                                        
                                                $output .= '</dl>';

                                
                                           
                                            
                                        };
                                    };
                                    wp_reset_postdata();
                    $output .= '</div>';       
                
                
                


                
            $output .= '</div>';
        
        

        $output .= '</div>';


        return $output;
    }










    /**
     * GenerateDynamicTemplate::post_page_content()
     * 
     * @return
     */
    function post_page_content($element)
	{
        extract($element['saved'][0]);
        $content = '';
		$output = '<div class="span'.$dynamic_size.' post_page_cont">';
        if(isset($dynamic_title) && !empty($dynamic_title))
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';     
		switch($dynamic_which_post_page)
		{
			case'post': $query_id = $dynamic_post_id; $type ='post'; break;
			case'page': $query_id = $dynamic_page_id; $type ='page'; break;
			case'self': $query_id = $this->post_id;	  $type = get_post_type( $this->post_id ); break;
		}

		$query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );
		$additional_loop = new WP_Query($query_post);
		
		if($additional_loop->have_posts())
		{
			
			while ($additional_loop->have_posts())
			{ 
				$additional_loop->the_post();
				
				if($dynamic_which_post_page != 'self' && $query_id != $this->post_id)
				{
					global $more;
					$more = 0;
				}
						
				
				if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)
				{
					$content = get_the_content();
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				}
				
				
				
				
			     
				    $output .= $content;
				 
                
                
			}
			
		}
		
		wp_reset_query();
        $output .= '</div>';
	
		return $output;
	}


    function services($element)
    {
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if($dynamic_shadow == 'yes')
        $output .= '<div class="divider_shadow dynamic_el"><h3 class="block-title">'.$dynamic_title.'</h3><span class="block-desc">'.$dynamic_desc.'</span><div class="arrow-holder left"><span></span></div><div class="arrow-holder right"><span></span></div></div>';
        $cat = -1;
        if($dynamic_services_categories == 'one')
            $cat = $dynamic_services_category;
        $query_post = array( 'cat' => $cat, 'posts_per_page'=>9999, 'post_type'=> 'services' );
        $additional_loop = new WP_Query($query_post);
        $output .= '<div class="touchcarousel">';
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                $content = apply_filters('the_content', $content);
                $content = str_replace(']]>', ']]&gt;', $content);
                $image_pos = themeple_post_meta(get_the_ID(), 'service_image');
                $lightboxes = themeple_post_meta(get_the_ID(), 'slideshow');
                
                $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 800, 'height' => 800), 'url');
                
                 $output .= '<section class=" one-service touchcarousel-item">';
                 
                 $output .= '<div class="row-fluid">';
                    if($image_pos == 'left'):

                        $output .= '<div class="span6"><a class="serv_img" href="'.$featured.'"><img  title="img" src="'.$featured.'" alt=""></a></div>';

                    endif;
                    $output .= '<div class="span6">';
                        $output .= '<h1>'.get_the_title().'</h1>';
                        $output .= '<p>'.$content.'</p>';
                        $output .= '<div class="row-fluid">';
                            foreach($lightboxes as $box):
                                
                                $image_string = get_the_post_thumbnail($box['slideshow_image'],'services-thumb');
                                $link = themeple_image_by_id($box['slideshow_image'], array('width'=>1024,'height'=>1024), 'url');
                                if(!empty($box['slideshow_video']))
                                    $link = $box['slideshow_video'];
                                $type = 'gallery';

                                if(!empty($box['slideshow_video']))
                                    $type = 'media'; 
                                
                                $output .= '    <div class="thumbnail_service">';
                                $output .= '        <a class="lightbox-'.$type.'" href="'.$link.'">';
                                $output .= '            <div class="visual lightbox">';
                                $output .= $image_string;
                                $output .= '            </div>';
                                $output .= '        </a>';
                                $output .= '    </div>';
                            endforeach;
                        
                        $output .= '</div>';
                    $output .= '</div>';
                    if($image_pos == 'right'):

                        $output .= '<div class="span6"><a class="serv_img" href="'.$featured.'"><img title="img" src="'.$featured.'" alt=""></a></div>';

                    endif;
                $output .= '</div>';
                $output .= '</section>';
                
                
            }
            
        }
        $output .= '</div>';
        $output .= '</div>';
        wp_reset_query();

    
        return $output;
    }


    function headers($element)
    {
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if(!isset($dynamic_title))
            $dynamic_title = '';
        if(!isset($dynamic_desc))
            $dynamic_desc = '';
        if($dynamic_shadow == 'yes')
        $output .= '<div class="divider_shadow dynamic_el"><h3 class="block-title">'.$dynamic_title.'</h3><span class="block-desc">'.$dynamic_desc.'</span></div>';
        $post = isset($dynamic_header_post)?$dynamic_header_post:0;
        
        if($post != 0){   
        $query_post = array( 'p' => $post, 'posts_per_page'=>1, 'post_type'=> 'header' );
        $additional_loop = new WP_Query($query_post);
        $output .= '<div class="dynamic_element">';
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                
                $media_position = themeple_post_meta(get_the_ID(), 'media_position');
                $video = themeple_post_meta(get_the_ID(), 'video_link');
                $button_title = themeple_post_meta(get_the_ID(), 'button_title');
                $button_link = themeple_post_meta(get_the_ID(), 'button_link');
                $button_align = themeple_post_meta(get_the_ID(), 'button_align');
                $list = themeple_post_meta(get_the_ID(), 'list_elements');
                $visual = themeple_post_meta(get_the_ID(), 'media_box');
                
                if($visual == 'yes') $visual = 'visual'; else $visual = '';
                $featured = themeple_image_by_id(get_post_thumbnail_id(), 'header-thumb', 'url');
                
                 $output .= '<section class=" top_header_element">';
                 
                 $output .= '<div class="row-fluid">';
                    if($media_position == 'left'):

                        $output .= '<div class="span6"><div class="'.$visual.'"><div class="visual_image">';
                        if(empty($video) && !empty($featured)){
                            $output .= '<img src="'.$featured.'" alt="" />';
                        }elseif(!empty($video) && empty($featured)){
                            if(themeple_backend_is_file($video, 'html5video'))
                            {
                                $video = themeple_html5_video_embed($slide['slideshow_video']);
                            }
                            else if(strpos($video,'<iframe') !== false)
                            {
                                $video = $video;
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($video)."[/embed]");
                            }
                            
                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.$video.'"></iframe>';
                            }

                            $output .= $video;
                        }
                        $output .= '</div></div></div>';

                    endif;
                    $output .= '<div class="span6">';
                        $output .= '<h1>'.get_the_title().'</h1>';
                        $output .= '<p>'.$content.'</p>';
                        $output .= '<div class="row-fluid">';
                        if(count($list) > 0)
                            $output .= '<ul>';
                            foreach($list as $li):
                                
                                $output .= '<li class="span6"><a href="'.$li['list_link'].'">'.$li['list_title'].'</a></li>';
                                
                            endforeach;
                        if(count($list) > 0)    
                            $output .= '</ul>';
                        
                        $output .= '</div>';
                        if(!empty($button_title)){
                            $output .= '<div class="row-fluid"><a class="button_top_header '.$button_align.'" href="'.$button_link.'">'.$button_title.'</a></div>';
                        }

                    $output .= '</div>';
                    if($media_position == 'right'):

                        $output .= '<div class="span6"><div class="'.$visual.'"><div class="visual_image">';
                        if(empty($video) && !empty($featured)){
                            $output .= '<img src="'.$featured.'" alt="" />';
                        }elseif(!empty($video) && empty($featured)){
                            if(themeple_backend_is_file($video, 'html5video'))
                            {
                                $video = themeple_html5_video_embed($slide['slideshow_video']);
                            }
                            else if(strpos($video,'<iframe') !== false)
                            {
                                $video = $video;
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($video)."[/embed]");
                            }
                            
                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.$video.'"></iframe>';
                            }

                            $output .= $video;
                        }
                        $output .= '</div></div></div>';

                    endif;
                $output .= '</div>';
                $output .= '</section>';
                
                
            }
            
        }
        $output .= '</div>';
        $output .= '</div>';
            wp_reset_query();
        }
    
        return $output;
    }

    function staff($element)
    {
        extract($element['saved'][0]);
        $output = '';
        if(isset($staff)){
        $output .= '<div class="span'.$dynamic_size.'">';
       
        $query_post = array( 'p' => $staff, 'posts_per_page'=>1, 'post_type'=> 'staff' );
        $additional_loop = new WP_Query($query_post);
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                
                
                $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 220, 'height' => 195), 'url');
                $staff_position = themeple_post_meta(get_the_ID(), 'staff_position_');
                 $output .= '<div class="one-staff">';
                 
                            $output .= '<img src="'.$featured.'" alt="">';
                            $output .= '<h6 class="helvetica">'.get_the_title().'</h6>';
                            $output .='<p>'.$staff_position.'</p>';
                            $output .= '<p class="c">'.$content.'</p>';    
                              $output .= '<div class="social">'; 
                                $output .= '<ul class="social_icons">';
                                if(themeple_post_meta(get_the_ID(), 'facebook_link') != '')
                                    $output .= '<li class="facebook"><a href="'.themeple_post_meta(get_the_ID(), 'facebook_link').'" title="Facebook"><i class="icon-facebook"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'twitter_link') != '')
                                    $output .= '<li class="twitter"><a href="'.themeple_post_meta(get_the_ID(), 'twitter_link').'" title="Twitter"><i class="icon-twitter"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'google_link') != '')
                                    $output .= '<li class="google"><a href="'.themeple_post_meta(get_the_ID(), 'google_link').'" title="Google"><i class="icon-google-plus"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'pinterest_link') != '')
                                    $output .= '<li class="pinterest"><a href="'.themeple_post_meta(get_the_ID(), 'pinterest_link').'" title="Pinterest"><i class="icon-pinterest"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'linkedin_link') != '')
                                    $output .= '<li class="linkedin"><a href="'.themeple_post_meta(get_the_ID(), 'linkedin_link').'" title="Linkedin"><i class="icon-linkedin"></i></a></li>';
                                
                                $output .= '<ul>';
                 
                 $output .= '</div></div>';
                
            }
            
        }
        
        $output .= '</div>';
        wp_reset_query();
        }
    
        return $output;
    }

    function head_text($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        $output .= '';
        if(!isset($dynamic_head_texttitle))
            $dynamic_head_texttitle = '';
        if(!isset($dynamic_head_text_description))
            $dynamic_head_text_description = '';
        $output .= '<div class="row-fluid head_text">';
            $output .= '<div class="span12"><h1>'.$dynamic_head_text_title.'</h1><h4>'.$dynamic_head_text_description.'</h4></div>';

        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function divider($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' '.(($dynamic_row == 'yes')?"divider_row_top":"").' ">';
        if(!isset($dynamic_title))
            $dynamic_title = '';
        if(!isset($dynamic_description))
            $dynamic_description = '';
        if($dynamic_shadow == 'yes')
        $output .= '<div class="divider_shadow dynamic_el '.((isset($carousel) && $carousel == 'yes')?"touchcarousel-dynamic":"").'"><h3 class="block-title">'.$dynamic_title.'</h3><span class="block-desc">'.$dynamic_description.'</span></div>';
        $output .= '</div>';
        return $output;
    }


    function recent_portfolio($element){
        extract($element['saved'][0]);
        $classs = '';
                                if(themeple_get_option('dynamic_greyscale') == 'yes')
                                    $classs=  'image-desaturate';
        $output = '<div class="span'.$dynamic_size.' recent_portfolio '.$classs.'">';
	    $rows = 1;
        if(!isset($dynamic_title))
            $dynamic_title = '';
        if(!isset($dynamic_desc))
            $dynamic_desc = '';
        if(isset($dynamic_num_rows))
            $rows = $dynamic_num_rows;
        
        $output .= '<div class="row-fluid"><div class="span12"><div class="header"><h3>'.$dynamic_title.'</h3><div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next" title="Next"></a></div><span class="border_style_color"></span></div></div></div>';    
        $columns = $dynamic_block_size;   
        $grid = 'three-cols';
                    switch($columns){
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
        $item_grid_class = 12/$columns;
                     $alg = 12/$dynamic_size;
                     $item_grid_class *=$alg;

        $posts_per_page = 9999;
        $posts_per_page = 12/$item_grid_class;
        if($rows == 1){
            $coe = 9999;
        }else{
            $coe = 2*$columns;
        }
            

			if($dynamic_from_where == 'all_cat'){
                    $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'portfolio' );
}else{
	$category = get_term($dynamic_cat, "portfolio_entries");
	$query_post = array('posts_per_page'=> 9999, 'post_type'=> 'portfolio',  'taxonomy' => 'portfolio_entries', 'portfolio_entries' => $category->slug );
}
                     $number_col = 0;
                     $number_display = 0;
                     if($dynamic_size == 12){
                        $number_col = 2;
                        $number_display = 2;
                     }elseif($dynamic_size == 2){
                        $number_col = 0;
                        $number_display = 0; 
                     }elseif($dynamic_size == 3){
                        $number_col = 4;
                        $number_display = 1; 
                     }elseif($dynamic_size == 4){
                        $number_col = 3;
                        $number_display = 1 ;
                     }elseif($dynamic_size == 5){
                        $number_col = 3;
                        $number_display = 1 ;
                     }elseif($dynamic_size == 6){
                        $number_col = 2;
                        $number_display = 1 ;
                     }elseif($dynamic_size == 7){
                        $number_col = 4;
                        $number_display = 2 ;
                     }elseif($dynamic_size == 8){
                        $number_col = 4;
                        $number_display = 3 ;
                     }elseif($dynamic_size == 9){
                        $number_col = 4;
                        $number_display = 3 ;
                     }elseif($dynamic_size == 10){
                        $number_col = 4;
                        $number_display = 3 ;
                     }
                     

                     
                     $output .= '<section id="portfolio-preview-items" class="row '.$grid.'">';

                     
                    $output .= '<div class="carousel carousel_portfolio">';
                     $item_grid_class = 12/$columns;
                     $alg = 12/$dynamic_size;
                     $item_grid_class *=$alg;
                     $loop = new WP_Query($query_post);
                     $i = 0;
                     if($loop->have_posts()){
                        while($loop->have_posts()){
                            $i++;
                            $loop->the_post();
                            $id =  get_the_ID();
                            
                            $the_id     = get_the_ID();
        
                            $sort_classes = "";
                            $item_categories = get_the_terms( $the_id, 'portfolio_entries' );
                        
                            if(is_object($item_categories) || is_array($item_categories))
                            {
                                foreach ($item_categories as $cat)
                                {
                                    $sort_classes .= $cat->slug.' ';
                                }
                            }       
                            if($number_col > 0 && $number_display > 0){
                                
                             $output .='<div class="portfolio-item">'; 
                                     $output .= '<div class="he-wrap tpl2">';
                                     $output .=' <img src="'.themeple_image_by_id(get_post_thumbnail_id(), 'port'.$columns, 'url').'" alt="">';  
                                     $output .='   <div class="overlay he-view">';
                                            
                                     $output .='       <div class="bg a0" data-animate="fadeIn">';
                                     $output .='           <div class="center-bar">';
                                                   
                                     $output .='               <a href="'.get_permalink().'" class="link a0" data-animate="elasticInDown"><span></span></a>';
                                     $output .='               <a href="'.themeple_image_by_id(get_post_thumbnail_id(), array('width'=> 1200, 'height' => 1200), 'url').'" class="lightbox a1 lightbox-gallery" data-animate="elasticInDown"><span></span></a>';
                                     $limit_ = 19; if($item_grid_class == 3) $limit_ = 10;
                                     
					  $output .='                <p class="short_desc">'.themeple_excerpt($limit_).'</p>';               
                                     $output .='            </div>';
                                     $output .='        </div>';    
                                     $output .='    </div>';
                                    $output .=' </div>';
                                    
                                    $output .='<div class="project">';
                                    $output .='    <h6 class="helvetica"><a href="'.get_permalink( ).'">'.get_the_title().'</a></h6>';
                                    $output .='       <span class="category">'.$sort_classes.'</span>';
                                    $output .='</div>';
     
                             $output .= '</div>';


                            }
                          
                        }
                    }
                    
                    $output .= '</div>';
                    $output .= '</section>';

                   
                    wp_reset_query();

                    
        
        

        
        $output .= '</div>';
        return $output;
    }
 


    function team_carousel($element){
        extract($element['saved'][0]);
        $classs = '';
        $output = '<div class="span'.$dynamic_size.' team_carousel '.$classs.'">';
        
        $output .= '<div class="row-fluid"><div class="span12"><div class="header"><h3>'.$dynamic_title.'</h3><div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next" title="Next"></a></div><span class="border_style_color"></span></div></div></div>'; 
          
        
            

          
        $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'staff' );

                     
                     

                     if($desc_bool == 'yes'):
                        $output .= '<div class="row-fluid">';
                            $output .= '<div class="span3">';
                                $output .= '<h6 class="desc_title">'.$desc_title.'</h6>';
                                $output .= '<p>'.$desc_desc.'</p>';
                                if($button_bool == 'yes'):
                                    $output .= '<a class="button_left_desc" href="'.$button_link.'"><i class="'.$button_icon.'"></i> <span>'.$button_title.'</span></a>';
                                endif;
                            $output .= '</div>';
                            $output .= '<div class="span9">';

                     endif;
                    

                    $output .= '<div class="row">' ;
                    $output .= '<div class="carousel carousel_staff">';
                     
                     $loop = new WP_Query($query_post);
                     $i = 0;
                     if($loop->have_posts()){
                        while($loop->have_posts()){
                            $i++;
                            $loop->the_post();
                            $id =  get_the_ID();
                            
                            $the_id     = get_the_ID();
        
                            $sort_classes = "";
                            $item_categories = get_the_terms( $the_id, 'portfolio_entries' );
                        
                            if(is_object($item_categories) || is_array($item_categories))
                            {
                                foreach ($item_categories as $cat)
                                {
                                    $sort_classes .= $cat->slug.' ';
                                }
                            }       
                            
                                
                             $content = get_the_content();
                
                
                $featured = themeple_image_by_id(get_post_thumbnail_id(), array('width' => 220, 'height' => 195), 'url');
                $staff_position = themeple_post_meta(get_the_ID(), 'staff_position_');
                 $output .= '<div class="one-staff">';
                 
                            $output .= '<img src="'.$featured.'" alt="">';
                            $output .= '<h6 class="helvetica">'.get_the_title().'</h6>';
                            $output .='<p>'.$staff_position.'</p>';
                            $output .= '<p class="c">'.$content.'</p>';    
                              $output .= '<div class="social">'; 
                                $output .= '<ul class="social_icons">';
                                if(themeple_post_meta(get_the_ID(), 'facebook_link') != '')
                                    $output .= '<li class="facebook"><a href="'.themeple_post_meta(get_the_ID(), 'facebook_link').'" title="Facebook"><i class="icon-facebook"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'twitter_link') != '')
                                    $output .= '<li class="twitter"><a href="'.themeple_post_meta(get_the_ID(), 'twitter_link').'" title="Twitter"><i class="icon-twitter"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'google_link') != '')
                                    $output .= '<li class="google"><a href="'.themeple_post_meta(get_the_ID(), 'google_link').'" title="Google"><i class="icon-google-plus"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'pinterest_link') != '')
                                    $output .= '<li class="pinterest"><a href="'.themeple_post_meta(get_the_ID(), 'pinterest_link').'" title="Pinterest"><i class="icon-pinterest"></i></a></li>';
                                if(themeple_post_meta(get_the_ID(), 'linkedin_link') != '')
                                    $output .= '<li class="linkedin"><a href="'.themeple_post_meta(get_the_ID(), 'linkedin_link').'" title="Linkedin"><i class="icon-linkedin"></i></a></li>';
                                $output .= '</ul>';
                 
                 $output .= '</div></div>';


                            
                          
                        }
                    }
                    
                    
                    $output .= '</div></div>';

                    if($desc_bool == 'yes'):
                        $output .= '</div>';
                        $output .= '</div>';    

                     endif;
                    wp_reset_query();

                    
        
        

        
        $output .= '</div>';
        return $output;
    }



    function services_full($element){
        extract($element['saved'][0]);
       
        $output = '<div class="span'.$dynamic_size.' services_full">';
        
        $output .= '<div class="header"><h6>'.$dynamic_title.'</h6></div>';    
          
        
                    if($desc_bool == 'yes'):
                        $output .= '<div class="row-fluid">';
                            $output .= '<div class="span3">';
                                $output .= '<h2 class="desc_title">'.$desc_title.'</h2>';
                                $output .= '<p>'.$desc_desc.'</p>';
                                if($button_bool == 'yes'):
                                    $output .= '<a class="button_left_desc" href="'.$button_link.'"><i class="'.$button_icon.'"></i> <span>'.$button_title.'</span></a>';
                                endif;
                            $output .= '</div>';
                            $output .= '<div class="span9">';

                     endif;
                    

                    $output .= '<ul>';
                    if(count($services) > 0){
                        foreach($services as $s):

                            $output .= '<li class="services_medium">';
                                $icon_class = ((isset($icon_bool) && $icon_bool == 'yes')?'with_icon':'no_icon');
                                    $data = array();
                                    $query = array();
                                    $data['link'] = '';
                                    $data['description'] = '';
                                    if($s['dynamic_content_type'] == 'page'){
                                        $query = array( 'p' => $s['dynamic_page'], 'posts_per_page'=>1, 'post_type'=> 'page' );
                                    }
                                    if($s['dynamic_content_type'] == 'post'){
                                        $query = array( 'p' => $s['dynamic_post'], 'posts_per_page'=>1, 'post_type'=> 'post' );
                                    }
                                    if($s['dynamic_content_type'] == 'content'){
                                        $data['description'] = $s['dynamic_content_content'];
                                        $data['link'] = $s['dynamic_content_link'];
                                    }else{
                                        $loop = new WP_Query($query);
                                        if($loop->have_posts()){
                                            while($loop->have_posts()){
                                                $loop->the_post();
                                                
                                                $data['link'] = get_permalink();
                                                $data['description'] = get_the_excerpt();
                                                
                                            }
                                        }
                                        wp_reset_query();
                                    }

                                    
                                        if($s['icon_bool'] == 'yes' && !empty($s['icon'])):
                                            
                                            $output .= '<i class="'.$s['icon'].' icon"></i>';
                                            

                                        endif;
                                    $output .= '<h2><a href="'.$data['link'].'">'.$s['title'].'</a></h2>';
                                    $output .= '<p>'.$data['description'].'</p>';
                                    $output .= '<a class="link" href="'.$data['link'].'">'.$s['link_title'].'</a>';
                            $output .= '</li>';

                        endforeach;
                    }

                    $output .= '</ul>';
                     
                    if($desc_bool == 'yes'):
                        $output .= '</div>';
                        $output .= '</div>';

                    endif;

        
        $output .= '</div>';
        return $output;
    }


    function widget($element){
        ob_start();
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        if(isset($dynamic_title) && !empty($dynamic_title))
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';    
        
        dynamic_sidebar("Dynamic Template: Widget ".$dynamic_sidebar);
        

        $output .= ob_get_clean();
        $output .= '</div>';
        return $output;
    }
    
    function home_blog($element){
       ob_start();
       extract($element['saved'][0]);
       $output = '<div class="span'.$dynamic_size.'">';
       if(isset($dynamic_title) && !empty($dynamic_title)) 
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';
       
         query_posts('posts_per_page = 3' );
       
         get_template_part( 'template_inc/loop', 'index');
        wp_reset_query();
        $output .= ob_get_clean();
        $output .= '</div>';
        return $output;
    }

   function home_portfolio ($element){
        ob_start();
        extract($element['saved'][0]);
        global $portfolio_p;
        global $themeple_config; 
        $output = '<div class="span'.$dynamic_size.'">';
        $portfolio_p = $portfolio_selected;
       
       

        if(isset($portfolio_p) && $portfolio_p != ''){
        $used_template_p = themeple_get_option_array('portfolio', 'portfolio_page', $portfolio_p, true); 
       
           }



      

   
        
       if(isset($used_template_p)){
            $used_template = $used_template_p; }

        $cats_port = $used_template['portfolio_cats'];
       
        $args = array(
        'taxonomy'  => 'portfolio_entries',
        'hide_empty'=> 0,
        'include'   =>  $cats_port
            );
        $themeple_config['current_sidebar'] = 'fullsize';
        $categories = get_categories($args);
        
        if(count($categories) > 0){
        $output .='<!-- Portfolio Filter --><nav id="portfolio-filter" class="span12">';
           $output .= '<ul class="">';
             $output .= '<li class="active all"><a href="#"  data-filter="*">'.__('View All', 'themeple').'</a><span></span></li>';
                
            foreach($categories as $cat):
                
                   $output .= '<li class="other"><a href="#" data-filter=".'.$cat->category_nicename.'">'.$cat->cat_name.'</a><span></span></li>';    
                
            endforeach;
            
         $output .='</ul>';
     $output .= '</nav>';
       } 
     
       $themeple_config['current_portfolio']['portfolio_columns']  = $dynamic_columns;
        $grid = 'three-cols';
       switch($dynamic_columns){
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
      
    $spancontent = 12;
       $output .= '<div class="row-fluid">';
       $output .='<section id="portfolio-preview-items" class="'.$grid.' span'.$spancontent.' ">';
       wp_reset_query();
       query_posts( 'post_type=portfolio&posts_per_page=9999' );
       get_template_part( 'template_inc/loop', 'portfolio-grid');
	
       wp_reset_query();
       $output .= ob_get_clean();
       $output .= '</section>';
       $output .= '</div>';
       
       $output .= '</div>';
       return $output;

    }
    function contact_form($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' contact_form">';
        $attr = array(
            "success" => '<p>'.$dynamic_msg.'</p>',
            "submit"  => $dynamic_submit,
            "submit_class" => "more-large",
            "form_class" => "standard-form",
            "action"  => get_permalink(),
            "myemail" => themeple_get_option('email'),
            "myblogname" => get_option('blogname'),
            "autoresponder" => themeple_get_option('autoresponder'),
            "autoresponder_subject" => themeple_get_option('autoresponder_subject'),
            "autoresponder_email" => themeple_get_option('email')
        );
        $custom_elements = themeple_get_option('contact_elements');
    
    
        $elements = array();
        if(is_array($custom_elements))
        {
            foreach($custom_elements as $new_element)
            {
                $elements[strtolower( $new_element['label'] ) ] = $new_element;
            }
        }
        $contact_form = new themeple_form($attr);
        $contact_form->create_elements($elements);
        if(!empty($dynamic_title))
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';
        $output .= '<div class="row-fluid">';
            
                $output .= '<div class="row-fluid">';
                    $output .= '<div class="span12">';
                    if(!empty($desc))
                        $output .= '<p class="desc">'.$desc.'</p>';
        $output .= $contact_form->display_form();
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function google_map($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        $output .= '<div class="row-fluid row-google-map"><iframe class="googlemap" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$dynamic_src.'&amp;output=embed"></iframe><span class="big_shadow"></span></div>';
        
        $output .= '</div>';
        return $output;
    }

    function plain_text($element){
        extract($element['saved'][0]);

        $output = '<div class="span'.$dynamic_size.' plain_text">';
        if(!empty($dynamic_title))
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';
        if(count($blocks) > 0){
            foreach($blocks as $block):
                if(!empty($block['block_title'])){
                     $style_css = '';
			if(!empty($block['icon'])){
                        $output .= '<div class="icon"><span class="iconset-32-'.$block['icon'].'"></span></div>';
			   $style_css = ' style="width:94%;" ';	
			}
                    $output .= '<h6 '.$style_css.'>'.$block['block_title'].'</h6>';
                }
                $output .= '<p>'.$block['block_text'].'</p>';
               
            endforeach;
        }
        
        $output .= '</div>';
        return $output;
    }

    function toggle($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        $nr = rand();
        if(isset($dynamic_title) && !empty($dynamic_title))  
        $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';   
        if(count($toggles) > 0){
            $output .= '<div class="accordion" id="accordion'.$nr.'">';
			$i = 0; 
            foreach($toggles as $toggle):
				$i++;
                $output .= '<div class="accordion-group">';
                    $output .= '<div class="accordion-heading '.( ($i==1)?"in_head":"").'">';
                    $id = rand(0, 50000);
                        $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$nr.'" href="#toggle'.$id.'">'.$toggle['title'].'</a>';
                    $output .= '</div>';
                    $output .= '<div id="toggle'.$id.'" class="accordion-body collapse  '.( ($i==1)?"in":"").'">';
                        $output .= '<div class="accordion-inner">';
                            $output .= $toggle['desc'];
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            endforeach;
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }


    function tabs($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        $nr = rand();
        if(isset($dynamic_title) && !empty($dynamic_title))      
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>';     
        if(count($tabs) > 0){
            $output .= '<div class="tabbable tabs-top">';
            $output .= '<ul class="nav nav-tabs">';
            $i = 0;
            foreach($tabs as $tab):
                $i++;
                $output .= '<li class="'.(($i == 1)?'active':'').'"><a href="#tab'.$i.'" data-toggle="tab" class="'.$tab['icon_bool'].'">';
                if($tab['icon_bool']=='title')
                    $output .= $tab['title'];
                else
                    $output .= '<i class="'.$tab['icon'].' icon"></i>';
                $output .= '</a></li>';
            endforeach;
            $output .= '</ul>';
            $output .= '<div class="tab-content">';
            $u = 0;
	     global $wp_embed;
	    
            foreach($tabs as $tab):
                $u++;
                $output .= '<div class="tab-pane '.(($u == 1)?'active':'').'" id="tab'.$u.'">';
                $output .= do_shortcode($tab['desc']); 
                $output .= '</div>';
            endforeach;
            $output .= '</div>';
            $output .= '</div>';
        }
        
        $output .= '</div>';
        return $output;
    }


    function skills($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        
        if(isset($dynamic_title) && !empty($dynamic_title))
            $output .= '<div class="header"><h3>'.$dynamic_title.'</h3><span class="border_style_color"></span></div>'; 
        if(isset($dynamic_desc) && !empty($dynamic_desc))
            $output .= '<p>'.$dynamic_desc.'</p>';

        if(count($skills) > 0){
            foreach($skills as $skill){
                    
                    $output .= '<div class="skill">';
                                    $output .= '<div class="percentage_circle"><span class="circle2"><span class="circle3"><span class="circle4"></span></span></span><span class="circle5"><span>'.$skill['percentage_skill'].'%</span></span></div>';
                                    $output .= '<span class="title"> </span>';
                                    $output .= '<div class="progress progress-striped active">';
                                        $output .= '<div class="bar" style="width: '.$skill['percentage_skill'].'%;"></div>';
                                        $output .= '<span class="">'.$skill['title'].'</span>';
                                    $output .= '</div>';
                    $output .= '</div>';
            }
        }
        $output .= '</div>';
        return $output;
    }
   
    function textbar($element){
        extract($element['saved'][0]);
        $class = '';
        if(!empty($image))
            $class .= 'with_image';
        $output = '<div class="span'.$dynamic_size.' textbar-container">';
            $output .= '<div class="textbar '.$class.'">';
            $output .= '<div class="container">';
            $output .= '    <div class="row-fluid">';
            $output .= '        <div class="span6">';
                if(!empty($image)){
                    $output .= '<div class="img_div"><img src="'.$image.'" /></div>';
                }
                $output .= '        <h4>'.$title.'</h4>';
                $output .= '        <span class="desc">'.$desc.'</span>';
            
            $output .= '        </div>';
            $output .= '        <div class="span6">';
                $output .= '        <h4>'.$title_2.'</h4>';
                $output .= '        <span class="desc">'.$desc_2.'</span>';
            if($button_bool == 'yes')
                    $output .= '<a href="'.$button_link.'" class="textbtn base_btn pull-right">'.$button_title.'</a>';            
            
            $output .= '        </div>';
            $output .= '         <span class="headgradient"></span>';
            
            $output .= '    </div>';
            $output .= '</div>';
            $output .= '<div class="header_shadow"></div>';   
                
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    function services_list($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_list">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        $output .= '<dl class="dl-horizontal">';
            if($icon_bool == 'yes' && !empty($icon)):
                $output .= '<dt>';
                    $output .= '<i class="'.$icon.' icon"></i>';
                $output .= '</dt>';
            endif;
            $output .= '<dd class="'.$icon_class.'">';
                $output .= '<h4>'.$title.'</h4>';
                
                if(isset($list) && count($list) > 0){
                    $output .= '<ul>';
                    foreach($list as $l):
                        $output .= '<li><i class="icon-angle-right"></i>'.$l['title'].'</li>';
                    endforeach;
                    $output .= '</ul>';
                }

            $output .= '</dd>';
        $output .= '</dl>';
        $output .= '</div>';
        return $output; 
    }

    function services_small($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_small">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        $data = array();
        $data['link'] = '';
        $data['description'] = "";
        $query = array();
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_query();
        }

        $output .= '<dl class="dl-horizontal">';
            if($icon_bool == 'yes'):
                $output .= '<dt>';
                    $output .= '<i class="'.$icon.' icon"></i>';
                $output .= '</dt>';
            endif;
            $output .= '<dd class="'.$icon_class.'">';
                $output .= '<h4>'.$title.'</h4>';
                $output .= '<p>'.$data['description'].'</p>';
                $output .= '<a href="'.$data['link'].'" class="pull-left">Read more</a>';
            $output .= '</dd>';
        $output .= '</dl>';
        
        $output .= '</div>';
        return $output; 
    }

    function services_medium($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_medium">';
        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        $data = array();
        $query = array();
        $data['link'] = '';
        $data['description'] = '';
        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $dynamic_content_content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_query();
        }

        
            if($icon_bool == 'yes' && $icon_bool_pred == 'yes' && !empty($icon)):
               
                $output .= '<div class="icon_medium"><div class="inner_icon"><i class="'.$icon.' icon"></i></div></div><span class="shadow"></span>';
                

            endif;

            if($icon_bool == 'yes'  && $icon_bool_pred == 'no' && !empty($icon_up)):
               
                $output .= '<div class="icon_medium"><div class="inner_icon"><span class="icon_up" style="background:url(\''.$icon_up.'\') center no-repeat;"></span><span class="shadow"></span></div></div>';
                

            endif;

        $output .= '<h4><a href="'.$data['link'].'">'.$title.'</a></h4>';
        $output .= '<p>'.$data['description'].'</p>';
        $output .= '<a class="link base_btn" href="'.$data['link'].'">'.$link_title.'</a>';
        $output .= '</div>';
        return $output; 
    }

    function services_steps($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.' services_steps">';
        
        foreach($steps as $s):
            $output .= '<div class="step">';
                $output .= '<div class="title-round"><h3>'.$s['title'].'</h3><div class="number-round"><h2>'.$s['number'].'</h2></div></div>';
                $output .= '<h4>'.$s['title_two'].'</h4>';
                $output .= '<p>'.$s['desc'].'</p>';
            $output .= '</div>';
        endforeach;
        $output .= '<div class="step result">';
                $output .= '<div class="title-round"><h3>'.$title.'</h3><div class="number-round"><h2>'.$number.'</h2></div></div>';
                $output .= '<h4>'.$title_two.'</h4>';
                $output .= '<p>'.$desc.'</p>';
            $output .= '</div>';

        
        $output .= '</div>';
        return $output; 
    }


    function faq ($element){
        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';

        $args = array(
            'taxonomy'  => 'faq_entries',
            'hide_empty'=> 0
        );

        $categories = get_categories($args);
         
        if(count($categories) > 0){
            $output .='<!-- Portfolio Filter --><nav id="faq-filter" class="span12">';
               $output .= '<ul class="">';
                 $output .= '<li class="active all"><a href="#"  data-filter="*">'.__('View All', 'themeple').'</a><span></span></li>';
                    
                foreach($categories as $cat):
                    
                       $output .= '<li class="other"><a href="#" data-filter=".'.$cat->category_nicename.'">'.$cat->cat_name.'</a><span></span></li>';    
                    
                endforeach;
                
                $output .='</ul>';
            $output .= '</nav>';
       }
       $nr = rand(0, 5000);
    if($desc_bool == 'yes'):
                        $output .= '<div class="row-fluid">';
                            $output .= '<div class="span3">';
                                $output .= '<h6 class="desc_title">'.$desc_title.'</h6>';
                                $output .= '<p>'.$desc_desc.'</p>';
                                if(isset($button_bool) && $button_bool == 'yes'):
                                    $output .= '<a class="button_left_desc" href="'.$button_link.'"><i class="'.$button_icon.'"></i> <span>'.$button_title.'</span></a>';
                                endif;
                            $output .= '</div>';
                            $output .= '<div class="span9">';

                     endif;   
    $output .= '<div class="accordion faq" id="accordion'.$nr.'">';
       $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'faq' );
       $loop = new WP_Query($query_post);
       if($loop->have_posts()){
            while($loop->have_posts()){
                           
                $loop->the_post();
                $sort_classes = "";
                $item_categories = get_the_terms( get_the_ID(), 'faq_entries' );
            
                if(is_object($item_categories) || is_array($item_categories))
                {
                    foreach ($item_categories as $cat)
                    {
                        $sort_classes .= $cat->slug.' ';
                    }
                }
                   
                    $output .= '<div class="accordion-group '.$sort_classes.'">';
                        $output .= '<div class="accordion-heading">';
                        $id = rand(0, 50000);
                            $output .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$nr.'" href="#toggle'.$id.'">'.get_the_title().'</a>';
                        $output .= '</div>';
                        $output .= '<div id="toggle'.$id.'" class="accordion-body collapse ">';
                            $output .= '<div class="accordion-inner">';
                                $output .= get_the_content();
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                
                


            }

        }
        $output .= '</div>';
        if($desc_bool == 'yes'):
                        $output .= '</div>';
                        $output .= '</div>';    

                     endif;
        $output .= '</div>';
        return $output;
       
    }

    function slideshow($element){

        extract($element['saved'][0]);
        $output = '<div class="span'.$dynamic_size.'">';
        switch($dynamic_which_post_page)
        {
            case'post': $query_id = $dynamic_post_id; $type ='post'; break;
            case'page': $query_id = $dynamic_page_id; $type ='page'; break;
            case'self': $query_id = $this->post_id;   $type = get_post_type( $this->post_id ); break;
        }

        $query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );
        $additional_loop = new WP_Query($query_post);
        
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                if($dynamic_which_post_page != 'self' && $query_id != $this->post_id)
                {
                    global $more;
                    $more = 0;
                }
                        
                
                if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)
                {
                     $slider = new themeple_slideshow(get_the_ID(), 'flexslider');

               

                                                if($slider && $slider->slide_number > 0){

                                                    $sliderHtml = $slider->render_slideshow();

                                                    $output .= $sliderHtml;

                                                }
                }
                
                 
                
                
            }
            
            
        }
       
        $output .= '</div>';
        return $output;
    }

   
    
}

?>