<?php
/**
 * The main template file
 */
get_header();
get_template_part( 'template-parts/banner/content', 'banner-blog' );

$blog_sidebar = bascart_option('blog_sidebar', 'right-sidebar');
$blog_style = bascart_option('post_layout', 'style1');

$column = ($blog_sidebar == 'no-sidebar' || !is_active_sidebar('sidebar-1')) ? 'col-lg-12' : 'col-lg-8 col-md-12';

?>

<section id="main-content" class="blog main-container" role="main">
	<div class="container">

		<div class="row">
      <?php if($blog_sidebar == 'left-sidebar'){
				get_sidebar();
			  }  ?>
			<div class="<?php echo esc_attr($column);?>">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/blog/contents/content', get_post_format()); ?>
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