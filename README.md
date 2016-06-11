# SocialShare: Get Links To Share Content
A Simple Class To Create Links For Sharing Content On Social Networks


##
This library creats urls for sharing content on following social networks:
* twitter
* facebook
* google-plus
* linkedin
* y-combinator
* instapaper
* reddit
* get-pocket
* digg
* stumbleupon
* buffer
* tumblr
* vk
* yummly
* xing
* delicious
* whatsapp


## Usage

``` php

<?php

	$socialButtons = new SocialShare(
		$permalink [, $title = null, $excerpt = null, $via = null]
	);

	// get urls to all available networks
	$urlsForAllNetworks = $socialButtons->get();

	// get urls to certain networks
	$urlsForCertainNetworks = $socialButtons->get( 'facebook', 'twitter', 'whatsapp' );


```