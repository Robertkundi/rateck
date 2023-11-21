<?php
/**
 * displays woo sidebar
 */
?>
<?php if ( is_active_sidebar( 'sidebar-woo' ) ) { ?>
   <div class="col-lg-4 col-md-12">
      <aside id="sidebar" class="sidebar" role="complementary">
         <?php dynamic_sidebar( 'sidebar-woo' ); ?>
      </aside> <!-- #sidebar --> 
   </div><!-- Sidebar col end -->
<?php }

?>
