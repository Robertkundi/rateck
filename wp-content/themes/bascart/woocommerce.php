<?php
get_header();
get_template_part( 'template-parts/banner/content', 'banner-woo' );
?>
<section id="main-content" class="blog main-container" role="main">
	<div class="container">
		<div class="row">
			
			<div id="content" class="<?php echo esc_attr($sidebar = is_active_sidebar( 'sidebar-woo' ) == true && is_shop() ? 'col-md-8' : 'col-md-12');  ?>">
				<div class="main-content-inner wooshop clearfix">
					<?php if ( have_posts() ) : ?>
						<?php woocommerce_content(); ?>
					<?php endif; ?>
				</div> <!-- close .col-sm-12 -->
			</div><!--/.content -->
			<?php
				if ( is_active_sidebar( 'sidebar-woo' ) && is_shop() ) {
					get_sidebar( 'woo' );
				}
			?>

		</div><!--/.row -->
	</div><!--/.row -->
</section><!--/.row -->


<?php get_footer(); ?>