<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'podcast.php';

header('Content-Type: application/json; charset=utf-8');

$user = new User();

$podcast = new Podcast;

$userList = $user->getAllUser();

$id = $_REQUEST['userId'];

$podcast = new Podcast();

$userList = $user->getAllUserName();

if ($id == "alldata") {
    
    $query = $user->getAllUser();

    echo json_encode($query);

    die;

} else {

     $output = [];

    foreach ($userList as $users) {

    $info = $users->userInfo;

    $profile = $users->image;



    $podcastList = $podcast->getUserPodcast($id);

    if (!empty($podcastList)) {
        
        $output[] =  $podcastList;
    
    }

}

if (!empty($output)) {
    
    $json = array(
    
    'profile'   => $profile,

    'profileInfo'  => $info,
    
    'podcast'   => $output

);

    echo json_encode($json);

} else {

    echo "There is no podcast added by ".$users->full_name.".";

    die;

}

}