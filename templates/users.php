<?php
/**
 * Template name: Users
 */
if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
	wp_redirect( esc_url( home_url() ) );
}

get_header();
?>

<table class="list-user">
	<thead>
		<tr>
			<td width="5%">ID</td>
			<td width="10%">NAME</td>
			<td width="15%">EMAIL</td>
			<td width="10%">PHONE</td>
			<td width="30%">WIN ITEMS</td>
			<td width="10%">WIN TIMES</td>
			<td width="13%">IP</td>
			<td width="7%">ACTION</td>
		</tr>
	</thead>
	<tbody class="current-list">
	<?php
		wp_reset_postdata();

		$per_page = 50;
		$offset = isset( $_GET['offset'] ) ? $_GET['offset'] : 0;

		$args = array(
			'role'   => 'Customer',
			'number' => -1
		);
		$user_query = new WP_User_Query( $args );
		$total_pages = count($user_query->get_results()) / $per_page;

		$args = array(
			'role'     => 'Customer',
			'meta_key' => 'gsk_ip_address',
			'orderby'  => 'meta_value',
			'number'   => $per_page,
			'offset'   => $offset
		);
		$user_query = new WP_User_Query( $args );
		$all_users  = $user_query->get_results();

		foreach( $all_users as $user ) {
			$ip       = get_user_meta( $user->ID, 'gsk_ip_address' )[0];
			$banned   = get_user_meta( $user->ID, 'banned' )[0];
			$items    = get_user_meta( $user->ID, 'enroll_win', true );
			$times    = explode( '|', $items );
			$phone    = get_user_meta( $user->ID, 'billing_phone', true );
			$can_roll = '1' !== $banned ? 'can-roll' : '';
		?>
		<tr>
			<td style="text-align:center"><?= $user->ID ?></td>
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
			<td style="text-align:center"><?= count( $times ) - 1; ?></td>
			<td><?= $ip ?></td>
			<?php if ( $banned === '1' ) : ?>
				<td style="text-align:center"><button class="enrolled-ban banned" data-id="<?= $user->ID ?>" data-b="0">UN-BAN</button></td>
			<?php else : ?>
				<td style="text-align:center"><button class="enrolled-ban" data-id="<?= $user->ID ?>" data-b="1">BAN</button></td>
			<?php endif; ?>
		</tr>
		<?php
		}

		$args = [
			'orderby'     => 'ids',
		];

		$enrolled_user = get_users( $args );


		foreach ( $enrolled_user as $user ) {
			$ip       = get_user_meta( $user->ID, 'gsk_ip_address' )[0];
			$banned   = get_user_meta( $user->ID, 'banned' )[0];
			$items    = get_user_meta( $user->ID, 'enroll_win', true );
			$times    = explode( '|', $items );
			$phone    = get_user_meta( $user->ID, 'billing_phone', true );
			$can_roll = '1' !== $banned ? 'can-roll' : '';
		?>
			<tr>
				<td style="text-align:center"><?= $user->ID ?></td>
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
				<td style="text-align:center"><?= count( $times ) - 1; ?></td>
				<td><?= $ip ?></td>
				<?php if ( $banned === '1' ) : ?>
					<td style="text-align:center"><button class="enrolled-ban banned" data-id="<?= $user->ID ?>" data-b="0">UN-BAN</button></td>
				<?php else : ?>
					<td style="text-align:center"><button class="enrolled-ban" data-id="<?= $user->ID ?>" data-b="1">BAN</button></td>
				<?php endif; ?>
			</tr>
		<?php } ?>
	</tbody>
</table>

<?php
get_footer();