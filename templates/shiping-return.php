<?php
/**
 * Template name: Shipping & Return
 */

get_header();
?>

<section class="shipping">
    <h3 class="sz-36 ttu fw-300">SHIPPING AND RETURN POLICIES?</h3>

    <div class="tabs container">
        <div class="tabs-nav col-md-6">
            <a class="tab-link ttu fw-300 active" href="#panel-1">order status & tracking</a>
            <a class="tab-link ttu fw-300" href="#panel-2">replace & refund policy</a>
            <a class="tab-link ttu fw-300" href="#panel-3">shipping & delivery policy</a>
        </div>

        <div class="tabs-panel col-md-6">
            <div id="panel-1" class="active">We don’t have a fixed schedule.since it takes lots of time & effort to cast good colorways</div>
            <div id="panel-2">We don’t have a fixed schedule.since it takes lots of time & effort to cast good colorways</div>
            <div id="panel-3">We don’t have a fixed schedule.since it takes lots of time & effort to cast good colorways</div>
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