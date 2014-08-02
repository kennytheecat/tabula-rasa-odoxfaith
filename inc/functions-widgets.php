<?php
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
?>
<?php
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
?>
<?php
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
	$link1 = $custom["link1"] [0];
	$link2 = $custom["link2"] [0];
	$link3 = $custom["link3"] [0];
	$link4 = $custom["link4"] [0];
	$link5 = $custom["link5"] [0];	
	$title1 = $custom["title1"] [0];
	$title2 = $custom["title2"] [0];
	$title3 = $custom["title3"] [0];
	$title4 = $custom["title4"] [0];
	$title5 = $custom["title5"] [0];
		if ( ! empty( $title ) && $link1 != '' ) echo $before_title . $title . $after_title;	
if ($link1 != '') {
	//echo '<div id="post_extras">';
	if ($link1 != '') { 
		echo '<a href="' . $link1 . '" target="_blank">' . $title1 . '</a><br />';
	}
	if ($link2 != '') { 
		echo '<a href="' . $link2 . '" target="_blank">' . $title2 . '</a><br />';
	}
	if ($link3 != '') { 
		echo '<a href="' . $link3 . '" target="_blank">' . $title3 . '</a><br />';
	}
	if ($link4 != '') { 
		echo '<a href="' . $link4 . '" target="_blank">' . $title4 . '</a><br />';
	}
	if ($link5 != '') { 
		echo '<a href="' . $link5 . '" target="_blank">' . $title5 . '</a><br />';
	}
	//echo '</div>';
}
	wp_reset_postdata();
		echo $after_widget; 
	}

}
register_widget( 'recommended_articles_Widget' );
?>
<?php
class church_fathers_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'church_fathers', // Base ID
			'Quotes from the Early Church', // Name
			array( 'description' => __( 'Displays quotes from the early church')) // Args
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
			extract( $args );
		$title = 'Quotes from the Early Church'; 

		echo $before_widget;
		$before_title = '<div class="widget-title-wrap"><div class="widget-title">';
		$after_title = '</div></div>';
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		
	$custom = get_post_custom($post->ID);
	$cfquote = $custom["cfquote"] [0];
	
if ($cfquote != '') {
	//echo '<div id="post_extras">';
	if ($cfquote != '') { 
		echo $cfquote . '<br />';
	}
	//echo '</div>';
}
	wp_reset_postdata();
		echo $after_widget; 
	}

}
register_widget( 'church_fathers_Widget' );
?>
<?php
class featured_video_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
	 		'featured_video', // Base ID
			'Featured Video', // Name
			array( 'description' => __( 'Featured Video')) // Args
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
			extract( $args );
		$title = 'Featured Video'; 

		echo $before_widget;
		$before_title = '<div class="widget-title-wrap"><div class="widget-title">';
		$after_title = '</div></div>';
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;

	$custom = get_post_custom($post->ID);
	$video_link = $custom["video_link"] [0];
	$video_desc = $custom["video_desc"] [0];	
		if ( ! empty( $title )  && ($video_link != '') ) echo $before_title . $title . $after_title;	
if ($video_link != '') {
	//echo '<div id="post_extras">';
	if ($video_link != '') { 
		echo '<div id="extra_video"><h3>Featured Video - ' . $video_desc . '</h3>				<object type="application/x-shockwave-flash" style="width:275px; height:225px;" data="http://www.youtube.com/v/' . $video_link . '">
					<param name="movie" value="http://www.youtube.com/v/' .  $video_link . '" />
				</object><br /></div>';
	}
	//echo '</div>';
}
	wp_reset_postdata();
		echo $after_widget; 
	}

}
register_widget( 'featured_video_Widget' );
?>
<?php
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
	$amazon_link1 = $custom["amazon_link1"] [0];
	$amazon_link2 = $custom["amazon_link2"] [0];
	$amazon_link3 = $custom["amazon_link3"] [0];
	$amazon_link4 = $custom["amazon_link4"] [0];
	$amazon_title1 = $custom["amazon_title1"] [0];
	$amazon_title2 = $custom["amazon_title2"] [0];
	$amazon_title3 = $custom["amazon_title3"] [0];
	$amazon_title4 = $custom["amazon_title4"] [0];
		if ( ! empty( $title ) && ($amazon_link1 != '') ) echo $before_title . $title . $after_title;	
if ($amazon_link1 != '') {
	if ($amazon_link1 != '') { 
		echo '
		<div class="ad_image_wrap">
			<div class="ad_image">
			<a href="http://www.amazon.com/gp/product/' . $amazon_link1 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link1 . '&linkCode=as2&tag=rv0f-20" target="_blank"><img border="0" src="http://ws.assoc-amazon.com/widgets/q?_encoding=UTF8&ASIN=' . $amazon_link1 . '&Format=_SL110_&ID=AsinImage&MarketPlace=US&ServiceVersion=20070822&WS=1&tag=rv0f-20" ></a><img src="http://www.assoc-amazon.com/e/ir?t=rv0f-20&l=as2&o=1&a=' . $amazon_link1 . '" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
			</div>
			<div class="ad_text"><a href="http://www.amazon.com/gp/product/' . $amazon_link1 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link1 . '&linkCode=as2&tag=rv0f-20" target="_blank">' . $amazon_title1 . '</a>
			</div>
		</div>';
	}
	if ($amazon_link2 != '') { 
		echo '
		<div class="ad_image_wrap">
			<div class="ad_image">
			<a href="http://www.amazon.com/gp/product/' . $amazon_link2 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link2 . '&linkCode=as2&tag=rv0f-20" target="_blank"><img border="0" src="http://ws.assoc-amazon.com/widgets/q?_encoding=UTF8&ASIN=' . $amazon_link2 . '&Format=_SL110_&ID=AsinImage&MarketPlace=US&ServiceVersion=20070822&WS=1&tag=rv0f-20" ></a><img src="http://www.assoc-amazon.com/e/ir?t=rv0f-20&l=as2&o=1&a=' . $amazon_link2 . '" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
			</div>
			<div class="ad_text"><a href="http://www.amazon.com/gp/product/' . $amazon_link2 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link2 . '&linkCode=as2&tag=rv0f-20" target="_blank">' . $amazon_title2 . '</a>
			</div>
		</div>';		
	}
	if ($amazon_link3 != '') { 
		echo '
		<div class="ad_image_wrap">
			<div class="ad_image">
			<a href="http://www.amazon.com/gp/product/' . $amazon_link3 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link3 . '&linkCode=as2&tag=rv0f-20" target="_blank"><img border="0" src="http://ws.assoc-amazon.com/widgets/q?_encoding=UTF8&ASIN=' . $amazon_link3 . '&Format=_SL110_&ID=AsinImage&MarketPlace=US&ServiceVersion=20070822&WS=1&tag=rv0f-20" ></a><img src="http://www.assoc-amazon.com/e/ir?t=rv0f-20&l=as2&o=1&a=' . $amazon_link3 . '" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
			</div>
			<div class="ad_text"><a href="http://www.amazon.com/gp/product/' . $amazon_link3 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link3 . '&linkCode=as2&tag=rv0f-20" target="_blank">' . $amazon_title3 . '</a>
			</div>
		</div>';
	}
	if ($amazon_link4 != '') { 
		echo '
		<div class="ad_image_wrap">
			<div class="ad_image">
			<a href="http://www.amazon.com/gp/product/' . $amazon_link4 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link4 . '&linkCode=as2&tag=rv0f-20" target="_blank"><img border="0" src="http://ws.assoc-amazon.com/widgets/q?_encoding=UTF8&ASIN=' . $amazon_link4 . '&Format=_SL110_&ID=AsinImage&MarketPlace=US&ServiceVersion=20070822&WS=1&tag=rv0f-20" ></a><img src="http://www.assoc-amazon.com/e/ir?t=rv0f-20&l=as2&o=1&a=' . $amazon_link4 . '" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
			</div>
			<div class="ad_text"><a href="http://www.amazon.com/gp/product/' . $amazon_link4 . '/ref=as_li_ss_il?ie=UTF8&camp=1789&creative=390957&creativeASIN=' . $amazon_link4 . '&linkCode=as2&tag=rv0f-20" target="_blank">' . $amazon_title4 . '</a>
			</div>
		</div>';
	}	
	if ($amazon_link1 != '') { 
		echo '</div>';
	}
}
	wp_reset_postdata();
		echo $after_widget; 
	}

}
register_widget( 'amazon_ads_Widget' );
?>