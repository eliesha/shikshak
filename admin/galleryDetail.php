<?php 

require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'gallery.php';

require CLASS_PATH.'galleryImages.php';

$gallery = new Gallery();

$galleryImages = new GalleryImages();

if (isset($_GET) && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $gallery_info = $galleryImages->getGalleriesById($id);
  }

?>
    <div class="container body">
      <div class="main_container">
      <?php require 'inc/menu.php' ?>
      <?php flash(); ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>मिडिया गैलरी</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row">
                      <?php 
                      
                          
                          if ($gallery_info) {
                          foreach ($gallery_info as $galleryItems) {
                            
                            ?>
                            <div class="col-md-4">
                              <div class="thumbnail">
                                <div class="image view view-first">
                                  <img style="width: 100%; display: block;" src="<?php echo $galleryItems->image_name ?>" alt="image" />
                                  <div class="mask">
                                    <div class="tools tools-bottom">
                                      <td>
                                      <?php 
                                        $delete = substr(md5("delete_image-".$galleryItems->id.$session->getSessionByKey('session_token')), 3, 15);

                                       ?>
                                        <a href="process/gallery?img_id=<?php echo $galleryItems->id;?>&amp;action=<?php echo $delete;?>" onclick="return confirm('तपाईं निश्चित हुनुहुन्छ कि तपाईं यस चित्र मेटाउन चाहनुहुन्छ?')"><i class="fa fa-times"></i></a></td>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
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
        <!-- /page content -->
<?php require 'inc/footer.php' ?>