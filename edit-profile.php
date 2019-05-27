<?php require 'inc/header.php'; 
    if(isset($_SESSION['fuser_id']) && !empty($_SESSION['fuser_id'])){
        
        $id = $_SESSION['fuser_id'];
        
        require CLASS_PATH.'bookmark.php';
    
        require CLASS_PATH.'article.php';
        
        $article = new Article();
        
        $bookmark = new Bookmark();
        
        $userInfo = $user->getUserById($id);
        
        $image = basename($userInfo[0]->image);
        
        if(isset($userInfo[0]->image)&& !empty($userInfo[0]->image) && file_exists(UPLOAD_DIR.'users/'.$image)){
                                            
            $profileImage = UPLOAD_URL.'users/'.$image;
            
        } else {
        
            $profileImage = FRONT_IMAGES_URL.'defaultUser.png';
        
        }
      ?>
<ul class="nav nav-tabs container p-4" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="#profile" role="tab" data-toggle="tab"><strong>प्रोफाइल</strong></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#articles" role="tab" data-toggle="tab"><strong>लेख लेख्नुहोस्</strong></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#archive" role="tab" data-toggle="tab"><strong>बुकमार्क</strong></a>
    </li>
</ul>
<!-- Tab panes -->
<div class="tab-content container p-4">
    <div role="tabpanel" class="tab-pane active" id="profile">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="text-center">
                        </div>
                        <form class="form-horizontal" role="form" action="process/user.php" method="POST" enctype="multipart/form-data" style="background:transparent">
                            <div class="text-center">
                                <img class="img-circle img-fluid" src="<?php echo $profileImage ?>" style="width:100px; height:100px;">
                                <div class="new edit-list">
                                    <p class="pstyle7">फोटो परिवर्तन गर्नुहोस</p>
                                    <input type="file" name="image" class="text-center center-block well well-sm submit-button">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 personal-info">
                        <h5 class="page-header"><strong>तपाईंको प्रोफाइल</strong></h5>
                        <ul class="list-inline">
                            <li class="full-name">
                                <h6 style="display: inline;"> <?php echo $userInfo[0]->full_name ?></h6>
                                <button id="click-button" onclick="myFunction()" style="float:right; width:50px; height:50px;"> <i class="fas fa-edit"></i></button>
                            </li>
                            <li class="e-mail ">
                                <h6 class="smaller-font" style="display: inline;"><?php echo $userInfo[0]->email ?></h6>
                            </li>
                            <li class="username">
                                <h6 class="smaller-font" style="display: inline;">Username: <?php echo $userInfo[0]->username ?></h6>
                            </li>
                        </ul>
                        <div class="new edit-list">
                            <div class="form-group">
                                <label class="control-label">First name:</label>
                                <input class="form-control" value="<?php echo $userInfo[0]->first_name ?>" type="text" name="first_name">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Last name:</label>
                                <input class="form-control" value="<?php echo $userInfo[0]->last_name ?>" type="text" name="last_name">
                            </div>
                            <div class="form-group">
                                <label class=" control-label">Username:</label>
                                <input class="form-control" value="<?php echo $userInfo[0]->username ?>" type="text" name="username">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password:</label>
                                <input class="form-control" value="password" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label class="control-label"></label>
                                <input type="hidden" value="84" name="user_id">
                                <button class="btn btn-articles">संचय गर्नुहोस </button>
                                <span></span>
                                <button class="btn btn-danger" type="reset">रद्द गर्नुहोस्</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 offset-md-1">
                        <h5 class="page-header text-center"><strong>तपाईले लेख्नु भएको लेखहरु</strong></h5>
                        <table class="table table-bordered">
                            <thead style="background: #1E695E; color:#fff">
                                <th>एस.एन</th>
                                <th>शीर्षक</th>
                                <th>स्थिति</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $data = $news->getNewsMannkaaKuraOfUser($id);
                                     
                                    if($data){
                                        
                                        foreach ($data as $key => $dataList){
                                            
                                            if($dataList->status == "Active"){
                                                
                                                $status = "स्वीकृत";
                                                
                                            } else {
                                                
                                                $status = "स्वीकृत";
                                                
                                            }
                                            
                                            ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $dataList->title ?></td>
                                    <td><?php echo $status ?></td>
                                </tr>
                                <?php
                                    }
                                    
                                    } else {
                                    
                                    echo "तपाईंले कुनै पनि लेख लेख्नु भएको छैन।";
                                    
                                    }
                                    
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="articles">
        <div class="row">
            <div class="col-md-2 col-sm-12">
                <img class="img-circle img-fluid" src="<?php echo $profileImage ?>" style="width:100px; height:100px;">
            </div>
            <div class="col-md-8 col-sm-12" id="id-form">
                <form action = "admin/process/news.php" method = "post" style="background:transparent">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>शीर्षक :</strong></label>
                        <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                        <label for="exampleFormControlTextarea1"><strong>सारांश :</strong></label>
                        <textarea class="form-control" name="summary" rows="3"></textarea>
                        <label for="exampleFormControlTextarea1"><strong>कथा :</strong></label>
                        <textarea class="form-control" name="story" class="summernote" id="summernote"></textarea>
                        <input type="hidden" name="news_category" value="14">
                        <input type="hidden" name="added_by" value="<?php echo $_SESSION['fuser_id'] ?>">
                        <input type = "hidden" name="article" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #1E695E">संचय गर्नुहोस् </button>
                </form>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="archive">
        <?php 
            $check = $bookmark->getBookmarkByUserIdLimit($_SESSION['fuser_id'], 0, 2);
            
            $count = count($check);
            
            if($count > 0){
                    if(is_array($check) || is_object($check)){
                       foreach($check as $list){
                        
                        $act = explode(' ', html_entity_decode($list->title));
                        $act = implode('-', $act);
                        
                        $base = basename($list->image);
                        
                        if(isset($list->image) && file_exists(UPLOAD_DIR.'news/'.$base)){
                            
                            $thumbnail = UPLOAD_URL.'news/'.$base;
                            
                        } else {
                            
                            $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                            
                        }
                        
                        
                        ?>
        <div class="wrap" id="wrap">   
        </div>
        <?php
            } 
                    }
                    
            
            } else {
            echo "तपाईंले कुनै पनि पोस्ट बुकमार्क गर्नु भएको छैन।";
            }
            
            $bookmarkNumber = $bookmark->getBookmarkByUserId($_SESSION['fuser_id']);
            $bookCount = count($bookmarkNumber);
            ?>
    </div>
</div>
<?php require 'inc/footer.php'; 
    require 'inc/fotjava.php'; 
    ?>
<script>
    CKEDITOR.replace( 'summernote',
      {
          extraPlugins: 'save-to-pdf',
          pdfHandler: '../assets/editor/plugins/save-to-pdf/savetopdf.php'
      } );
</script>
<script scr="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        var count = 5;
        var bookCount = <?php echo $bookCount ?>;
        count = count;
        $('#wrap').load('data.php', {
            limit: count
        });
        var percent = 90;
        var window_scrolled;
        var scrollCount = 1;
        $(window).scroll(function() {
            window_scrolled = ($(document).height()/100)*90;
            if($(window).scrollTop() + $(window).height() >= window_scrolled) {
                count = count + 5;
                if(bookCount > scrollCount*5){
                    $('#nodata').hide();
                    $('#wrap').load('data.php', {
                        limit: count
                    });
                } 
                scrollCount++; 
            } 
        });
    });
    $('#click-button').click(function(){
       $(".new").toggleClass("edit-list");
    });
    
</script>
<?php
    } else {
        redirect('/signin.php', 'error', 'कृपया पहिले लग इन गर्नुहोस्।');
    }
    ?>