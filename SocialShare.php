<?php


/**
 * Simple class to receive urls for sharing content on social networks
 *
 *
 * @since   June 11, 2016
 * @link    https://github.com/honeyport/socialshare
 * @version 1.0.0
 */

class SocialShare {

	/**
	 * params for the share apis
	 * of the social networks
	 * @var array
	 */
	private $_params = array();


	/**
	 * list of available networks
	 * @var array
	 */
	private $_networks = array(
		'twitter',
		'facebook',
		'google-plus',
		'linkedin',
		'y-combinator',
		'instapaper',
		'reddit',
		'get-pocket',
		'digg',
		'stumbleupon',
		'buffer',
		'tumblr',
		'vk',
		'yummly',
		'xing',
		'delicious',
		'whatsapp',
	);


	/**
	 * Creates a new SocialShare instance
	 * @param string $permalink link to content
	 * @param string $title     title of content
	 * @param string $excerpt   excerpt of the content
	 * @param string $via       source of content
	 * @param string $text      message used for whatsapp, default: $title . ' ' . $permalink
	 */
	public function __construct( $permalink, $title = null, $excerpt = null, $via = null, $text = null ) {

		$this->_params =  array(
			'permalink' 	=>	$permalink,
			'title'				=>	$title,
			'excerpt'			=>	$excerpt,
			'via' 				=>	$via,
			'text' 				=>	( $text ) ? $text : $title . ' ' . $permalink,
		);

	}


	/**
	 * create a url query string
	 * @param  string $url url
	 * @param  array $query var => val
	 * @return string        query
	 */
	private function _create_query_string( $url, $query ) {
		$query_string = '';

		foreach ( $query as $var => $value ) {

			if( $var ) {

				// check, if required vars have a value
				if( $var[0] == '*' && $value === null ) {
					return false;
				}

				// only add to query if there is a value
				if( $value !== null && $value !== '' ) {
					$query_string .= '&' . ltrim( $var, '*' ) . '=' . urlencode( $value );
				}

			}
		}

		return $url . ltrim( $query_string, '&' );
	}

	/**
	 * get value from data array
	 * @param  string $index data
	 * @return mixed         data or null
	 */
	private function _get_param( $index ) {
		return ( isset( $this->_params[ $index ] ) ) ? $this->_params[ $index ] : null ;
	}


	/**
	 * get array of share urls
	 * @param string comma separated list of provider names
	 * @return array array of share urls
	 */
	public function get() {

		$args = func_get_args();

		if( empty( $args ) ) {

			$networks = $this->_networks;

		} else {
			$networks = array();

			foreach ( $args as $network ) {

				if( in_array( $network, $this->_networks) ) {
					$networks[] = $network;
				}
			}
		}

		$urls = array();

		foreach ( $networks as $network ) {
			$url = call_user_func( array( $this, str_replace( '-', '_', $network ) ) );

			if( $url ) {
				$urls[ $network ] = $url;
			}
		}

		return $urls;
	}

	/*---------------------------------------------
	 *
	 * 				network methods
	 *
	 *
	 ---------------------------------------------- */


	/**
	 * twitter
	 * @return string url
	 */
	private function twitter() {
		$url = 'https://twitter.com/intent/tweet?';

		$query = array(
			'*url' 	=> $this->_get_param( 'permalink' ),
			'text'	=> $this->_get_param( 'title' ),
			'via'		=> $this->_get_param( 'via' ),
		);

		return $this->_create_query_string( $url, $query );
	}

	/**
	 * facebook
	 * @return string url
	 */
	private function facebook() {
		$url = 'https://www.facebook.com/sharer/sharer.php?';

		$query = array(
			'*u' 	=> $this->_get_param( 'permalink' ),
		);

		return $this->_create_query_string( $url, $query );
	}

	/**
	 * google plus
	 * @return string url
	 */
	private function google_plus() {

		$url = 'https://plus.google.com/share?';

		$query = array(
			'*url' 	=> $this->_get_param( 'permalink' ),
			'hl' 	=> $this->_get_param( 'lang' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * linkedin
	 * @return string url
	 */
	private function linkedin() {

		$url = 'http://www.linkedin.com/shareArticle?';


		$query = array(
			'*url' 	=> $this->_get_param( 'permalink' ),	// The url-encoded URL of the page that you wish to share.
			'*mini'	=> 'true',		// A required argument who's value must always be:  true
			'title' 	=> $this->_get_param( 'title' ),
			'summary' 	=> $this->_get_param( 'excerpt' ),
			'source' 	=> $this->_get_param( 'via' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * y-combinator
	 * @return string url
	 */
	private function y_combinator() {

		$url = 'https://news.ycombinator.com/submitlink?';

		$query = array(
			'op' => 'basic',
			'*u' => $this->_get_param( 'permalink' ),
			'*t' 	=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * instapaper
	 * @return string url
	 */
	private function instapaper() {

		$url = 'https://www.instapaper.com/hello2?';

		$query = array(
			'*url' => $this->_get_param( 'permalink' ),
			'title' 	=> $this->_get_param( 'title' ),
			'description' 	=> $this->_get_param( 'excerpt' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * reddit
	 * @return string url
	 */
	private function reddit() {

		$url = 'https://www.reddit.com/submit?';

		$query = array(
			'*url' => $this->_get_param( 'permalink' ),
			'*title' 	=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * get-pocket
	 * @return string url
	 */
	private function get_pocket() {

		$url = 'https://getpocket.com/save?';

		$query = array(
			'*url' => $this->_get_param( 'permalink' ),
			'*title' 	=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * digg
	 * @return string url
	 */
	private function digg() {

		$url = 'https://digg.com/submit?';

		$query = array(
			'*url' => $this->_get_param( 'permalink' ),
			'title' 	=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * stumbleupon
	 * @return string url
	 */
	private function stumbleupon() {

		$url = 'https://stumbleupon.com/submit?';

		$query = array(
			'*url' 		=> $this->_get_param( 'permalink' ),
			'title' 	=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * buffer
	 * @return string url
	 */
	private function buffer() {

		$url = 'https://buffer.com/add';

		$query = array(
			'*url' 		=> $this->_get_param( 'permalink' ),
			'*text' 	=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * tumblr
	 * @return string url
	 */
	private function tumblr() {

		$url = 'https://www.tumblr.com/share/link?';

		$query = array(
			'*url' 		=> $this->_get_param( 'permalink' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * vk
	 * @return string url
	 */
	private function vk() {

		$url = 'https://vkontakte.ru/share.php?';

		$query = array(
			'*url' 		=> $this->_get_param( 'permalink' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * yummly
	 * @return string url
	 */
	private function yummly() {

		$url = 'https://www.yummly.com/urb/verify?';

		$query = array(
			'*url' 		=> $this->_get_param( 'permalink' ),
			'*title' 		=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * xing
	 * @return string url
	 */
	private function xing() {

		$url = 'https://www.xing.com/spi/shares/new?';

		$query = array(
			'*url' 	=> $this->_get_param( 'permalink' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * delicious
	 * @return string url
	 */
	private function delicious() {

		$url = 'https://del.icio.us/post?';

		$query = array(
			'*url' 	=> $this->_get_param( 'permalink' ),
			'*title' 	=> $this->_get_param( 'title' ),
		);

		return $this->_create_query_string( $url, $query );
	}


	/**
	 * whatsapp
	 * @return string url
	 */
	private function whatsapp() {

		$url = 'whatsapp://send?';

		$query = array(
			'*text' 	=> $this->_get_param( 'text' ),
		);

		return $this->_create_query_string( $url, $query );
	}
}