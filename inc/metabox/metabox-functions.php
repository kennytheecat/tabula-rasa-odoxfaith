<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	
	/**
	 * Metabox to be displayed on a single page ID
	 */
	$meta_boxes['cfquote'] = array(
		'id'         => 'cfquote',
		'title'      => __( 'Church Father Quotes', 'tabula-rasa' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Quote', 'tabula-rasa' ),
				'desc' => __( '', 'tabula-rasa' ),
				'id'   => 'cfquote',
				'type' => 'textarea',
			),
		)
	);
	
	$meta_boxes['feat_video'] = array(
		'id'         => 'feat_video',
		'title'      => __( 'Featured Video', 'tabula-rasa' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Video Title', 'tabula-rasa' ),
				'desc' => __( '', 'tabula-rasa' ),
				'id'   => 'video_desc',
				'type' => 'text',
			),
			array(
				'name' => __( 'Video Link', 'tabula-rasa' ),
				'desc' => __( '', 'tabula-rasa' ),
				'id'   => 'video_link',
				'type' => 'text',
			),
		),
	);	
	
	/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['ext_articles'] = array(
		'id'         => 'ext_articles',
		'title'      => __( 'Articles from the Web', 'tabula-rasa' ),
		'pages'      => array( 'post', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'ext_articles',
				'type'        => 'group',
				'description' => __( 'Generates reusable form entries', 'tabula-rasa' ),
				'options'     => array(
					'group_title'   => __( 'Entry {#}', 'tabula-rasa' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Entry', 'tabula-rasa' ),
					'remove_button' => __( 'Remove Entry', 'tabula-rasa' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Article Title',
						'id'   => 'ext_article_title',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Article Link',
						'description' => '',
						'id'   => 'ext_article_link',
						'type' => 'text',
					),
				),
			),
		),
	);

	/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['amazon'] = array(
		'id'         => 'amazon',
		'title'      => __( 'Recommended Books', 'tabula-rasa' ),
		'pages'      => array( 'post', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'amazon_post',
				'type'        => 'group',
				'description' => __( 'Generates reusable form entries', 'tabula-rasa' ),
				'options'     => array(
					'group_title'   => __( 'Entry {#}', 'tabula-rasa' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Entry', 'tabula-rasa' ),
					'remove_button' => __( 'Remove Entry', 'tabula-rasa' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Product Title',
						'id'   => 'product_title_post',
						'type' => 'text',
						// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
					),
					array(
						'name' => 'Product Link',
						'description' => '',
						'id'   => 'product_link_post',
						'type' => 'text',
					),
				),
			),
		),
	);	
	
	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
