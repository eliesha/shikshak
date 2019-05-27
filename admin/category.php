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
                    <h2>कोटि सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>एस.एन</th>
                          <th>शीर्षक</th>
                          <th>मुख्य कोटि</th>
                          <th>उप कोटी</th>
                          <th>मेनुमा देखाउनुहोस्</th>
                          <th>स्थिति</th>
                          <th>एक्शन</th>
                        </thead>
                        <tbody>
                        	<?php 
                        		$categoryList = $category->getAllCategory();
                        		if ($categoryList) {
                        			foreach ($categoryList as $key => $categoryItems) {
                        				?>
                        				<tr>
				                            <td><?php echo $key+1 ?></td>
                                    <?php 
                                        $edit = substr(md5("edit_category-".$categoryItems->id.$session->getSessionByKey('session_token')), 3, 15);
                                      ?>
				                            <td><a href="addCategory?id=<?php echo $categoryItems->id ?>&amp;act=<?php echo $edit;?>"><?php echo $categoryItems->title ?></a></td>
				                            <td><?php echo ($categoryItems->is_parent == 1 ) ? 'Yes' : 'No' ?></td>
				                            <td>
                                      <?php  
                                          $parent_id = $categoryItems->parent_id;
                                          /*debugger($parent_id, true);*/
                                          if ($parent_id != 0) {
                                            $parent_info = $category->getCategoryById($parent_id);
                                            if ($parent_info) {
                                              echo $parent_info[0]->title;
                                            } 
                                          }
                                      ?>
                                    </td>
				                            <td><?php echo ($categoryItems->show_in_menu == 1 ) ? 'Yes' : 'No' ?></td>
				                            <td><?php echo $categoryItems->status ?></td>
				                            <td>
				                            	<?php 
					                              $delete = substr(md5("delete_category-".$categoryItems->id.$session->getSessionByKey('session_token')), 3, 15);
					                             ?>
				                                <a href="process/category?id=<?php echo $categoryItems->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाईं पक्का यो कोटि मेटाउन चाहनुहुन्छ?')">Delete</a>
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