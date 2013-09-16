<?php
add_action('init', 'services_register');

/**
 * portfolio_register()
 * 
 * @return
 */
function services_register() 
{

	$labels = array(
		'name' => _x('Services', 'post type general name'),
		'singular_name' => _x('Services Entry', 'post type singular name'),
		'add_new' => _x('Add New', 'services'),
		'add_new_item' => __('Add New Service Entry', 'themeple'),
		'edit_item' => __('Edit Service Entry', 'themeple'),
		'new_item' => __('New Service Entry', 'themeple'),
		'view_item' => __('View Service Entry', 'themeple'),
		'search_items' => __('Search Service Entries', 'themeple'),
		'not_found' =>  __('No Service Entries found', 'themeple'),
		'not_found_in_trash' => __('No Service Entries found in Trash', 'themeple'), 
		'parent_item_colon' => ''
	);
	
	$slugRule = "Service_trusted";
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'supports' => array('title','thumbnail','editor')
	);
	
	
	
	register_post_type( 'services' , $args );
	
	
	register_taxonomy("service_entries", 
		array("services"), 
		array(	"hierarchical" => true, 
		"label" => "Services Categories", 
		"singular_label" => "Services Categories", 
		"rewrite" => true,
		"query_var" => true
	));  
}

add_filter("manage_edit-services_columns", "prod_edit_services_columns");
add_action("manage_posts_custom_column",  "prod_custom_services_columns");

/**
 * prod_edit_columns()
 * 
 * @param mixed $columns
 * @return
 */
function prod_edit_services_columns($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		
		"title" => "Title",
		"service_entries" => "Categories"
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}

/**
 * prod_custom_columns()
 * 
 * @param mixed $column
 * @return
 */
function prod_custom_services_columns($column)
{
	global $post;
	switch ($column)
	{
		
	
		case "description":
		
		break;
		case "price":
		
		break;
		case "service_entries":
		echo get_the_term_list($post->ID, 'service_entries', '', ', ','');
		break;
	}
}
?>