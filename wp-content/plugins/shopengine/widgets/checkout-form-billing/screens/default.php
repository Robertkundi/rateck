<?php
/**
 * This template will overwrite the WooCommerce file: woocommerce/templates/checkout/form-billing.php.
 */

defined( 'ABSPATH' ) || exit;

$checkout = WC()->checkout();

?>

<div class="shopengine-checkout-form-billing">

    <div class="woocommerce-billing-fields">
		<?php if(wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()) : ?>

            <h3 class="shopengine-billing-address-header"><?php esc_html_e('Billing &amp; Shipping', 'shopengine'); ?></h3>

		<?php else : ?>

            <h3 class="shopengine-billing-address-header"><?php !empty($settings['shopengine_billing_form_title']) ? esc_html_e($settings['shopengine_billing_form_title'], 'shopengine') : esc_html_e('Billing details', 'shopengine'); ?></h3>

		<?php endif; ?>

		<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

        <div class="woocommerce-billing-fields__field-wrapper">
			<?php
			$fields = $checkout->get_checkout_fields('billing');

			foreach($fields as $key => $field) {
				woocommerce_form_field($key, $field, $checkout->get_value($key));
			}

			do_action( 'woocommerce_checkout_billing' );
			?>
        </div>

		<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
    </div>

	<?php if(!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
        <div class="woocommerce-account-fields">
			<?php if(!$checkout->is_registration_required()) : ?>

                <p class="form-row form-row-wide create-account">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                               id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?>
                               type="checkbox" name="createaccount" value="1"/>
                        <span><?php esc_html_e('Create an account?', 'shopengine'); ?></span>
                    </label>
                </p>

			<?php endif; ?>

			<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

			<?php if($checkout->get_checkout_fields('account')) : ?>

                <div class="create-account">
					<?php foreach($checkout->get_checkout_fields('account') as $key => $field) : ?>
						<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
					<?php endforeach; ?>
                    <div class="clear"></div>
                </div>

			<?php endif; ?>

			<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
        </div>
	<?php endif; ?>
</div>

