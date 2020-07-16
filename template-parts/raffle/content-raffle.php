<h2><?php the_title(); ?></h2>

<?php the_post_thumbnail( 'full' ); ?>

<div class="raffle-countdown">
    <h3 class="fd sz-36 stroke-2 ttu raffle-countdown__title">raffle upcomming</h3>
    
    <p class="countdown" data-date="<?= date( 'Y-m-d H:i', rwmb_meta( 'gskraffle_time' ) ); ?>"></p>

    <form method="post">
        <input type="hidden" name="">
    </form>
</div>