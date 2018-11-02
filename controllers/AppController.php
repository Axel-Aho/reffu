<?php
class AppController extends BaseController {
	function before_filter(){
		$this->favicon = check_url( ot_get_option('site_favicon') );
	}
}
