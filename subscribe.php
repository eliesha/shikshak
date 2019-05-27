<?php 
    require 'inc/header.php'; 
    
    if (!isset($_SESSION['front_token']) && empty($_SESSION['front_token'])) {
    
    		redirect('/subscription');
    
    } 
    
    ?>
<div class="main">
<div class="container">
    <div class="row py-4">
        <h1 class="heading-title">सब्स्क्रिप्शन प्लान रोज्नुहोस्</h1>
    </div>
    <div class="row signup py-4 justify-content-center">
        <!-- Subscription Model-1 -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">प्रिन्ट भर्सन</h5>
                    <h6 class="card-price text-center"><span class="NPR"></span><span
                        id="printAmount"> २४००</span>
                    </h6>
                    <div class="select-duration">
                        <form method="post" action="/checkout">
                            <input type="hidden" name="version" value="print">
                            <label for="printRange">वर्ष</label>
                            <input data-print-1y="८००" data-print-2y="१६००" data-print-3y="२४००"
                                data-print-4y="३२००" data-print-5y="४०००" type="range" class="custom-range period"
                                min="1" max="5" step="1" id="printRange" name="printRange">
                            <div class="row">
                                <div class="col px-0">१</div>
                                <div class="col px-0">२</div>
                                <div class="col px-0">३</div>
                                <div class="col px-0">४</div>
                                <div class="col px-0">५</div>
                            </div>
                    </div>
                    <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-check text-success"></i></span><strong>पत्रिकाको छापिएको संस्करण।</strong></li>
                    <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>हरेक महिना तपाईंको ढोकामा डेलिबर गरिन्छ।   
                    </li>
                    <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>१९९४ देखिको अभिलेखहरू खोजी पढ्न सक्नुहुनेछ। 
                    </li>
                    <li><span class="fa-li"><i class="fas fa-times text-danger"></i></span>पछिल्लो ३ संस्करणहरूमा गरिन्छ। <br></li>
                    <li><span class="fa-li"><i class="fas fa-times text-danger"></i></span>HTML मा पहुँच (मोबाइल अनुकूल) संस्करण।<br></li>
                    </ul>
                    <button style="width:100%" class="btn-lg btncustom btn mb-2 " type="submit" value="submit">सदस्यता लिनुहोस्</button></form>
                </div>
            </div>
        </div>
        <!-- Subscription Model-2-->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">अनलाइन भर्सन</h5>
                    <h6 class="card-price text-center"><span class="NPR"></span><span id="onlineAmount"> २४००</span></h6>
                    <div class="select-duration">
                        <form method="post" action="/checkout">
                            <input type="hidden" name="version" value="e-paper">
                            <label for="onlineRange">वर्ष</label>
                            <input data-online-1y="८००" data-online-2y="१६००" data-online-3y="२४००" data-online-4y="३२००" data-online-5y="४०००" type="range" class="custom-range period" min="1" max="5" step="1" id="onlineRange" name="onlineRange">
                            <div class="row">
                                <div class="col px-0">१</div>
                                <div class="col px-0">२</div>
                                <div class="col px-0">३</div>
                                <div class="col px-0">४</div>
                                <div class="col px-0">५</div>
                            </div>
                    </div>
                    <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-check text-success"></i></span><strong>संस्करण अनलाइनमा तुरुन्त पहुँच प्राप्त हुनेछ। </strong></li>
                    <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>१९९४ देखिको अभिलेखहरू खोजी पढ्न सक्नुहुनेछ।
                    </li>
                    <li><span class="fa-li"><i class="fas fa-check text-success"></i></span>HTML मा पहुँच (मोबाइल अनुकूल) संस्करण।</li>
                    <li><span class="fa-li"><i class="fas fa-times text-danger"></i></span>पत्रिकाको छापिएको संस्करण।<br></li><br>
                    </ul>
                    <button style="width:100%" class="btn-lg btncustom btn mb-2 " type="submit" value="submit">सदस्यता लिनुहोस्</button></form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>
<script src="js/bootstrap.min.js" async defer></script>
<script>
    $(function () {
    
        $('input[type=range][name=printRange]').on("change, input", function () {
    
            var year = this.value;
            $("#printAmount").text($(this).attr('data-print-' + year + 'y'));
            $('#printSubscribe').attr('href', base_url + 'subscription/checkout/print-' + year +
                'y');
        });
    
        $('input[type=range][name=onlineRange]').on("change, input", function () {
    
            var year = this.value;
            $("#onlineAmount").text($(this).attr('data-online-' + year + 'y'));
            $('#onlineSubscribe').attr('href', base_url + 'subscription/checkout/online-' + year +
                'y');
        });
    });
</script>