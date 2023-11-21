<?php
 $blog_related_post = bascart_option('blog_related_post','no');
 $blog_related_post_number = bascart_option('blog_related_post_number',3);

?>
<?php if($blog_related_post=="yes"): ?>
   <?php
      $related_post = bascart_related_posts_by_tags($post->ID,$blog_related_post_number);

      if( $related_post->have_posts() ) { ?>
         <div class="related-post-title-wraper">
            <h2 class="related-post-title"><?php echo esc_html__( 'Releated Posts', 'bascart' )?></h2>
         </div>
         <div class="row">
            <?php
            while ($related_post->have_posts()) : $related_post->the_post(); ?>
            <div class="col-lg-4 col-md-6">
               <div class="recent-project-wrapper">
                  <div class="recent-project-img">

                     <img style="height:200px;width:200px;" class="img-responsive" src="<?php echo get_the_post_thumbnail_url(); ?>" alt=" <?php esc_attr(the_title_attribute()); ?> ">
                  </div>
                  <!-- end recent-project-img -->
                  <div class="recent-project-info">
                     <p class="project-title"><?php echo get_the_date();  ?></p>
                     <h3 class="ts-title"><a href="#"><?php the_title(); ?></a></h3>
                  </div>
                  <!-- end recent-project-info -->
               </div>
            </div>
            <?php endwhile; ?>
         </div>
      <?php
   }
    wp_reset_postdata();

  ?>
<?php endif; ?>
