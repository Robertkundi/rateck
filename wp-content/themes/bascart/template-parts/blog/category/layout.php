<div class="main-content-inner category-layout">
   <?php while ( have_posts() ) {
      the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('post-layout'); ?>>
         <?php  get_template_part( 'template-parts/blog/contents/content', get_post_format() ); ?>
      </article>
   <?php } wp_reset_postdata(); ?>

</div>