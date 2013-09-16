<?php
add_action('init', 'header_register');

/**
 * portfolio_register()
 * 
 * @return
 */
function header_register() 
{

	$labels = array(
		'name' => _x('Top Headers', 'post type general name'),
		'singular_name' => _x('Header Entry', 'post type singular name'),
		'add_new' => _x('Add New', 'header'),
		'add_new_item' => __('Add New Header Entry', 'themeple'),
		'edit_item' => __('Edit Header Entry', 'themeple'),
		'new_item' => __('New Header Entry', 'themeple'),
		'view_item' => __('View Header Entry', 'themeple'),
		'search_items' => __('Search Header Entries', 'themeple'),
		'not_found' =>  __('No Header Entries found', 'themeple'),
		'not_found_in_trash' => __('No Header Entries found in Trash', 'themeple'), 
		'parent_item_colon' => ''
	);
	
	$slugRule = "header_trusted";
	
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
	
	
	
	register_post_type( 'header' , $args );
	
	
	register_taxonomy("header_entries", 
		array("header"), 
		array(	"hierarchical" => true, 
		"label" => "Header Categories", 
		"singular_label" => "Header Categories", 
		"rewrite" => true,
		"query_var" => true
	));  
}

add_filter("manage_edit-header_columns", "prod_edit_header_columns");
add_action("manage_posts_custom_column",  "prod_custom_header_columns");

/**
 * prod_edit_columns()
 * 
 * @param mixed $columns
 * @return
 */
function prod_edit_header_columns($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Title",
		"header_entries" => "Categories"
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
function prod_custom_header_columns($column)
{
	global $post;
	switch ($column)
	{
		
	
		case "description":
		
		break;
		case "price":
		
		break;
		case "header_entries":
		echo get_the_term_list($post->ID, 'header_entries', '', ', ','');
		break;
	}
}
?>