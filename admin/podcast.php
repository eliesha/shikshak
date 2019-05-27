<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'podcast.php';
$podcast = new Podcast;

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
                    <h2>पोडकास्ट सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>एस.एन.</th>
                          <th>शीर्षक</th>
                          <th>कोटि</th>
                          <th>अवधि</th>
                          <th>थप गर्ने व्यक्ति</th>
                          <th>थपिएको मिति</th>
                          <th>एक्शन</th>
                        </thead>
                        <tbody>
                          <?php 
                            $all_podcast = $podcast->getAllPodcast();
                            //debugger($all_podcast, true);
                            if ($all_podcast) {
                                foreach ($all_podcast as $key => $podcastList) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <?php 
                                        $edit = substr(md5("edit_podcast-".$podcastList->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
                                    <td><a href="addPodcast?id=<?php echo $podcastList->id ?>&amp;act=<?php echo $edit;?>"><?php echo $podcastList->title;?></a></td>
                                    <td><?php echo $podcastList->category ?></td>
                                    <td><?php echo $podcastList->duration ?></td>
                                    <td><?php echo $podcastList->author ?></td>
                                    <td><?php echo $podcastList->added_date ?></td>
                                    <td>
                                      <?php 
                                        $delete = substr(md5("delete_podcast-".$podcastList->id.$session->getSessionByKey('session_token')), 3, 15);
                                       ?>
                                        <a href="process/podcast?id=<?php echo $podcastList->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाईं पक्का यो पोडकास्ट मेटाउन चाहनुहुन्छ?')">रद्द गर्नुहोस्</a>
                                    </td>
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