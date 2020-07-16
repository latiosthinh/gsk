<?php
/**
 * Template name: Raffle
 */

get_header();
?>

<section class="raffle-flow">
    <h3 class="sz-48 fi ttu fw-300">HOW TO ENTER <br> GSK RAFFLE SALES</h3>

    <h4 class="ttu fd stroke-2 txt-yl">raffle flow</h4>

    <div class="col-md-6">
        <?php
        $images = rwmb_meta( 'raffle-flow', array( 'size' => 'thumbnail' ) );
        
        foreach ( $images as $img ) :
        ?>

        <img src="<?= $img['full_url'] ?>" >

        <?php endforeach; ?>
    </div>
</section>

<section class="raffle-regulation">
    <h4 class="ttu fd stroke-2 txt-yl">raffle regulation</h4>
    
    <div class="col-md-6">
        <img src="<?php echo IMG . '/regulation.png' ?>">
    </div>
</section>

<?php
get_footer();