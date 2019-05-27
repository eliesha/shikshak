        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Developed by <a href="https://www.bsaitechnosales.com/"><strong>BSAI Techno Sales</strong></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo ADMIN_ASSETS_URL ?>jquery/jquery.min.js"></script>
    <!--Select 2-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo ADMIN_ASSETS_URL ?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Chart.js-->
    <script src="<?php echo ADMIN_ASSETS_URL ?>Chart.js/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo ADMIN_ASSETS_URL ?>gauge/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo ADMIN_ASSETS_URL ?>bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo ADMIN_ASSETS_URL ?>moment/moment.min.js"></script>
    <script src="<?php echo ADMIN_ASSETS_URL ?>bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo ADMIN_ASSETS_URL ?>js/custom.min.js"></script>
    <script>
    $('#pop_up').modal('show')
    </script>
    <script type="text/javascript" src="<?php echo ADMIN_ASSETS_URL ?>datatables/jquery.dataTables.min.js"></script>
     <script>
        $(document).ready( function () {
        $('.table').DataTable();
        } );
     </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://unpkg.com/nepali-date-picker@2.0.0/dist/jquery.nepaliDatePicker.min.js" integrity="sha384-bBN6UZ/L0DswJczUYcUXb9lwIfAnJSGWjU3S0W5+IlyrjK0geKO+7chJ7RlOtrrF" crossorigin="anonymous"></script>
    <script>
        var currentDate = new Date();
      
        var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
     
        var formatedNepaliDate = calendarFunctions.bsDateFormat("%M %d, %y", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        
        var date = $('.date').val();
        if (date) {
            $(".date").nepaliDatePicker({
                dateFormat: "%D, %M %d, %y",
                closeOnDateSelect: true
            });
        } else {
            $(".date").val(formatedNepaliDate);
        }
    </script>
    <script>
      CKEDITOR.replace( 'summernote',
            {
                extraPlugins: 'save-to-pdf',
                pdfHandler: '../assets/editor/plugins/save-to-pdf/savetopdf.php'
            } );
    </script>

    </body>
</html>
