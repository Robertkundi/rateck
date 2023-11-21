<?php
/**
 * the template for displaying all pages.
 */
get_header();
get_template_part( 'template-parts/banner/content', 'banner-page' );

$blog_sidebar = bascart_option('blog_sidebar', 'right-sidebar');
$column = ($blog_sidebar == 'no-sidebar' || !is_active_sidebar('sidebar-1')) ? 'col-lg-10 mx-auto' : 'col-lg-8 col-md-12';
if(class_exists( 'WooCommerce' ) && (is_cart() || is_checkout() || is_account_page())) {
	$blog_sidebar = 'no-sidebar';
	$column = 'col-lg-12 mx-auto';
}

?>
<div id="main-content" class="main-container"  role="main">
    <div class="container">
        <div class="row">
        <?php if($blog_sidebar == 'left-sidebar'){
				get_sidebar();
			  }  ?>
			<div class="<?php echo esc_attr($column);?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="single-content">

						<div class="entry-content">
							<?php get_template_part( 'template-parts/blog/contents/content', 'page' ); ?>
						</div> <!-- .entry-content -->

						<footer class="entry-footer">
							<?php
							if ( is_user_logged_in() ) {
								echo '<p>';
								edit_post_link(
									esc_html__( 'Edit', 'bascart' ),
									'<span class="meta-edit">',
									'</span>'
								);
								echo '</p>';
							}
							?>
						</footer> <!-- .entry-footer -->
					</div>

					<?php comments_template(); ?>
				<?php endwhile; ?>
            </div> <!-- .col-md-8 -->

            <?php if($blog_sidebar == 'right-sidebar'){
				get_sidebar();
			  }  ?>
        </div> <!-- .row -->
    </div> <!-- .container -->
</div> <!--#main-content -->
<?php get_footer(); ?>