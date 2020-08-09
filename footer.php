<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gsk
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row">
				<?php the_custom_logo(); ?>

				<div class="info">
					<?php if ( rwmb_meta( 'gsk_address', null, get_option( 'page_on_front' ) ) ) : ?>
						<p class="address"><?= rwmb_meta( 'gsk_address', null, get_option( 'page_on_front' ) ) ?></p>
					<?php endif; ?>
					
					<?php if ( rwmb_meta( 'gsk_email', null, get_option( 'page_on_front' ) ) ) : ?>
						<a href="mailto:<?= rwmb_meta( 'gsk_email', null, get_option( 'page_on_front' ) ) ?>" class="email"><?= rwmb_meta( 'gsk_email', null, get_option( 'page_on_front' ) ) ?></a>
					<?php endif; ?>
					
				</div>

				<div class="links">
					<?php 
					$links = rwmb_meta( 'gsk_links', null, get_option( 'page_on_front' ) );

					if ( $links ) :
						foreach ( $links as $l ) :
					?>
						<a href="<?= $l[ 'url' ] ?>" class="link"><?= $l[ 'title' ] ?></a>
					<?php
						endforeach;
					endif;
					?>
				</div>

				<div class="social">
					<a href="<?= rwmb_meta( 'gsk_instagram', null, get_option( 'page_on_front' ) ) ?>"><img src="<?php echo IMG . '/instagram.png' ?>"></a>
					<a href="<?= rwmb_meta( 'gsk_discord', null, get_option( 'page_on_front' ) ) ?>"><img src="<?php echo IMG . '/discord.png' ?>"></a>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
