<?php
$raffle_id = get_queried_object_id();
wp_reset_postdata();

$args = [
	'orderby'    => 'ID',
	'meta_query' => [
		[
			'key'     => 'enroll_win_id',
			'value'   => $raffle_id,
			'compare' => 'LIKE'
		]
	]
];

$win_users = get_users( $args );

if ( ! $win_users ) {
	return;
}
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
foreach ( $win_users as $user ) {
	$ip       = get_user_meta( $user->ID, 'gsk_ip_address' )[0];
	$banned   = get_user_meta( $user->ID, 'banned' )[0];
	$items    = get_user_meta( $user->ID, 'enroll_win', true );
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