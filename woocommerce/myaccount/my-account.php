<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
if ( current_user_can( 'manage_options' ) ) {

global $raffle_id;
?>
	<table class="list-user">
		<thead>
			<tr>
				<td width="5%">ID</td>
				<td width="10%">NAME</td>
				<td width="20%">EMAIL</td>
				<td width="15%">PHONE</td>
				<td width="30%">ITEMS</td>
				<td width="13%">IP</td>
				<td width="7%">ACTION</td>
			</tr>
		</thead>
		<tbody class="current-list">
		<?php
			wp_reset_postdata();

			$args = [
				'meta_key'     => 'enroll',
				'meta_value'   => $raffle_id,
			];

			$enrolled_user = get_users( $args );


			foreach ( $enrolled_user as $user ) {
				$ip       = get_user_meta( $user->ID, 'gsk_ip_address' )[0];
				$banned   = get_user_meta( $user->ID, 'banned' )[0];
				$items    = get_user_meta( $user->ID, 'enroll_items', true );
				$phone    = get_user_meta( $user->ID, 'billing_phone', true );
				$can_roll = '1' !== $banned ? 'can-roll' : '';
			?>
				<tr>
					<td><?= $user->ID ?></td>
					<td>
						<a href="<?php echo home_url(), '/wp-admin/user-edit.php?user_id=', $user->ID, '&wp_http_referer=%2Fwp-admin%2Fusers.php'; ?>" target="_blank">
							<?= $user->display_name ?>
						</a>
					</td>
					<td><?= $user->user_email ?></td>
					<td><?= $phone ?></td>
					<td class="user-item <?= $can_roll ?>"
						data-user-id="<?= $user->ID ?>"
						data-user-items="<?= $items ?>">
						<?= $items ?>
					</td>
					<td><?= $ip ?></td>
					<?php if ( $banned === '1' ) : ?>
						<td><button class="enrolled-ban banned" data-id="<?= $user->ID ?>" data-b="0">UN-BAN</button></td>
					<?php else : ?>
						<td><button class="enrolled-ban" data-id="<?= $user->ID ?>" data-b="1">BAN</button></td>
					<?php endif; ?>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<section class="roll-area">
		<div class="roll-area__actions">

			<?php
			$group_items = rwmb_meta( 'gskgroup_product', null, $raffle_id );

			foreach ( $group_items as $item ) :
			?>
				<button class="roll-btn" data-id="<?= $raffle_id ?>" data-item="<?= $item[ 'gskgallery_name' ] ?>">ROLL <?= $item[ 'gskgallery_name' ] ?></button>
			<?php endforeach; ?>

			<label>Numbers
				<input id="roll-number" type="number" value="2">
			</label>

			<button id="save-result-btn">SAVE</button>

			<a href="<?= get_permalink( $raffle_id ); ?>">Go to Raffle Results</a>
		</div>
		
		<div class="table-roll-result">
			<table>
				<thead>
					<tr>
						<td width="5%">ID</td>
						<td width="10%">NAME</td>
						<td width="20%">EMAIL</td>
						<td width="15%">PHONE</td>
						<td width="30%">ITEMS</td>
						<td width="13%">IP</td>
						<td width="7%">ACTION</td>
					</tr>
				</thead>
				<tbody class="roll-result">
				</tbody>
			</table>
		</div>
	</section>
<?php
} else {
    do_action( 'woocommerce_account_navigation' ); ?>

	<div class="woocommerce-MyAccount-content container">
		<?php
			/**
			 * My Account content.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
		?>
	</div>

	<div class="container personal-winning-raffle">
		<h3 class="txt-center txt-yl">Winning Raffle</h3>

		<div class="row">
		<?php
		$curUser = wp_get_current_user();
		$win_list = array_filter( explode( ',', get_user_meta( $curUser->ID, 'enroll_win_id', true ) ) );

		$args = [
			'post_type' => 'product',
			'post__in'  => $win_list
		];

		$raffle_query = new WP_Query($args);

		if ( $raffle_query->have_posts() ) :
			while ( $raffle_query->have_posts() ) : $raffle_query->the_post();
		?>
		<a href="<?php the_permalink() ?>" class="col-md-3 personal-winning-raffle__item">
			<?php the_post_thumbnail( 'size-woocommerce_thumbnail' ) ?>
			<?php the_title() ?>
		</a>
		<?php
			endwhile;
		endif;
		?>
		</div>
	</div>
<?php
}