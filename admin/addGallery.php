<?php 

require '../config/init.php';

require 'inc/header.php'; ?>
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php'; ?>
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
                    <h2>गैलरी थप्नुहोस</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                <form class="form form-horizontal" action="process/gallery" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="control-label col-sm-3">शीर्षक:</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" id="title" placeholder="शीर्षक लेख्नुहोस्" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3">क्याप्शन :</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="description" id="description" style="resize: none;" rows="5" placeholder="क्याप्शन प्रविष्ट गर्नुहोस्">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3">स्थिति:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" id="status">
                                <option selected disabled hidden>---कुनै एक छान्नुहोस---</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3">थम्बनेल:</label>
                        <div class="col-sm-9">
                            <input type="file" name="thumbnail" id="thumbnail" required accept="image/*">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3">अन्य तस्बिरहरू:</label>
                        <div class="col-sm-9">
                            <input type="file" name="images[]" multiple id="images" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-9">
                            <button class="btn btn-danger" type="reset"><i class="fa fa-trash"></i> रद्द गर्नुहोस्</button>
                            <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> गैलरी थप्नुहोस</button>
                        </div>
                    </div>
                </form>
            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php require 'inc/footer.php' ?>

