<?php require 'inc/header.php'; 
    $result = $_GET['q'];
    
    $version = $_GET['version'];
    
    $years = $_GET['years'];
    
    $orderId = $_GET['oid'];
    
    $amt = $_GET['amt'];
    
    $user_id = $_GET['uid'];
    
    $ref = $_GET['refid'];
    
    ?>
<div class="container text-center" id="c404">
    <div class="row">
        <div class="col-md-6 col-sm-12 offset-md-3 c404">
            <h1>भुक्तानी सफल!</h1>
            <h5><strong>भुक्तानी सफलतापूर्वक प्राप्त भएको छ। शिक्षक मासिकलाई माया गरिदिनुभएकोमा धन्यावाद। </strong></h5>
            <br>
            <ul>
                <li style="text-align:left">Order ID: <?php echo $orderId ?></li>
                <li style="text-align:left">Version: <?php echo $version ?></li>
                <li style="text-align:left">Years: <?php echo $years ?></li>
            </ul>
        </div>
    </div>
</div>
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>