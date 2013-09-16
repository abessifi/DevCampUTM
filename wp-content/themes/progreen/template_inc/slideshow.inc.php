<?php

/**
 * themeple_slideshow
 * 
 * @package   
 * @author 
 * @copyright oni12
 * @version 2012
 * @access public
 */
class themeple_slideshow{
    
    
    var $slides = array();
    var $post_id;
    var $slide_number;
    var $slide_type;
    var $slide_options = array();
    var $custom_header_html = "";
    var $custom_footer_html = "";
    var $slide_ul_class = "";
    var $slide_container_class = "";
    var $slide_element_class = "";
    var $before_render_media = "";
    var $after_render_media = "";
    var $before_elements = "";
    var $after_elements = "";
    var $slide_container_id = "";
    var $media_img_data = array();
    var $before_container_html = "";
    var $after_container_html = "";
    var $layout = "";
    /**
     * themeple_slideshow::themeple_slideshow()
     * 
     * @return
     */
    function themeple_slideshow($post_id = false, $slide_type = ""){
        global $themeple_config;
        if(!$post_id) 
            $post_id = themeple_get_post_id();
		if(!$post_id) 
            return false;
        if(isset($themeple_config['conditionals']) && isset($themeple_config['conditionals']['routed_frontpage'])){
            if($themeple_config['conditionals']['routed_frontpage']){
                if(themeple_get_option('frontpage') == get_the_ID())
                    $post_id = themeple_get_option('frontpage');
            }
        }
        $this->post_id = $post_id;
        $this->slides = themeple_post_meta($this->post_id, 'slideshow');
        $this->slide_type = themeple_post_meta($this->post_id, '_slideshow_type');
        if($slide_type != ""){
            $this->slide_type = $slide_type;
        }
        $this->options['shadow'] = themeple_post_meta($this->post_id, '_slideshow_shadow');
        
        $this->options['slideshow_layout'] = themeple_post_meta($this->post_id, '_slideshow_layout');
        $this->slide_number = $this->slidecount();
        if($this->slide_number)
            $this->media_img_data = array_fill(0, $this->slide_number+1, "");
        if($this->slide_type == "")
            return false;
        if($this->slide_type != 'layer_slider' && $this->slide_type != 'revolution' )
            $this->{$this->slide_type}();
        else{
            $this->options['layer_slider_id'] = themeple_post_meta($this->post_id, '_slideshow_layer_slider')+1;
            $this->slide_number = 5;
            $this->options['revolution_alias'] = themeple_post_meta($this->post_id, '_slideshow_revolution');
        }
        if($this->slide_number == 0)
            return false;
        
            
        return true;
        
    }
    
    /**
     * themeple_slideshow::setCustomHeaderHtml()
     * 
     * @return
     */
    function setCustomHeaderHtml($html = ""){
        $this->custom_header_html = $html;
    }
    
    /**
     * themeple_slideshow::slideshow_behavior()
     * 
     * @return
     */
    function slideshow_behavior(){
        if($this->options['slideshow_layout'] == 'default')
		{
			$this->slides = themeple_post_meta($this->post_id, 'slideshow'); 
		}
		
		if($this->options['slideshow_layout']== 'single' && (themeple_check_multi_entry()))
		{
			if(is_array($this->slides)) 
			{
				$this->slides = array_slice($this->slides, 0, 1);
			}
		}

		$this->slide_number = $this->slidecount();
    }
    
    /**
     * themeple_slideshow::slidecount()
     * 
     * @return
     */
    function slidecount(){
        if(is_array($this->slides))
            return count($this->slides);
        return 0;
    }
    /**
     * themeple_slideshow::display()
     * 
     * @return
     */
    function display($force_display = false){
        if($this->slide_type != 'layer_slider' && $this->slide_type != 'revolution')
            return $this->render_slideshow();
        elseif($this->slide_type == 'layer_slider')
            return $this->layer_slider();
        elseif($this->slide_type == 'revolution')
            return $this->revolution();

    }
    
    /**
     * themeple_slideshow::render_slideshow()
     * 
     * @return
     */
    function render_slideshow(){
        if(post_password_required($this->post_id)){ return false; }
        global $themeple_config;
        $output = "";
        $i = 0;
        $output .= $this->before_container_html;
        if($this->slide_number){
        
            $output .= '<div class="slideshow_container '.$this->slide_container_class.' slide_layout_'.$this->options['slideshow_layout'].'" id="'.$this->slide_container_id.'flex">';
            $output .= $this->custom_header_html;
            $output .= '    <ul class="'.$this->slide_ul_class.' slide_'.$this->slide_type.'">';
            $output .= $this->before_elements;
            foreach($this->slides as $slide):
                
                $i++;
                $image = "";
				if(!empty($slide['slideshow_image']))
				{	
                    
					$image_string = themeple_image_by_id($slide['slideshow_image'], array('width'=>940,'height'=>600), 'image', $this->media_img_data[$i]); 
					if(!$image_string) $image_string = $slide['slideshow_image'];
					if(isset($slide['slideshow_link']) && $slide['slideshow_link'] != 'http://')
					{
						$image = "<a href='".$slide['slideshow_link']."'>".$image_string."</a>";
					}else
                        $image = $image_string;
				}
                $video = "";
				if(!empty($slide['slideshow_video']))
				{
					if(themeple_backend_is_file($slide['slideshow_video'], 'html5video'))
					{
						$video = themeple_html5_video_embed($slide['slideshow_video']);
					}
					else if(strpos($slide['slideshow_video'],'<iframe') !== false)
					{
						$video = $slide['slideshow_video'];
					}
					else
					{
						global $wp_embed;
						$video = $wp_embed->run_shortcode("[embed]".trim($slide['slideshow_video'])."[/embed]");
					}
					
					if(strpos($video, '<a') === 0)
					{
						$video = '<iframe src="'.$slide['slideshow_video'].'"></iframe>';
					}
				}
                $output .= "		<li class='".$this->slide_element_class." slide_element slide".$i." frame".$i."' data-thumb='".themeple_image_by_id($slide['slideshow_image'], array('width'=>90,'height'=>45), 'url')."'>";
        			if(!is_array($this->before_render_media))
                        $output .=           $this->before_render_media;
                    else
                        $output .=           $this->before_render_media[$i];
                    $output .= 			 $image.$video;
    				$output .=           $this->after_render_media;
                    if($this->slide_type == 'flexslider' && isset($slide['slideshow_description']) && strlen($slide['slideshow_description']) > 1){
                        $output .= $this->after_render_media = '<p class="flex-caption"><span>'.$slide['slideshow_description'].'</span></p>';
                    }
    			$output .= "		</li>";
    			
    			
            
            
            endforeach;
            $output .= $this->after_elements;
            $output .= "	</ul>";
            $output .= $this->custom_footer_html;
            $output .= '<span class="headborder"></span>';
            $output .= "</div>";
            $output .= $this->after_container_html;
            
        }
        return $output;
        
    }
    
    /**
     * themeple_slideshow::flexslider()
     * 
     * @return
     */
    function flexslider(){
        global $themeple_config;
        $this->slide_container_class = 'flexslider';
        $this->slide_ul_class = "slides";
        $this->custom_footer_html = '<div class="bottom_shadow"></div>';
        $themeple_config['slideshow_type'] = 'flexslider';
    }

    function layer_slider(){
       return do_shortcode('[layerslider id="'.$this->options['layer_slider_id'].'"]');
    }

    function revolution(){
       return do_shortcode('[rev_slider '.$this->options['revolution_alias'].']');
    }

    function flexslider_with_thumbnails(){
        global $themeple_config;
        $this->slide_container_class = 'flexslider_with_thumbnails';
        $this->slide_ul_class = "slides";
        $themeple_config['slideshow_type'] = 'flexslider';
    }
    
    
    
        
    
    
}


?>