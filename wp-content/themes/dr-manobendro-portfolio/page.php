<?php
/**
 * Default page template.
 *
 * @package Dr_Manobendro_Portfolio
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( ! is_front_page() ) : ?>
		<div class="page-hero">
			<div class="page-hero__inner">
				<h1 class="page-hero__title"><?php the_title(); ?></h1>
			</div>
		</div>
	<?php endif; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--page' ); ?>>
		<div class="entry__content">
			<?php
			the_content();
			wp_link_pages();
			?>
		</div>
	</article>
<?php endwhile; ?>

<?php
get_footer();
