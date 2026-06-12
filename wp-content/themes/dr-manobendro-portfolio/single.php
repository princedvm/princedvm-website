<?php
/**
 * Single post template.
 *
 * @package Dr_Manobendro_Portfolio
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class="page-hero">
		<div class="page-hero__inner">
			<p class="page-hero__meta">
				<?php echo esc_html( get_the_date() ); ?> &middot; <?php the_author(); ?>
			</p>
			<h1 class="page-hero__title"><?php the_title(); ?></h1>
		</div>
	</div>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry--single' ); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry__thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<div class="entry__content">
			<?php
			the_content();
			wp_link_pages();
			?>
		</div>

		<footer class="entry__footer">
			<?php the_tags( '<p class="entry__tags">' . esc_html__( 'Tags:', 'dr-manobendro-portfolio' ) . ' ', ', ', '</p>' ); ?>
			<div class="entry__nav">
				<div><?php previous_post_link( '%link', '&larr; %title' ); ?></div>
				<div><?php next_post_link( '%link', '%title &rarr;' ); ?></div>
			</div>
		</footer>
	</article>

	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
<?php endwhile; ?>

<?php
get_footer();
