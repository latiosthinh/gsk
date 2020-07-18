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
					<p class="address">No 94, 5A Street, Binh Hung Hoa A Ward, <br> Tan Phu District HCMC, 700000, Vietnam.</p>

					<a href="mailto:gsk@gmail.com" class="email">gsk@gmail.com</a>
				</div>

				<div class="links">
					<a href="#" class="link">Our activities overview</a>
					<a href="#" class="link">How to do commission</a>
				</div>

				<div class="social">
					<a href="#"><img src="<?php echo IMG . '/instagram.png' ?>"></a>
					<a href="#"><img src="<?php echo IMG . '/discord.png' ?>"></a>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
