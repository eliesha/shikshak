<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'podcast.php';

require CLASS_PATH.'category.php';

header('Content-Type: application/json; charset=utf-8');

$podcast = new Podcast();

$category = new Category();

$podList = $category->getCategoryPodcast();

$id = $_REQUEST['podcastId'];

if ($id == "alldata") {
	
	$podList = $category->getCategoryPodcastWithEpi();
	
	echo json_encode($podList);

} else {

	$podItems = $podcast->getPodcastByCategoryId($id);

	$count = count($podItems);

	if (!empty($podItems)) {
	   
	    $output = array();

	    foreach ($podItems as $podCast) {

	            $output = $podItems;
	    
	    } 

        echo json_encode($output);
	
	} else {
	    
	        echo "Sorry! there is no podcast added to this category.";
	    
	}


}