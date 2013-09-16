<?php



/* COLUMNS */



/*$elements[] = array(



	"dynamic" => "column",

	"name" => __("Columns", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_column",

	"removable" => "remove element",

	"default_size" => 4,

	"subelements" => array(



								array(	

									"slug"	=> "",

									"name" 	=> "Do you want icon?",

									"desc" 	=> "",

									"id" 	=> "dynamic_icon_req",

									"type" 	=> "switchbutton",

									"std"   => "no"

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Upload Icon here",

									"desc" 	=> "",

									"btn_text" => "Upload",

									"id" 	=> "dynamic_icon",

									"type" 	=> "upload",

									"required" => array('dynamic_icon_req','yes')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Upload Hover Icon here",

									"desc" 	=> "",

									"btn_text" => "Upload",

									"id" 	=> "dynamic_icon_hover",

									"type" 	=> "upload",

									"required" => array('dynamic_icon_req','yes')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Content Type",

									"desc" 	=> "Select the content type to be used",

									"id" 	=> "dynamic_content_type",

									"type" 	=> "select",

									"subtype" => array('Post' => 'post', 'Page' => 'page', 'Add Content here' => 'content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the post",

									"desc" 	=> "",

									"id" 	=> "dynamic_post",

									"type" 	=> "select",

									"subtype" => 'post',

									"required" => array('dynamic_content_type','post')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the page",

									"desc" 	=> "",

									"id" 	=> "dynamic_page",

									"type" 	=> "select",

									"subtype" => 'page',

									"required" => array('dynamic_content_type','page')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Title",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_title",

									"type" 	=> "input_text",

									"required" => array('dynamic_content_type','content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Content",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_content",

									"type" 	=> "textarea",

									"required" => array('dynamic_content_type','content')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_link",

									"type" 	=> "input_text",

									"std" => "http://",

									"required" => array('dynamic_content_type','content')

								),





							    array( 

											"id" => "dynamic_size",

											"type" => "hidden",

											"std" => 4

									)



		)



);



/* COLUMNS END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* RECENT PORTFOLIO  */



$elements[] = array(



	"dynamic" => "recent_portfolio",

	"name" => __("Featured Portfolio", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_recent_portfolio",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(



						



								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

								),


								

								

						

								 array(

									"name" 	=> "Block Size:",

									"desc" 	=> "This mean that if you select 1/4 and you choose a 100% row, should be display 4 items. Be sure that items are in exact proporcion with the column percentage. For example you cant use a 1/4 with 66% column or 1/3 with 75% column ",

									"id" 	=> "dynamic_block_size",

									"type" 	=> "select",

									"no_first" => "true",

									"subtype" => array("1/4" => 4, '1/3' => 3, '1/2' => 2, '1/1' => 1)

								),



								array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 12

								),

								array( 

									"id" => "dynamic_from_where",

									"type" => "select",

									"name" => "Set featured Portfolio:",

									"no_first" => true,

									"subtype" => array("Show Portfolio from all categories" => "all_cat", "Select a specific Category" => "cat")

								),

								array( 

									"id" => "dynamic_cat",

									"type" => "select",

									"taxonomy" => "portfolio_entries",

									"name" => "Select the category:",

									"subtype" => "cat",

									"required" => array("dynamic_from_where", "cat")

								)



		)



);



/* RECENT PORTFOLIO END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Recent News */

 

$elements[] =	array(	

				"dynamic"		=> 'recent_news',

				"name" 			=> __("Recent News", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_recent_news", 

				"removable"  => 'remove element',

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						



								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),

								array(

									"name" => "Number of posts",

									"id" => "posts_per_page",

									"type" => "input_text",

									"std" => "2"

									

								),



						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								),

						array( 

									"id" => "dynamic_from_where",

									"type" => "select",

									"name" => "Set Headlines From Blog",

									"no_first" => true,

									"subtype" => array("Show headlines from all categories" => "all_cat", "Select a specific Category" => "cat")

								),

								array( 

									"id" => "dynamic_cat",

									"type" => "select",

									"name" => "Select the category:",

									"subtype" => "cat",

									"required" => array("dynamic_from_where", "cat")

								)

						

								

					   	

					            



				)

			);


/* ----------------------------------------------- */
/* ----------------------------------------------- */

/* TEAM CAROUSEL PORTFOLIO  */



$elements[] = array(



	"dynamic" => "team_carousel",

	"name" => __("Team Carousel", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_team_carousel",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(



						



								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

								),


								array(

									"name" => "Do you want description on the left?",

									"id" => "desc_bool",

									"type" => "switchbutton",

									"std" => "yes"

								),

								array(

									"name" => "Left Title",

									"id" => "desc_title",

									"type" => "input_text",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Left Description",

									"id" => "desc_desc",

									"type" => "textarea",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Do you want Button?",

									"id" => "button_bool",

									"type" => "switchbutton",

									"std"  => "no",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Button Title",

									"id" => "button_title",

									"type" => "input_text",

									"std"  => "",

									"required" => array("button_bool", "yes")

								),

								array(

									"name" => "Button Link",

									"id" => "button_link",

									"type" => "input_text",

									"std"  => "",

									"required" => array("button_bool", "yes")

								),

								array(

									"name" => "Button Icon",

									"id" => "button_icon",

									"type" => "iconset",

									"required" => array("button_bool", "yes")

								),





								array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 12

								)

		)



);



/* TEAM CAROUSEL END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* LATEST BLOG */



$elements[] =	array(	

				"dynamic"		=> 'latest_blog',

				"name" 			=> __("Latest From Blog", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_latest_blog", 

				"removable"  => 'remove element',

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						



								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),

								array(

									"name" => "Do you want description on the left?",

									"id" => "desc_bool",

									"type" => "switchbutton",

									"std" => "yes"

								),

								array(

									"name" => "Left Title",

									"id" => "desc_title",

									"type" => "input_text",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Left Description",

									"id" => "desc_desc",

									"type" => "textarea",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Do you want Button?",

									"id" => "button_bool",

									"type" => "switchbutton",

									"std"  => "no",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Button Title",

									"id" => "button_title",

									"type" => "input_text",

									"std"  => "",

									"required" => array("button_bool", "yes")

								),

								array(

									"name" => "Button Link",

									"id" => "button_link",

									"type" => "input_text",

									"std"  => "",

									"required" => array("button_bool", "yes")

								),

								array(

									"name" => "Button Icon",

									"id" => "button_icon",

									"type" => "iconset",

									"required" => array("button_bool", "yes")

								),

								array(

									"name" => "Style",

									"id" => "style",

									"type" => "select",

									"no_first" => true,

									"subtype" => array("Simple Type (Video, Standart, Gallery)" => "v1", "Only Featured Image" => "v2")

								),

						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								),

						array( 

									"id" => "dynamic_from_where",

									"type" => "select",

									"name" => "Set Headlines From Blog",

									"no_first" => true,

									"subtype" => array("Show headlines from all categories" => "all_cat", "Select a specific Category" => "cat")

								),

								array( 

									"id" => "dynamic_cat",

									"type" => "select",

									"name" => "Select the category:",

									"subtype" => "cat",

									"required" => array("dynamic_from_where", "cat")

								)

						

								

					   	

					            



				)

			);



/* LATEST BLOG END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* HOME BLOG */

      $elements[] =	array(	

				"dynamic"		=> 'home_blog',

				"name" 			=> __("Full Blog", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_home_blog", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	



							array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),



					        array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)





					)





	);			



/* END BLOG */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/** Home Portfolio Element **/
	  $elements[] =	array(	
					"dynamic"		=> 'home_portfolio',
					"name" 			=> __("Full Portfolio", 'themeple'),
					"slug"			=> "",
					"type" 			=> "layout_section", 
					"id" 			=> "dynamic_home_portfolio", 
					"removable"  => 'remove element',
					"blank" 		=> true, 
					"default_size" => 12,
					"nodescription" => true,
					'subelements' 	=> array(	

								array(
										"name" => "Nr of columns",
										"id" => "dynamic_columns",
										"type" => "select",
										"std" => "",
										"subtype" => array("One Column" => 1, "Two Columns" => 2, "Three Columns" => 3, "Four Columns" => 4)
										
									),
								array(
										"name" => "Portfolio Page",
										"id" => "portfolio_selected",
										"type" => "select",
										"std" => "",
										"subtype" => 'page'
										
									),

								
						        array( 
									"id" => "dynamic_size",
									"type" => "hidden",
									"std" => 12
									)


						)






		);			







/** End Home Portfolio Element **/



/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* FAQ */

      $elements[] =	array(	

				"dynamic"		=> 'faq',

				"name" 			=> __("FAQ", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_faq", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	



							array(

									"name" => "Do you want description on the left?",

									"id" => "desc_bool",

									"type" => "switchbutton",

									"std" => "yes"

								),

								array(

									"name" => "Left Title",

									"id" => "desc_title",

									"type" => "input_text",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Left Description",

									"id" => "desc_desc",

									"type" => "textarea",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Do you want Button?",

									"id" => "button_bool",

									"type" => "switchbutton",

									"std"  => "no",

									"required" => array("desc_bool", "yes")

								),

								array(

									"name" => "Button Title",

									"id" => "button_title",

									"type" => "input_text",

									"std"  => "",

									"required" => array("button_bool", "yes")

								),

								array(

									"name" => "Button Link",

									"id" => "button_link",

									"type" => "input_text",

									"std"  => "",

									"required" => array("button_bool", "yes")

								),

								array(

									"name" => "Button Icon",

									"id" => "button_icon",

									"type" => "iconset",

									"required" => array("button_bool", "yes")

								),



					        array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)





					)





	);			



/* END FAQ */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* STAFF */



$elements[] =	array(	

				"dynamic"		=> 'staff',

				"name" 			=> __("One Staff Member", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_staff", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

					





						array( "name" => "Select the Category",

								"desc" => "",

								"id" => "staff",

								

								"type" => "select",

								"subtype" => 'staff'),

					

						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

								)		

					   	

					            



				)

			);



/* STAFF END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* Slideshow */



$elements[] =	array(	

				"dynamic"		=> 'slideshow',

				"name" 			=> __("Slideshow", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_slideshow", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

					





						array(	"name" 	=> "Which Content?",

								"desc" 	=> "Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.",

					            "id" 	=> "dynamic_which_post_page",

					            "type" 	=> "select",

								"slug"	=> "",

								"std"	=> "self",

								"no_first"=>true,

					            "subtype" => array('Display the content of this post/page'=>'self','Choose a post'=>'post','Choose a Page'=>'page')),

					    

					   	array(	

								"slug"	=> "",

								"name" 	=> "Select Page",

								"desc" 	=> "",

								"id" 	=> "dynamic_page_id",

								"type" 	=> "select",

								"subtype" => 'page',

								"required" => array('dynamic_which_post_page','page')

							),

							

						

						 array(	

								"slug"	=> "",

								"name" 	=> "Select Post",

								"desc" 	=> "",

								"id" 	=> "dynamic_post_id",

								"type" 	=> "select",

								"subtype" => 'post',

								"required" => array('dynamic_which_post_page','post')

							),

					

						array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

								)		

					   	

					            



				)

			);



/* SLIDESHOW END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* TESTIMONIALS */



$elements[] = array(



	"dynamic" => "testimonials",

	"name" => __("Testimonials", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_testimonials",

	"removable" => "remove element",

	"default_size" => 6,

	"subelements" => array(



						

								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),

								array(

									"name" => "Do you want image on the left?",

									"id" => "image_bool",

									"type" => "switchbutton",

									"std" => "no"

									

								),

								array( 

									"id" => "dynamic_size",

									"type" => "hidden",

									"std" => 6

								)



		)



);



/* TESTIMONIALS END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* CLIENTS */



$elements[] = array(



	"dynamic" => "clients",

	"name" => __("Clients", 'themeple'),

	"type" => "layout_section",

	"id" => "dynamic_clients",

	"removable" => "remove element",

	"default_size" => 12,

	"subelements" => array(



			

								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

								),
								
								


							

								array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)



		)



);



/* CLIENTS END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* POST PAGE CONTENT */



$elements[] =	array(	

				"dynamic"		=> 'post_page_content',

				"name" 			=> __("Post/Page Content", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_post_page", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						

								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

								),



						array(	"name" 	=> "Which Content?",

								"desc" 	=> "Chosose a page or post. The content of that entry will be displayed. By default it will display the content of the current post or page that has the this template aplied to it.",

					            "id" 	=> "dynamic_which_post_page",

					            "type" 	=> "select",

								"slug"	=> "",

								"std"	=> "self",

								"no_first"=>true,

					            "subtype" => array('Display the content of this post/page'=>'self','Choose a post'=>'post','Choose a Page'=>'page')),

					    

					   	array(	

								"slug"	=> "",

								"name" 	=> "Select Page",

								"desc" 	=> "",

								"id" 	=> "dynamic_page_id",

								"type" 	=> "select",

								"subtype" => 'page',

								"required" => array('dynamic_which_post_page','page')

							),

							

						

						 array(	

								"slug"	=> "",

								"name" 	=> "Select Post",

								"desc" 	=> "",

								"id" 	=> "dynamic_post_id",

								"type" 	=> "select",

								"subtype" => 'post',

								"required" => array('dynamic_which_post_page','post')

							),

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* POST PAGE CONTENT END */

/* WIDGET */



$elements[] =	array(	

				"dynamic"		=> 'Widget',

				"name" 			=> __("Widget", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_widget", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							





								array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),



						 array(



						 		"name" 	=> "Sidebar Name: ",

								"desc" 	=> "Give a name to the sidebar that you want to create for this column. After you create it and save theme options, the new sidebar will be ready in the  <a href='widgets.php'>Appearance &raquo; Widgets</a>",

								"id" 	=> "dynamic_sidebar",

								"type" => "input_text"

								



						 	),

						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* WIDGET END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* CONTACT FORM */



$elements[] =	array(	

				"dynamic"		=> 'contact_form',

				"name" 			=> __("Contact Form", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_contact", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(



						 		"name" 	=> "Title",

								"desc" 	=> "Write Title here",

								"id" 	=> "dynamic_title",

								"type" => "input_text"

								



						 	),

						 array(



						 		"name" 	=> "Description",

								"desc" 	=> "",

								"id" 	=> "desc",

								"type" => "textarea"

								



						 	),

						 array(



						 		"name" 	=> "Success Message",

								"desc" 	=> "Write the Message that you want to be displayed when the message has sent",

								"id" 	=> "dynamic_msg",

								"type" => "textarea"

								



						 	),



						 array(



						 		"name" 	=> "Submit Button Text",

								"desc" 	=> "",

								"id" 	=> "dynamic_submit",

								"type" => "input_text"

								



						 	),

						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* CONTACTFORM END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* CONTACTINFO */



$elements[] =	array(	

				"dynamic"		=> 'contact_info',

				"name" 			=> __("Contact Info", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_contact_info", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(



						 		"name" 	=> "Title",

								"desc" 	=> "Write Title here",

								"id" 	=> "dynamic_title",

								"type" => "input_text"

								



						 	),

						 array(

						 		"name" 	=> "Address",

								"desc" 	=> "",

								"id" 	=> "address",

								"type" => "textarea"

						 ),



						 array(

						 		"name" 	=> "Phone",

								"desc" 	=> "",

								"id" 	=> "phone",

								"type" => "input_text"

						 ),

						 array(

						 		"name" 	=> "Fax",

								"desc" 	=> "",

								"id" 	=> "fax",

								"type" => "input_text"

						 ),

						 array(

						 		"name" 	=> "Web",

								"desc" 	=> "",

								"id" 	=> "web",

								"type" => "input_text"

						 ),
						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

						)

					            



				)

			);



/* CONTACTINFO END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* GOOGLEMAP */



$elements[] =	array(	

				"dynamic"		=> 'google_map',

				"name" 			=> __("Google Map", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_map", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							



						 array(



						 		"name" 	=> "Source",

								"desc" 	=> "Only the link",

								"id" 	=> "dynamic_src",

								"type" => "input_text"

								



						 	),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)

					            



				)

			);



/* GOOGLEMAP END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* TEXTBAR */



$elements[] =	array(	

				"dynamic"		=> 'textbar',

				"name" 			=> __("Text Bar", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "text_bar", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							



						 array(



						 		"name" 	=> "Left Title",

								"desc" 	=> "",

								"id" 	=> "title",

								"type" => "input_text"

								



						 	),

						 array(



						 		"name" 	=> "Left Description",

								"desc" 	=> "",

								"id" 	=> "desc",

								"type" => "input_text"

								



						 	),

						 array("name" 	=> "Left Image",

								"desc" 	=> "",

								"id" 	=> "image",

								"btn_text" => "Upload",

								"type" => "upload"),


						 array("name" 	=> "Social Icons",

								"desc" 	=> "",

								"id" 	=> "socials",

								"std"	=> "yes",

								"type" => "switchbutton"),

						 
						 array("name" 	=> "Right Title",

								"desc" 	=> "",

								"id" 	=> "title_2",

								"type" => "input_text"),

						 
						 array("name" 	=> "Right Description",

								"desc" 	=> "",

								"id" 	=> "desc_2",

								"type" => "input_text"),


						 array(



						 		"name" 	=> "Do you want button?",

								"desc" 	=> "",

								"id" 	=> "button_bool",

								"std"	=> "yes",

								"type" => "switchbutton"

								



						 	),

						 array(



						 		"name" 	=> "Button Title",

								"desc" 	=> "",

								"id" 	=> "button_title",

								"required" => array('button_bool', 'yes'),

								"type"  => "input_text"



								



						 	),

						 array(



						 		"name" 	=> "Button Link",

								"desc" 	=> "",

								"id" 	=> "button_link",

								"required" => array('button_bool', 'yes'),

								"type"  => "input_text"



								



						 	),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)

					            



				)

			);



/* TEXTBAR END */



/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* PLAINTEXT */



$elements[] =	array(	

				"dynamic"		=> 'plain_text',

				"name" 			=> __("Plain Text", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_plain", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						array(



						 		"name" 	=> "Block Title",

								"desc" 	=> "Write Title here",

								"id" 	=> "dynamic_title",

								"type" => "input_text"

								



						 	),	

						array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "blocks", 

		                    "linktext"          => "Add another Block Element",

		                    "deletetext"   		=> "Remove Block Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "block_title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

												

					                            array(    

						                               "name"    => "Text:",

						                                   

						                               "desc"    => "",

						                               "id"      => "block_text",

						                               "std"     => "",

						                               "type"    => "textarea"

						                       )

					                            

														

												

		                 )),

						 

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

				)            



				

			);



/* PLAINTEXT END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* TOGGLE */



$elements[] =	array(	

				"dynamic"		=> 'toggle',

				"name" 			=> __("Toggle", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_toggle", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

								array(

									"name" => "Block Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),



						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "toggles", 

		                    "linktext"          => "Add another Toggle Element",

		                    "deletetext"   		=> "Remove Toggle Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

					                            array(    

						                               "name"    => "Content:",

						                                   

						                               "desc"    => "",

						                               "id"      => "desc",

						                               "std"     => "",

						                               "type"    => "textarea"

						                       )

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

								)

					            



				)

			);



/* TOGGLE END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Services List */



$elements[] =	array(	

				"dynamic"		=> 'services_list',

				"name" 			=> __("Services List", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_list", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 4,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 array(    

					                                   "name"    => "Do you want Icon?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton",



						),

						 

						 array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool", 'yes')

						),

						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "list", 

		                    "linktext"          => "Add another Element",

		                    "deletetext"   		=> "Remove Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												)

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 4

						)

					            



				)

			);



/* SERVICES LIST END */







/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */


/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Services Small */



$elements[] =	array(	

				"dynamic"		=> 'services_small',

				"name" 			=> __("Services Small", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_small", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						

						 array(    

					                                   "name"    => "Do you want Icon?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton"

						),

						  

						 array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool", 'yes')

						),

						array(	

									"slug"	=> "",

									"name" 	=> "Content Type",

									"desc" 	=> "Select the content type to be used",

									"id" 	=> "dynamic_content_type",

									"type" 	=> "select",

									"subtype" => array('Post' => 'post', 'Page' => 'page', 'Add Content here' => 'content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the post",

									"desc" 	=> "",

									"id" 	=> "dynamic_post",

									"type" 	=> "select",

									"subtype" => 'post',

									"required" => array('dynamic_content_type','post')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the page",

									"desc" 	=> "",

									"id" 	=> "dynamic_page",

									"type" 	=> "select",

									"subtype" => 'page',

									"required" => array('dynamic_content_type','page')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Content",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_content",

									"type" 	=> "textarea",

									"required" => array('dynamic_content_type','content')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_link",

									"type" 	=> "input_text",

									"std" => "http://",

									"required" => array('dynamic_content_type','content')

								),







						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

						)

					            



				)

			);



/* SERVICES Small END */







/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */



/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Services Medium */



$elements[] =	array(	

				"dynamic"		=> 'services_medium',

				"name" 			=> __("Services Medium", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_medium", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 3,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

						),

						 array(    

					                                   "name"    => "Do you want Icon?",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton"

						),

						array(    

					                                   "name"    => "Do you want a predefined Icon?",

					                                   "desc"    => "",

					                                   "id"      => "icon_bool_pred",

					                                   "std"     => "yes",

					                                   "type"    => "switchbutton",

					                                   "required" => array("icon_bool", 'yes')

						),

						 array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool_pred", 'yes')

						),

						 array(    

					                                   "name"    => "Upload Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_up",

					                                   "std"     => "",

					                                   "btn_text" => "Upload",

					                                   "type"    => "upload",

					                                   "required" => array("icon_bool_pred", 'no')

						),

						array(	

									"slug"	=> "",

									"name" 	=> "Content Type",

									"desc" 	=> "Select the content type to be used",

									"id" 	=> "dynamic_content_type",

									"type" 	=> "select",

									"subtype" => array('Post' => 'post', 'Page' => 'page', 'Add Content here' => 'content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the post",

									"desc" 	=> "",

									"id" 	=> "dynamic_post",

									"type" 	=> "select",

									"subtype" => 'post',

									"required" => array('dynamic_content_type','post')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Select the page",

									"desc" 	=> "",

									"id" 	=> "dynamic_page",

									"type" 	=> "select",

									"subtype" => 'page',

									"required" => array('dynamic_content_type','page')

								),





								array(	

									"slug"	=> "",

									"name" 	=> "Content",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_content",

									"type" 	=> "textarea",

									"required" => array('dynamic_content_type','content')

								),



								

								array(	

									"slug"	=> "",

									"name" 	=> "Link",

									"desc" 	=> "",

									"id" 	=> "dynamic_content_link",

									"type" 	=> "input_text",

									"std" => "http://",

									"required" => array('dynamic_content_type','content')

								),



								array(	

									"slug"	=> "",

									"name" 	=> "Link Title",

									"desc" 	=> "",

									"id" 	=> "link_title",

									"type" 	=> "input_text",

									"std" => "",

									

								),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 3

						)

					            



				)

			);



/* SERVICES MEDIUM END */

/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* Services Steps */


/*
$elements[] =	array(	

				"dynamic"		=> 'services_steps',

				"name" 			=> __("Services Steps", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_services_steps", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 12,

				"nodescription" => true,

				'subelements' 	=> array(	

						

							

						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "steps", 

		                    "linktext"          => "Add another Tab Element",

		                    "deletetext"   		=> "Remove Tab Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

					                            array(    

						                               "name"    => "Number:",

						                                   

						                               "desc"    => "",

						                               "id"      => "number",

						                               "std"     => "",

						                               "type"    => "input_text"

						                       ),

					                            array(    

						                               "name"    => "Second Title:",

						                                   

						                               "desc"    => "",

						                               "id"      => "title_two",

						                               "std"     => "",

						                               "type"    => "input_text"

						                       ),

					                            array(    

						                               "name"    => "Description:",

						                                   

						                               "desc"    => "",

						                               "id"      => "desc",

						                               "std"     => "",

						                               "type"    => "textarea"

						                       )

					        )

					     ),



						array(    

					                                   "name"    => "Result Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

					                            array(    

						                               "name"    => "Result Number:",

						                                   

						                               "desc"    => "",

						                               "id"      => "number",

						                               "std"     => "",

						                               "type"    => "input_text"

						                       ),

					                            array(    

						                               "name"    => "Result Second Title:",

						                                   

						                               "desc"    => "",

						                               "id"      => "title_two",

						                               "std"     => "",

						                               "type"    => "input_text"

						                       ),

					                            array(    

						                               "name"    => "Result Description:",

						                                   

						                               "desc"    => "",

						                               "id"      => "desc",

						                               "std"     => "",

						                               "type"    => "textarea"

						                       ),







						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 12

						)

					            



				)

			);



/* SERVICES STEPS END */







/* ---------------------------------------------------------- */

/* ---------------------------------------------------------- */

/* TABS */



$elements[] =	array(	

				"dynamic"		=> 'tabs',

				"name" 			=> __("Tabs", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_tabs", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

								array(

									"name" => "Block Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),






						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "tabs", 

		                    "linktext"          => "Add another Tab Element",

		                    "deletetext"   		=> "Remove Tab Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Do you want Icon or Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon_bool",

					                                   "std"     => "title",

					                                   "type"    => "select",

					                                   "subtype" => array("Title" => "title", "Icon" => "icon")

												),

					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text",

					                                   "required" => array("icon_bool", 'title')

												),

												array(    

					                                   "name"    => "Select Icon",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "icon",

					                                   "std"     => "",

					                                   "type"    => "iconset",

					                                   "required" => array("icon_bool", 'icon')

												),

					                            array(    

						                               "name"    => "Content:",

						                                   

						                               "desc"    => "",

						                               "id"      => "desc",

						                               "std"     => "",

						                               "type"    => "textarea"

						                       )

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* TABS END */

/* ---------------------------------------------------------- */

/* SKILLS */



$elements[] =	array(	

				"dynamic"		=> 'skills',

				"name" 			=> __("Skills", 'themeple'),

				"slug"			=> "",

				"type" 			=> "layout_section", 

				"id" 			=> "dynamic_skills", 

				"removable"  => 'remove element',

				"blank" 		=> true, 

				"default_size" => 6,

				"nodescription" => true,

				'subelements' 	=> array(	

						

						array(

									"name" => "Title",

									"id" => "dynamic_title",

									"type" => "input_text",

									"std" => ""

									

								),



						


						 array(    

		                    

		                    "type"              => "layout_section", 

		                    "desc" 				=> "",

		                    "id"                => "skills", 

		                    "linktext"          => "Add another Tab Element",

		                    "deletetext"   		=> "Remove Tab Element",

		                    "blank"        		=> true,

		                    "subelements" 		=> array(



					                    		array(    

					                                   "name"    => "Title:",

					                                   

					                                   "desc"    => "",

					                                   "id"      => "title",

					                                   "std"     => "",

					                                   "type"    => "input_text"

												),

					                            array(    

						                               "name"    => "Percentage of the skill:",

						                               "desc"    => "",

						                               "id"      => "percentage_skill",

						                               "std"     => "",

						                               "type"    => "input_text"

						                       )

					        )

					     ),



						

						 array( 

								"id" => "dynamic_size",

								"type" => "hidden",

								"std" => 6

								)

					            



				)

			);



/* SKILLS END */



?>