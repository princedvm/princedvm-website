<?php
/**
 * Template Name: Full Width (Builder Friendly)
 * Template Post Type: page
 *
 * Full-bleed content area with the theme header and footer.
 * No page title is printed, so page builders control the whole canvas.
 *
 * @package Dr_Manobendro_Portfolio
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--full-width' ); ?>>
		<div class="entry__content entry__content--full">
			<?php the_content(); ?>
		</div>
	</article>
<?php endwhile; ?>

<?php
get_footer();
