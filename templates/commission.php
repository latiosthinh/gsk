<?php
/**
 * Template name: Commission
 */

get_header();
?>

<section class="selection">
    <div class="name">
        <h3>SKETCHES <br> SELECTION</h3>
    </div>
    <img src="<?php echo IMG . '/sketches.png' ?>">
</section>

<section class="company">
    <h3>GSK company</h3>

    <div class="list container">
        <div class="row">
        <?php
        $items = rwmb_meta( 'group_company' );

        foreach( $items as $item ) {
            ?>
            <div class="item">
                <img src="<?php echo wp_get_attachment_url( $item['company_image'][0] ) ?>">
                <a class="btn bg-yl" href="<?php echo $item['company_url']; ?>">DOWNLOAD</a>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</section>

<section class="company gang">
    <h3>GSK gang</h3>

    <div class="list container">
        <div class="row">
        <?php
        $items = rwmb_meta( 'group_gang' );

        foreach( $items as $item ) {
            ?>
            <div class="item">
                <img src="<?php echo wp_get_attachment_url( $item['gang_image'][0] ) ?>">
                <a class="btn bg-yl" href="<?php echo $item['gang_url']; ?>">DOWNLOAD</a>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</section>

<section class="submission">
    <div class="top">
        <h3>Commission <br> submission</h3>
        <img src="<?php echo IMG . '/sketches.png' ?>">
    </div>
    <div class="content">
        <?php echo rwmb_meta( 'submission_content' ) ?>
    </div>
</section>

<section class="submission">
    <div class="top">
        <h3>Commission <br> price</h3>
        <img src="<?php echo IMG . '/sketches.png' ?>">
    </div>
    <div class="content">
        <?php echo rwmb_meta( 'price_content' ) ?>
    </div>
</section>

<?php
get_footer();