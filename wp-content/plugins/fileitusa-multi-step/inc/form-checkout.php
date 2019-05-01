<?php
//do_action( 'woocommerce_before_checkout_form', $checkout );

// check the WooCommerce options
  //$checkout = WC()->checkout();
$is_registration_enabled = version_compare( '3.6.1', WC()->version, '<=') ? $checkout->is_registration_enabled() : get_option( 'woocommerce_enable_signup_and_login_from_checkout' ) == 'yes'; 
$has_checkout_fields = version_compare( '3.6.1', WC()->version, '<=') ? $checkout->get_checkout_fields() : (is_array($checkout->checkout_fields) && count($checkout->checkout_fields) > 0 );
$show_login_step = ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) ? false : true;
$stop_at_login = ( ! $is_registration_enabled && $checkout->is_registration_required() && ! is_user_logged_in() ) ? true : false;
$checkout_url = apply_filters( 'woocommerce_get_checkout_url', version_compare( '2.5', WC()->version, '<=' ) ? wc_get_checkout_url() : WC()->cart->get_checkout_url() );

do_action( 'woocommerce_before_checkout_form', $checkout );

?>
<div class="container-fluid"> 
    <div class="row">
        <form id="example-form" name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo site_url(). '/checkout';?>" enctype="multipart/form-data">

    <div>
        <h3>Contact Info</h3>
        <section>
              <?php //if ( $has_checkout_fields ) : ?>

      <!-- Step: Billing -->
      <div class="wpmc-step-item wpmc-step-billing">
        <?php ///if ( !$show_login_step ) do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
          <?php if ( $checkout->get_checkout_fields() ) : ?>

        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
        <?php do_action( 'woocommerce_checkout_billing'); ?>
      </div>    

  <?php endif; ?>
            <p>(*) Mandatory</p>
        </section>
        <h3>Company Info</h3>
        <section>
         
          <?php //do_action( 'woocommerce_checkout_after_customer_details' ); ?>

        <div id="clonetrigger1">

          <fieldset class="clonable">
              <div class="regrow">
                  <div class="regrow">
                      <label class="inside">Company Name:</label>
                      <input class="text" name="FIUPS_comp_name1_1" type="text" required="required">
                  </div>
                  <div class="regrow">
                      <label class="inside">Company Registration:</label>
                      <input class="text" name="FIUPS_comp_reg1_1" type="text" required="required">
                  </div>
                  <div class="regrow">
                      <label class="inside">Company Email:</label>
                      <input class="text" name="FIUPS_comp_email1_1" type="text" required="required">
                  </div>
              </div>
          </fieldset>
           <div id="formbuttons" class="regrow">
              <input type="button" class="button fieldclone btn-success" id="clonetrigger" value="Clone" />
          </div>
        </div>



        
            <p>(*) Mandatory</p>
        </section>
        <h3>Order Info</h3>
        <section>

            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
  
  

            <div id="order_review" class="wpmc-step-item wpmc-step-review wpmc-order">
              <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
              <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
              <?php do_action( 'woocommerce_checkout_order_review' ); ?>
              <?php do_action( 'wpmc-woocommerce_order_review' ); ?>
            </div>
        </section>
        <h3>Review & Checkout</h3>
        <section>
            <div class="wpmc-step-item wpmc-step-payment">
              <h3 id="payment_heading"><?php _e( 'Payment', 'woocommerce' ); ?></h3>
              <?php do_action( 'wpmc-woocommerce_checkout_payment' ); ?>
              <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
          </div>
        </section>
    </div>
</form>

<script src="<?php echo site_url(); ?>/wp-content/plugins/fileitusa-multi-step/assets/js/jquery.steps.js?ver=5.1.1">
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/fileitusa-multi-step/assets/js/jquery.validate.min.js?ver=5.1.1">
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/fileitusa-multi-step/assets/js/demo.js?ver=5.1.1">
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins/fileitusa-multi-step/assets/js/custom.js?ver=5.1.1">
</script>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

    </div>
</div>
