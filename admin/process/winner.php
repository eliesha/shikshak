<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'winner.php';

require CLASS_PATH.'session.php';

$winner = new Winner();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {
    
    $data = array(
        
        'name' => escapeString($_POST['name']),
        
        'month' => $_POST['month'],
        
        'address' => escapeString($_POST['address'])
        
        );
        
    $winner_id = (isset($_POST['winner_id']) && !empty($_POST['winner_id'])) ? (int)$_POST['winner_id'] : null;

		if ($winner_id) {
    
            $act = "edit";
    
            $winner_id = $winner->updateWinner($data, $winner_id);
			
		} else {
    
            $act = "add";
    
            $winner_id = $winner->addWinner($data);
		}
		
	if ($winner_id) {

			redirect('../winner', 'success', 'Winner '.$act.'ed successfully.');

	} else {

		redirect('../winner', 'error', 'Sorry! There was problem while '.$act.'ing winner.');

	}
    
}