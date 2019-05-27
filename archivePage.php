<?php
    require 'inc/header.php';
    
    if(isset($_GET['date']) && !empty($_GET['date'])){
        
        $date = $_GET['date'];
        
    }
    
    $postAuthor = new postAuthor();
    
    $date = strtotime($date);
    
    $startingDate = date('Y-m-01', $date);
    
    $lastdate = date('Y-m-31', $date);
    
    $getArchive = $news->getNewsByDate($startingDate, $lastdate);
    
    $getAnka = $series->getAnkaByDate($startingDate, $lastdate);
    
    $image = basename($getAnka[0]->image);
    
    if(isset($getAnka[0]->image) && file_exists(UPLOAD_DIR.'series/'.$image)){
        
        $thumbnail = UPLOAD_URL.'series/'.$image;
        
    } else {
        
         $thumbnail = FRONT_IMAGES_URL.'shikshak.jpg';
        
    }
    
    ?>
<div class="individual-issue py-4 container">
    <!-- <div class="row">
        <div class="col-lg-9">-->
    <div class="row">
        <div class="col-md-2">
            <div class="cover-of-the-issue">
                <img src="<?php echo $thumbnail ?>">
            </div>
        </div>
        <div class="col-md-10 text-part">
            <h3 class="color-code"><?php echo $getAnka[0]->month ?></h3>
            <h4 class="color-code"><?php $getAnka[0]->month ?>
            </h4>
            <h6 class="color-code">मूल्य:Rs.60</h6>
            <!--<a href="/subscribe"><button class="btn btn-articles">ग्राहाक बन्नुहोस्</button></a>-->
        </div>
    </div>
    <div class="row table-with-pdf">
        <table>
            <thead style="background:#1E695E; color:#fff;padding:40px;">
                <th style="padding:8px">शीर्षक</th>
                <th style="padding:8px">लेखक</th>
                <th style="padding:8px">डाउनलोड</th>
            </thead>
            <tbody>
                <?php 
                    if(!empty($getArchive)){
                        
                        foreach($getArchive as $key => $archiveList){
                            
                            $authorNameList = $postAuthor->getAuthorById($archiveList->id);
                            
                            $act = explode(' ', html_entity_decode($archiveList->title));
                                $act = implode('-', $act);
                            ?>
                <tr>
                    <td><a href="/<?php echo $archiveList->id;?>/<?php echo $act ?>"><?php echo $archiveList->title ?></a></td>
                    <td>
                        <ul>
                        <?php
                        $countList = count($authorNameList);
                        
                        if($countList > 0){
                        
                            for($i=0; $i<$countList; $i++){
                                
                                $act = explode(' ', html_entity_decode($authorNameList[$i]->author));
                            
                                $act = implode('-', $act);
                                
                                ?>
                                <li><a href="/user/<?php echo $authorNameList[$i]->user_id;?>/<?php echo $act ?>"><?php echo $authorNameList[$i]->author ?></a></li>
                                <?php
                                
                            }?>
                            </ul>
                    </td>
                            <?php
                        }
                        
                            
                            
                            ?>
                        
                    <td class="text-center">
                        <?php 
                            $act = explode(' ', html_entity_decode($archiveList->title));
                            $act = implode('-', $act);
                            ?>
                        <form name="proposal_form" action="/wordGenerate.php" method="post"">
                           <input type="hidden" name="id" value="<?php echo $archiveList->id ?>" class="input-button">
                           <input type="hidden" name="submit_docs" value="Export as MS Word" class="input-button">
                           <button style="background:transparent;border:none;" id="btn-click"><a href><i class="fas fa-download"></i></a></button>
                        </form>
                    </td>
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
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"charset="UTF-8"></script>
<script>
    function landscape_document(){
    var doc = new jsPDF("landscape");
    doc.text(20,20,'टुटललाई ३ करोड ४० लाख कर, पठाओमाथि छानबिन जारी');
    doc.save('Shikshak.pdf');
    }
</script>