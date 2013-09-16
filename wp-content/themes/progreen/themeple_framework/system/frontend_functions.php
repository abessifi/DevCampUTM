<?php
	/** 
     * @author roshi
     * @copyright roshi[www.themeforest.net/user/roshi]
     * @version 2012
     */
if(!function_exists('themeple_option'))
{
	/**
	 * themeple_option()
	 * 
	 * @param mixed $key
	 * @param string $default
	 * @param bool $echo
	 * @param bool $decode
	 * @return
	 */
	function themeple_option($key, $default = "", $echo = true, $decode = true)
	{	
		$result = themeple_get_option($key, $default, false, $decode);
		
		if(!$echo) return $result;
		
		echo $result;
	}
}

if(!function_exists('themeple_get_option')){
    
    /**
     * themeple_get_option()
     * 
     * @param bool $key
     * @param string $default
     * @param bool $echo
     * @param bool $decode
     * @return
     */
    function themeple_get_option($key = false, $default = "", $echo = false, $decode = true){
        
        global $controller;
		$result = $controller->options;
		
		if(is_array($key)) 
		{ 
			$result = $result[$key[0]];
		}
		else
		{
			$result = $result['themeple'];
		}
		
		if($key === false)
		{

		}
		else if(isset($result[$key]))
		{	
			$result = $result[$key];
		}
		else
		{
			$result = $default;
		}
		
		
		if($decode) { $result = themeple_entity_decode($result); }
		if($result == "") { $result = $default; }
		if($echo) echo $result;
		
		return $result;
        
    }
    
}

if(!function_exists('themeple_check_dynamic_template'))
{
	
	/**
	 * themeple_check_dynamic_template()
	 * 
	 * @param bool $id
	 * @param bool $dependency
	 * @return
	 */
	function themeple_check_dynamic_template($id = false, $dependency = false)
	{
		$result = false;
		if(!$id) $id = themeple_get_post_id();
		if(!$id) return $result;
		
		if($dependency)
		{
			if(themeple_post_meta($id, $dependency[0]) != $dependency[1])
			{
				return false;
			}
		}
		
		if($template = themeple_post_meta($id, 'layout')) 
		{
			if(strpos($template, "dynamic") !== false)
                $result = $template; 
		}
		
		return $result;
	}
}

if(!function_exists('themeple_post_meta'))
{

	/**
	 * themeple_post_meta()
	 * 
	 * @param string $post_id
	 * @param bool $subkey
	 * @return
	 */
	function themeple_post_meta($post_id = '', $subkey = false)
	{
		$themeple_post_id = $post_id;

		if(!$subkey && $themeple_post_id != "" && !is_numeric($themeple_post_id) && !is_object($themeple_post_id))
		{
			$subkey = $themeple_post_id;
			$themeple_post_id = "";
		}
		
		global $controller, $themeple_config;
		$key = '_themeple_elements_'.$controller->db_options_prefix;
		
		$values = "";

		if(is_object($themeple_post_id) && isset($themeple_post_id->ID)) 
		{ 
			$themeple_post_id = $themeple_post_id->ID;
		}
		
		
		if(!$themeple_post_id) 
		{ 
			$themeple_post_id = @get_the_ID();
		}
		
		if(!is_numeric($themeple_post_id)) return;
		
		
		$themeple_config['meta'] = themeple_entity_decode(get_post_meta($themeple_post_id, $key, true));
		
		
		if($subkey && isset($themeple_config['meta'][$subkey]))
		{
			$meta = $themeple_config['meta'][$subkey];
		}
		else if($subkey)
		{
			$meta = false;
		}
		else
		{
			$meta = $themeple_config['meta'];
		}
		
		return $meta;
	}
	
	add_action('the_post', 'themeple_post_meta');
}

if(!function_exists('themeple_get_post_id')){
    /**
     * themeple_get_post_id()
     * 
     * @return
     */
    function themeple_get_post_id()
    {
		global $themeple_config;
		$ID = false;
		
		if(!isset($themeple_config['real_ID']))
		{
			if(!empty($themeple_config['new_query']['page_id'])) 
			{ 
				$ID = $themeple_config['new_query']['page_id']; 
			}
			else
			{
				$ID = @get_the_ID();
			}
			
			$themeple_config['real_ID'] = $ID;
		}
		else
		{
			$ID = $themeple_config['real_ID'];
		}
		return $ID;
	}
	
	add_action('wp_head', 'themeple_get_post_id');
}

if(!function_exists('themeple_generate_thumbnail_sizes'))
{

	/**
	 * themeple_generate_thumbnail_sizes()
	 * 
	 * @param mixed $config
	 * @return
	 */
	function themeple_generate_thumbnail_sizes($config)
	{	
		if (function_exists('add_theme_support')) 
		{ 
			foreach ($config['thumbnail_sizes'] as $id => $size)
			{
				if($id == 'base')
				{
					set_post_thumbnail_size($config['thumbnail_sizes'][$id]['width'], $config['thumbnail_sizes'][$id]['height'], true);
				}
				else
				{	
					if(!isset($config['thumbnail_sizes'][$id]['crop'])) $config['thumbnail_sizes'][$id]['crop'] = true;
				
					add_image_size(	 
						$id,
						$config['thumbnail_sizes'][$id]['width'], 
						$config['thumbnail_sizes'][$id]['height'], 
						$config['thumbnail_sizes'][$id]['crop']);
				}
			}
		}
	}
}

if(!function_exists('themeple_favicon'))
{
	/**
	 * themeple_favicon()
	 * 
	 * @param string $url
	 * @return
	 */
	function themeple_favicon($url = "")
	{
		$icon_link = "";
		if($url)
		{
			$type = "image/x-icon";
			if(strpos($url,'.png' )) $type = "image/png";
			if(strpos($url,'.gif' )) $type = "image/gif";
		
			$icon_link = '<link rel="icon" href="'.$url.'" type="'.$type.'">';
		}
		
		return $icon_link;
	}
}


if(!function_exists('themeple_logo'))
{

	/**
	 * themeple_logo()
	 * 
	 * @param string $default
	 * @return
	 */
	function themeple_logo($default = "")
	{
		if($logo = themeple_get_option('logo'))
		{
			 
			 $logo = "<img src=".$logo." alt='' />";
			 $logo = "<a href='".home_url('/')."'>".$logo."</a>";
		}
		else
		{ 
			$logo = get_bloginfo('name');
			if($default != '') $logo = "<img src=".$default." alt='' title='$logo'/>";
			$logo = "<a href='".home_url('/')."'>".$logo."</a>";
		}
	
		return $logo;
	}
}

if(!function_exists('themeple_get_option_array')){
    /**
     * themeple_get_option_array()
     * 
     * @param mixed $key
     * @param bool $subkey
     * @param bool $subkey_value
     * @return
     */
    function themeple_get_option_array($key, $subkey = false, $subkey_value = false, $only_one = false)
	{
		$result 	= array();
		$all_sets 	= themeple_get_option($key);
		
		if(is_array($all_sets) && $subkey && $subkey_value !== false)
		{
			foreach($all_sets as $set)
			{
				
				if($only_one && isset($set[$subkey]) && $set[$subkey]){
					
					if(strpos($set[$subkey], $subkey_value) !== false )
						return $set;
				}
				if(isset($set[$subkey]) && $set[$subkey] == $subkey_value) return $set;
			}
		}
		else
		{
			$result = $all_sets;
		}
		
		return $result;
	}
}

if(!function_exists('themeple_check_multi_entry_page'))
{
	
	/**
	 * themeple_check_multi_entry_page()
	 * 
	 * @return
	 */
	function themeple_check_multi_entry_page()
	{
		global $themeple_config;
		$result = true;
		
		if (is_singular())
            $result = false;
		
		
		if(is_front_page() && themeple_get_option('frontpage') == themeple_get_the_ID())
		{
			$result = false;
		}
		
		if (isset($themeple_config['multi_entry_page']))
		{ 
			$result = $themeple_config['multi_entry_page'];
		} 
		
		return $result;
	}
}

if(!function_exists('themeple_image_by_id'))
{

	/**
	 * themeple_image_by_id()
	 * 
	 * @param mixed $thumbnail_id
	 * @param mixed $size
	 * @param string $output
	 * @param string $data
	 * @return
	 */
	function themeple_image_by_id($thumbnail_id, $size = array('width'=>800,'height'=>800), $output = 'image', $data = "")
	{	
		if(!is_numeric($thumbnail_id)) return false;


		
		if(is_array($size)) 
		{
			$size[0] = $size['width'];
			$size[1] = $size['height'];
		}

		$image_src = wp_get_attachment_image_src($thumbnail_id, $size);
		
		if(!$image_src){
			$image_src = array();
			$image_src[0] = THEMEPLE_BASE_URL.'img/default.jpg';
			if($output == 'image')
				return "<img src='".$image_src[0]."' ".$data."/>";
		
		}
		if ($output == 'url') return $image_src[0];
		
		
		


		$attachment = get_post($thumbnail_id);
		
		if(is_object($attachment))
		{
			
			$image_description = $attachment->post_excerpt == "" ? $attachment->post_content : $attachment->post_excerpt;
			$image_description = trim(strip_tags($image_description));
			$image_title = trim(strip_tags($attachment->post_title));
			
			return "<img src='".$image_src[0]."' title='".$image_title."' alt='".$image_description."' ".$data."/>";
		}	
	}
}

if(!function_exists('themeple_html5_video_embed'))
{

	/**
	 * themeple_html5_video_embed()
	 * 
	 * @param mixed $path
	 * @param string $image
	 * @param mixed $types
	 * @return
	 */
	function themeple_html5_video_embed($path, $image = "", $types = array('webm' => 'type="video/webm"', 'mp4' => 'type="video/mp4"', 'ogv' => 'type="video/ogg"'))
	{	
		preg_match("!^(.+?)(?:\.([^.]+))?$!", $path, $path_split);
		
		$output = "";
		if(isset($path_split[1]))
		{
			if(!$image && @file_get_contents($path_split[1].'.jpg',0,NULL,0,1))
			{
				$image = 'poster="'.$path_split[1].'.jpg"';
			}
			
			$uid = 'player_'.get_the_ID().'_'.mt_rand().'_'.mt_rand();
		
			$output .= '<video class="themeple_video" '.$image.' controls id="'.$uid.'">';

			foreach ($types as $key => $type)
			{
				if($path_split[2] == $key || @file_get_contents($path_split[1].'.'.$key,0,NULL,0,1)) 
				{  
					$output .= '	<source src="'.$path_split[1].'.'.$key.'" '.$type.' />';
				}
			}

			$output .= '</video>';
		}
		return $output;
	}
}
if(!function_exists('themeple_remove_empty_paragraphs')){
    /**
     * themeple_remove_empty_paragraphs()
     * 
     * @param mixed $content
     * @return
     */
    function themeple_remove_empty_paragraphs($content) {
        //$content = trim( do_shortcode(  $content ) );

        

    	return $content;
    }
}

if(!function_exists('themeple_check_custom_widget'))
{
	/**
	 * themeple_check_custom_widget()
	 * 
	 * @param mixed $area
	 * @param string $return
	 * @return
	 */
	function themeple_check_custom_widget($area, $return = 'title')
	{	
		$special_id_string = "";
		
		if($area == 'page')
		{
			$id_array = themeple_get_option('widget_pages');
			

		}
		else if($area == 'cat')
		{
			$id_array = themeple_get_option('widget_categories');
		}
		else if($area == 'dynamic_template')
		{
			global $controller;
			$dynamic_widgets = array();
			
			foreach($controller->options as $option_parent)
			{
				foreach ($option_parent as $key => $element_data)
				{
					
					if( isset($element_data[0]) && is_array($element_data) && strpos($key, 'widget') !== false)
					{

						
							if(!empty($element_data[0]['dynamic_sidebar']))
							{
								$dynamic_widgets[] =  $element_data[0]['dynamic_sidebar'];
							}
						
					}
				}
			}

			return $dynamic_widgets;
		}

		if(is_array($id_array))
		{
			foreach ($id_array as $special)
			{
				if(isset($special['widget_'.$area]) && $special['widget_'.$area] != "")
				{
					$special_id_string .= $special['widget_'.$area].",";
				}
			}
		}

		$special_id_string = trim($special_id_string,',');
		
		
		$clean_id_array = explode(',',$special_id_string);

		if($return != 'title') return $clean_id_array;

		
		if(is_page($clean_id_array))
		{	
			return get_the_title();
		}
		else if(is_category($clean_id_array))
		{
			return single_cat_title( "", false );
		}
		
	}
}

?>