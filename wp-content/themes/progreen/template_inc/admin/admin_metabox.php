<?php		

 	$layers = array();
    // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "layerslider";
 	if($wpdb->get_var("show tables like '$table_name' ") == $table_name) {
    // Get sliders
    	$sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );

    
	    foreach($sliders as $key => $item) {
	 
	        $layers[$item->name] = $item->id-1;
	    }
	}



    $revsliders = array();
    // Get WPDB Object
    global $wpdb;
 
    // Table name
    $table_name = $wpdb->prefix . "revslider_sliders";
 
    if($wpdb->get_var("show tables like '$table_name' ") == $table_name) {
       

    $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        
                                        ORDER BY id ASC LIMIT 100" );

    
    if(count($sliders) > 0):
	    foreach($sliders as $key => $item) {
	 
	        $revsliders[$item->title] = $item->alias;
	    }
    endif;
	}


$boxes = array( 
	array( 'title' =>  __('Layout', 'themeple'), 'id'=>'layout' , 'page'=>array('post','page'), 'context'=>'side', 'priority'=>'low' ),
    
    array( 'title' =>  __('Slideshow Options', 'themeple'), 'id'=>'slideshow_meta', 'page'=>array('page'), 'context'=>'normal', 'priority'=>'high' ),
    array( 'title' =>  __('Page Header', 'themeple'), 'id'=>'page_header', 'page'=>array('page'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Slideshow Options', 'themeple'), 'id'=>'slideshow_meta_portfolio', 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	
	array( 'title' =>  __('Media - Add any number images and videos for the slider', 'themeple'), 'id'=>'media' , 'page'=>array('post','page','portfolio'), 'context'=>'normal', 'priority'=>'high' ),					 
	array( 'title' =>  __('Media - Add any number images and videos for the slider', 'themeple'), 'id'=>'media_serv' , 'page'=>array('services'), 'context'=>'normal', 'priority'=>'high' ),
	
	array( 'title' =>  __('Social Links', 'themeple'), 'id'=>'social_links' , 'page'=>array('staff'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Staff Position', 'themeple'), 'id'=>'staff_position', 'page'=>array('staff'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' => __('Testimonial Options', 'themeple'), 'id'=>'testimonial_options', 'page'=>array('testimonial'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Services Options', 'themeple'), 'id'=>'services_options' , 'page'=>array('services'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Header Options', 'themeple'), 'id'=>'header_options' , 'page'=>array('page'), 'context'=>'normal', 'priority'=>'high' ),
	array( 'title' =>  __('Author Options', 'themeple'), 'id'=>'author_options' , 'page'=>array('post'), 'context'=>'normal', 'priority'=>'high' ),

);

								
$elements = array(

				

				
				
array(	
					"slug"	=> "layout",
					"name" 	=> __("Select Page layout", 'themeple'),
					"desc" 	=> "",
					"id" 	=> "layout",
					"type" 	=> "select",
					"std" 	=> "",
					"hook" 	=> 'on_save_layout_dynamic_save',
					"no_first"=>true,
					"subtype" => array( 	
											'Predefined Templates' => array(
											'Use global default' => "",
											'Left sidebar' =>'sidebar_left',
											'Right sidebar'=>'sidebar_right',
											'Fullwidth'=>'fullsize'
											),
											
											'Dynamic Templates' => themeple_admin_get_dynamic_templates('dynamic_template-')
											
										)),		
				
		
		
		array(	
		"name" 	=> __("Which Slider do you want to use?", 'themeple'),
		"desc" 	=> "Select one of defined sliders. Default flexslider" ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"slug"  => "slideshow_meta",
		"subtype" => array('Layer Slider'=>'layer_slider', "Revolution Slider" => 'revolution', 'Flexslider'=>'flexslider')),
		
		array(	
		"name" 	=> __("Slideshow Layout", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_layout",
		"type" 	=> "radioimage",
		"std" 	=> "fixed",
		"slug"  => "slideshow_meta",
		
		"subtype"           => array( 
                                                  array('name' => 'Fixed to page layout', 'value' =>'fixed', 'img' => 'boxed.png'),
                                                  array('name' => 'Full Width', 'value' =>'fullwidth', 'img' => '90x62/fullwidth.png')
                                    )
		),
		

		
		

		array(	
		"name" 	=> __("Select one of the sliders you have created", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_layer_slider",
		"type" 	=> "select",
		"std" 	=> "flexslider",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'layer_slider'),
		"subtype" => $layers),

		array(	
		"name" 	=> __("Select one of the sliders you have created", 'themeple'),
		"desc" 	=> "" ,
		"id" 	=> "_slideshow_revolution",
		"type" 	=> "select",
		"std" 	=> "flexslider",
		"slug"  => "slideshow_meta",
		"no_first" => true,
		"required" => array('_slideshow_type', 'revolution'),
		"subtype" => $revsliders),
		
		 
	array(	
		"name" 	=> __("Which Slider do you want to use?", 'themeple'),
		"desc" 	=> "Select one of defined sliders. Default flexslider" ,
		"id" 	=> "_slideshow_type",
		"type" 	=> "select",
		"slug"  => "slideshow_meta_portfolio",
		"no_first" => true,
		"subtype" => array( 'Flexslider'=>'flexslider')),
		

		array(	"name" 	=>  "Featured Media",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "media",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>"Add Video or Iframe by URL",
							'subelements' 	=> array(	
							
    							array(	"name" 	=> "Featured Media",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_image",
    							"type" 	=> "gallery_image",
    							"slug"  => "media",
    							"nodescription" => true,
    							"subtype" => "advanced",
    							"label"	=> "Insert"),
    							
    							array(	"name" 	=> "",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_video",
    							"type" 	=> "input_text",
    							"class"	=> "slideshow_video_input",
    							"slug"  => "media",
    							"simple"=> true,
    							"class"=> 'slideshow_video_input',
    							"nodescription" => true),
							
							
							array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "group1", "nodescription" => true),
								
								
								array(	"slug"	=> "media", "type" => "visual_group_start", "id" => "group1", "nodescription" => true,'name'=>'Default Options'),
	
								
								
										
								
							            
							    array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "tab1_end", "nodescription" => true),
							    
							    
								
								
								
		    							    
							   
							   
							  array(	"slug"	=> "media", "type" => "visual_group_end", "id" => "tab_container_end", "nodescription" => true),
	
							)
						),
							

			
			
			
			
			
		
);

$elements[] = 	array(	"name" 	=>  "Featured Media",
							"id" 	=>  "slideshow",
							"type" 	=> "upload_gallery",
							"slug"  => "media_serv",
							"nodescription" => true,
							"label"	=> "Add to slideshow",
							"button_video"	=>"Add Video or Iframe by URL",
							'subelements' 	=> array(	
							
    							array(	"name" 	=> "Featured Media",
    							"desc" 	=> 	"",
    							"id" 	=>  "slideshow_image",
    							"type" 	=> "gallery_image",
    							"slug"  => "media_serv",
    							"nodescription" => true,
    							"subtype" => "advanced",
    							"label"	=> "Insert"),
    							
    							
							
							
								array(	"slug"	=> "media_serv", "type" => "visual_group_start", "id" => "group1", "nodescription" => true),
								
								
								array(	"slug"	=> "media_serv", "type" => "visual_group_start", "id" => "group2", "nodescription" => true,'name'=>'Default Options'),
	
								array(	
										"name" 	=> "Write here the link of video if you want to display a video on lightbox",
		    							"desc" 	=> 	"",
		    							"id" 	=>  "slideshow_video",
		    							"type" 	=> "input_text",
		    							"slug"  => "media_serv"
		    							),
								
										
								
							            
							    array(	"slug"	=> "media_serv", "type" => "visual_group_end", "id" => "group2_end", "nodescription" => true),
							    
							    
								
								
								
		    							    
							   
							   
							  	array(	"slug"	=> "media_serv", "type" => "visual_group_end", "id" => "group1_end", "nodescription" => true),
	
							)
						);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "facebook_link", 
                    "name"          => __("Facebook Link", 'themeple'),
					"slug"			=> "social_links");

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "twitter_link", 
                    "name"          => __("Twitter Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "google_link", 
                    "name"          => __("Google Plus Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "linkedin_link", 
                    "name"          => __("Linkedin Link", 'themeple'),
					"slug"			=> "social_links");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "pinterest_link", 
                    "name"          => __("Piterest Link", 'themeple'),
					"slug"			=> "social_links");

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "staff_position_", 
                    "name"          => __("The position of the employer", 'themeple'),
					"slug"			=> "staff_position");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "staff_position_", 
                    "name"          => __("The position of the employer", 'themeple'),
					"slug"			=> "testimonial_options");
$elements[] =	array(
					"type" 			=> "select", 
					"id" 			=> "stars_", 
                    "name"          => __("Stars?", 'themeple'),
                    "no_first"      => true,
                    "subtype" 		=> array("1 Star" => 1, '2 Stars' => 2, '3 Stars' => 3, '4 Stars' => 4, '5 Stars' => 5),
					"slug"			=> "testimonial_options");

$elements[] =	array(
					"type" 			=> "radioimage", 
					"id" 			=> "service_image", 
                    "name"          => __("The position of the image you have selected as feature image", 'themeple'),
					"slug"			=> "services_options",
					"std" => "right",
					"subtype"           => array( 
                                                     array('name' => 'Left Side', 'value' =>'left', 'img' => '90x62/imageleft.png'),
                                                     array('name' => 'Right Side', 'value' =>'right', 'img' => '90x62/imageright.png'),
                                                )
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "header_top", 
                    "name"          => __("Header text on the top?", 'themeple'),
					"slug"			=> "header_options"
);

$elements[] =	array(
					"type" 			=> "select", 
					"id" 			=> "header_type", 
                    "name"          => __("Select the style that you want to display the content before the slideshow", 'themeple'),
					"slug"			=> "header_options",
					"subtype"		=> array("First Format" => 'v1', 'Second Format' => "v2", 'Only a colored line' => "v3")
					);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "biggest_title", 
                    "name"          => __("Biggest Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "second_title", 
                    "name"          => __("Second Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "textarea", 
					"id" 			=> "right_description", 
                    "name"          => __("Right Description", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "link_title", 
                    "name"          => __("Link Title", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "link_href", 
                    "name"          => __("Link", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v1")
);

$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_1", 
                    "name"          => __("Title 1", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_1", 
                    "name"          => __("Icon 1", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);


$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_2", 
                    "name"          => __("Title 2", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_2", 
                    "name"          => __("Icon 2", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);



$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_3", 
                    "name"          => __("Title 3", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_3", 
                    "name"          => __("Icon 3", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);


$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "title_4", 
                    "name"          => __("Title 4", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);

$elements[] =	array(
					"type" 			=> "iconset", 
					"id" 			=> "icon_4", 
                    "name"          => __("Icon 4", 'themeple'),
					"slug"			=> "header_options",
					"required"		=> array("header_type", "v2")
);



$elements[] =	array(
					"type" 			=> "switchbutton", 
					"id" 			=> "page_header_bool", 
					"std"			=> "yes",
                    "name"          => __("Do you want page Header?", 'themeple'),
					"slug"			=> "page_header");
$elements[] =	array(
					"type" 			=> "input_text", 
					"id" 			=> "page_header_desc", 
					"std"			=> "",
                    "name"          => __("Page Description", 'themeple'),
					"slug"			=> "page_header");

$elements[] =	array(
					"type" 	       => "select", 
					"id" 			=> "author_id",
					"subtype"		=> "staff",
					"taxonomy"		=> "staff_entries", 
                    			"name"               => __("Author Name", 'themeple'),
					"slug"			=> "author_options");


	
/*$portfolio_metas = themeple_get_option('portfolio-meta', array(array('meta'=>'Project'), array('meta'=>'Client'), array('meta'=>'URL')));

$counter = 0;
foreach($portfolio_metas as $p_meta)
{
	if(!empty($p_meta['meta']))
	{

		$counter ++;
        */
        $elements[] = array(    
                                   "name"    => "Do you want skills fields?",
                                   "slug"    => "portfolio-meta",
                                   "desc"    => "",
                                   "id"      => "skills_bool",
                                   "std"     => "no",
                                   "type"    => "switchbutton");
		$elements[] =   array(    
                    "slug"              => "portfolio-meta",
                    "type"              => "layout_section", 
                    "desc" 				=> "Add Skills Elements as much as you want",
                    "id"                => "skills", 
                    "linktext"          => "Add another Skill",
                    "deletetext"   		=> "Remove Skill",
                    "required"			=> array("skills_bool", "yes"),
                    "subelements" 		=> array(

                    		array(    
                                   "name"    => "Skill Title:",
                                   "slug"    => "portfolio-meta",
                                   "desc"    => "",
                                   "id"      => "title",
                                   "std"     => "",
                                   "type"    => "input_text"),
                                   array(    
                                   "name"    => "Skill Percentage:",
                                   "slug"    => "portfolio-meta",
                                   "desc"    => "",
                                   "id"      => "percentage",
                                   "std"     => "",
                                   "type"    => "input_text")
                   	)
          );         
      

	/*}
}

if($counter)
{*/
	$boxes[]    = array( 'title' =>  __('Portfolio Meta Information', 'themeple'), 'id'=>'portfolio-meta' , 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' );
/*}*/
