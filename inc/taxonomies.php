<?php
//////////////////////////////////////// Register Series Taxonomy
function series_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Series', 'Taxonomy General Name', 'rockharbor' ),
		'singular_name'              => _x( 'Series', 'Taxonomy Singular Name', 'rockharbor' ),
		'menu_name'                  => __( 'Series', 'rockharbor' ),
		'all_items'                  => __( 'All Series', 'rockharbor' ),
		'parent_item'                => __( 'Parent Series', 'rockharbor' ),
		'parent_item_colon'          => __( 'Parent Series:', 'rockharbor' ),
		'new_item_name'              => __( 'New Series Name', 'rockharbor' ),
		'add_new_item'               => __( 'Add New Series', 'rockharbor' ),
		'edit_item'                  => __( 'Edit Series', 'rockharbor' ),
		'update_item'                => __( 'Update Series', 'rockharbor' ),
		'view_item'                  => __( 'View Series', 'rockharbor' ),
		'separate_items_with_commas' => __( 'Separate series with commas', 'rockharbor' ),
		'add_or_remove_items'        => __( 'Add or remove series', 'rockharbor' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'rockharbor' ),
		'popular_items'              => __( 'Popular Series', 'rockharbor' ),
		'search_items'               => __( 'Search Series', 'rockharbor' ),
		'not_found'                  => __( 'Not Found', 'rockharbor' ),
		'no_terms'                   => __( 'No series', 'rockharbor' ),
		'items_list'                 => __( 'Series list', 'rockharbor' ),
		'items_list_navigation'      => __( 'Series list navigation', 'rockharbor' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        'rewrite' => array('with_front' => false, 'slug' => 'series'),
	);
	register_taxonomy( 'series', array( 'message' ), $args );
}
add_action( 'init', 'series_taxonomy', 0 );

//////////////////////////////////////// Register Teachers Taxonomy
function teachers_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Teachers', 'Taxonomy General Name', 'rockharbor' ),
		'singular_name'              => _x( 'Teacher', 'Taxonomy Singular Name', 'rockharbor' ),
		'menu_name'                  => __( 'Teachers', 'rockharbor' ),
		'all_items'                  => __( 'All Teachers', 'rockharbor' ),
		'parent_item'                => __( 'Parent Teachers', 'rockharbor' ),
		'parent_item_colon'          => __( 'Parent Teachers:', 'rockharbor' ),
		'new_item_name'              => __( 'New Teacher Name', 'rockharbor' ),
		'add_new_item'               => __( 'Add New Teacher', 'rockharbor' ),
		'edit_item'                  => __( 'Edit Teacher', 'rockharbor' ),
		'update_item'                => __( 'Update Teacher', 'rockharbor' ),
		'view_item'                  => __( 'View Teacher', 'rockharbor' ),
		'separate_items_with_commas' => __( 'Separate each teaher with commas', 'rockharbor' ),
		'add_or_remove_items'        => __( 'Add or remove teachers', 'rockharbor' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'rockharbor' ),
		'popular_items'              => __( 'Popular Teachers', 'rockharbor' ),
		'search_items'               => __( 'Search Teachers', 'rockharbor' ),
		'not_found'                  => __( 'Not Found', 'rockharbor' ),
		'no_terms'                   => __( 'No teachers', 'rockharbor' ),
		'items_list'                 => __( 'Teachers list', 'rockharbor' ),
		'items_list_navigation'      => __( 'Teachers list navigation', 'rockharbor' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        'rewrite' => array('with_front' => false, 'slug' => 'teacher'),
	);
	register_taxonomy( 'teacher', array( 'message' ), $args );
}
add_action( 'init', 'teachers_taxonomy', 0 );

//////////////////////////////////////// Register Campuses Taxonomy
function campus_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Campuses', 'Taxonomy General Name', 'rockharbor' ),
		'singular_name'              => _x( 'Campus', 'Taxonomy Singular Name', 'rockharbor' ),
		'menu_name'                  => __( 'Campuses', 'rockharbor' ),
		'all_items'                  => __( 'All Campuses', 'rockharbor' ),
		'parent_item'                => __( 'Parent Campus', 'rockharbor' ),
		'parent_item_colon'          => __( 'Parent Campus:', 'rockharbor' ),
		'new_item_name'              => __( 'New Campus Name', 'rockharbor' ),
		'add_new_item'               => __( 'Add New Campus', 'rockharbor' ),
		'edit_item'                  => __( 'Edit Campus', 'rockharbor' ),
		'update_item'                => __( 'Update Campus', 'rockharbor' ),
		'view_item'                  => __( 'View Campus', 'rockharbor' ),
		'separate_items_with_commas' => __( 'Separate each campus with commas', 'rockharbor' ),
		'add_or_remove_items'        => __( 'Add or remove campus', 'rockharbor' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'rockharbor' ),
		'popular_items'              => __( 'Popular Campuses', 'rockharbor' ),
		'search_items'               => __( 'Search Campuses', 'rockharbor' ),
		'not_found'                  => __( 'Not Found', 'rockharbor' ),
		'no_terms'                   => __( 'No campuses', 'rockharbor' ),
		'items_list'                 => __( 'Campuses list', 'rockharbor' ),
		'items_list_navigation'      => __( 'Campuses list navigation', 'rockharbor' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        'rewrite' => array('with_front' => false, 'slug' => 'site'),
	);
	register_taxonomy( 'campuses', array( 'message' ), $args );
}
add_action( 'init', 'campus_taxonomy', 0 );

//////////////////////////////////////// Register Tags Taxonomy
function tags_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'rockharbor' ),
		'singular_name'              => _x( 'Tags', 'Taxonomy Singular Name', 'rockharbor' ),
		'menu_name'                  => __( 'Tags', 'rockharbor' ),
		'all_items'                  => __( 'All Tags', 'rockharbor' ),
		'parent_item'                => __( 'Parent Tags', 'rockharbor' ),
		'parent_item_colon'          => __( 'Parent Tags:', 'rockharbor' ),
		'new_item_name'              => __( 'New Tag Name', 'rockharbor' ),
		'add_new_item'               => __( 'Add New Tag', 'rockharbor' ),
		'edit_item'                  => __( 'Edit Tag', 'rockharbor' ),
		'update_item'                => __( 'Update Tag', 'rockharbor' ),
		'view_item'                  => __( 'View Tag', 'rockharbor' ),
		'separate_items_with_commas' => __( 'Separate tags with commas', 'rockharbor' ),
		'add_or_remove_items'        => __( 'Add or remove tags', 'rockharbor' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'rockharbor' ),
		'popular_items'              => __( 'Popular Tags', 'rockharbor' ),
		'search_items'               => __( 'Search Tags', 'rockharbor' ),
		'not_found'                  => __( 'Not Found', 'rockharbor' ),
		'no_terms'                   => __( 'No tags', 'rockharbor' ),
		'items_list'                 => __( 'Tag list', 'rockharbor' ),
		'items_list_navigation'      => __( 'Tag list navigation', 'rockharbor' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        'rewrite' => array('with_front' => false, 'slug' => 'message/tags'),
	);
	register_taxonomy( 'tags', array( 'message' ), $args );
}
add_action( 'init', 'tags_taxonomy', 0 );



//////////////////////////////////////// Register Department Taxonomy
function departments_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Departments', 'Taxonomy General Name', 'rockharbor' ),
		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name', 'rockharbor' ),
		'menu_name'                  => __( 'Departments', 'rockharbor' ),
		'all_items'                  => __( 'All Departments', 'rockharbor' ),
		'parent_item'                => __( 'Parent Department', 'rockharbor' ),
		'parent_item_colon'          => __( 'Parent Department:', 'rockharbor' ),
		'new_item_name'              => __( 'New Department Name', 'rockharbor' ),
		'add_new_item'               => __( 'Add New Department', 'rockharbor' ),
		'edit_item'                  => __( 'Edit Department', 'rockharbor' ),
		'update_item'                => __( 'Update Department', 'rockharbor' ),
		'view_item'                  => __( 'View Department', 'rockharbor' ),
		'separate_items_with_commas' => __( 'Separate departments with commas', 'rockharbor' ),
		'add_or_remove_items'        => __( 'Add or remove departments', 'rockharbor' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'rockharbor' ),
		'popular_items'              => __( 'Popular Departments', 'rockharbor' ),
		'search_items'               => __( 'Search Departments', 'rockharbor' ),
		'not_found'                  => __( 'Not Found', 'rockharbor' ),
		'no_terms'                   => __( 'No departments', 'rockharbor' ),
		'items_list'                 => __( 'Departments list', 'rockharbor' ),
		'items_list_navigation'      => __( 'Departments list navigation', 'rockharbor' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
        'rewrite' => array('with_front' => false, 'slug' => 'department'),
	);
	register_taxonomy( 'department', array( 'staff' ), $args );
}
add_action( 'init', 'departments_taxonomy', 0 );
