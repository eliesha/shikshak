<?php require 'inc/header.php';
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        
        if ($id) {
            
            $getProfile = $profile->getProfileById($id);
            
        }
    
    }
     ?>
<div class="main">
    <div class="container">
        <!-- End of top adspace -->
        <div class="row py-2 px-2">
            <!--  Main Content Column-->
            <div class="col-md-9">
                <h1 class="py-3 text-md-center" style="margin: auto;"><?php echo $getProfile[0]->title ?>
                </h1>
                <?php 
                    $image = basename($getProfile[0]->image);
                    
                    if (isset($getProfile[0]->image) && !empty($getProfile[0]->image) && file_exists(UPLOAD_DIR.'profile/'.$image)) {
                        
                        $feature = UPLOAD_URL.'profile/'.$image; 
                    ?>
                <img src="<?php echo $feature ?>" class="img-fluid py-2 apple" style="width:900px; height: 500px">
                <?php
                    } else {
                        $feature = "";
                        ?>
                <a href=""><img src="<?php echo $feature ?>" class="img-fluid py-2 apple"></a>
                <?php
                    }
                    
                     ?>
                <div class="row">
                    <div class="social-row" style="padding: 10px;float: left;">
                        <?php 
                            $act = explode(' ', html_entity_decode($getProfile[0]->author));
                                                           $act = implode('-', $act);
                            ?>
                        <a href="/user/<?php echo $getProfile[0]->added_by ?>/<?php echo $act ?>">
                            <p class="ptype888">लेखक <strong><em><?php echo $getProfile[0]->author ?></em></strong></p>
                        </a>
                    </div>
                    <!-- AddToAny BEGIN -->
                    <!-- AddToAny BEGIN -->
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="padding-left: 0px;padding-top: 8px">
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                    </div>
                </div>
                <p class="ptype777 editor">
                    <?php echo html_entity_decode($getProfile[0]->story) ?>
                </p>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-3 col-xs-8 col-md-8 pt-2">
                <div class="row" style="padding-top: 55px">
                    <a href=""><img src="<?php echo FRONT_IMAGES_URL ?>template2.gif" alt="template1" class="img-fluid pt-4 apple"></a>
                    <a href=""><img src="<?php echo FRONT_IMAGES_URL ?>template3.gif" alt="template1" class="img-fluid py-2 apple"></a>
                    <a href=""><img src="<?php echo FRONT_IMAGES_URL ?>template4.gif" alt="template1" class="img-fluid py-2 apple"></a>
                    <a href=""><img src="<?php echo FRONT_IMAGES_URL ?>template5.gif" alt="template1" class="img-fluid py-2 apple"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of section  -->
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->