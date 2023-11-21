<?php
   get_header();
   get_template_part( 'template-parts/banner/content', 'banner-blog' );

   $blog_sidebar = bascart_option('blog_sidebar','right-sidebar');
   $column = ($blog_sidebar == 'no-sidebar' || !is_active_sidebar('sidebar-1')) ? 'col-lg-12' : 'col-lg-8 col-md-12';
?>

<div id="main-content" class="blog main-container" role="main">
	<div class="container">
		<div class="row">
         <?php
            if($blog_sidebar == 'left-sidebar' ):
               get_sidebar();
            endif;
         ?>
         <div class="<?php echo esc_attr($column);?>">
               <?php if ( have_posts() ) : ?>

                     <?php
                        get_template_part( 'template-parts/blog/category/layout', 'layout' );
                        get_template_part( 'template-parts/blog/paginations/pagination', 'style1' );

                     else :
                        get_template_part( 'template-parts/blog/contents/content', 'none' );
                     endif;
               ?>

        </div><!-- #col -->
         <?php
            if($blog_sidebar == 'right-sidebar'):
				   get_sidebar();
            endif;
         ?>
     </div><!-- #row -->
	</div><!-- #container -->
</div>

<?php
get_footer();
