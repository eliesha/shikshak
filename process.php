<?php 
    require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
    
    require CLASS_PATH.'session.php';
    
    require CLASS_PATH.'user.php';
    
    $payment = new Payment();
    
    if(isset($_POST)){
        
        $data = array(
            
            'uid' => $_SESSION['fuser_id'],
            
            'shippingName' => $_POST['full_name'],
            
            'shippingAddress' => $_POST['address'],
            
            'shippingContact' => $_POST['contact'],
            
            'shippingCountry' => $_POST['country']
            
            );
       
       $paymentSession = $payment->insertPayementSession($data);
        
    }
    ?>