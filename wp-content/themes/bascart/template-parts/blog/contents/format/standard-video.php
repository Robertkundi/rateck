<div class="post-media post-video">
   <?php if(has_post_thumbnail()): ?>
        <img class="img-fluid" alt="<?php esc_attr(the_title_attribute()); ?>" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" >
       <?php
        if ( is_sticky() ) {
                  echo '<sup class="meta-featured-post"> <i class="fas fa-thumbtack"></i> ' . esc_html__( 'Sticky', 'bascart' ) . ' </sup>';
           }
           ?>

   <?php
   if( defined( 'DEVM' ) && bascart_meta_option(get_the_ID(),'featured_video')!=''):
   ?>
         <div class="video-link-btn">
            <a href="<?php echo bascart_meta_option(get_the_ID(),'featured_video'); ?>" class="play-btn popup-btn"><i class="fas fa-play"></i></a>
         </div>
         <?php endif; ?>

         <?php endif; ?>
         </div>
         <div class="post-body clearfix">
         <div class="entry-header">
           <?php bascart_post_meta(); ?>
           <h2 class="entry-title">
               <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
           </h2>
         </div>


         <div class="post-content">
            <div class="entry-content">
                <p>
                     <?php bascart_excerpt( 30, null ); ?>
                </p>
            </div>
            <?php
            if(!is_single()):

              printf('<div class="post-footer readmore-btn-area"><a class="readmore" href="%1$s">Read More <i class="xts-icon xts-arrow-right"></i></a></div>',
              get_the_permalink()
                );
            endif;
        ?>
         </div>
   <!-- Post content right-->

</div>
<!-- post-body end-->