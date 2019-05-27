<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'news.php';

require CLASS_PATH.'category.php';

require CLASS_PATH.'session.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'token.php';

$news = new News();

$postWriter = new postAuthor();

$users = new User();

$session = new Session();

$category = new Category();

$token = new Token();

if (isset($_POST) && !empty($_POST)) {

	$data = array();
	
	$data['title'] = escapeString($_POST['title']);
	
	$data['story'] = htmlentities($_POST['story']);
	
	$data['summary'] = htmlentities($_POST['summary']);
	
	$data['news_category'] = (int)($_POST['news_category']);
	
	$data['status'] = (isset($_POST['status'])) ? escapeString($_POST['status']) : 'Inactive'; 
	
	$data['griha'] = (isset($_POST['griha']) && $_POST['griha'] == 1 ) ? 1 : 0;
	
	$data['added_date'] = escapeString($_POST['date']);
	
	$data['archieveCategory'] = (isset($_POST['archieveCategory'])) ? escapeString($_POST['archieveCategory']) : 'website'; 

	if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
	
		$image = uploadSingleFile($_FILES['image'], 'news');
	
		if ($image) {
	
			$data['image'] = $image; 
	
			$filename = basename($_POST['del_image']);
	
			if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'news/'.$filename)) {
	
				unlink(UPLOAD_DIR.'news/'.$filename);
	
			}
	
		} 
	
	} 
	
	$news_id = (isset($_POST['news_id']) && !empty($_POST['news_id'])) ? (int)$_POST['news_id'] : null;

		if ($news_id) {
	
			$act = "अद्यावधिक";
	
			$news_id = $news->updateNews($data, $news_id);
				   
				    if($news_id){
				        
				        $filename = basename($_POST['del_image']);
		
        				if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'news/'.$filename)) {
        		
        					unlink(UPLOAD_DIR.'news/'.$filename);
        		
        				}

                        $authordelete = $postWriter->deleteAuthor($_POST['news_id']);
                       
                		$count = count($_POST['added_by']);
                
                		if($count > 0){
                			
                			for($i=0; $i<$count; $i++){
                
                				$temp =array(
                				
                					'post_id' => $_POST['news_id'],
                				
                					'user_id'	=> $_POST['added_by'][$i]
                				
                				);
                			$postauthor = $postWriter->addAuthor($temp);	
                			
                			}
                			
                		}
                		
                		
            		    if($data['news_category'] == 14){
            		        if($postauthor){
            		            redirect('/admin/inactiveArticle', 'success', 'लेख सफलतापूर्वक '.$act.' भयो।');
            		        } else {
            		            redirect('/admin/inactiveArticle', 'error', 'माफ गर्नुहोस्! लेख '.$act.' गर्दा समस्या भयो।');
            		        }
                		} elseif($data['news_category'] != 14) {
                		    if($postauthor){
            		            redirect('../news', 'success', 'समाचार सफलतापूर्वक '.$act.' भयो।');
            		        } else {
            		            redirect('../news', 'error', 'माफ गर्नुहोस्! समाचार '.$act.' गर्दा समस्या भयो।');
            		        }
                		}
                	
                	} 
			
		} else {
	
			$act = "थप";
	
			$news_id = $news->addNews($data);
			    
			    $filename = basename($_POST['del_image']);
		
				if (isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'news/'.$filename)) {
		
					unlink(UPLOAD_DIR.'news/'.$filename);
		
				}
				    
				    if($news_id){

                		$count = count($_POST['added_by']);
                
                		if($count > 0){
                			
                			for($i=0; $i<$count; $i++){
                
                				$temp =array(
                				
                					'post_id' => $news_id,
                				
                					'user_id'	=> $_POST['added_by'][$i]
                				
                				);
                			$postauthor = $postWriter->addAuthor($temp);	
                			
                			}
                			
                		}
                		
	
                		if(!empty($_POST['push']) && $_POST['push'] == 'checked'){
                		    
                		    $id = $news_id;
                		    
                		    $dataArray = array();
                		    
                		    $categoryName = $category->getCategoryById($data['news_category']);
                		    
                		    $dataArray['catTitle'] = $categoryName[0]->title;
                		    
                		    $authorDetail = $postWriter->getAuthorById($id);
                		    
                		    $dataArray['userDetail'] = $authorDetail;
                		    
                		    $dataArray['image'] = $data['image'];
                		    
                		    $dataArray['id'] = $id;
                		    
                		    $dataArray['added_date'] = $data['added_date'];
                	        
                    	    $getTokens = $token->getAllTokens();
                    	    
                    	    $countTokens = count($getTokens);
                    	    
                    	    $imagefinal = $data['image']; 
                    	    
                    	    for($i=0;$i<$countTokens;$i++){
                    	        
                        	    $finalToken = $getTokens[$i]->token;
                        	    
                        	    $file =  send_notification($dataArray, $finalToken);   
                    	        
                    	    }
                    	    
                    	}
                		
                		if($_POST['article'] == 1){
                		    
                		    if($postauthor){
                    		    redirect('/edit-profile', 'success', 'लेख सफलतापूर्वक '.$act.' भयो।');
                    		} else {
                    		    redirect('/edit-profile', 'error', 'माफ गर्नुहोस्! लेख '.$act.' गर्दा समस्या भयो।');
                    		}
                		    
                		} else {
                		    
                		    if($postauthor){
                    		    redirect('../news', 'success', 'समाचार सफलतापूर्वक '.$act.' भयो।');
                    		} else {
                    		    redirect('../news', 'error', 'माफ गर्नुहोस्! समाचार '.$act.' गर्दा समस्या भयो।');
                    		}
                		    
                		}
                		
                	} 
		   
	
		}
		
} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];
	
	$act = escapeString($_GET['act']);
	
	if ($act == substr(md5("delete_news-".$id.$session->getSessionByKey('session_token')), 3, 15)) {
		
		$news_info = $news->getNewsById($id);
		
		if ($news_info) {

			$image = basename($news_info[0]->image);
			
			$delete  = $news->deleteNews($id);
			
			if($news_info[0]->news_category != 14){
			    
			    if ($delete) {

    				if (isset($news_info[0]->image) && !empty($news_info[0]->image) && file_exists(UPLOAD_DIR.'news/'.$image)) {
    
    					unlink(UPLOAD_DIR.'news/'.$image);
    				}
    				
    
    				redirect('/admin/news', 'success', 'समाचार सफलतापूर्वक हटाइयो।');
    			
    			} else {
    				
    				redirect('/admin/news', 'error', 'माफ गर्नुहोस्! समाचार मेट्दा समस्या भयो।');
    			
    			}
			    
			} else {
			    
			    if ($delete) {

    				if (isset($news_info[0]->image) && !empty($news_info[0]->image) && file_exists(UPLOAD_DIR.'news/'.$image)) {
    
    					unlink(UPLOAD_DIR.'news/'.$image);
    				}
    				
    
    				redirect('/admin/inactiveArticle', 'success', 'लेख  सफलतापूर्वक हटाइयो।');
    			
    			} else {
    				
    				redirect('/admin/inactiveArticle', 'error', 'माफ गर्नुहोस्! लेख मेट्दा समस्या भयो।');
    			
    			}
			    
			}
			
		
		} else {

			redirect('../news', 'error', 'तपाईंले खोज्नु भएको समाचार पाइएन।');
		
		}
	
	} else {

		redirect('../news', 'error', 'टोकन बेमेल।');
	
	}

} else {

	redirect('../', 'error', 'अनधिकृत पहुँच।');

}