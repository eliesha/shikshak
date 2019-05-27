<?php 
require '../config/init.php';
require 'inc/header.php';

require CLASS_PATH.'janamat.php';
$janamat = new Janamat;


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
                    <h2>जनमत सुची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>क्रम</th>
                          <th>शिर्षक</th>
                          <th>मिति</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php 
                            $janamat_info = $janamat->getAllJanamat();

                            if ($janamat_info) {
                                foreach ($janamat_info as $key => $janamatQuestion) {
                                  ?>
                                  <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <?php 
                                        $edit = substr(md5("edit_janamat-".$janamatQuestion->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
                                    <td><a href="addJanamat?id=<?php echo $janamatQuestion->id ?>&amp;act=<?php echo $edit;?>""><?php echo $janamatQuestion->title ?></a></td>
                                    <td><?php echo $janamatQuestion->added_date ?></td>
                                    <td>
                                      <?php 
                                        $delete = substr(md5("delete_janamat-".$janamatQuestion->id.$session->getSessionByKey('session_token')), 3, 15);
                                       ?>
                                        <a href="process/janamat?id=<?php echo $janamatQuestion->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाईं पक्का यो प्रश्न मेटाउन चाहानुहुन्छ?')">Delete</a>
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