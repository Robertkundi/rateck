<?php
    $site_logo = $settings['site_logo'];
?>
<div class="bascart-widget-logo">
    <a href="<?php echo esc_url(home_url('/')); ?>">
        <img width="319" height="90" src="<?php 
            if(isset($site_logo['url']) && $site_logo['url'] !=''){
            echo esc_url( $site_logo['url']);
        }else{
             echo esc_url( bascart_src( 'custom-logo', BASCART_IMG . '/logo.png'));
        }
        ?>" alt="<?php bloginfo('name'); ?>">
    </a>
</div>