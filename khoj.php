<?php 
    require 'inc/header.php';
    require CLASS_PATH.'category.php';
    $category = new Category();
    $search_param = array();
    
    /********Search results from Keyword*********/
    if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    	$search_param['keyword'] = htmlentities($_GET['keyword']);
    }
    /********Search results from Keyword*********/
    
    $limit = 10;
    $search_param['limit'] = $limit;
    $search_result = $news->getSearchValue($search_param);
    $fullName = $_GET['keyword'];
    $total_count = $search_result['count'];
    $search_result = $search_result['data'];
    $count = count($search_result);
    $getDetail = $user->getUserByName($fullName);
    $id = $getDetail[0]->id;
    $data = $news->getNewsByUserId($id);
    $dataCount = count($data);
	if($getDetail){
	   for($i=0; $i<$dataCount; $i++){
	    $act = explode(' ', html_entity_decode($data[$i]->title));
        $act = implode('-', $act);
        $thumbnail = basename($data[$i]->image);
        if(isset($data[$i]->image) && file_exists(UPLOAD_DIR.'news/'.$thumbnail)){
                
                $thumbnail = UPLOAD_URL.'news/'.$thumbnail;
                
            } else {
                
                $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                
            }
            ?>
            <div class="main">
            <div class="container">
                <div class="row">
                    <div class="row  rowmain" >
                        <div class="col-md-7 topics-sec-item-cont">
                            <p class="topics-sec-item-label">
                                <time id="PubTime"><?php echo $data[$i]->added_date ?></time>
                            </p>
                            <a href="/<?php echo $data[$i]->id?>/<?php echo $act ?>">
                                <h2 class="topics-sec-item-head"><?php echo $data[$i]->title ?></h2>
                            </a>
                            <p class="topics-sec-item-p"><?php echo $data[$i]->summary ?></p>
                        </div>
                        <div class="col-md-5 topics-sec-item-img">
                            <img src="<?php echo $thumbnail ?>" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
	   }
	} elseif($search_result){
	    
	    for($i=0; $i<$count; $i++){
	       $act = explode(' ', html_entity_decode($search_result[$i]->title));
        $act = implode('-', $act);
        $thumbnail = basename($search_result[$i]->image);
        if(isset($search_result[$i]->image) && file_exists(UPLOAD_DIR.'news/'.$thumbnail)){
                
                $thumbnail = UPLOAD_URL.'news/'.$thumbnail;
                
            } else {
                
                $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                
            }
            ?>
            <div class="main">
            <div class="container">
                <div class="row">
                    <div class="row  rowmain" >
                        <div class="col-md-7 topics-sec-item-cont">
                            <p class="topics-sec-item-label">
                                <time id="PubTime"><?php echo $search_result[$i]->added_date ?></time>
                            </p>
                            <a href="/<?php echo $search_result[$i]->id?>/<?php echo $act ?>">
                                <h2 class="topics-sec-item-head"><?php echo $search_result[$i]->title ?></h2>
                            </a>
                            <p class="topics-sec-item-p"><?php echo $search_result[$i]->summary ?></p>
                        </div>
                        <div class="col-md-5 topics-sec-item-img">
                            <img src="<?php echo $thumbnail ?>" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
	    }
	} else {
	    ?>
	    <div class="container text-center" id="c404">
           <div class="row">
              <div class="col-md-6 col-sm-12 offset-md-3 c404">
                 <h1>डेटा फेला परेन!</h1>
                 <h5><strong>माफ गर्नुहोस्! तपाईले खोज्नु भएको डेटा फेला पार्न सकिएन।</strong></h5>
              </div>
           </div>
        </div>
	    <?php
	}
require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>