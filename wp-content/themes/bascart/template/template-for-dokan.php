<?php
/**
 * template-home.php
 *
 * Template Name: Template for Dokan
 * Template Post Type: page,ts-projects,ts-service
 */
   $post_type = get_post_type();
   get_header(); 
   if( $post_type == "ts-service" && is_single()):
       get_template_part( 'template-parts/banner/content', 'banner-service' );
   elseif( $post_type == "ts-projects" && is_single()):
   get_template_part( 'template-parts/banner/content', 'banner-project' );
   else:
      get_template_part( 'template-parts/banner/content', 'banner-page' );
   endif;  

 // calling title part from blog dir
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('dokan-template-content');?> role="main">
    <div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
    </div> <!-- end main-content -->
</div> <!-- end main-content -->
<?php get_footer(); ?>