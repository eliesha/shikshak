<?php 
require 'inc/checklogin.php';

require CLASS_PATH. 'categoryAccess.php';

require CLASS_PATH.'news.php';

$category_permitted = new CategoryAccess;

$news = new News();

$postWriter = new postAuthor();

$profile = $user->getUserById($_SESSION['user_id']);

 ?>
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../" class="site_title"><i class="fa fa-home"></i> <span>साइट भ्रमण गर्नुहोस्!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $profile[0]->image ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>वेलकम,</span>
                <h2><?php echo $profile[0]->first_name.' '.$profile[0]->last_name ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="dashboard"><i class="fas fa-tachometer-alt"></i> ड्यासबोर्ड</a>
                  </li>
                  <?php 

                  if ($session->getSessionByKey('roles') == 'Admin') {
                    ?>
                    <li><a><i class="fas fa-sitemap"></i> कोटि <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addCategory">कोटि थपनुहोस</a></li>
                      <li><a href="category">कोटि सूची</a></li>
                    </ul>
                  </li>
                    <?php
                  }

                   ?>
                   <li><a><i class="fas fa-comments"></i> प्रतिक्रिया <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="editComment">प्रतिक्रिया सच्याउनुहोस् </a></li>
                      <li><a href="comments">प्रतिक्रिया सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="far fa-newspaper"></i> समाचार <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addNews">समाचार थपनुहोस</a></li>
                      <li><a href="news">समाचार सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-images"></i> ग्यालरी <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addGallery">तस्बिर थपनुहोस</a></li>
                      <li><a href="listGallery">तस्बिर सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-brain"></i> सामान्य ज्ञान <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addQuiz">प्रश्न थपनुहोस</a></li>
                      <li><a href="quiz">प्रश्न सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fab fa-forumbee"></i> जनमत <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addJanamat">प्रश्न थपनुहोस</a></li>
                      <li><a href="janamat">प्रश्न सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-university"></i> शैशिक प्रोफाइल <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addProfile">प्रोफाइल थपनुहोस</a></li>
                      <li><a href="profile">प्रोफाइल सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-blog"></i> लेख (मानका कुरा) <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="inactiveArticle">लेखहरू</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-book"></i> पुस्तक <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addBook">पुस्तक थपनुहोस</a></li>
                      <li><a href="book">पुस्तक सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-database"></i> शिक्षकका अंकहरु <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addSeries">अंकहरु थपनुहोस</a></li>
                      <li><a href="bookSeries">अंकहरु सूची</a></li>
                    </ul>
                  </li>
                   <?php 

                   if ($_SESSION['roles'] == 'Admin') {
                    ?>
                    <li><a><i class="fas fa-podcast"></i> पोडकास्ट <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addPodcast">पोडकास्ट थपनुहोस</a></li>
                      <li><a href="podcast">पोडकास्ट सूची</a></li>
                    </ul>
                    </li>
                    <?php
                   } else {

                    $user_id = $session->getSessionByKey('user_id');

                    $getCategory = $category_permitted->getCategoriesByUserId($user_id);
                    
                    function filterArray($value){
                        return ($value->is_pod == 1);
                    }

                    $filteredArray = array_filter($getCategory, 'filterArray');

                    if ($filteredArray != Null) {
                        ?>
                        <li><a><i class="fas fa-podcast"></i> पोडकास्ट <span class="fas fa-chevron-down right"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="addPodcast">पोडकास्ट थपनुहोस</a></li>
                            <li><a href="podcast">पोडकास्ट सूची</a></li>
                          </ul>
                        </li>
                        <?php
                    } else {
                      echo "";
                    }

                   }

                    ?>
                </ul>
              </div>
              <?php 
                if ($_SESSION['roles'] == 'Admin') {
                  ?>
                  <div class="menu_section">
                <h3>अतिरिक्त</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fas fa-users"></i> शिक्षक पत्रिकाको सदस्यहरू <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="subscriber">सदस्यहरू सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-dollar-sign"></i> विज्ञापन <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addAds">विज्ञापन थपनुहोस</a></li>
                      <li><a href="ads">विज्ञापन सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-trophy"></i> प्रश्नोत्तरीको विजेता <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addWinner">विजेता थपनुहोस</a></li>
                      <li><a href="winner">विजेता सूची</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-user-plus"></i> युजरहरू <span class="fas fa-chevron-down right"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="addUsers">युजर थपनुहोस</a></li>
                      <li><a href="users">युजर सूची</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
                  <?php
                } else {
                  echo "";
                }
               ?>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $profile[0]->image ?>" alt=""><?php echo $profile[0]->first_name.' '.$profile[0]->last_name ?> 
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="myProfile"> Profile</a></li>
                    <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <?php 

                  if ($session->getSessionByKey('roles') == 'Admin') {
                    
                    $inactiveArticle = $news->countInactiveNewsMannKaaKura();
                    
                  ?>

                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-inbox" style="font-size: 23px"></i>
                    <?php 
                    if ($inactiveArticle[0]->inactiveMannKaaKura > 0) {
                      ?>

                      <div class="badge bg-red dot">
                       <?php echo $inactiveArticle[0]->inactiveMannKaaKura ?>
                      </div>
                      <?php
                    }
                     ?>
                  </a>

                  <?php
                  }
                  $listArticle = $news->getInactiveNewsMannKaaKura();
                  
                   ?>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <?php 

                    if ($listArticle) {
                      foreach ($listArticle as $items) {
                        $edit = substr(md5("edit_news-".$items->id.$session->getSessionByKey('session_token')), 3, 15);
                        
                        $profileImage = basename($items->user_profile);

                        if(isset($items->user_profile) && file_exists(UPLOAD_DIR.'users/'.$profileImage)){
                            
                            $profileImage = UPLOAD_URL.'users/'.$profileImage;
                            
                        } else {
                            
                            $profileImage = FRONT_IMAGES_URL.'defaultUser.png';
                            
                        }
                        
                        ?>
                        <li>
                          <a href="addNews?id=<?php echo $items->id ?>&amp;act=<?php echo $edit;?>">
                            <span class="image"><img src="<?php echo $profileImage ?>" alt="Profile Image" /></span>
                            <span>
                              <span><?php echo $items->title ?></span>
                            </span>
                            <span class="message"><?php echo html_entity_decode($items->summmary) ?></span>
                          </a>
                        </li>
                        <?php
                      }
                    }

                     ?>
                    <li>
                      <div class="text-center">
                        <a href="inactiveArticle.php">
                          <strong>सबै लेखहरू हेर्नुहोस्</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        