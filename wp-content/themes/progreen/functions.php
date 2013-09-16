<?php
global $themeple_config;

if ( ! isset( $content_width ) ) $content_width = 940;

require_once( 'template_inc/admin/admin_portfolio_type.php' );
require_once( 'template_inc/admin/admin_staff_type.php' );
require_once( 'template_inc/admin/admin_testimonial_type.php' );
require_once( 'template_inc/admin/admin_faq_type.php' );
require_once 'template_inc/admin/register-shortcodes.php' ;
require_once 'themeple_framework/themeple_init.php';

function language_setup() {
    $lang_dir = get_template_directory() . '/lang';
    load_theme_textdomain('themeple', $lang_dir);
} 
add_action('init', 'language_setup');


$themeple_config['thumbnail_sizes']['widget'] 			 	= array('width'=>36,  'height'=>36);						// small preview pics eg sidebar news
$themeple_config['thumbnail_sizes']['slider_thumb'] 		= array('width'=>70,  'height'=>50);						// slideshow preview pics
$themeple_config['thumbnail_sizes']['fullsize'] 		 	= array('width'=>930, 'height'=>930, 'crop'=>false);		// big images for lightbox and portfolio single entries
	
themeple_generate_thumbnail_sizes($themeple_config);


add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

add_image_size( 'testimonial-thumb', 120, 140, true );
add_image_size( 'slide_thumb', 90, 45, true );
add_image_size( 'staff-thumb', 220, 195, true );
add_image_size( 'recent_sc_portfolio', 60, 60, true );
add_image_size( 'port3', 300, 170, true );
add_image_size( 'port2', 460, 275, true );
add_image_size( 'port4', 220, 140, true );
add_image_size( 'post_author', 75, 75, true );
add_image_size( 'featured_blog', 218, 180,  true );
add_image_size( 'blog', 657, 247, true );
add_image_size( 'full_2000', 2000, 2000 );
if(!function_exists('themeple_navigation_menus')){
    
    /**
     * themeple_navigation_menus()
     * 
     * @return
     */
    function themeple_navigation_menus(){
    		global $themeple_config;
    	
    		add_theme_support('nav_menus');
    		foreach($themeple_config['navigations'] as $id => $name){ 
    		      register_nav_menu($id, THEMETITLE.' '.$name); 
            }
   	}
    $themeple_config['navigations'] = array('main' => 'Main Navigation');
    themeple_navigation_menus();
}
if(!function_exists('themeple_widgets'))
{
	/**
	 * themeple_widgets()
	 * 
	 * @return
	 */
	function themeple_widgets()
	{
		register_widget( 'themepletwitter' );
        register_widget( 'SocialWidget' );
        register_widget( 'FlickrWidget' );
		register_widget( 'LatestBlogWidget' );
        register_widget( 'SubscribersWidget' );
        register_widget( 'RecentContentWidget' );
        register_widget( 'SlideshowWidget' );
        register_widget( 'VideoWidget' );
        register_widget( 'ListContentWidget' );
        register_widget( 'ContactWidget' );
        register_widget( 'ShortcodeWidget' );
        register_widget('ContactInfoWidget');
	}
	
	themeple_widgets(); 
}

add_action('wp_enqueue_scripts', 'register_styles');
function register_styles(){
            
            wp_enqueue_style('mediaelementplayer');
            wp_enqueue_style('jquery.fancybox');
            wp_enqueue_style('hoverex');
            wp_enqueue_style('themeple_font_aw');
            wp_enqueue_style('themeple_font_aw_ie');
            

}


add_action('wp_head', 'register_scripts');
function register_scripts(){
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap.min' );
    wp_enqueue_script( 'jquery-easing-1-1' );
    wp_enqueue_script( 'jquery-easing-1-3' );
    wp_enqueue_script( 'jquery.mobilemenu' );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'isotope');
    wp_enqueue_script( 'jquery.cycle' );
    wp_enqueue_script('customSelect');
    wp_enqueue_script('jquery.flexslider-min');
    wp_enqueue_script('jquery.mousewheel');
    //wp_enqueue_script('jquery.contentcarousel');
    wp_enqueue_script('jquery.fancybox');
    wp_enqueue_script('jquery.fancybox-media');
    wp_enqueue_script('jquery.carouFredSel-6.1.0-packed');
    wp_enqueue_script('mediaelementplayer'); 
    wp_enqueue_script('tooltip'); 
    wp_enqueue_script('jquery.hoverex'); 
    wp_enqueue_script( 'jquery.imagesloaded.min' );
    wp_enqueue_script( 'switcher' );
    if( (themeple_get_option('nav_pos') == 'center' && !isset($_COOKIE['themeple_position'])) || (isset($_COOKIE['themeple_position']) && $_COOKIE['themeple_position'] == 'center') )
        wp_enqueue_script('menu'); 
    wp_enqueue_script( 'main' );
    wp_enqueue_script('comment-reply');
    wp_enqueue_script('placeholder');
}

/**
 * get_twitter_entries()
 * 
 * @param mixed $count
 * @param mixed $username
 * @param mixed $widget_id
 * @param string $time
 * @param string $avatar
 * @param string $used_for
 * @return
 */
function get_twitter_top_footer($count, $username, $widget_id = 9999, $time='no', $avatar = 'no')
{       
        $filtered_message = "";
        $output = "";
        $iterations = 0;
        
        $cache = get_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id);
        
        if($cache)
        {
            $tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);
        }
        else
        {
        
            $response = wp_remote_get( 'http://api.twitter.com/1/statuses/user_timeline.xml?include_rts=true&screen_name='.$username );
            if (!is_wp_error($response)) 
            {
                $xml = simplexml_load_string($response['body']);


                if( empty( $xml->error ) ) 
                {
                    if ( isset($xml->status[0])) 
                    {
                        
                        $tweets = array();
                        foreach ($xml->status as $tweet) 
                        {
                            if($iterations == $count) break;
                            
                            $text = (string) $tweet->text;
                            if($text[0] != "@")
                            {
                                $iterations++;
                                $tweets[] = array(
                                    'text' => filter( $text ),
                                    'created' =>  strtotime( $tweet->created_at ),
                                    'user' => array(
                                        'name' => (string)$tweet->user->name,
                                        'screen_name' => (string)$tweet->user->screen_name,
                                        'image' => (string)$tweet->user->profile_image_url,
                                        'utc_offset' => (int) $tweet->user->utc_offset[0],
                                        'follower' => (int) $tweet->user->followers_count));
                            }
                        }
                        
                        set_transient(THEMENAME.'_tweetcache_id_'.$username.'_'.$widget_id, 'true', 60*30);
                        update_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id, $tweets);

                    }
                }
            }
        }
        

        
        if(!isset($tweets[0]))
        {
            $tweets = get_option(THEMENAME.'_tweetcache_'.$username.'_'.$widget_id);
        }
        
        if(isset($tweets[0]))
        {   
            $time_format = get_option('date_format')." - ".get_option('time_format');
            
                foreach ($tweets as $message)
                {   
                    $output .= '<li class="tweet"><img src="'.$message['user']['image'].'" alt="" />';
                        $output .= '<h6>'.$message['user']['name'].' @ '.$message['text'].'</h6>';
                    $output .= '</li>';
                }
        
        }
    
        
        if($output != "")
        {
            
                $filtered_message = "<ul class='tweet_list' id='tweet_footer'>$output</ul>";
           
        }
        else
        {
            
                $filtered_message = "<ul class='tweet_list' id='tweet_footer'><li>No public Tweets found</li></ul>";
            
        }
        
        return $filtered_message;
}

add_filter('body_class', 'add_header_class');
function add_header_class($classes = ''){
	$header_class = 'header_1'; 
       if(isset($_COOKIE['themeple_header'])) 
		$header_class = 'header_'.$_COOKIE['themeple_header'];
	$classes[] = $header_class;
	return $classes; 
}
 

add_theme_support( 'post-formats', array( 'quote', 'gallery','video', 'audio' ) ); 
require_once 'template_inc/slideshow.inc.php';
require_once 'template_inc/functions-template.php';
require_once 'template_inc/admin/register-sidebars.php';
require_once 'template_inc/generate_dynamic_template.php';

require_once 'functions-progreen.php'; 
?>