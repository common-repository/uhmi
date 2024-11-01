<div class="uhmi-content uhmi-content-<?php esc_attr_e( $post_id ) ?> <?php echo($note ? 'uhmi-has-note' : '') ?>" data-uhmi_payment_id="<?php esc_attr_e( $payment_id ) ?>" data-uhmi-post_id="<?php esc_attr_e( $post_id ) ?>">

	<?php wp_nonce_field( '_uhmi_content_payment_nonce' ); ?>

	<?php if ($content) : ?>

		<div class="uhmi-preview">

			<?php echo $content ?>

		</div>

	<?php endif; ?>

	<div class="uhmi-button-wrapper">

		<?php if ($note) : ?>

			<div class="uhmi-note">

				<?php echo $note ?>

			</div>

		<?php endif; ?>

		<button type="button" class="uhmi-button uhmi-payment" data-uhmi_payment_id="<?php esc_attr_e( $payment_id ) ?>" style="background:<?php esc_attr_e( $button['color'] ) ?>"><?php echo $button['text'] ?></button>

	</div>

</div>
