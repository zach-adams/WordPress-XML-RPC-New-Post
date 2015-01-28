<?php
require 'vendor/autoload.php';

$site_endpoint = "http://your-site-endpoint.com/xmlrpc.php";
$site_username = "username";
$site_password = "password";


# Your Wordpress website is at: http://wp-website.com
$endpoint = $site_endpoint;

# The Monolog logger instance
$wpLog = new Monolog\Logger('wp-xmlrpc');

# Create client instance
$wpClient = new \HieuLe\WordpressXmlrpcClient\WordpressClient();
# Log error
$wpClient->onError(function($error, $event) use ($wpLog){
    $wpLog->addError($error, $event);
});

# Set the credentials for the next requests
$wpClient->setCredentials($endpoint, $site_username, $site_password);

$args = array(
	'post_title'=>'Post Title',
	'post_status'=>'published',
	'post_content'=>'Lorem ipsum',
	'custom_fields'=> array(
		array('key'=>'test1','value'=>'Test 1'),
		array('key'=>'test2','value'=>'Test 2'),
	)
);
$wpClient->newPost($args['post_title'],$args['post_content'],$args);

echo 'The evil deed which you requested is done.';

?>
