<?php
/**
 * the template for displaying search result
 */
get_header();
get_template_part( 'template-parts/banner/content', 'banner-blog' );
$blog_sidebar = bascart_option('blog_sidebar', 'right-sidebar');
$column = ($blog_sidebar == 'no-sidebar' || !is_active_sidebar('sidebar-1')) ? 'col-lg-10 mx-auto' : 'col-lg-8 col-md-12';

$blog_sidebar_class = '';
if ($blog_sidebar != 'no-sidebar') {
	$blog_sidebar_class = 'sidebar-active';
} else {
	$blog_sidebar_class = 'sidebar-inactive';
}
?>

<section id="main-content" class="blog main-container <?php echo esc_attr($blog_sidebar_class); ?>" role="main">
	<div class="container">
		<div class="row">
      <?php if($blog_sidebar == 'left-sidebar'){
				get_sidebar();
			  }  ?>
			<div class="<?php echo esc_attr($column);?>">
				<?php if ( have_posts() ) : ?>
					<div class="xs-page-header">
                        <h2>
							<?php printf(esc_html__('Search Results for: %s', 'bascart'), get_search_query()); ?>
                        </h2>
                        <?php
                            // show author bio if exists
                            if (get_the_author_meta('description')) {
                                echo '<p>' . the_author_meta('description') . '</p>';
                            }
                        ?>
					</div>

					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/blog/contents/content', get_post_format() ); ?>
					<?php endwhile; ?>

					<?php get_template_part( 'template-parts/blog/paginations/pagination', 'style1' ); ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/blog/contents/content', 'none' ); ?>
				<?php endif; ?>
			</div><!-- .col-md-8 -->

         <?php if($blog_sidebar == 'right-sidebar'){
				get_sidebar();
			  }  ?>
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- #main-content -->
<?php get_footer(); ?>