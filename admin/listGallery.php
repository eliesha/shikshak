<?php 

require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'gallery.php';

require CLASS_PATH.'galleryImages.php';

$gallery = new Gallery();

$gallery_images = new GalleryImages();

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
                    <h2>ग्यालरी संग्रह</h2>
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
                        $gallery_info = $gallery->getAllGallery();

                        if ($gallery_info) {
                          foreach ($gallery_info as $key => $galleryItems) {
                            ?>
                            <div class="col-md-4">
                              <div class="thumbnail">
                                <div class="image view view-first">
                                  <img style="width: 100%; display: block;" src="<?php echo $galleryItems->thumbnail ?>" alt="image" />
                                  <div class="mask">
                                    <p><?php echo $galleryItems->title ?></p>
                                    <div class="tools tools-bottom">
                                      <a href="galleryDetail?id=<?php echo $galleryItems->id ?>"><i class="fas fa-pencil-alt"></i></a>
                                      <?php 
                                        $delete = substr(md5("delete_imageFolder-".$galleryItems->id.$session->getSessionByKey('session_token')), 3, 15);
                                       ?>
                                      <a href="process/gallery?id=<?php echo $galleryItems->id ?>&act=<?php echo $delete ?>"><i class="fa fa-times"></i></a>
                                    </div>
                                  </div>
                                </div>
                                <div class="caption">
                                  <p><?php echo $galleryItems->description ?></p>
                                </div>
                              </div>
                            </div>
                            <?php
                          }
                        }
                        //debugger($gallery_info, true);
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