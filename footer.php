<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package tabula-rasa
 */
?>
	<?php if (!is_home()) {?>
		</div><!-- #content -->
	</div><!-- .site-content-wrapper -->
	<?php } ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner-footer">
<?php
// get all the categories from the database
$cats = get_categories(); 

// loop through the categries
foreach ($cats as $cat) {
		// setup the cateogory ID
		$cat_id = $cat->term_id;
		if ( $cat_id == 1 ) continue;
		// Make a header for the cateogry
		echo "<div class='site-map-section'>";
		echo "<h2 class='site-map-title'>".$cat->name."</h2>";
		echo "<ul>";
		
		// create a custom wordpress query
		query_posts("cat=$cat_id&posts_per_page=100");
		// start the wordpress loop!
		if (have_posts()) : while (have_posts()) : the_post(); ?>
			<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
		<?php 
		endwhile; 
		endif; // done our wordpress loop. Will start again for each category ?>
	</ul>
	</div>		
<?php } // done the foreach statement ?>
			<div class="bottom-footer">
				<div class="site-info">
					<?php printf( __( 'Site Design by %1$s', 'tabula-rasa' ),  '<a href="http://third-law.com/" rel="designer">Third Law Web Design</a>' ); ?>
				</div><!-- .site-info -->
				<?php wp_nav_menu( array( 'theme_location' => 'social', 'container_class' => 'menu-social') ); ?>				
			</div>
		</div>	
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>