<?php
/* Featured Post
**********************************************************************/
class excerpts_by_alt_category_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'excerpts_by_alt_category', // Base ID
			'Excerpts of Other Categories', // Name
			array( 'description' => __( 'Displays excerpts of other categories')) // Args
		);
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	public function form( $instance ) {
	}

	public function widget( $args, $instance ) {
		global $post;
		$categories = get_the_category($post->ID);
		$cat_name = $categories[0]->cat_name;
	
		extract( $args );
		$title = 'Featured Articles';

		echo $before_widget;
		$before_title = '<div class="widget-title-wrap"><div class="widget-title">';
		$after_title = '</div></div>';
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

		$args= array(
			'posts_per_page' => 1,
			'orderby' => 'rand',
			'cat' => -$cat_name
			);

	$featuredWidget= new WP_Query($args);
	
	while ( $featuredWidget->have_posts() ) : $featuredWidget->the_post(); ?>
	<div class="widget_featured">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt();?>
	</div>
		<?php
	endwhile;
	wp_reset_postdata();
		echo $after_widget; 
	}

}
register_widget( 'excerpts_by_alt_category_Widget' );

/* Related Posts
**********************************************************************/
class posts_by_category_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'posts_by_category', // Base ID
			'Posts by Category', // Name
			array( 'description' => __( 'Displays posts by category')) // Args
		);
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	public function form( $instance ) {
		$title = (isset( $instance[ 'title' ])) ? $instance[ 'title' ] : 'Featured Business';

	?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
	<?php 
	}


	public function widget( $args, $instance ) {
		global $post;
		$categories = get_the_category($post->ID);
		$cat_name = $categories[0]->cat_name;
	
		extract( $args );
		$title = 'More Articles About ' . $cat_name; 

		echo $before_widget;
		$before_title = '<div class="widget-title-wrap"><div class="widget-title">';
		$after_title = '</div></div>';
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

		$args= array(
			'posts_per_page' => -1,
			'category_name' => $cat_name
			);

	$featuredWidget= new WP_Query($args);
	
	while ( $featuredWidget->have_posts() ) : $featuredWidget->the_post(); ?>
	
	<div class="widget_featured">
		
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt();?>
	</div>
		
		<?php
	endwhile;
	
	wp_reset_postdata();

		echo $after_widget; 
	}

}
register_widget( 'posts_by_category_Widget' );

/* Recommended External Articles
**********************************************************************/
class recommended_articles_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'recommended_articles', // Base ID
			'Recommended Articles', // Name
			array( 'description' => __( 'Displays recommended articles')) // Args
		);
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	public function form( $instance ) {
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = 'Articles from the Web'; 

		echo $before_widget;
		$before_title = '<div class="widget-title-wrap"><div class="widget-title">';
		$after_title = '</div></div>';

		$custom = get_post_custom($post->ID);
		
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;	
		
		$ext_articles = $custom["_cmb_ext_articles"] [0];
		$ext_articles = unserialize($ext_articles);
		foreach ( (array)$ext_articles as $value ) { 
			echo '<a href="' . $value['ext_article_link'] . '" target="_blank">' . $value['ext_article_title'] . '</a><br />'; 
		}
		
		wp_reset_postdata();
		echo $after_widget; 		
	}
}
register_widget( 'recommended_articles_Widget' );

/* Recommended Books
**********************************************************************/
class amazon_ads_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'amazon_ads', // Base ID
			'Amazon Ads', // Name
			array( 'description' => __( 'Displays Amazon Ads')) // Args
		);
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	public function form( $instance ) {
	}

	public function widget( $args, $instance ) {
			extract( $args );
		$title = 'Recommended Books'; 

		echo $before_widget;
		$before_title = '<div class="widget-title-wrap"><div class="widget-title">';
		$after_title = '</div></div>';

		$custom = get_post_custom($post->ID);
		if ( ! empty( $title )  ) echo $before_title . $title . $after_title;	
		
		$amazon = $custom["_cmb_amazon_post"] [0];
		$amazon = unserialize($amazon);
		foreach ( (array)$amazon as $value ) {
			echo '
			<div class="ad_image_wrap">
				<div class="ad_image">
				<a href="http://www.amazon.com/gp/product/' . $value['product_link_post'] . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $value['product_link_post'] . '&linkCode=as2&tag=rv0f-20" target="_blank"><img border="0" src="http://ws.assoc-amazon.com/widgets/q?_encoding=UTF8&ASIN=' . $value['product_link_post'] . '&Format=_SL110_&ID=AsinImage&MarketPlace=US&ServiceVersion=20070822&WS=1&tag=rv0f-20" ></a><img src="http://www.assoc-amazon.com/e/ir?t=rv0f-20&l=as2&o=1&a=' . $value['product_link_post'] . '" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
				</div>
				<div class="ad_text"><a href="http://www.amazon.com/gp/product/' . $value['product_link_post'] . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $value['product_link_post'] . '&linkCode=as2&tag=rv0f-20" target="_blank">' . $value['product_title_post'] . '</a>
				</div>
			</div>';
		} 
	wp_reset_postdata();
		echo $after_widget; 
	}
}
register_widget( 'amazon_ads_Widget' );
?>