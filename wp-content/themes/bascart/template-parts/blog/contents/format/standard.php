<?php if(has_post_thumbnail()): ?>
  <div class="post-media post-image">
      <a href="<?php echo esc_url(get_the_permalink()); ?>">
        <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=" <?php esc_attr(the_title_attribute()); ?>">
      </a>
      <?php
           if ( is_sticky() ) {
					echo '<sup class="meta-featured-post"> <i class="fas fa-thumbtack"></i> ' . esc_html__( 'Sticky', 'bascart' ) . ' </sup>';
           }
       ?>
</div>
   <?php endif; ?>

<div class="post-body clearfix">
      <div class="entry-header">
        <?php bascart_post_meta(); ?>
        <h2 class="entry-title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

      </div>
      <?php
           if ( is_sticky() && !has_post_thumbnail() ) {
					echo '<sup class="meta-featured-post"> <i class="fas fa-thumbtack"></i> ' . esc_html__( 'Sticky', 'bascart' ) . ' </sup>';
           }

       ?>
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

</div>
<!-- post-body end-->