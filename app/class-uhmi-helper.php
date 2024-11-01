<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper class with all kinds of (handy) functions.
 */
class Uhmi_Helper
{
	/**
	 * Default button currency.
	 */
	private static $default_button_currency = 'EUR';

	/**
	 * Default button color.
	 */
	private static $default_button_color = '#007bff';

	/**
	 * Max length of content title.
	 */
	private static $title_max_length = 120;

	/**
	 * All loaded payment ids.
	 */
	public static $loaded_payment_ids;

	/**
	 * Add a loaded payment id.
	 *
	 * @param  string  $payment_id
	 * @return array
	 */
	public static function add_loaded_payment_id($payment_id)
	{
		return self::$loaded_payment_ids[] = $payment_id;
	}

	/**
	 * Update Uhmi options.
	 *
	 * @param  array  $options
	 * @return void
	 */
	public static function update_options($options)
	{
		if ( ! is_array($options)) {
			return;
		}

		$uhmi_options = get_option( 'uhmi_options', array() );
		$uhmi_options = array_merge($uhmi_options, $options);

		update_option( 'uhmi_options', $uhmi_options, true );
	}

	/**
	 * Get option.
	 *
	 * @param  string  $key
	 * @param  mixed   $return
	 * @return mixed
	 */
	public static function get_option($key, $return = false)
	{
		$uhmi_options = get_option( 'uhmi_options', false );

		return (isset($uhmi_options[$key]) ? $uhmi_options[$key] : $return);
	}

	/**
	 * Get default text of button.
	 *
	 * @return string
	 */
	public static function get_default_button_text()
	{
		return __( 'Buy for %currency%%price%', 'uhmi' );
	}

	/**
	 * Get default currency of button.
	 *
	 * @return string
	 */
	public static function get_default_button_currency()
	{
		return self::$default_button_currency;
	}

	/**
	 * Get default color of button.
	 *
	 * @return string
	 */
	public static function get_default_button_color()
	{
		return  self::$default_button_color;
	}

	/**
	 * Get general text of button.
	 *
	 * @return string
	 */
	public static function get_button_text()
	{
		$button_option = Uhmi_Helper::get_option('button', null);

		if ( ! isset($button_option['text'])) {
			return self::get_default_button_text();
		}

		return $button_option['text'];
	}

	/**
	 * Get general currency of button.
	 *
	 * @return string
	 */
	public static function get_button_currency()
	{
		$currencies = self::get_currencies();
		$button_option = Uhmi_Helper::get_option('button', null);

		if ( ! isset($button_option['currency'])) {
			return $currencies[self::get_default_button_currency()];
		}

		$currency = $button_option['currency'];

		if (isset($currencies[$currency])) {
			return $currencies[$currency];
		}

		return $currencies[self::get_default_button_currency()];
	}

	/**
	 * Get general color of button.
	 *
	 * @return string
	 */
	public static function get_button_color()
	{
		$button_option = Uhmi_Helper::get_option('button', null);

		if ( ! isset($button_option['color'])) {
			return self::get_default_button_color();
		}

		return $button_option['color'];
	}

	/**
	 * Get button.
	 *
	 * @param  object  $post
	 * @param  int 	   $price
	 * @return string
	 */
	public static function get_button($post, $price = 0)
	{
		$button_option = get_post_meta( $post->ID, 'uhmi_content_button', true );

		$color = self::get_default_button_color();
		$colorType = ( isset($button_option['color_type']) ? $button_option['color_type'] : 'general' );

		if ($colorType === 'custom') {

			if (isset($button_option['color']) && ! empty($button_option['color'])) {
				$color = $button_option['color'];
			}

		} elseif ($colorType === 'general') {

			$color = self::get_button_color();
		}

		$text = self::get_default_button_text();
		$type = ( isset($button_option['type']) ? $button_option['type'] : 'general' );

		if ($type === 'custom') {

			if (isset($button_option['text']) && ! empty($button_option['text'])) {
				$text = $button_option['text'];
			}

		} elseif ($type === 'general') {

			$text = self::get_button_text();
		}

		$buttonText = str_replace('%price%', number_format_i18n( floatval($price), 2 ), $text);
		$buttonText = str_replace('%currency%', self::get_button_currency(), $buttonText);
		//$buttonText = esc_html( $buttonText ) . ' <span>' . esc_html( 'via Uhmi', 'uhmi' ) . '</span>';
		$buttonText = esc_html( $buttonText );

		return array(
			'color' => $color,
			'text'  => $buttonText
		);
	}

	/**
	 * Get note.
	 *
	 * @param  object  $post
	 * @return string
	 */
	public static function get_note($post)
	{
		$note  = get_post_meta( $post->ID, 'uhmi_content_note', true );
		$noteType = ( isset($note['type']) ? $note['type'] : 'disabled' );

		if ($noteType === 'custom') {
			$note = ( isset($note['text']) ? $note['text'] : Uhmi_Helper::get_option('note', '') );
		} elseif ($noteType === 'general') {
			$note = Uhmi_Helper::get_option('note', '');
		} else {
			return false;
		}

		$note = str_replace( ']]>', ']]&gt;', $note );

		return $note;
	}

	/**
	 * Is post type allowed?
	 *
	 * @param  string  $postType
	 * @return bool
	 */
	public static function is_post_type_allowed($postType)
	{
		if ($postType === 'post') {
			return true;
		}

		if ($postType === 'page') {
			return true;
		}

		return false;
	}

	/**
	 * Get the allowed screen IDs.
	 *
	 * @return array
	 */
	public static function get_screen_ids()
	{
		return array(
			'toplevel_page_uhmi',
			'uhmi_page_uhmi_settings',
			'admin_page_uhmi_ready'
		);
	}

	/**
	 * Get host, ie thisdomain.com.
	 *
	 * @return string
	 */
	public static function get_host()
	{
		$domain = (isset($_SERVER['HTTP_HOST']) && ! empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);

		$host = parse_url($domain, PHP_URL_HOST);
		$host = ( ! empty($host) ? $host : $domain);

		return preg_replace('/^www\./', '', $host); // what if the site is 'www.com'?
	}

	/**
	 * Get list of currencies.
	 *
	 * @return array
	 */
	public static function get_currencies()
	{
		return array(
			'EUR' => '&euro;',
			'USD' => '$',
			'GBP' => '&pound;'
		);
	}

	/**
	 * Get list of countries.
	 *
	 * @return array
	 */
	public static function get_countries()
	{
		$countries = UHMI_PLUGIN_DIR . '/storage/countries/countries-en.json';
		return json_decode(file_get_contents($countries), true);
	}

	/**
	 * Get the user's locale.
	 *
	 * @return mixed
	 */
	public static function get_user_locale()
	{
		$countries = self::get_countries();

		$locale = strtoupper( substr( get_user_locale(), -2 ) );

		return isset($countries[$locale]) ? $locale : false;
	}

	/**
	 * Get payment success url.
	 *
	 * @param  object  $post
	 * @return string
	 */
	public static function get_payment_success_url($post)
	{
		$data = array(
		    'uhmi'	 	   => true,
		    'post_id' 	   => $post->ID
		    //'payment_id' => $post->ID,
		);

		$url = get_site_url();

		if (strpos($url, '?') !== false) { // if it has a '?'
			return $url . '&' . http_build_query($data);
		}

		return $url . '/?' . http_build_query($data);
	}

	/**
	 * Get list of content categories.
	 *
	 * @return array
	 */
	public static function get_content_categories()
	{
		return array(
			'animation',
			'art',
			'article',
			'audio',
			'audiobook',
			'blog',
			'design',
			'ebook',
			'game',
			'gaming',
			'movie',
			'music',
			'photo',
			'podcast',
			'reading',
			'software',
			'video',
			'vlog',
			'other'
		);
	}

	/**
	 * Sanitize title.
	 *
	 * @param  string  $title
	 * @return string
	 */
	public static function sanitize_title($title)
	{
		return self::cut_max_length( $title, self::$title_max_length );
	}

	/**
	 * Cut string with max length.
	 *
	 * @param  string  $value
	 * @param  int 	   $length
	 * @return string
	 */
	public static function cut_max_length($value, $length)
	{
		return substr( $value, 0, $length );
	}

	/**
	 * Call success notice.
	 *
	 * @call notice
	 */
	public static function notice_success()
	{
		self::notice( __( 'Your changes have been saved.', 'uhmi' ), 'success' );
	}

	/**
	 * Call error notice.
	 *
	 * @param string  $message
	 * @call  notice
	 */
	public static function notice_error($message)
	{
		self::notice( $message, 'error' );
	}

	/**
	 * Call not allowed notice.
	 *
	 * @call  notice_error
	 */
	public static function notice_not_allowed()
	{
		self::notice_error( __( 'Sorry, you do not have sufficient permissions to do this.' , 'uhmi' ) );
	}

	/**
	 * Show notice.
	 *
	 * @param  string  $message
	 * @param  string  $type
	 * @return string
	 */
	public static function notice($message = '', $type = 'info')
	{
		add_action( 'admin_notices', function() use ($message, $type) {
			?>

			<div class="notice notice-<?php esc_attr_e( $type ) ?> is-dismissible">

				<p><?php esc_html_e( $message ) ?></p>

			</div>

			<?php
		});
	}
}
