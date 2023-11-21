<?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
		<div class="post-media post-image">
		     <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=" <?php esc_attr(the_title_attribute()); ?>">
              
      </div>

	<?php endif; ?>
	<div class="post-body clearfix">

		<!-- Article header -->
		<header class="entry-header clearfix">
			<?php bascart_post_details_meta(); ?>
		</header><!-- header end -->

		<!-- Article content -->
		<div class="entry-content clearfix">
			<?php
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content( esc_html__( 'Continue reading &rarr;', 'bascart' ) );
				bascart_link_pages();
			}
			?>
         <?php
            if ( is_user_logged_in() && is_single() ) {
         ?>

                  <p style="float:left;margin-top:20px;">
                  <?php
                  edit_post_link(
                     esc_html__( 'Edit', 'bascart' ),
                     '<span class="meta-edit">',
                     '</span>'
                  );
                  ?>

           </p>
         <?php
            }
         ?>
      </div> <!-- end entry-content -->
     
      <?php if(has_tag()) : ?>
         <!-- Post tags -->
         <span class="single_post_hr_line"></span>
         <div class="post-footer clearfix">
         <?php bascart_tag_list(); ?>
         </div> <!-- .entry-footer -->
      <?php endif; ?>

   </div> <!-- end post-body -->
