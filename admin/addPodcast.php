<?php 

require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'category.php';

require CLASS_PATH.'podcast.php';

$category = new Category;

$podcast = new Podcast;

$act = "थप गर्नुहोस्";

?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php 
            if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
            $id = (int)$_GET['id'];
            $action = $_GET['act'];
            if($action != substr(md5("edit_podcast-".$id.$session->getSessionByKey('session_token')), 3, 15)){
              
              redirect('podcast', 'error', 'टोकन बेमेल।');
            
            }

            $pod_info = $podcast->getPodcastById($id);
              
            if(!$pod_info){

              redirect('podcast', 'error', 'तपाईंले खोज्नु भएको पोडकास्ट पाइएन।');
            }
            $act = "अद्यावधिक गर्नुहोस्";
        }
         ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>पोडकास्ट <?php echo $act;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <br />
                    <form style="max-width: 900px" action="process/podcast" method="post" enctype="multipart/form-data">
                        <div class="form-group pull-right">
                           <label>मिति:</label>
                           <input type="text" class="date" name="added_date" value="<?php echo @$pod_info[0]->added_date ?>">
                        </div>
                        <div class="form-group">
                            <label for="EditedBy">शीर्षक: </label>
                            <input type="text" class="form-control" placeholder="शीर्षक प्रविष्ट गर्नुहोस्" id="title" name="title" required value="<?php echo @$pod_info[0]->title;?>">
                        </div>

                        <div class="form-group">
                            <label for="EditedBy">वर्णन: </label>
                            <textarea name="description" class="form-control" placeholder="दिइएका पोडकास्टका लागि वर्णन प्रविष्ट गर्नुहोस्।" style="resize:none" rows="3"><?php echo $pod_info[0]->description ?></textarea>
                        </div>
                              
                        <div class="form-group">
                            <label for="Category">पोडकास्ट कोटि: </label>
                            <select class="form-control" name="category" id="category">
                            <option selected disabled hidden>--कुनै एक छान्नुहोस--</option>
                            <?php 
                            if ($session->getSessionByKey('roles') == 'Admin') {
                            
                            $podCategory = $category->getCategoryPodcast();
                              
                            } else {

                              $podCategory = $category_permitted->getCategoriesByUserId($session->getSessionByKey('user_id'));
                            
                            }

                              if ($podCategory) {
                            
                                   foreach ($podCategory as $categoryList) {
                            
                                    $class = "hidden";
                            
                                    if ($categoryList->is_pod == 1) {
                            
                                      $class = "";
                            
                                    }
                            
                                    ?>
                                   <option class="<?php echo $class ?>" value="<?php echo @$categoryList->id?>" <?php echo (isset($pod_info) && $pod_info[0]->category == $categoryList->id) ? 'selected' : '' ?>><?php echo @$categoryList->title;?></option>
                                <?php
                              }
                              }
                            ?>
                           </select>
                        </div>
                                
                        <div class="form-group pt-2">
                            <label for="EditedBy">थप गर्ने व्यक्ति को नाम : </label>
                            <select class="form-control" name="added_by">
                              <option selected disabled hidden>-- कुनै एक छान्नुहोस --</option>
                                <?php 
                                  if ($_SESSION['roles'] == 'Admin') {
                                    $userlist = $user->getAllUserList();
                                      if ($userlist) {
                                        foreach ($userlist as $userList) {
                                ?>
                                          <option value="<?php echo @$userList->id ?>" <?php echo (isset($pod_info[0]->added_by) == $userList->id) ? "selected" : '' ?>><?php echo @$userList->full_name ?></option>
                                      <?php
                                    }
                                  }
                              } else {
                                ?>
                                  <option selected value="<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['full_name'] ?></option>
                                <?php
                              }
                             ?>
                             </select>
                        </div>
                        <?php $audio = $pod_info[0]->audio;
                        $url = $pod_info[0]->url;
                        ?> 
                        <div class="form-group pt-2 input-upload">
                            <label for="EditedBy">पोडकास्ट प्रकार : </label>
                            <select class="form-control" name="podcast_type" id="podcast_type">
                              <option selected disabled hidden>-- कुनै एक छान्नुहोस --</option>
                                <option id="audio1" name="audio1" value="audio1" <?php echo (isset($pod_info[0]->audio) && $pod_info[0]->audio == $audio) ? 'selected' : '' ?>>अडियो</option>
                                <option id="video1" name="video1" value="video1" <?php echo (isset($pod_info[0]->url) && $pod_info[0]->url == $url) ? 'selected' : '' ?>>भिडियो</option>
                             </select>
                        </div>                        
                               
                        <div class="form-group" id="input-upload">
                            <label for="avatar">अडियो अपलोड गर्नुहोस्:</label><br>
                            <input type="file" class="upload" id="fileUp" name="audio">
                        </div>  

                        <div class="form-group" style="width:30%" id="input-file">
                            <label for="Filename">अडियो अवधि: </label>
                            <input id="infos" class="form-control" name="duration" value="<?php echo $pod_info[0]->duration ?>">
                        </div> 

                        <div class="form-group" id="input-upload-file">
                            <label for="avatar">भिडियो अपलोड गर्नुहोस्:</label><br>
                            <input type="url" name="link" id="link" class="form-control" placeholder="युटुब लिंक अपलोड गर्नुहोस्" value="<?php echo $pod_info[0]->url ?>">
                        </div> 
                        
                        <div class="form-group">
                            <input type="hidden" name="pod_id" value="<?php echo @$pod_info[0]->id ?>">
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> पोडकास्ट <?php echo $act;?></button>
                            <button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> रद्द गर्नुहोस्</button>
                        </div>                
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php require 'inc/duration.php' ?>

<?php require 'inc/footer.php';?>

<script type="text/javascript">
 
  $('#podcast_type').change(function() {
  var val = $('#podcast_type').val();        
  if (val == 'audio1') {                     
    $('#input-upload').show();
    $('#input-file').show();
    $('#input-upload-file').hide();
  } else if (val == 'video1') {             
    $('#input-upload').hide();
    $('#input-file').hide();
    $('#input-upload-file').show();
  } else {
    $('#input-upload').hide();               
    $('#input-file').hide();
    $('#input-upload-file').hide();
  }
}).change();
  
</script> 

