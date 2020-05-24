<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gsk
 */

?>

<div class="col-md-4">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="<?php the_permalink() ?>">
			<img src="<?php echo the_post_thumbnail_url( 'thumb-315' ) ?>">
		</a>

		<div class="entry-content">
			<a href="<?php the_permalink() ?>">
				<h3><?php the_title() ?></h3>
			
				<?php the_excerpt() ?>
			</a>
			<div class="tags">
				<?php
				$tags = get_the_tags( get_the_ID() );
				foreach ( $tags as $tag )  {
					echo '<a href="' . get_tag_link( $tag->term_id ) . '">#' .  $tag->name . '</span>';
				}
				// var_dump( $tags );
				?>
			</div>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
