<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'subscriber.php';
$subscriberclass = new Subscriber();

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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Subscriber</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>S.N</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Phone</th>
                        </thead>
                        <tbody>
                            <?php 
                            $userList = $subscriberclass->getAllSubscriber();
                            if ($userList) {
                              foreach ($userList as $key => $users) {
                                ?>
                                <tr>
                                 <td><?php echo ($key+1) ?></td> 
                                 <td><?php echo $users->name ?></a>
                                 </td>  
                                 <td><?php echo $users->email ?></td> 
                                 <td><?php echo $users->address ?></td>
                                 <td><?php echo $users->phone ?></td>
                                </tr>
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