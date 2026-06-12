<?php
/**
 * Main template: blog index, archives and search results.
 *
 * @package Dr_Manobendro_Portfolio
 */

get_header();
?>

<div class="page-hero">
	<div class="page-hero__inner">
		<h1 class="page-hero__title">
			<?php
			if ( is_home() && ! is_front_page() ) {
				single_post_title();
			} elseif ( is_search() ) {
				/* translators: %s: search query. */
				printf( esc_html__( 'Search results for "%s"', 'dr-manobendro-portfolio' ), esc_html( get_search_query() ) );
			} elseif ( is_archive() ) {
				the_archive_title();
			} else {
				esc_html_e( 'Field Notes & Articles', 'dr-manobendro-portfolio' );
			}
			?>
		</h1>
		<?php if ( is_archive() ) the_archive_description( '<div class="page-hero__description">', '</div>' ); ?>
	</div>
</div>

<div class="container">
	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="post-card__thumb" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php the_post_thumbnail( 'medium_large' ); ?>
						</a>
					<?php endif; ?>
					<div class="post-card__body">
						<p class="post-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-card__excerpt"><?php the_excerpt(); ?></div>
						<a class="post-card__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'dr-manobendro-portfolio' ); ?> &rarr;</a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<div class="pagination">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found. Try a different search.', 'dr-manobendro-portfolio' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
