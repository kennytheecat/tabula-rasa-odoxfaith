<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tabula-rasa
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div class="featured">
			<div class="featured-text" class="left">
			The Orthodox Church is evangelical, but not Protestant.<br />It is orthodox, but not Jewish.<br />It is catholic, but not Roman.<br />It isn't non-denominational - it is pre-denominational.<br />It has believed, taught, preserved, defended and died for the Faith of the Apostles since the Day of Pentecost 2000 years ago.
			</div>		
			<div class="featured-content" class="left">
				<iframe width="400" height="300" src="http://www.youtube.com/embed/laHcgdE55Mo?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>		

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- #content -->
</div><!-- .site-content-wrapper -->
	<div class="featured-divider"></div>
	<div class="featured-cats">
		<?php query_posts('showposts=9&orderby=rand'); ?>

		<?php 
		while (have_posts()) : the_post(); 
		?>
		<div class="featured-cat-wrapper">
			<div class="featured-cat">
				<div class="home-featured-image">
					<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail('featured_cat'); ?>
					</a>
				</div>
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<div class="home-featured-text">
					<?php the_excerpt(); ?>
				</div>
				<span class="featured-cross"></span>
				<div class="read-more">
					<a href="<?php the_permalink() ?>">Read More...</a>
				</div>
			</div>
			<span class="shadow-left"></span>
			<span class="shadow-right"></span>
		</div>
		<?php 
		endwhile;
		?>			
	</div>
<?php get_footer(); ?>