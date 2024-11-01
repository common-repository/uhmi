<h1><?php esc_html_e( 'Welcome, let\'s get started!', 'uhmi' ) ?></h1>

<p><?php esc_html_e( 'Monetize your content by selling your articles, videos, music, podcasts and any other type of content for any price you want – from 1 cent. Amp up your service with features such as donations, Pay What You Want, subscriptions and many more.', 'uhmi' ) ?></p>

<div class="uhmi-get-started-start">

	<div class="uhmi-get-started-start-choice uhmi-get-started-start-create">
		<a href="<?php echo esc_url( UHMI_WEBSITE ) ?>/create?account_type=sell&intended=wp&client=wp&wp_redirect=<?php echo urlencode( admin_url( 'admin.php?page=uhmi&step=2' ) ) ?>" target="_blank" id="uhmi-btn-account" class="uhmi-btn uhmi-round-3em" data-next="<?php echo admin_url( 'admin.php?page=uhmi&step=2' ) ?>"><?php esc_html_e( 'Create a Uhmi account', 'uhmi' ) ?></a>
		<p><?php esc_html_e( 'It takes less than a minute!', 'uhmi' ) ?></p>
	</div>

	<div class="uhmi-get-started-start-or">|</div>

	<div class="uhmi-get-started-start-choice">
		<a href="<?php echo admin_url( 'admin.php?page=uhmi&step=2' ) ?>" class="uhmi-btn uhmi-btn-dark uhmi-btn-next uhmi-round-3em"><?php esc_html_e( 'I have a Uhmi account', 'uhmi' ) ?> &rsaquo;</a>
	</div>

</div>
