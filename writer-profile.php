<?php require 'inc/header.php';
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {
    
        $id = $_GET['id'];
    
        if ($id) {
    
            $userProfile = $news->getNewsByUserId($id);
            
            $countNews = count($userProfile);
    
        }
    
    }
    
     ?>
<div class="main">
    <div class="container">
        <!-- End of top adspace -->
        <div class="row ">
            <!--  Main Content Column-->
            <div class="col-md-8 paddingtype-1">
                <!-- writer intro -->
                <div class="row">
                    <div class="col-md-3">
                        <?php 
                            $profileImage = $userProfile[0]->profile_picture;
                            
                            $picture = basename($profileImage);
                            
                            if(isset($profileImage) && !empty($profileImage) && file_exists(UPLOAD_DIR.'users/'.$picture)){
                            
                                
                            
                                $thumbnail = UPLOAD_URL.'users/'.$picture;
                            
                                
                            
                            } else {
                            
                                $thumbnail = FRONT_IMAGES_URL.'defaultUser.png';
                            
                            }
                            
                            
                            
                            ?>
                        <div class="profile-img"><img class="img-responsive" src="<?php echo $thumbnail ?>" alt="profile"
                            title="profile">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="profile-des">
                            <h1 class="profile-des-title btm-border"><?php echo $userProfile[0]->author ?></h1>
                            <p class="profile-details-des"></p>
                            <p><?php echo $userProfile[0]->user_info ?></p>
                        </div>
                    </div>
                </div>
                <!-- Writer's articles -->
                <?php 
                    if($userProfile){
                    
                        foreach($userProfile as $users){
                    
                            ?>
                <div class="wrap" id="wrap"></div>
                <?php
                    }
                    
                    
                    
                    }
                    
                    
                    
                    ?>
            </div>
            <!-- Sidebar -->
            <div class="col-md-4 col-xs-8 pt-md-2">
                <div class="row">
                    <div class="opinion-writers-intro">
                        <div class="col-md-12 paddingtype-3">
                            <h2 class="opinion1 btm-border">अन्य लेखकका लेखहरु</h2>
                        </div>
                    </div>
                </div>
                <div class="row writertopics content-for-sidebar">
                    <div class="col-12 pt-md-4">
                        <?php 
                            $getUsers = $user->getAdminUsers($_GET['id'], 12);
                            
                            if($getUsers){
                            
                                foreach($getUsers as $users){
                            
                                    ?>
                        <div class="row sidebar-writers">
                            <?php 
                                $profileImage = $users->image;
                                
                                
                                
                                $profilePic = basename($profileImage);
                                
                                
                                
                                if(isset($profileImage) && !empty($profileImage) && file_exists(UPLOAD_DIR.'users/'.$profilePic)){
                                
                                    
                                
                                    $image = UPLOAD_URL.'users/'.$profilePic;
                                
                                    
                                
                                } else {
                                
                                    
                                
                                    $image = FRONT_IMAGES_URL.'defaultUser.png';
                                
                                    
                                
                                }
                                
                                
                                
                                ?>
                            <div class="col-3"><img src="<?php echo $image ?>" alt="pic"></div>
                            <div class="col-9 spacing-for-tab">
                                <p type="ptype-writer">
                                    <?php 
                                        $act = explode(' ', html_entity_decode($users->full_name));
                                        
                                            $act = implode('-', $act);
                                        
                                        ?>
                                    <img src="/assets/img/left-quote.svg" class="left-quote img-fluid" > <a href="/user/<?php echo $users->id ?>/<?php echo $act ?>"><span class="writer-spacing"><?php echo $users->full_name ?></span></a>
                                </p>
                                <?php 
                                    $userNews = $news->getNewsByUserId($users->id, 1);
                                    
                                    if($userNews){
                                    
                                        
                                    
                                        foreach($userNews as $newsList){
                                    
                                            ?>
                                <h5><?php echo $newsList->title ?></h5>
                                <?php
                                    }
                                    
                                    
                                    
                                    }
                                    
                                    ?>
                            </div>
                        </div>
                        <hr class="hrstyle1">
                        <?php
                            }
                            
                            }
                            
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- End of section  -->
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>
<script type="text/javascript">
    $( document ).ready(function() {
        var count = 5;
        var bookCount = <?php echo $countNews ?>;
        var user = <?php echo $_GET['id'] ?>;
        count = count;
            $('#wrap').load('/newsData.php', {
                limit: count,
                id: user
            });
        var percent = 80;
        var window_scrolled;
        var scrollCount = 1;
        $(window).scroll(function() {
            window_scrolled = ($(document).height()/100)*80;
            if($(window).scrollTop() + $(window).height() >= window_scrolled) {
             
                count = count + 5;
                if(bookCount > scrollCount*5){
                    $('#wrap').load('/newsData.php', {
                        limit: count,
                        id: user
                    });
                } 
                scrollCount++;
            }
        });
        
    });
</script>