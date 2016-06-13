# SocialShare: Get Links To Share Content
A Simple Library To Create Links For Sharing Content On Social Networks


##
This library creates urls for sharing content on following social networks:
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

	require 'SocialShare.php';

	$socialButtons = new SocialShare(
		$permalink [, $title = null, $excerpt = null, $via = null, $text = null]
	);

	// get urls to all available networks
	$urlsForAllNetworks = $socialButtons->get();

	// get urls to certain networks
	$urlsForCertainNetworks = $socialButtons->get( 'facebook', 'twitter', 'whatsapp' );


```

## Parameters

*$permalink*
	(string) (required) the url to the shared content

*$title*
	(string) (optional) title of the shared content

*$excerpt*
	(string) (optional) excerpt of the shared content

*$via*
	(string) (optional) name of the source of the shared content (for e.g twitter)

*$text*
	(string) (optional) text for the default message in whatsapp



## License

The MIT License (MIT)

Copyright (c) 2016 honeyport

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.