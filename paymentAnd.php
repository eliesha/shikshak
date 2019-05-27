<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

$subscription = new Subscriber();

$version = $_POST['version'];

$years = $_POST['year'];

$orderId = $_POST['order_id'];

$amt = $_POST['amount'];

$user_id = $_POST['user_id'];

$refid = $_POST['ref_id'];

$name = $_POST['name'];

$phone = $_POST['phone'];

$address = $_POST['address'];

$country = $_POST['country'];

$data = array(
    
    'uid' => $user_id,
    
    'name' => $name,
    
    'phone' => $phone,
    
    'address' => $address,
    
    'country' => $country,
    
    'version' => $version,
    
    'years' => $years,
    
    'orderid' => $orderId,
    
    'amount' => $amt,
    
    'refid' => $refid
    
    );
    
    $checkUser = $subscription->checkSubscribers($user_id);
    
    if($checkUser){
        
        $getSubscriber = $subscription->getSubscriberById($user_id);
    
        $data['amount'] = $_POST['amount'] + $getSubscriber[0]->amount;
        
        $data['years'] = $_GET['year'] + $getSubscriber[0]->years;
        
        $data['orderid'] = $getSubscriber[0]->orderid;
        
        $updateSubscriber = $subscription->updateSubscriber($data, $user_id);
        
        if($updateSubscriber){
            
            $result = array();
            
            $result['success'] = "1";
            
            $result['message'] = "Payment Successfully";
            
            echo json_encode($result);
            
        } else {
            
            $result = array();
            
            $result['success'] = "0";
            
            $result['message'] = "Payment Unsuccessfully";
            
            echo json_encode($result);
            
        }
        
    } else {
        
            $success = $subscription->addSubscriber($data);
            
            if($success){
                
            $result = array();
            
            $result['success'] = "1";
            
            $result['message'] = "Payment Successfully";
            
            echo json_encode($result);
            
        } else {
            
            $result = array();
            
            $result['success'] = "0";
            
            $result['message'] = "Payment Unsuccessfully";
            
            echo json_encode($result);
            
        }
        
    }
?>