<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'profile.php';
$profile = new Profile;

$profile_info = $profile->getAllProfile();
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php flash(); ?>
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
                    <h2>शैक्षिक प्रोफाइल सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>S.N</th>
                          <th>Title</th>
                          <th>Added date</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php 
                           if ($profile_info) {
                              foreach ($profile_info as $key => $profileList) {
                                ?>
                                  <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <?php 
                                        $edit = substr(md5("edit_profile-".$profileList->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
                                    <td><a href="addProfile?id=<?php echo $profileList->id ?>&amp;act=<?php echo $edit;?>"><?php echo $profileList->title;?></a></td>
                                    <td><?php echo $profileList->added_date ?></td>
                                    <td>
                                      <?php 
                                        $delete = substr(md5("delete_profile-".$profileList->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
                                      <a href="process/profile?id=<?php echo $profileList->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाईं पक्का यो शैक्षिक प्रोफाइल हटाउन चाहनुहुन्छ?')">रदगर्नुहोस्</a></td>
                                  </tr>
                                <?php
                              }
                           }
                           ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php require 'inc/footer.php';?>