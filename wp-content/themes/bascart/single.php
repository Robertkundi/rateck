<?php
/**
 * the template for displaying all posts.
 */
  get_header();
  get_template_part( 'template-parts/banner/content', 'banner-single' );

  $blog_sidebar = bascart_option('blog_details_sidebar', 'no-sidebar');
  $column = ($blog_sidebar == 'no-sidebar' ) ? 'col-lg-10 mx-auto' : 'col-lg-8 col-md-12 mx-auto';

  $blog_sidebar_class = '';
  if ($blog_sidebar != 'no-sidebar') {
    $blog_sidebar_class = 'sidebar-active';
  } else {
    $blog_sidebar_class = 'sidebar-inactive';
  }
?>
<div id="main-content" class="main-container blog-single <?php echo esc_attr($blog_sidebar_class);?>"  role="main">
    <div class="container">
        <div class="row">
        <?php if($blog_sidebar == 'left-sidebar'){
				  get_sidebar();
			  }  ?>
            <div class="<?php echo esc_attr($column);?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(["post-content","post-single"]); ?>>
						<?php get_template_part( 'template-parts/blog/contents/content', 'single' ); ?>
              </article>

					<?php
						bascart_post_nav();
                 ?>
                <?php get_template_part( 'template-parts/blog/post-parts/part', 'author' ); ?>
               <?php
                comments_template();

               ?>
				<?php endwhile; ?>
            </div> <!-- .col-md-8 -->
            <?php if($blog_sidebar == 'right-sidebar'){
				get_sidebar();
			  }  ?>

        </div> <!-- .row -->
        <?php get_template_part( 'template-parts/blog/post-parts/related', 'post' ); ?>
    </div> <!-- .container -->
</div> <!--#main-content -->
<?php get_footer(); ?>