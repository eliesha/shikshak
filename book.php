<?php require 'inc/header.php';
    if(isset($_GET['id']) && !empty($_GET['id'])){
       
        $id = $GET['id'];
        
        $bookData = $book->getBookById($_GET['id']);
        
        if($bookData){
            ?>
<div class="main-book-cover">
    <div class="container">
        <div class="row">
            <div class="col-md-9 p-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="book-cover">
                            <?php 
                                $image = basename($bookData[0]->image);
                                
                                if(isset($bookData[0]->image) && file_exists(UPLOAD_DIR.'book/'.$image)){
                                    
                                    $thumbnail = UPLOAD_URL.'book/'.$image;
                                    
                                } else {
                                    
                                    $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
                                    
                                }
                                
                                ?>
                            <img src="<?php  echo $thumbnail ?>" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="book-description pt-2">
                            <h2><?php echo $bookData[0]->title ?> - <?php echo $bookData[0]->writer ?></h2>
                            <p><?php echo html_entity_decode($bookData[0]->story) ?></p>
                            <h6>प्रकाशक: <?php echo $bookData[0]->publication ?> </h6>
                            <hr>
                            <h4>मूल्य: <?php echo $bookData[0]->price ?> </h4>
                            <a href="<?php echo $bookData[0]->link ?>"  target="_blank" class="btn-lg book-cover-button">किन्नुहोस </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
    
    }
    
    
    ?>
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>