<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
require CLASS_PATH.'series.php';
$series = new Series();
$class = '';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
$seriesYear = $series->getAnkaByYear($id);
if(!empty($seriesYear)){
    ?>
    <div class="carousel-item <?php echo $class ?>">
        <div class="top-with-controls-archive text-center">
            <h4 id="uniqueyear"><?php echo $id ?></h4>
        </div>
        <div class="body-archive"><div class="row py-2">
        <?php
        if(!empty($seriesYear)){
            foreach($seriesYear as $yearSeries){
                $imageSeries = basename($yearSeries->image);
                if(isset($yearSeries->image) && file_exists(UPLOAD_DIR.'series/'.$imageSeries)){
                    $cover = UPLOAD_URL.'series/'.$imageSeries;
                } else {
                    $cover = FRONT_IMAGES_URL.'shikshak.jpg';
                }
                ?>
                <div class="col-md-3 col-sm-6">
                        <img src="<?php echo $cover ?>" class="img-fluid">
                    </div>
                <?php
            }
        }
        ?>
        </div>
        </div>
    </div>
    <?php
} else {
    echo "No archive left";
}
?>