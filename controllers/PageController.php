<?php
class PageController extends AppController {
	function action_page() {
		global $post;

		$this->articles = get_field_object('articles', $id);


		$this->blog = gw_get_posts('blog', true, [
			'post_type' => 'blog',
			'post_status' => 'publish',
			'posts_per_page' => -1,
            'order' => 'ASC',
		]);
		$this->chart = gw_get_posts('chart', true, [
			'post_type' => 'chart',
			'post_status' => 'publish',
			'posts_per_page' => -1,
            'order' => 'ASC',
		]);
	}
	function action_frontpage() {
		global $post;

		$this->articles = get_field_object('articles', $id);

		$this->blog = gw_get_posts('blog', true, [
			'post_type' => 'blog',
			'post_status' => 'publish',
			'posts_per_page' => -1,
            'order' => 'ASC',
		]);
		$this->chart = gw_get_posts('chart', true, [
			'post_type' => 'chart',
			'post_status' => 'publish',
			'posts_per_page' => -1,
            'order' => 'ASC',
		]);

	}
	function action_articles() {
		global $post;

		$this->blog = gw_get_posts('blog', true, [
			'post_type' => 'blog',
			'post_status' => 'publish',
			'posts_per_page' => -1,
            'order' => 'ASC',
		]);

	}
	function action_notfound() {
		$this->content = apply_filters( 'the_content', gw_get_option('404_page_content', false, true) );
	}
	function action_cookiepolicy(){
		$this->content = apply_filters( 'the_content', gw_get_option('cookie_warning_page_content', false, true) );
		
	}
}
