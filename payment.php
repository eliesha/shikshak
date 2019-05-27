<?php require 'inc/header.php'; 

$subscription = new Subscriber();

$payment = new Payment();

$result = $_GET['q'];

$version = $_GET['version'];

$years = $_GET['years'];

$orderId = $_GET['oid'];

$amt = $_GET['amt'];

$user_id = $_GET['uid'];

$refid = $_GET['refId'];

$shippingDetails = $payment->getPaymentSessionById($user_id);

$name = $shippingDetails[0]->shippingName;

$phone = $shippingDetails[0]->shippingContact;

$address = $shippingDetails[0]->shippingAddress;

$country = $shippingDetails[0]->shippingCountry;

$data = array(
    
    'name' => $name,
    
    'phone' => $phone,
    
    'address' => $address,
    
    'country' => $country,
    
    'uid' => $user_id,
    
    'version' => $version,
    
    'years' => $years,
    
    'orderid' => $orderId,
    
    'amount' => $amt,
    
    'refid' => $refid
    
    );

if($result == "su"){
    
    $checkUser = $subscription->checkSubscribers($user_id);
    
    if($checkUser){
        
        $getSubscriber = $subscription->getSubscriberById($user_id);
    
        $data['amount'] = $_GET['amt'] + $getSubscriber[0]->amount;
        
        $data['years'] = $_GET['years'] + $getSubscriber[0]->years;
        
        $data['orderid'] = $getSubscriber[0]->orderid;
        
        $updateSubscriber = $subscription->updateSubscriber($data, $user_id);
        
        if($updateSubscriber){
            
            $deletePaymentSession = $payment->deleteSessionById($_SESSION['fuser_id']);
            
            redirect('http://oxygenaltitude.com/paymentSuccess?q=su&uid='.$user_id.'&version='.$version.'&years='.$data['years'].'&oid='.$data['orderid'].'&amt='.$data['amount'].'');
            
        }
        
    } else {
        
            $success = $subscription->addSubscriber($data);
            
            if($success){
                
            $deletePaymentSession = $payment->deleteSessionById($_SESSION['fuser_id']);
                
            redirect('http://oxygenaltitude.com/paymentSuccess?q=su&uid='.$user_id.'&version='.$version.'&years='.$years.'&oid='.$orderId.'&amt='.$amt);
            
        }
        
    }
    
}

?>
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>