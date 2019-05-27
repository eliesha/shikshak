<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'series.php';
$series = new Series;
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
                    <h2>अंक सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>एस . एन</th>
                          <th>शीर्षक</th>
                          <th>स्थिति</th>
                          <th>काम</th>
                        </thead>
                        <tbody>
                        <?php 

                        $seriesList = $series->getAllSeries();
                       
                        if($seriesList){
                            
                            foreach($seriesList as $key => $list){
                                ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <?php 
                                        $edit = substr(md5("edit_ad-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                    ?>
                                    <td><a href="addSeries?id=<?php echo $list->id ?>&amp;act=<?php echo $edit;?>"><?php echo $list->month;?></a></td>
                                    <td><?php
                                    $image = basename($list->image);
                                    if(!empty($list->image) && file_exists(UPLOAD_DIR.'series/'.$image)){
                                        
                                        $thumbnail = UPLOAD_URL.'series/'.$image;
                                        
                                    } else {
                                        
                                        $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                        
                                    }
                                     
                                    ?>
                                    <img src="<?php echo $thumbnail ?>" style="width:80px;">
                                    </td>
                                    <?php 
                                        $delete = substr(md5("delete_series-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
                                      <td>
                                      <a href="process/series?id=<?php echo $list->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाईं पक्का यो शैक्षिक अंक हटाउन चाहनुहुन्छ?')">रद्द गर्नुहस्</a</td>
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