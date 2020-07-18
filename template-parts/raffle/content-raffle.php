<h2><?php the_title(); ?></h2>

<?php the_post_thumbnail( 'full' ); ?>

<div class="raffle-countdown">
	<h3 class="fd sz-36 stroke-2 ttu raffle-countdown__title">raffle upcomming</h3>
	
	<p class="countdown"
	data-id="<?= get_the_ID(); ?>"
	data-date="<?= date( 'Y-m-d H:i', rwmb_meta( 'gskraffle_time' ) ); ?>"
	data-end="<?= date( 'Y-m-d H:i', rwmb_meta( 'gskraffle_end_time' ) ); ?>"
	></p>
</div>