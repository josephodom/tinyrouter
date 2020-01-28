<?php

require_once 'class.tinyrouter.php';

// First, I'm going to set up how I intend to use it:

$router = new TinyRouter();

// Without regex
$router->any(':/post/?/noregex', function($id){
	return 'You are attempting to view post # ' . $id . ' via the no-regex route';
});

// With regex
// This allows more control
$router->any('/^\/post\/([0-9]+)\/regex/', function($id){
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		return 'Posting to post # ' . $id . 'via regex route';
	}
	
	return 'You are attempting to view post # '. $id . ' via the regex route'
		. '<br><form method="post"><button type="submit">Go to $_POST?</button></form>';
});

// Post
$router->get(':/post/new', function(){
	return 'This is the page for creating a new post.<form method="post"><button type="submit">Submit</button></form>';
});
$router->post('/post/new', function(){
	return 'You have created a new post!';
});

// Multiple routes, one method
$router->any([
	':/multiple/routes',
	':/many/routes',
], function(){
	return 'This method has multiple route strings!';
});

// Display our page
echo $router->run();

// Notably missing:
// - PUT support

?>