<?php
class BlogController extends AppController {
	
	function action_single() {
		global $post;

        $this->blog = gw_get_posts('blog', true, [
			'post_type' => 'blog',
			'post_status' => 'publish',
			'posts_per_page' => -1,
            'order' => 'ASC',
		]);
	}
	
}
