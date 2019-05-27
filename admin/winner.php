<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'quizusers.php';
require CLASS_PATH.'winner.php';
$winner = new QuizUsers;
$winners = new Winner;
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php flash(); ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <?php 
                    
                    $getWinner = $winners->getOneWinner(1);
                    
                    $userName = $getWinner[0]->name;
                    
                    $getImage = $user->getUserByName($userName); 
                    
                    $base = basename($getImage[0]->image);
                    //debugger($base, true);
                    if(isset($getImage[0]->image) && file_exists(UPLOAD_DIR.'users/'.$base)){
                        
                        $thumbnail = UPLOAD_URL.'users/'.$base;
                        
                    } else {
                        
                        $thumbnail = FRONT_IMAGES_URL.'defaultUser.png';
                        
                    }
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <img src="<?php echo $thumbnail ?>" alt="winner"> <br>
                        
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h3>बधाई छ!</h3>
                         <p style="padding-top:30px;">Name: <?php echo $getWinner[0]->name ?></p>
                         
                         <p>Month: <?php echo $getWinner[0]->month ?></p>
                         
                         <p>Address: <?php echo $getWinner[0]->address ?></p>
                    </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>विजेताहरुको सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>एस . एन</th>
                          <th>पुरा नाम</th>
                        </thead>
                        <tbody>
                        <?php 
                        
                        $date = date('Y-m-01').' -1 months)';
                        
                        $winnerList = $winner->getAllWinnerList($date);
                        
                        if($winnerList){
                            
                            foreach($winnerList as $list){
                                
                                $id = $list->user_id;
                                
                                $userName = $user->getUserById($id);
                                
                                if($userName){
                                    
                                    foreach($userName as $key => $newList){
                                        ?>
                                        <tr>
                                            <td><?php echo $key+1 ?></td>
                                            <td><?php echo $newList->full_name ?></td>
                                        </tr>
                                        <?php
                                    }
                                    
                                }
                                ?>
                                <?php
                            }
                            
                        }
                        
                        ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php require 'inc/footer.php';?>