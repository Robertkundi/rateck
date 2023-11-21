<?php
use Devmonsta\Libs\Posts;
class Post extends Posts
{

    public function register_controls()
    {

        $this->add_box([
            'id'        => 'post_box_1',
            'post_type' => 'post',
            'title'     => 'Posts Settings',
        ]);

        /**
         * control for text input
         */

        $this->add_control([
            'box_id' => 'post_box_1',
            'type'   => 'url',
            'name'   => 'featured_video',
            'label'     => esc_html__('Video URL', 'bascart'),
            'desc'     => esc_html__('Paste a video link from Youtube, Vimeo, Dailymotion, Facebook or Twitter it will be embedded in the post and the thumb used as the featured image of this post. You need to choose "Video Format" as post format to use "Featured Video".', 'bascart'),
        ]);

    }
}
