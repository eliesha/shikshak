<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'ads.php';
$ads = new Ads;
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
                    <h2>लेख सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>एस . एन</th>
                          <th>शीर्षक</th>
                          <th>लिङ्क</th>
                          <th>स्थिति</th>
                          <th>काम</th>
                        </thead>
                        <tbody>
                        <?php 

                        $adList = $ads->getAllAds();
                        
                        if($adList){
                            foreach($adList as $key => $list){
                                ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <?php 
                                        $edit = substr(md5("edit_ad-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                    ?>
                                    <td><a href="addAds?id=<?php echo $list->id ?>&amp;act=<?php echo $edit;?>"><?php echo $list->title;?></a></td>
                                    <td><?php echo $list->url ?></td>
                                    <td><?php echo $list->status ?></td>
                                    <td>
                                      <?php 
                                        $delete = substr(md5("delete_ad-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
                                      <a href="process/ads?id=<?php echo $list->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाईं पक्का यो शैक्षिक विज्ञापन हटाउन चाहनुहुन्छ?')">रद्द गर्नुहोस्</a></td>
                                    
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