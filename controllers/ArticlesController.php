<?php
class ArticlesController extends AppController {
	
	function action_single() {
		global $post;

        $this->articles = gw_get_posts('articles', true, [
			'post_type' => 'articles',
			'post_status' => 'publish',
			'posts_per_page' => -1,
            'order' => 'ASC',
		]);
	}
	
}
