<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'category.php';
$category = new Category;

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
                    <h2>List Users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>S.N</th>
                          <th>Username</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Categories</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                            <?php 
                            $userList = $user->getAllUser();
                            if ($userList) {
                              foreach ($userList as $key => $users) {
                                ?>
                                <tr>
                                 <td><?php echo ($key+1) ?></td> 
                                 <td>
                                  <?php 
                                    $edit = substr(md5("edit_user-".$users->id.$session->getSessionByKey('session_token')), 3, 15);
                                  ?>
                                  <a href="addUsers?id=<?php echo $users->id ?>&amp;act=<?php echo $edit;?>"><?php echo $users->username ?></a>
                                 </td> 
                                 <td><?php echo $users->first_name. ' ' .$users->last_name ?></td> 
                                 <td><?php echo $users->email ?></td> 
                                 <td><?php echo $users->roles ?></td> 
                                 
                                <?php

                                $allCategories = $category->getAllCategory();
                                
                                $categoryAccess = $category_permitted->getCategoriesByUserId($users->id);?>
                                
                                <td>
                                    <ul>
                                        <?php
                                        
                                        if(!empty($categoryAccess)){
                                            foreach ($categoryAccess as $items) {
                                                ?>
                                                <li>
                                                <?php
                                                echo $items->title?>
                                            </li>
                                                <?php
                                            }
                                        
                                            
                                        } else {
                                            echo "-";
                                        }
                                        
                                        ?>
                                    </ul>
                                </td>
                                <td>
                                  <?php 
                                    $delete = substr(md5("delete_category-".$users->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
                                      <a href="process/user?id=<?php echo $users->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
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
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php require 'inc/footer.php';?>