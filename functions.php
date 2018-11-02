<?php
	/* Theme specific functions here */
	
	  function register_my_menus() {
		register_nav_menus(
		  array(
			'header-menu' => __( 'Header Menu' ),
			'language-menu' => __( 'Language Menu' )
		  )
		);
	  }
	  add_action( 'init', 'register_my_menus' );

	  add_action('admin_init', function(){


	});

	function remove_empty_p( $content ) {
		$content = force_balance_tags( $content );
		$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
		$content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
		return $content;
	}
	add_filter('the_content', 'remove_empty_p', 20, 1);

	function my_enqueue_assets () {
		wp_enqueue_script('ajax_filter', get_template_directory_uri() . '/assets/js/ajax_filter.js', array('jquery'), '1.0', true);
		wp_localize_script( 'ajax_filter', 'ajaxadress', array('ajaxurl' => admin_url('admin-ajax.php')));
	}
	add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' );
	add_action( 'admin_enqueue_scripts', 'my_enqueue_assets' );

	// Filter AJAX
	// taxonomy ajax
	function filter_ajax_function(){
		$id = $_POST['id'];
		
		$args = array(
			'orderby' => 'date', // we will sort posts by date
			'order'	=> $_POST['date'], // ASC or DESC
			'post_type' => 'blog',
		);
		
		// for taxonomies / categories
		
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'terms' => $id,
				));
			
		$query = new WP_Query( $args );
		
		if( $query->have_posts() ) : 
			while( $query->have_posts() ): $query->the_post(); ?>
			<div class="blog_box col-8 col-s-24 col-xs-24">
			<p class="date"><?= get_the_date($query->ID); ?></p> 
				<a href="<?= get_permalink($query->ID) ?>">
					<div class="blog_img" style="background-image:
							url('<?= get_field('blog_image', $post); ?>');">
					</div>
					<div class="blog_text">
							<h3><?= get_the_title($post) ?></h3>
					</div> 
				</a>
			</p>
			</div>
			<?php endwhile;
			//echo '</div>';
			wp_reset_postdata();
		else :
			echo 'No posts found';
		endif;
	 
		die();
	}
	 
	 
	add_action('wp_ajax_filter_ajax_function', 'filter_ajax_function'); 
	add_action('wp_ajax_nopriv_filter_ajax_function', 'filter_ajax_function');



	


/* ucc_get_calendar() :: Extends get_calendar() by including custom post types.
 * Derived from get_calendar() code in /wp-includes/general-template.php.
 */
 
function ucc_get_calendar( $post_types = '' , $initial = true , $echo = true ) {
  global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
	
  if ( empty( $post_types ) || !is_array( $post_types ) ) {
    $args = array(
      'public' => true ,
			'_builtin' => false,
			
    );
    $output = 'names';
    $operator = 'and';
	
    //$post_types = get_post_types( $args , $output , $operator ); dd($post_types);	
		//$post_types = array_merge( $post_types , array( 'post' ) );
		$post_types = array(
			'post_type' => 'instances',
			'order' => 'ASC',
			'post_status' => array('publish', 'future')
		);
		
  } else {
    /* Trust but verify. */
    $my_post_types = array();
    foreach ( $post_types as $post_type ) {
      if ( post_type_exists( $post_type ) )
        $my_post_types[] = $post_type;
    }
    $post_types = $my_post_types;
  }
  $post_types_key = implode( '' , $post_types );
  $post_types = "'" . implode( "' , '" , $post_types ) . "'";
 
  $cache = array();
  $key = md5( $m . $monthnum . $year . $post_types_key );
  if ( $cache = wp_cache_get( 'get_calendar' , 'calendar' ) ) {
    if ( is_array( $cache ) && isset( $cache[$key] ) ) {
      remove_filter( 'get_calendar' , 'ucc_get_calendar_filter' );
      $output = apply_filters( 'get_calendar',  $cache[$key] );
      add_filter( 'get_calendar' , 'ucc_get_calendar_filter' );
      if ( $echo ) {
        echo $output;
        return;
      } else {
        return $output;
      }
    }
  }
 
  if ( !is_array( $cache ) )
    $cache = array();
 
  // Quick check. If we have no posts at all, abort!
  if ( !$posts ) {
    $sql = "SELECT 1 as test FROM $wpdb->posts WHERE post_type IN ( $post_types ) AND post_status = 'publish' LIMIT 1";
    $gotsome = $wpdb->get_var( $sql );
    if ( !$gotsome ) {
      $cache[$key] = '';
      wp_cache_set( 'get_calendar' , $cache , 'calendar' );
      return;
    }
  }
 
  if ( isset( $_GET['w'] ) )
    $w = '' . intval( $_GET['w'] );
 
  // week_begins = 0 stands for Sunday
  $week_begins = intval( get_option( 'start_of_week' ) );
 
  // Let's figure out when we are
  if ( !empty( $monthnum ) && !empty( $year ) ) {
    $thismonth = '' . zeroise( intval( $monthnum ) , 2 );
    $thisyear = ''.intval($year);
  } elseif ( !empty( $w ) ) {
    // We need to get the month from MySQL
    $thisyear = '' . intval( substr( $m , 0 , 4 ) );
    $d = ( ( $w - 1 ) * 7 ) + 6; //it seems MySQL's weeks disagree with PHP's
    $thismonth = $wpdb->get_var( "SELECT DATE_FORMAT( ( DATE_ADD( '${thisyear}0101' , INTERVAL $d DAY ) ) , '%m' ) " );
  } elseif ( !empty( $m ) ) {
    $thisyear = '' . intval( substr( $m , 0 , 4 ) );
    if ( strlen( $m ) < 6 )
        $thismonth = '01';
    else
        $thismonth = '' . zeroise( intval( substr( $m , 4 , 2 ) ) , 2 );
  } else {
    $thisyear = gmdate( 'Y' , current_time( 'timestamp' ) );
    $thismonth = gmdate( 'm' , current_time( 'timestamp' ) );
  }
 
  $unixmonth = mktime( 0 , 0 , 0 , $thismonth , 1 , $thisyear);
 
  // Get the next and previous month and year with at least one post
  $previous = $wpdb->get_row( "SELECT DISTINCT MONTH( post_date ) AS month , YEAR( post_date ) AS year
    FROM $wpdb->posts
    WHERE post_date < '$thisyear-$thismonth-01'
    AND post_type IN ( $post_types ) AND post_status = 'publish'
      ORDER BY post_date DESC
      LIMIT 1" );
  $next = $wpdb->get_row( "SELECT DISTINCT MONTH( post_date ) AS month, YEAR( post_date ) AS year
    FROM $wpdb->posts
    WHERE post_date > '$thisyear-$thismonth-01'
    AND MONTH( post_date ) != MONTH( '$thisyear-$thismonth-01' )
    AND post_type IN ( $post_types ) AND post_status = 'publish'
      ORDER  BY post_date ASC
      LIMIT 1" );
 
  /* translators: Calendar caption: 1: month name, 2: 4-digit year */
  $calendar_caption = _x( '%1$s %2$s' , 'calendar caption' );
  $calendar_output = '<table id="wp-calendar" summary="' . esc_attr__( 'Calendar' ) . '">
  <caption>' . sprintf( $calendar_caption , $wp_locale->get_month( $thismonth ) , date( 'Y' , $unixmonth ) ) . '</caption>
  <thead>
  <tr>';
 
  $myweek = array();
 
  for ( $wdcount = 0 ; $wdcount <= 6 ; $wdcount++ ) {
    $myweek[] = $wp_locale->get_weekday( ( $wdcount + $week_begins ) % 7 );
  }
 
  foreach ( $myweek as $wd ) {
    $day_name = ( true == $initial ) ? $wp_locale->get_weekday_initial( $wd ) : $wp_locale->get_weekday_abbrev( $wd );
    $wd = esc_attr( $wd );
    $calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
  }
 
  $calendar_output .= '
  </tr>
  </thead>
 
  <tfoot>
  <tr>';
 
  if ( $previous ) {    $calendar_output .= "\n\t\t" . '<td colspan="3" id="prev"><a href="' . get_month_link( $previous->year , $previous->month ) . '" title="' . sprintf( __( 'View posts for %1$s %2$s' ) , $wp_locale->get_month( $previous->month ) , date( 'Y' , mktime( 0 , 0 , 0 , $previous->month , 1 , $previous->year ) ) ) . '">&laquo; ' . $wp_locale->get_month_abbrev( $wp_locale->get_month( 
		$previous->month ) ) . '</a></td>';
  } else {
    $calendar_output .= "\n\t\t" . '<td colspan="3" id="prev" class="pad">&nbsp;</td>';
  }
 
  $calendar_output .= "\n\t\t" . '<td class="pad">&nbsp;</td>';
 
  if ( $next ) {    $calendar_output .= "\n\t\t" . '<td colspan="3" id="next"><a href="' . get_month_link( $next->year , $next->month ) . '" title="' . esc_attr( sprintf( __( 'View posts for %1$s %2$s' ) , $wp_locale->get_month( $next->month ) , date( 'Y' , mktime( 0 , 0 , 0 , $next->month , 1 , $next->year ) ) ) ) . '">' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $next->month ) ) . ' &r
aquo;</a></td>';
  } else {
    $calendar_output .= "\n\t\t" . '<td colspan="3" id="next" class="pad">&nbsp;</td>';
  }
 
  $calendar_output .= '
  </tr>
  </tfoot>
 
  <tbody>
  <tr>';
 

	
  // Get days with posts
  $dayswithposts = $wpdb->get_results( "SELECT DISTINCT DAYOFMONTH( post_date )
    FROM $wpdb->posts 
		WHERE MONTH( post_date ) = '$thismonth'
    AND YEAR( post_date ) = '$thisyear'
    AND post_type IN ( $post_types )
    AND post_date <> '"
		 . current_time( 'mysql' ) . '\'', ARRAY_N );
	
  if ( $dayswithposts ) {
    foreach ( (array) $dayswithposts as $daywith ) {
      $daywithpost[] = $daywith[0];
    }
  } else {
    $daywithpost = array();
  } 
  if ( strpos( $_SERVER['HTTP_USER_AGENT'] , 'MSIE' ) !== false || stripos( $_SERVER['HTTP_USER_AGENT'] , 'camino' ) !== false || stripos( $_SERVER['HTTP_USER_AGENT'] , 'safari' ) !== false )
    $ak_title_separator = "\n";
  else
    $ak_title_separator = ', ';
 
  $ak_titles_for_day = array();
  $ak_post_titles = $wpdb->get_results( "SELECT ID, post_title, DAYOFMONTH( post_date ) as dom "
    . "FROM $wpdb->posts "
    . "WHERE YEAR( post_date ) = '$thisyear' "
    . "AND MONTH( post_date ) = '$thismonth' "
    . "AND post_date  "
    . "AND post_type IN ( $post_types )"
  );
  if ( $ak_post_titles ) {
    foreach ( (array) $ak_post_titles as $ak_post_title ) {
 
        $post_title = esc_attr( apply_filters( 'the_title' , $ak_post_title->post_title , $ak_post_title->ID ) );
 
        if ( empty( $ak_titles_for_day['day_' . $ak_post_title->dom] ) )
          $ak_titles_for_day['day_'.$ak_post_title->dom] = '';
        if ( empty( $ak_titles_for_day["$ak_post_title->dom"] ) ) // first one
          $ak_titles_for_day["$ak_post_title->dom"] = $post_title;
        else
          $ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
    }
  }
 
  // See how much we should pad in the beginning
  $pad = calendar_week_mod( date( 'w' , $unixmonth ) - $week_begins );
  if ( 0 != $pad )
    $calendar_output .= "\n\t\t" . '<td colspan="' . esc_attr( $pad ) . '" class="pad">&nbsp;</td>';
 
  $daysinmonth = intval( date( 't' , $unixmonth ) );
  for ( $day = 1 ; $day <= $daysinmonth ; ++$day ) {
    if ( isset( $newrow ) && $newrow )
      $calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
    $newrow = false;

    if ( $day == gmdate( 'j' , current_time( 'timestamp' ) ) && $thismonth == gmdate( 'm' , current_time( 'timestamp' ) ) && $thisyear == gmdate( 'Y' , current_time( 'timestamp' ) ) )
      $calendar_output .= '<td id="today">'; 
    else
			$calendar_output .= '<td>';
			
		$date= "$thisyear/$thismonth/$day";
    if ( in_array( $day , $daywithpost ) ) // any posts today?
        $calendar_output .= '<a class="calendar_day" href="' . get_day_link( $thisyear , $thismonth , $day ) . "\" title=\"" . esc_attr( $ak_titles_for_day[$day] ) . "\" value=" . esc_attr( $date ) . ">$day</a>";
    else
      $calendar_output .= $day;
    $calendar_output .= '</td>';
 
    if ( 6 == calendar_week_mod( date( 'w' , mktime( 0 , 0 , 0 , $thismonth , $day , $thisyear ) ) - $week_begins ) )
      $newrow = true;
  }

  $pad = 7 - calendar_week_mod( date( 'w' , mktime( 0 , 0 , 0 , $thismonth , $day , $thisyear ) ) - $week_begins );
  if ( $pad != 0 && $pad != 7 )
    $calendar_output .= "\n\t\t" . '<td class="pad" colspan="' . esc_attr( $pad ) . '">&nbsp;</td>';
 
  $calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";
 
  $cache[$key] = $calendar_output;
  wp_cache_set( 'get_calendar' , $cache, 'calendar' );
 
  remove_filter( 'get_calendar' , 'ucc_get_calendar_filter' );
  $output = apply_filters( 'get_calendar',  $calendar_output );
  add_filter( 'get_calendar' , 'ucc_get_calendar_filter' );
 
  if ( $echo )
    echo $output;
  else
		return $output;
}
 
function ucc_get_calendar_filter( $content ) {
  $output = ucc_get_calendar( '' , '' , false );
  return $output;
}
add_filter( 'get_calendar' , 'ucc_get_calendar_filter' , 10 , 2 );



function calendar_ajax_function(){
	$postday = $_POST['value'];

	$args = array(
		'post_type' => 'instances',
		'order' => 'ASC'
	);
	
	 $query = new WP_Query( $args );
	 $posts = $query->posts;

	 if( $query->have_posts() ) : ?>

	<div class="card">
		<?php	while( $query->have_posts() ): $query->the_post();  
		if( get_the_date('Y/n/j', $post) == $postday ) : ?> 
				<div class="calendar_item">
						<h3><?= get_the_title($post) ?></h3>
						<p><?= the_excerpt($post) ?></p>
				</div> 
		<?php endif;
		 endwhile; ?>
	</div>
	<?php	wp_reset_postdata();
	else :
		echo 'No posts found';
	endif; 
 
	die();
}
 
 
add_action('wp_ajax_calendar_ajax_function', 'calendar_ajax_function'); 
add_action('wp_ajax_nopriv_calendar_ajax_function', 'calendar_ajax_function');