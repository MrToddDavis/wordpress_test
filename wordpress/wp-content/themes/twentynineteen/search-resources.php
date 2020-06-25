<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php _e( 'Search results for: ', 'twentynineteen' ); ?>
					<span class="page-description"><?php echo get_search_query(); ?></span>
				</h1>

				<?php
				/*
				 * Dropdowns for each taxonomy and term within.
				 * Not sure what this outputs. If it's an array of objects, would do $taxonomy->name.
				 */
				$taxonomies = get_taxonomies();
				foreach ($taxonomies as $taxonomy) {
					echo '<label for="' . $taxonomy . '">' . $taxonomy . ':</label>
					<select name="' . $taxonomy . '" id="' . $taxonomy . '">';
					$terms = get_the_term_list( $post->ID, '$taxonomy', ',', '' );
					foreach ($term in $terms) {
						echo '<option value="' . $term . '">' . $term . '</option>'
					}
					echo '</select>'
				}
				?>
				
				<?php
				get_the_term_list( $post->ID, 'audience', '<strong>Audiences: </strong>', ', ', ' ');
				get_the_term_list( $post->ID, 'topic', '<strong>Topics: </strong>', ', ', ' ');
				?>

			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that
				 * will be used instead.
				 */
				get_template_part( 'template-parts/content/content', 'excerpt' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			twentynineteen_the_posts_navigation();

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
