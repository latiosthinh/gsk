<?php
/**
 * Template name: Shipping & Return
 */

get_header();
?>

<section class="shipping">
	<h3 class="sz-36 ttu fw-300">SHIPPING AND RETURN POLICIES?</h3>

	<?php $qa = rwmb_meta( 'gsk_qa' ); ?>
	<div class="tabs container">
		<div class="tabs-nav col-md-6">
			<?php 
			$i = 0;
			foreach( $qa as $q ): ?>
			<a class="tab-link ttu fw-300" href="#panel-<?= $i+1 ?>"><?= $q[ 'gsk_question' ]  ?></a>
			<?php endforeach; ?>
		</div>

		<div class="tabs-panel col-md-6">
			<?php
			$i = 0;
			foreach( $qa as $a ):
			?>
			<div id="panel-<?= $i+1 ?>"><?= $a[ 'gsk_answer' ]  ?></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="content">
	<div class="container pad-0">
		<div class="col-md-10">
			<?php the_content(); ?>
		</div>
	</div>
</section>

<?php
get_footer();