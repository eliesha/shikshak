<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

$payment = new Payment();

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

$id = $_SESSION['fuser_id'];

$shippingDetails = $payment->getPaymentSessionById($id);

$act = explode(' ', html_entity_decode($comment->title));
                $act = implode('-', $act);

    echo '<p>
        नाम: '.$shippingDetails[0]->shippingName.'<br>
        ठेगाना: '.$shippingDetails[0]->shippingAddress.'<br> सम्पर्क नम्बर: '. $shippingDetails[0]->shippingContact.'
        </p>';

?>