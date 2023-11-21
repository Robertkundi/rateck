<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * recent post widget
 */
class Bascart_Recent_Post extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'bascart_latest_news_widget', 'description' => esc_html__('A widget that display latest posts from all categories', 'bascart-essential') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bascart_latest_news_widget' );
		parent::__construct( 'bascart_latest_news_widget', esc_html__('Bascart Latest Posts', 'bascart-essential'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings.
		$title 	= apply_filters('widget_title', (!isset($instance['title']) ? '' : $instance['title']) );
		$categories 	= (!isset($instance['categories'])? '': $instance['categories']);
		$post_count 	= (!isset($instance['post_count'])? '': $instance['post_count']);
        $post_title_crop 	= (!isset($instance['post_title_crop'])? '10': $instance['post_title_crop']);
     
        $layout     = 'layout1';

        if ( ! empty($instance['orderby']) ) {
            $orderby     = $instance['orderby'];
        } else {
            $orderby     = 'latestpost';
        }

        if ( $orderby == 'popularposts' ) {
			$query = array(
				'posts_per_page' => $post_count,
				'order' => 'DESC',
				'nopaging' => 0,
				'post_status' => 'publish',
				'meta_key' => 'newszone_post_views_count',
				'orderby' => 'meta_value_num',
				'ignore_sticky_posts' => 1,
				'cat' => $categories,
				'suppress_filters' => false,
			);
        } else {
			$query = array(
				'posts_per_page' => $post_count,
				'order' => 'DESC',
				'nopaging' => 0,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'cat' => $categories,
				'suppress_filters' => false,
			);
        }

		$args = new WP_Query($query);
		if ($args->have_posts()) :

			print $before_widget;

		if ( $title )
			print $before_title . $title . $after_title;
		?>
		<div class="ts-count-post bascart-recent-post">
			<div class="bascart-wrapper row bascart-post-grid">
				<?php $i=0; while ($args->have_posts()) : $args->the_post(); $i++; ?>
					<div class="col-12">
						<div class="bascart-grid-single thumb-left">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<div class="post-thumb">
								<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<span class="bascart-sm-bg-img" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>);"></span>
								
								</a>
								</div>
								<div class="post-content">
									<div class="category-wrapper">
										<?php 
											$cat = get_the_category(); 
											if(isset($cat[0])): ?> 
												<a class="post-cat" href="<?php echo get_category_link($cat[0]->term_id); ?>">
													<?php echo get_cat_name($cat[0]->term_id); ?>
												</a>
											<?php endif; ?>
									</div>
									
									<h3 class="post-heading"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words(get_the_title(), $post_title_crop,''); ?></a></h4>
									<div class="post-meta"><span class="post-date" ><i class="xts-icon xts-date" aria-hidden="true"></i> <?php echo get_the_date(get_option('date_format')); ?></span></div>
								</div>
							<?php } else{?>
								<div class="post-info media-body">
									<h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words(get_the_title(), $post_title_crop,''); ?></a></h4>
									<p class="post-meta"><span class="post-date" > <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date(get_option('date_format')); ?></span></p>
								</div>
							<?php } ?>
							</div>
					</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php
	print $after_widget;
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] 			= esc_html( $new_instance['title'] );
	$instance['categories'] 	= $new_instance['categories'];
	$instance['orderby'] 		= esc_html( $new_instance['orderby'] );
    $instance['post_count'] 	= esc_html( $new_instance['post_count'] );
    $instance['post_title_crop'] = esc_html( $new_instance['post_title_crop'] );

	return $instance;
}


function form( $instance ) {

	$defaults = array(
		'title' => esc_html__('Blog Posts', 'bascart-essential'),
		'post_count' => 4,
		'orderby' => 'latestpost',
		'categories' => '',
		'post_title_crop' => 10
		);

      $instance = wp_parse_args( (array) $instance, $defaults );

      ?>
      
		<!-- Widget Title -->
		<p>
			<label for="<?php print $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'bascart-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'title' ); ?>" name="<?php print $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>

		<!-- Ordered By -->
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php esc_html_e('Order By', 'bascart-essential'); ?></label>
            <?php
            $options = array(
                'latestpost' 	=> 'latest Posts',
                'popularposts' 	=> 'Popular Posts',
            );
            if(isset($instance['orderby'])) $orderby = $instance['orderby'];
            ?>
            <select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
                <?php
                $op = '<option value="%s"%s>%s</option>';

                foreach ($options as $key=>$value ) {

                    if ($orderby === $key) {
                        printf($op, $key, ' selected="selected"', $value);
                    } else {
                        printf($op, $key, '', $value);
                    }
                }
                ?>
            </select>
        </p>

		<!-- Post Category -->
		<p>
			<label for="<?php print $this->get_field_id('categories'); ?>"><?php esc_html_e('Filter by Categories', 'bascart-essential'); ?></label>
			<select id="<?php print $this->get_field_id('categories'); ?>" name="<?php print $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php print $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php print $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Count of Latest Posts -->
		<p>
			<label for="<?php print $this->get_field_id( 'post_count' ); ?>"><?php esc_html_e('Count of Latest Post', 'bascart-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'post_count' ); ?>" name="<?php print $this->get_field_name( 'post_count' ); ?>" value="<?php echo esc_attr( $instance['post_count'] ); ?>" size="3" />
		</p>

      <!-- Post Title Crop-->
		<p>
			<label for="<?php print $this->get_field_id( 'post_title_crop' ); ?>"><?php esc_html_e('Post Title Crop:', 'bascart-essential'); ?></label>
			<input  type="text" class="widefat" id="<?php print $this->get_field_id( 'post_title_crop' ); ?>" name="<?php print $this->get_field_name( 'post_title_crop' ); ?>" value="<?php echo esc_attr( $instance['post_title_crop'] ); ?>"  />
		</p>


		<?php
	}

}
