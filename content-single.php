<?php
/**
 * @package tabula-rasa
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tabula-rasa' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
<?php
	$custom = get_post_custom($post->ID);
	$cfquote = $custom["cfquote"] [0];	
	$video_link = $custom["video_link"] [0];
	$video_desc = $custom["video_desc"] [0];
	
if ($cfquote != '') {
	echo '
	<div  class="top-shadow">
		<h3>Quotes from Early Christians:</h3>
		' . $cfquote . '</div>
		<div class="bottom-shadow"></div>';
}
if ($video_link != '') {
		echo '<div class="extra_video"><h3>Featured Video - ' . $video_desc . '</h3>				<object type="application/x-shockwave-flash" style="width:425px; height:350px;" data="http://www.youtube.com/v/' . $video_link . '">
					<param name="movie" value="http://www.youtube.com/v/' .  $video_link . '" />
				</object><br /></div>';
	}		
?>
</article><!-- #post-## -->
