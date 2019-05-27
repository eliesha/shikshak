<?php require 'inc/header.php';
    
    require CLASS_PATH.'ads.php';
    
    require CLASS_PATH.'comments.php';
    
    require CLASS_PATH.'bookmark.php';
    
    $ads = new Ads;
    
    $bookmark = new Bookmark();
    
    $comments = new Comments();
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        
        $id = $_GET['id'];
        
        if ($id) {
            
            $authorName = $postAuthor->getAuthorById($id);
            
            $count = count($authorName);
            
            $getNews = $news->getNewsById($id);
            
        }
        
    }
    
    $id = $_SESSION['fuser_id'];
    
    $user_info = $user->getUserById($id);
    
    $userImage = basename($user_info[0]->image);
    
    if(isset($user_info[0]->image) && !empty($user_info[0]->image) && file_exists(UPLOAD_DIR.'users/'.$userImage)){
    
        $userProfileImage = UPLOAD_URL.'users/'.$userImage;
    
    } else {
    
        $userProfileImage = FRONT_IMAGES_URL.'defaultUser.png';
    
    }
    
     ?>
<div class="main">
<div class="container">
    <!-- End of top adspace -->
    <div class="row py-2 px-2">
        <!--  Main Content Column-->
        <div class="col-md-9" style="text-align: justify">
            <h1 class="py-3" style="margin: auto;"><?php echo $getNews[0]->title ?>
            </h1>
            <?php 
                $image = basename($getNews[0]->image);
                
                if (isset($getNews[0]->image) && !empty($getNews[0]->image) && file_exists(UPLOAD_DIR.'news/'.$image)) {
                    
                    $feature = UPLOAD_URL.'news/'.$image; 
                ?>
            <img src="<?php echo $feature ?>" class="img-fluid py-2 apple">
            <?php
                } else {
                    
                    echo "";
                    
                }
                
                 ?>
            <div class="row">
                <div class="social-row" style="padding: 10px;float: left;">
                    <?php
                        if($count > 1){
                            
                            $act = explode(' ', html_entity_decode($authorName[0]->author));
                            $act = implode('-', $act);
                            
                            $bact = explode(' ', html_entity_decode($authorName[1]->author));
                            $bact = implode('-', $bact);
                            
                            ?>
                    <p class="ptype888"><?php echo $getNews[0]->added_date ?> | <strong><a href="/user/<?php echo $authorName[0]->user_id ?>/<?php echo $act ?>" target="_blank"><?php echo $authorName[0]->author ?></strong></a> र <strong><a href="/user/<?php echo $authorName[1]->user_id ?>/<?php echo $bact ?>" target="_blank"><?php echo $authorName[1]->author ?></strong></a></p>
                    <?php
                        } else {
                            
                            $act = explode(' ', html_entity_decode($authorName[0]->author));
                            $act = implode('-', $act);
                            
                            ?>
                    <p class="ptype888"><?php echo $getNews[0]->added_date ?> | <strong><a href="/user/<?php echo $authorName[0]->user_id ?>/<?php echo $act ?>"><?php echo $authorName[0]->author ?></strong></a></p>
                    <?php
                        }
                        
                        ?>
                    <!--HERE-->
                </div>
                <?php 
                    if(isset($_SESSION['front_token'])){
                        
                        $user_id = $_SESSION['fuser_id'];
                    
                        $post_id = $getNews[0]->id;
                        
                        $check = $bookmark->checkBookmarkDetails($user_id, $post_id);
                        
                        $class = '';
                        
                        if($check){
                            
                            $class = 'decorate';
                            
                        }
                        
                    }
                    
                    ?>
                <?php 
                    if(isset($_SESSION['fuser_id'])){
                        ?>
                <div style="float: left;">
                    <form action="/process/bookmark.php" id="bookmark"  method="post">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['fuser_id'] ?>">
                        <input type="hidden" name="post_id" value="<?php echo $_GET['id'] ?>">
                        <button id="button" style="background:transparent; border:solid 0px #fff;float:right; padding-top:14px; "><i id="icon" class="far fa-bookmark <?php echo $class ?>" ></i></button>
                    </form>
                </div>
                <?php
                    } else {
                        ?>
                <button style="background:transparent; border:solid 0px #fff;float:right; margin-top: -5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i id="icon" class="far fa-bookmark" style="color:#000;"></i></button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body mt-4">
                                        <p class="nav-link active text-center">कृपया पहिले लग इन गर्नुहोस्।</p>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="true">साइन अप</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="signin-tab" data-toggle="tab" href="#signin" role="tab"
                                                    aria-controls="signin" aria-selected="false">साइन इन</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="signup" role="tabpanel"
                                                aria-labelledby="signup-tab">
                                                <form class="px-4 text-center container" id="signup-gap" action="/process/user.php" method="POST">
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <!-- First name -->
                                                            <input type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="नाम "
                                                                name="first_name" required>
                                                        </div>
                                                        <div class="col">
                                                            <!-- Last name -->
                                                            <input type="text" id="defaultRegisterFormLastName" class="form-control" placeholder="थर "
                                                                name="last_name" required>
                                                        </div>
                                                    </div>
                                                    <!-- E-Mail -->
                                                    <input type="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="इमेल"
                                                        name="email" required>
                                                    <!-- Phone Number -->
                                                    <input type="number" id="defaultRegisterPhoneNumber" class="form-control mb-4" placeholder="फोन"
                                                        aria-describedby="defaultRegisterFormPhoneHelpBlock" name="phonenumber">
                                                    <!--Country-->
                                                    <div class="subscription text-left mb-4">
                                                        <select class="form-control" name="country" placeholder="???" aria-describedby="defaultRegisterFormPhoneHelpBlock">
                                                            <option selected disabled hidden>--कुनै एक छार्नुहोस्--</option>
                                                            <option value="AF" <?php echo (@$user_info[0]->country=='AF') ? 'selected' : '';?>>अफगानिस्तान</option>
                                                            <option value="AX" <?php echo (@$user_info[0]->country=='AX') ? 'selected' : '';?>>अल्यांड आइल्याण्ड</option>
                                                            <option value="AL" <?php echo (@$user_info[0]->country=='AL') ? 'selected' : '';?>>अल्बानिया</option>
                                                            <option value="DZ" <?php echo (@$user_info[0]->country=='DZ') ? 'selected' : '';?>>अल्जेरिया</option>
                                                            <option value="AS" <?php echo (@$user_info[0]->country=='AS') ? 'selected' : '';?>>अमेरिकन समोआ</option>
                                                            <option value="AD" <?php echo (@$user_info[0]->country=='AD') ? 'selected' : '';?>>आनदोर्रा</option>
                                                            <option value="AO" <?php echo (@$user_info[0]->country=='AO') ? 'selected' : '';?>>अंगोला</option>
                                                            <option value="AI" <?php echo (@$user_info[0]->country=='AI') ? 'selected' : '';?>>एङ्गुइला</option>
                                                            <option value="AQ" <?php echo (@$user_info[0]->country=='AQ') ? 'selected' : '';?>>अन्टार्कटिका</option>
                                                            <option value="AG" <?php echo (@$user_info[0]->country=='AG') ? 'selected' : '';?>>एंटिगुआ याण्ड बारबुडा</option>
                                                            <option value="AR" <?php echo (@$user_info[0]->country=='AR') ? 'selected' : '';?>>अर्जेन्टीना</option>
                                                            <option value="AM" <?php echo (@$user_info[0]->country=='AM') ? 'selected' : '';?>>आर्मेनिया</option>
                                                            <option value="AW" <?php echo (@$user_info[0]->country=='AW') ? 'selected' : '';?>>अरुबा</option>
                                                            <option value="AU" <?php echo (@$user_info[0]->country=='AU') ? 'selected' : '';?>>अष्ट्रेलिया</option>
                                                            <option value="AT" <?php echo (@$user_info[0]->country=='AT') ? 'selected' : '';?>>अस्ट्रिया</option>
                                                            <option value="AZ" <?php echo (@$user_info[0]->country=='AZ') ? 'selected' : '';?>>अजरबैजान</option>
                                                            <option value="BS" <?php echo (@$user_info[0]->country=='BS') ? 'selected' : '';?>>बहामास</option>
                                                            <option value="BH" <?php echo (@$user_info[0]->country=='BH') ? 'selected' : '';?>>बहरीन</option>
                                                            <option value="BD" <?php echo (@$user_info[0]->country=='BD') ? 'selected' : '';?>>बांग्लादेश</option>
                                                            <option value="BB" <?php echo (@$user_info[0]->country=='BB') ? 'selected' : '';?>>बारबाडोस</option>
                                                            <option value="BY" <?php echo (@$user_info[0]->country=='BY') ? 'selected' : '';?>>बेलारूस</option>
                                                            <option value="BE" <?php echo (@$user_info[0]->country=='BE') ? 'selected' : '';?>>बेल्जियम</option>
                                                            <option value="BZ" <?php echo (@$user_info[0]->country=='BZ') ? 'selected' : '';?>>बेलीज</option>
                                                            <option value="BJ" <?php echo (@$user_info[0]->country=='BJ') ? 'selected' : '';?>>बेनिन</option>
                                                            <option value="BM" <?php echo (@$user_info[0]->country=='BM') ? 'selected' : '';?>>बर्मुडा</option>
                                                            <option value="BT" <?php echo (@$user_info[0]->country=='BT') ? 'selected' : '';?>>भुटान</option>
                                                            <option value="BO" <?php echo (@$user_info[0]->country=='BO') ? 'selected' : '';?>>बोलिभिया</option>
                                                            <option value="BQ" <?php echo (@$user_info[0]->country=='BQ') ? 'selected' : '';?>>बोनायर, सिन्ट इस्टटिटास र साबा</option>
                                                            <option value="BA" <?php echo (@$user_info[0]->country=='BA') ? 'selected' : '';?>>बोस्निया र हेर्जेगोभिना</option>
                                                            <option value="BW" <?php echo (@$user_info[0]->country=='BW') ? 'selected' : '';?>>बोत्सवाना</option>
                                                            <option value="BV" <?php echo (@$user_info[0]->country=='BV') ? 'selected' : '';?>>बुभेट आइल्याण्ड</option>
                                                            <option value="BR" <?php echo (@$user_info[0]->country=='BR') ? 'selected' : '';?>>ब्राजील</option>
                                                            <option value="IO" <?php echo (@$user_info[0]->country=='IO') ? 'selected' : '';?>>ब्रिटिश इन्डियन ओसन तेर्रिटोरी  </option>
                                                            <option value="BN" <?php echo (@$user_info[0]->country=='BN') ? 'selected' : '';?>>ब्रुनेई दारुसलाम</option>
                                                            <option value="BG" <?php echo (@$user_info[0]->country=='BG') ? 'selected' : '';?>>बुल्गारिया</option>
                                                            <option value="BF" <?php echo (@$user_info[0]->country=='BF') ? 'selected' : '';?>>बर्किना फासो</option>
                                                            <option value="BI" <?php echo (@$user_info[0]->country=='BI') ? 'selected' : '';?>>बुरुंडी</option>
                                                            <option value="KH" <?php echo (@$user_info[0]->country=='KH') ? 'selected' : '';?>>कम्बोडिया</option>
                                                            <option value="CM" <?php echo (@$user_info[0]->country=='CM') ? 'selected' : '';?>>क्यामरून</option>
                                                            <option value="CA" <?php echo (@$user_info[0]->country=='CA') ? 'selected' : '';?>>क्यानाडा</option>
                                                            <option value="CV" <?php echo (@$user_info[0]->country=='CV') ? 'selected' : '';?>>केप वर्डे</option>
                                                            <option value="KY" <?php echo (@$user_info[0]->country=='KY') ? 'selected' : '';?>>केमैन आइल्याण्ड्स</option>
                                                            <option value="CF" <?php echo (@$user_info[0]->country=='CF') ? 'selected' : '';?>>सेन्ट्रल अफ्रिकन रिपब्लिक</option>
                                                            <option value="TD" <?php echo (@$user_info[0]->country=='TD') ? 'selected' : '';?>>चाड</option>
                                                            <option value="CL" <?php echo (@$user_info[0]->country=='CL') ? 'selected' : '';?>>चिली</option>
                                                            <option value="CN" <?php echo (@$user_info[0]->country=='CN') ? 'selected' : '';?>>चीन</option>
                                                            <option value="CX" <?php echo (@$user_info[0]->country=='CX') ? 'selected' : '';?>>क्रिसमसको आइल्याण्ड्स</option>
                                                            <option value="CC" <?php echo (@$user_info[0]->country=='CC') ? 'selected' : '';?>>कोकोस (कीलिंग) आइल्याण्ड्स</option>
                                                            <option value="CO" <?php echo (@$user_info[0]->country=='CO') ? 'selected' : '';?>>कोलंबिया</option>
                                                            <option value="KM" <?php echo (@$user_info[0]->country=='KM') ? 'selected' : '';?>>कोमोरोस</option>
                                                            <option value="CG" <?php echo (@$user_info[0]->country=='CG') ? 'selected' : '';?>>कङ्गो</option>
                                                            <option value="CD" <?php echo (@$user_info[0]->country=='CD') ? 'selected' : '';?>>डेमोक्रेटिक रिपब्लिक ओफ कङ्गो</option>
                                                            <option value="CK" <?php echo (@$user_info[0]->country=='CK') ? 'selected' : '';?>>कुक आइल्याण्ड्स</option>
                                                            <option value="CR" <?php echo (@$user_info[0]->country=='CR') ? 'selected' : '';?>>कोस्टा रिका</option>
                                                            <option value="CI" <?php echo (@$user_info[0]->country=='CI') ? 'selected' : '';?>>कोट डी आइवर</option>
                                                            <option value="HR" <?php echo (@$user_info[0]->country=='HR') ? 'selected' : '';?>>क्रोएशिया</option>
                                                            <option value="CU" <?php echo (@$user_info[0]->country=='CU') ? 'selected' : '';?>>क्युबा</option>
                                                            <option value="CW" <?php echo (@$user_info[0]->country=='CW') ? 'selected' : '';?>>किउरिसाउ</option>
                                                            <option value="CY" <?php echo (@$user_info[0]->country=='CY') ? 'selected' : '';?>>साइप्रस</option>
                                                            <option value="CZ" <?php echo (@$user_info[0]->country=='CZ') ? 'selected' : '';?>>चेक रिपब्लिक</option>
                                                            <option value="DK" <?php echo (@$user_info[0]->country=='DK') ? 'selected' : '';?>>डेनमार्क</option>
                                                            <option value="DJ" <?php echo (@$user_info[0]->country=='DJ') ? 'selected' : '';?>>जिबूती</option>
                                                            <option value="DM" <?php echo (@$user_info[0]->country=='DM') ? 'selected' : '';?>>डोमिनिका</option>
                                                            <option value="DO" <?php echo (@$user_info[0]->country=='DO') ? 'selected' : '';?>>डोमिनिकन रिपब्लिक</option>
                                                            <option value="EC" <?php echo (@$user_info[0]->country=='EC') ? 'selected' : '';?>>इक्वाडोर</option>
                                                            <option value="EG" <?php echo (@$user_info[0]->country=='EG') ? 'selected' : '';?>>इजिप्ट</option>
                                                            <option value="SV" <?php echo (@$user_info[0]->country=='SV') ? 'selected' : '';?>>अल साल्वाडोर</option>
                                                            <option value="GQ" <?php echo (@$user_info[0]->country=='GQ') ? 'selected' : '';?>>इक्वेटोरियल गिनी</option>
                                                            <option value="ER" <?php echo (@$user_info[0]->country=='ER') ? 'selected' : '';?>>इरिट्रिया</option>
                                                            <option value="EE" <?php echo (@$user_info[0]->country=='EE') ? 'selected' : '';?>>एस्टोनिया</option>
                                                            <option value="ET" <?php echo (@$user_info[0]->country=='ET') ? 'selected' : '';?>>इथियोपिया</option>
                                                            <option value="FK" <?php echo (@$user_info[0]->country=='FK') ? 'selected' : '';?>>फकलल्याण्ड आइल्याण्ड्स (माल्विनास)</option>
                                                            <option value="FO" <?php echo (@$user_info[0]->country=='FO') ? 'selected' : '';?>>फरो आइल्याण्ड्स</option>
                                                            <option value="FJ" <?php echo (@$user_info[0]->country=='FJ') ? 'selected' : '';?>>फिजी</option>
                                                            <option value="FI" <?php echo (@$user_info[0]->country=='FI') ? 'selected' : '';?>>फिनल्याण्ड</option>
                                                            <option value="FR" <?php echo (@$user_info[0]->country=='FR') ? 'selected' : '';?>>फ्रान्स</option>
                                                            <option value="GF" <?php echo (@$user_info[0]->country=='GF') ? 'selected' : '';?>>फ्रेन्च गुयाना</option>
                                                            <option value="PF" <?php echo (@$user_info[0]->country=='PF') ? 'selected' : '';?>>फ्रेंच पोलिनेसिया</option>
                                                            <option value="TF" <?php echo (@$user_info[0]->country=='TF') ? 'selected' : '';?>>फ्रेंच साउथन टेरेटोरीज्</option>
                                                            <option value="GA" <?php echo (@$user_info[0]->country=='GA') ? 'selected' : '';?>>गबोन</option>
                                                            <option value="GM" <?php echo (@$user_info[0]->country=='GM') ? 'selected' : '';?>>गाम्बिया</option>
                                                            <option value="GE" <?php echo (@$user_info[0]->country=='GE') ? 'selected' : '';?>>जर्जिया</option>
                                                            <option value="DE" <?php echo (@$user_info[0]->country=='DE') ? 'selected' : '';?>>जर्मनी</option>
                                                            <option value="GH" <?php echo (@$user_info[0]->country=='GH') ? 'selected' : '';?>>घाना</option>
                                                            <option value="GI" <?php echo (@$user_info[0]->country=='GI') ? 'selected' : '';?>>जिब्राल्टर</option>
                                                            <option value="GR" <?php echo (@$user_info[0]->country=='GR') ? 'selected' : '';?>>ग्रीस</option>
                                                            <option value="GL" <?php echo (@$user_info[0]->country=='GL') ? 'selected' : '';?>>ग्रीनल्याण्ड</option>
                                                            <option value="GD" <?php echo (@$user_info[0]->country=='GD') ? 'selected' : '';?>>ग्रेनेडा</option>
                                                            <option value="GP" <?php echo (@$user_info[0]->country=='GP') ? 'selected' : '';?>>ग्वाडेलुप</option>
                                                            <option value="GU" <?php echo (@$user_info[0]->country=='GU') ? 'selected' : '';?>>गुआम</option>
                                                            <option value="GT" <?php echo (@$user_info[0]->country=='GT') ? 'selected' : '';?>>गुआम</option>
                                                            <option value="GG" <?php echo (@$user_info[0]->country=='GG') ? 'selected' : '';?>>गअनजी</option>
                                                            <option value="GN" <?php echo (@$user_info[0]->country=='GN') ? 'selected' : '';?>>गिनी</option>
                                                            <option value="GW" <?php echo (@$user_info[0]->country=='GW') ? 'selected' : '';?>>गिनी-बिसाउ</option>
                                                            <option value="GY" <?php echo (@$user_info[0]->country=='GY') ? 'selected' : '';?>>गुयाना</option>
                                                            <option value="HT" <?php echo (@$user_info[0]->country=='HT') ? 'selected' : '';?>>हैती</option>
                                                            <option value="HM" <?php echo (@$user_info[0]->country=='HM') ? 'selected' : '';?>>हअर्ड आइल्याण्ड याण्ड म्याकडोनाल्ड आइल्याण्ड्स</option>
                                                            <option value="VA" <?php echo (@$user_info[0]->country=='VA') ? 'selected' : '';?>>होली सी (वेटिकन सिटी इसटेट)</option>
                                                            <option value="HN" <?php echo (@$user_info[0]->country=='HN') ? 'selected' : '';?>>होन्डुरस</option>
                                                            <option value="HK" <?php echo (@$user_info[0]->country=='HK') ? 'selected' : '';?>>हंगकंग</option>
                                                            <option value="HU" <?php echo (@$user_info[0]->country=='HU') ? 'selected' : '';?>>हंगेरी</option>
                                                            <option value="IS" <?php echo (@$user_info[0]->country=='IS') ? 'selected' : '';?>>आइसल्याण्ड</option>
                                                            <option value="IN" <?php echo (@$user_info[0]->country=='IN') ? 'selected' : '';?>>भारत</option>
                                                            <option value="ID" <?php echo (@$user_info[0]->country=='ID') ? 'selected' : '';?>>इंडोनेशिया</option>
                                                            <option value="IR" <?php echo (@$user_info[0]->country=='IR') ? 'selected' : '';?>>ईरान, इस्लामिक रिपब्लिक of</option>
                                                            <option value="IQ" <?php echo (@$user_info[0]->country=='IQ') ? 'selected' : '';?>>इराक</option>
                                                            <option value="IE" <?php echo (@$user_info[0]->country=='IE') ? 'selected' : '';?>>आयरल्याण्ड</option>
                                                            <option value="IM" <?php echo (@$user_info[0]->country=='IM') ? 'selected' : '';?>>आइल ओफ म्यान</option>
                                                            <option value="IL" <?php echo (@$user_info[0]->country=='IL') ? 'selected' : '';?>>इजरायल</option>
                                                            <option value="IT" <?php echo (@$user_info[0]->country=='IT') ? 'selected' : '';?>>इटली</option>
                                                            <option value="JM" <?php echo (@$user_info[0]->country=='JM') ? 'selected' : '';?>>जमैका</option>
                                                            <option value="JP" <?php echo (@$user_info[0]->country=='JP') ? 'selected' : '';?>>जापान</option>
                                                            <option value="JE" <?php echo (@$user_info[0]->country=='JE') ? 'selected' : '';?>>जर्सी</option>
                                                            <option value="JO" <?php echo (@$user_info[0]->country=='JO') ? 'selected' : '';?>>जोर्डन</option>
                                                            <option value="KZ" <?php echo (@$user_info[0]->country=='KZ') ? 'selected' : '';?>>कजाकिस्तान</option>
                                                            <option value="KE" <?php echo (@$user_info[0]->country=='KE') ? 'selected' : '';?>>केन्या</option>
                                                            <option value="KI" <?php echo (@$user_info[0]->country=='KI') ? 'selected' : '';?>>किरिबाती</option>
                                                            <option value="KP" <?php echo (@$user_info[0]->country=='KP') ? 'selected' : '';?>>डेमोक्रेटिक पिपल्स रिपब्लिक आफ कोरिया</option>
                                                            <option value="KR" <?php echo (@$user_info[0]->country=='KR') ? 'selected' : '';?>>कोरिया, रिपब्लिक आफ कोरिया</option>
                                                            <option value="KW" <?php echo (@$user_info[0]->country=='KW') ? 'selected' : '';?>>कुवैत</option>
                                                            <option value="KG" <?php echo (@$user_info[0]->country=='KG') ? 'selected' : '';?>>किर्गिस्तान</option>
                                                            <option value="LA" <?php echo (@$user_info[0]->country=='LA') ? 'selected' : '';?>>लाओ पिपल्स डेमोक्रेटिक रिपब्लिक</option>
                                                            <option value="LV" <?php echo (@$user_info[0]->country=='LV') ? 'selected' : '';?>>लाटभिया</option>
                                                            <option value="LB" <?php echo (@$user_info[0]->country=='LB') ? 'selected' : '';?>>लेबनन</option>
                                                            <option value="LS" <?php echo (@$user_info[0]->country=='LS') ? 'selected' : '';?>>लेसोथो</option>
                                                            <option value="LR" <?php echo (@$user_info[0]->country=='LR') ? 'selected' : '';?>>लाइबेरिया</option>
                                                            <option value="LY" <?php echo (@$user_info[0]->country=='LY') ? 'selected' : '';?>>लिबिया</option>
                                                            <option value="LI" <?php echo (@$user_info[0]->country=='LI') ? 'selected' : '';?>>लिकटेंस्टीन</option>
                                                            <option value="LT" <?php echo (@$user_info[0]->country=='LT') ? 'selected' : '';?>>लिथुआनिया</option>
                                                            <option value="LU" <?php echo (@$user_info[0]->country=='LU') ? 'selected' : '';?>>लक्समबर्ग</option>
                                                            <option value="MO" <?php echo (@$user_info[0]->country=='MO') ? 'selected' : '';?>>मकाओ</option>
                                                            <option value="MK" <?php echo (@$user_info[0]->country=='MK') ? 'selected' : '';?>>रिपब्लिक आफ म्यासेडोनिया</option>
                                                            <option value="MG" <?php echo (@$user_info[0]->country=='MG') ? 'selected' : '';?>>मेडागास्कर</option>
                                                            <option value="MW" <?php echo (@$user_info[0]->country=='MW') ? 'selected' : '';?>>मलावी</option>
                                                            <option value="MY" <?php echo (@$user_info[0]->country=='MY') ? 'selected' : '';?>>मलेशिया</option>
                                                            <option value="MV" <?php echo (@$user_info[0]->country=='MV') ? 'selected' : '';?>>मालदीव</option>
                                                            <option value="ML" <?php echo (@$user_info[0]->country=='ML') ? 'selected' : '';?>>माली</option>
                                                            <option value="MT" <?php echo (@$user_info[0]->country=='MT') ? 'selected' : '';?>>माल्टा</option>
                                                            <option value="MH" <?php echo (@$user_info[0]->country=='MH') ? 'selected' : '';?>>मार्शल आइल्याण्ड्स</option>
                                                            <option value="MQ" <?php echo (@$user_info[0]->country=='MQ') ? 'selected' : '';?>>मार्टिनिक</option>
                                                            <option value="MR" <?php echo (@$user_info[0]->country=='MR') ? 'selected' : '';?>>मरिटानिया</option>
                                                            <option value="MU" <?php echo (@$user_info[0]->country=='MU') ? 'selected' : '';?>>मरीशस</option>
                                                            <option value="YT" <?php echo (@$user_info[0]->country=='YT') ? 'selected' : '';?>>मायोटी</option>
                                                            <option value="MX" <?php echo (@$user_info[0]->country=='MX') ? 'selected' : '';?>>मेक्सिको</option>
                                                            <option value="FM" <?php echo (@$user_info[0]->country=='FM') ? 'selected' : '';?>>फेडेरेटेड इसटेट आफ माइक्रोनेशिया</option>
                                                            <option value="MD" <?php echo (@$user_info[0]->country=='MD') ? 'selected' : '';?>>रिपब्लिक आफ मोल्दोवा</option>
                                                            <option value="MC" <?php echo (@$user_info[0]->country=='MC') ? 'selected' : '';?>>मोनाको</option>
                                                            <option value="MN" <?php echo (@$user_info[0]->country=='MN') ? 'selected' : '';?>>मङ्गोलिया</option>
                                                            <option value="ME" <?php echo (@$user_info[0]->country=='ME') ? 'selected' : '';?>>मोन्टेनेग्रो</option>
                                                            <option value="MS" <?php echo (@$user_info[0]->country=='MS') ? 'selected' : '';?>>मोन्टसेराट</option>
                                                            <option value="MA" <?php echo (@$user_info[0]->country=='MA') ? 'selected' : '';?>>मोरक्को</option>
                                                            <option value="MZ" <?php echo (@$user_info[0]->country=='MZ') ? 'selected' : '';?>>मोजाम्बिक</option>
                                                            <option value="MM" <?php echo (@$user_info[0]->country=='MM') ? 'selected' : '';?>>म्यांमार</option>
                                                            <option value="NA" <?php echo (@$user_info[0]->country=='NA') ? 'selected' : '';?>>नामिबिया</option>
                                                            <option value="NR" <?php echo (@$user_info[0]->country=='NR') ? 'selected' : '';?>>नाउरू</option>
                                                            <option value="NP" <?php echo (@$user_info[0]->country=='NP') ? 'selected' : '';?>>नेपाल</option>
                                                            <option value="NL" <?php echo (@$user_info[0]->country=='NL') ? 'selected' : '';?>>नेदरल्याण्ड</option>
                                                            <option value="NC" <?php echo (@$user_info[0]->country=='NC') ? 'selected' : '';?>>न्यू क्यालेडोनिया</option>
                                                            <option value="NZ" <?php echo (@$user_info[0]->country=='NZ') ? 'selected' : '';?>>न्युजिल्याण्ड</option>
                                                            <option value="NI" <?php echo (@$user_info[0]->country=='NI') ? 'selected' : '';?>>निकारागुआ</option>
                                                            <option value="NE" <?php echo (@$user_info[0]->country=='NE') ? 'selected' : '';?>>नाइजर</option>
                                                            <option value="NG" <?php echo (@$user_info[0]->country=='NG') ? 'selected' : '';?>>नाइजीरिया</option>
                                                            <option value="NU" <?php echo (@$user_info[0]->country=='NU') ? 'selected' : '';?>>न्युये</option>
                                                            <option value="NF" <?php echo (@$user_info[0]->country=='NF') ? 'selected' : '';?>>नरफोक आइल्याण्ड</option>
                                                            <option value="MP" <?php echo (@$user_info[0]->country=='MP') ? 'selected' : '';?>>नर्थ मारियाना आइल्याण्ड्स</option>
                                                            <option value="NO" <?php echo (@$user_info[0]->country=='NO') ? 'selected' : '';?>>नर्वे</option>
                                                            <option value="OM" <?php echo (@$user_info[0]->country=='OM') ? 'selected' : '';?>>ओमान</option>
                                                            <option value="PK" <?php echo (@$user_info[0]->country=='PF') ? 'selected' : '';?>>पाकिस्तान</option>
                                                            <option value="PW" <?php echo (@$user_info[0]->country=='PW') ? 'selected' : '';?>>पलाऊ</option>
                                                            <option value="PS" <?php echo (@$user_info[0]->country=='PS') ? 'selected' : '';?>>प्यालेस्टाइन टेरिटोरी</option>
                                                            <option value="PA" <?php echo (@$user_info[0]->country=='PA') ? 'selected' : '';?>>पनामा</option>
                                                            <option value="PG" <?php echo (@$user_info[0]->country=='PG') ? 'selected' : '';?>>पापुआ न्यू गिनी</option>
                                                            <option value="PY" <?php echo (@$user_info[0]->country=='PY') ? 'selected' : '';?>>पराग्वे</option>
                                                            <option value="PE" <?php echo (@$user_info[0]->country=='PE') ? 'selected' : '';?>>पेरू</option>
                                                            <option value="PH" <?php echo (@$user_info[0]->country=='PH') ? 'selected' : '';?>>फिलीपींस</option>
                                                            <option value="PN" <?php echo (@$user_info[0]->country=='PN') ? 'selected' : '';?>>पिटक्यान</option>
                                                            <option value="PL" <?php echo (@$user_info[0]->country=='PL') ? 'selected' : '';?>>पोल्याण्ड</option>
                                                            <option value="PT" <?php echo (@$user_info[0]->country=='PT') ? 'selected' : '';?>>पोर्चुगल</option>
                                                            <option value="PR" <?php echo (@$user_info[0]->country=='PR') ? 'selected' : '';?>>पुएर्टो रिको</option>
                                                            <option value="QA" <?php echo (@$user_info[0]->country=='QA') ? 'selected' : '';?>>कतार</option>
                                                            <option value="RE" <?php echo (@$user_info[0]->country=='RE') ? 'selected' : '';?>>रियूनियन</option>
                                                            <option value="RO" <?php echo (@$user_info[0]->country=='RO') ? 'selected' : '';?>>रोमानिया</option>
                                                            <option value="RU" <?php echo (@$user_info[0]->country=='RU') ? 'selected' : '';?>>रसियन फेडेरेसन</option>
                                                            <option value="RW" <?php echo (@$user_info[0]->country=='RW') ? 'selected' : '';?>>रुवान्डा</option>
                                                            <option value="BL" <?php echo (@$user_info[0]->country=='BL') ? 'selected' : '';?>>सेन्ट बारथलेमी</option>
                                                            <option value="SH" <?php echo (@$user_info[0]->country=='SH') ? 'selected' : '';?>>सेन्ट हेलेना, अस्सेन्सन याण्ड ट्रिस्टन ड कन्हा</option>
                                                            <option value="KN" <?php echo (@$user_info[0]->country=='KN') ? 'selected' : '';?>>सेन्ट किट्स र नेविस</option>
                                                            <option value="LC" <?php echo (@$user_info[0]->country=='LC') ? 'selected' : '';?>>सेन्ट लूसिया</option>
                                                            <option value="MF" <?php echo (@$user_info[0]->country=='MF') ? 'selected' : '';?>>सेन्ट मार्टिन (फ्रेन्च पार्ट)</option>
                                                            <option value="PM" <?php echo (@$user_info[0]->country=='PM') ? 'selected' : '';?>>सेन्ट पियरे र म्यूक्लोन</option>
                                                            <option value="VC" <?php echo (@$user_info[0]->country=='VC') ? 'selected' : '';?>>सेन्ट विन्सेंट याण्ड द ग्रेनेडाइन्स</option>
                                                            <option value="WS" <?php echo (@$user_info[0]->country=='WS') ? 'selected' : '';?>>समोआ</option>
                                                            <option value="SM" <?php echo (@$user_info[0]->country=='SM') ? 'selected' : '';?>>सान मारिनो</option>
                                                            <option value="ST" <?php echo (@$user_info[0]->country=='ST') ? 'selected' : '';?>>साओ टोम याण्ड प्रिन्सिपी</option>
                                                            <option value="SA" <?php echo (@$user_info[0]->country=='SA') ? 'selected' : '';?>>साउदी अरेबिया</option>
                                                            <option value="SN" <?php echo (@$user_info[0]->country=='SN') ? 'selected' : '';?>>सेनेगल</option>
                                                            <option value="RS" <?php echo (@$user_info[0]->country=='RS') ? 'selected' : '';?>>सर्बिया</option>
                                                            <option value="SC" <?php echo (@$user_info[0]->country=='SC') ? 'selected' : '';?>>सेशेल</option>
                                                            <option value="SL" <?php echo (@$user_info[0]->country=='SL') ? 'selected' : '';?>>सिएरा लियोन</option>
                                                            <option value="SG" <?php echo (@$user_info[0]->country=='SG') ? 'selected' : '';?>>सिंगापुर</option>
                                                            <option value="SX" <?php echo (@$user_info[0]->country=='SX') ? 'selected' : '';?>>सिन्ट मार्टन (डच पार्ट)</option>
                                                            <option value="SK" <?php echo (@$user_info[0]->country=='SK') ? 'selected' : '';?>>स्लोवाकिया</option>
                                                            <option value="SI" <?php echo (@$user_info[0]->country=='SI') ? 'selected' : '';?>>स्लोभेनिया</option>
                                                            <option value="SB" <?php echo (@$user_info[0]->country=='SB') ? 'selected' : '';?>>सुलेमान आइल्याण्ड्स</option>
                                                            <option value="SO" <?php echo (@$user_info[0]->country=='SO') ? 'selected' : '';?>>सोमालिया</option>
                                                            <option value="ZA" <?php echo (@$user_info[0]->country=='ZA') ? 'selected' : '';?>>साउथ अफ्रिका</option>
                                                            <option value="GS" <?php echo (@$user_info[0]->country=='GS') ? 'selected' : '';?>>साउथ जर्जिया याण्ड द  साउथ स्यान्डविच आइल्याण्ड्स</option>
                                                            <option value="SS" <?php echo (@$user_info[0]->country=='SS') ? 'selected' : '';?>>साउथ सूडान</option>
                                                            <option value="ES" <?php echo (@$user_info[0]->country=='ES') ? 'selected' : '';?>>स्पेन</option>
                                                            <option value="LK" <?php echo (@$user_info[0]->country=='LK') ? 'selected' : '';?>>श्रीलंका</option>
                                                            <option value="SD" <?php echo (@$user_info[0]->country=='SD') ? 'selected' : '';?>>सूडान</option>
                                                            <option value="SR" <?php echo (@$user_info[0]->country=='SR') ? 'selected' : '';?>>सुरिनाम</option>
                                                            <option value="SJ" <?php echo (@$user_info[0]->country=='SJ') ? 'selected' : '';?>>साल्भार्ड याण्ड जन मेयन</option>
                                                            <option value="SZ" <?php echo (@$user_info[0]->country=='SZ') ? 'selected' : '';?>>स्वाजील्याण्ड</option>
                                                            <option value="SE" <?php echo (@$user_info[0]->country=='SE') ? 'selected' : '';?>>स्वीडेन</option>
                                                            <option value="CH" <?php echo (@$user_info[0]->country=='CH') ? 'selected' : '';?>>स्विट्जरल्याण्ड</option>
                                                            <option value="SY" <?php echo (@$user_info[0]->country=='SY') ? 'selected' : '';?>>सीरिया अरब रिपब्लिक</option>
                                                            <option value="TW" <?php echo (@$user_info[0]->country=='TW') ? 'selected' : '';?>>प्रोभीयन्स ओफ चिन, तैवन</option>
                                                            <option value="TJ" <?php echo (@$user_info[0]->country=='TJ') ? 'selected' : '';?>>ताजिकिस्तान</option>
                                                            <option value="TZ" <?php echo (@$user_info[0]->country=='TZ') ? 'selected' : '';?>>युनाइटेड रिपब्लिक ओफ तान्जानिया</option>
                                                            <option value="TH" <?php echo (@$user_info[0]->country=='TH') ? 'selected' : '';?>>थाईल्याण्ड</option>
                                                            <option value="TL" <?php echo (@$user_info[0]->country=='TL') ? 'selected' : '';?>>टिमोर-लेस्टे</option>
                                                            <option value="TG" <?php echo (@$user_info[0]->country=='TG') ? 'selected' : '';?>>टोगो</option>
                                                            <option value="TK" <?php echo (@$user_info[0]->country=='TK') ? 'selected' : '';?>>टोकेलौ</option>
                                                            <option value="TO" <?php echo (@$user_info[0]->country=='TO') ? 'selected' : '';?>>टोंगा</option>
                                                            <option value="TT" <?php echo (@$user_info[0]->country=='TT') ? 'selected' : '';?>>त्रिनिदाद याण्ड याण्ड</option>
                                                            <option value="TN" <?php echo (@$user_info[0]->country=='TN') ? 'selected' : '';?>>टुनिशिया</option>
                                                            <option value="TR" <?php echo (@$user_info[0]->country=='TR') ? 'selected' : '';?>>टर्की</option>
                                                            <option value="TM" <?php echo (@$user_info[0]->country=='TM') ? 'selected' : '';?>>तुर्कमेनिस्तान</option>
                                                            <option value="TC" <?php echo (@$user_info[0]->country=='TC') ? 'selected' : '';?>>तर्कस याण्ड काइकोस आइल्याण्ड्स</option>
                                                            <option value="TV" <?php echo (@$user_info[0]->country=='TV') ? 'selected' : '';?>>तुवालु</option>
                                                            <option value="UG" <?php echo (@$user_info[0]->country=='UG') ? 'selected' : '';?>>युगान्डा</option>
                                                            <option value="UA" <?php echo (@$user_info[0]->country=='UA') ? 'selected' : '';?>>यूक्रेन</option>
                                                            <option value="AE" <?php echo (@$user_info[0]->country=='AE') ? 'selected' : '';?>>युनाइटेड अरब यिमीरेटस्</option>
                                                            <option value="GB" <?php echo (@$user_info[0]->country=='GB') ? 'selected' : '';?>>युनाइटेड किङ्गडम</option>
                                                            <option value="US" <?php echo (@$user_info[0]->country=='US') ? 'selected' : '';?>>युनाइटेड इसटेट अफ अमेरिका</option>
                                                            <option value="UM" <?php echo (@$user_info[0]->country=='UM') ? 'selected' : '';?>>युनाइटेड इसटेट  मिनोर आउटलाइयिङ्ग आइल्याण्ड्स</option>
                                                            <option value="UY" <?php echo (@$user_info[0]->country=='UY') ? 'selected' : '';?>>उरुग्वे</option>
                                                            <option value="UZ" <?php echo (@$user_info[0]->country=='UZ') ? 'selected' : '';?>>उजबेकिस्तान</option>
                                                            <option value="VU" <?php echo (@$user_info[0]->country=='VU') ? 'selected' : '';?>>वानुअतु</option>
                                                            <option value="VE" <?php echo (@$user_info[0]->country=='VE') ? 'selected' : '';?>>बोलिभियन रिपब्लिक अफ भेनेजुएला</option>
                                                            <option value="VN" <?php echo (@$user_info[0]->country=='VN') ? 'selected' : '';?>>भियतनाम</option>
                                                            <option value="VG" <?php echo (@$user_info[0]->country=='VG') ? 'selected' : '';?>>भर्जिन आइल्याण्ड्स, ब्रिटिश</option>
                                                            <option value="VI" <?php echo (@$user_info[0]->country=='VI') ? 'selected' : '';?>>भर्जिन आइल्याण्ड्स, यु.यस</option>
                                                            <option value="WF" <?php echo (@$user_info[0]->country=='WF') ? 'selected' : '';?>>वालिस याण्ड फ्यूचुना</option>
                                                            <option value="EH" <?php echo (@$user_info[0]->country=='EH') ? 'selected' : '';?>>वेसटर्न साहारा</option>
                                                            <option value="YE" <?php echo (@$user_info[0]->country=='YE') ? 'selected' : '';?>>यमन</option>
                                                            <option value="ZM" <?php echo (@$user_info[0]->country=='ZM') ? 'selected' : '';?>>जाम्बिया</option>
                                                            <option value="ZW" <?php echo (@$user_info[0]->country=='ZW') ? 'selected' : '';?>>जिम्बाब्वे</option>
                                                        </select>
                                                    </div>
                                                    <!-- Username-->
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <!-- First name -->
                                                            <input type="text" id="defaultRegisterFormUsername" name="username" class="form-control mb-4"
                                                                placeholder="प्रयोगकर्ता नाम">
                                                        </div>
                                                        <div class="col">
                                                            <!-- Last name -->
                                                            <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="पासवर्ड"
                                                                aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password">
                                                        </div>
                                                    </div>
                                                    <div class="submitbutton text-left">
                                                        <button style="margin-top: -35px !important;" class="btn btncustom btn mb-4 mt-4" type="submit" value="submit">साइन
                                                        अप</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                                <form class="px-4 text-center container" method="post" action="/process/login.php">
                                                    <br>
                                                    <input type="text" id="defaultRegisterFormUsername" name="username" class="form-control mb-4" placeholder="प्रयोगकर्ता नाम">
                                                    <input type="password" id="defaultRegisterFormPassword" class="form-control mb-2"
                                                        aria-describedby="defaultRegisterFormPasswordHelpBlock" name="password" placeholder="पासवर्ड">
                                                    <input type="hidden" name="book" value="<?php echo $_GET['id'] ?>/<?php echo $_GET['act'] ?>">
                                                    <div class="forgotpassword text-left">
                                                        <p style="padding-right: 10px"><a href="reset-password.php"><strong><span style="color: #1E695E;"> पासवर्ड बिर्सनुभयो ?</span></strong></a>
                                                        <p>
                                                            </a>
                                                    </div>
                                                    <div class="signupbutton text-left">
                                                        <a href="#"><button class="btn-lg btncustom btn mb-2 " type="submit" value="submit">साइन
                                                        इन</button></a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    
                    ?>
                <div class="addthis_inline_share_toolbox" style="padding-top:18px;"></div>
            </div>
            <p class="ptype777 editor">
                <?php echo html_entity_decode($getNews[0]->story) ?>
            </p>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-3 col-xs-12 col-md-3 ">
            <div class="row">
                <?php
                    $innerAds = $ads->getInnerAds(4);
                    
                    if($innerAds){
                        
                        foreach($innerAds as $inner){
                            
                            $base = basename($inner->image);
                            
                            if(isset($inner->image) && !empty($inner->image) && file_exists(UPLOAD_DIR.'ads/'.$base)){
                                
                                $thumbnail = UPLOAD_URL.'ads/'.$base;
                                
                            } else {
                                
                                $thumbnail = FRONT_IMAGES_URL.'template2.gif';
                                
                            }
                            
                            ?>
                <a href="<?php echo $inner->url ?>" class="apple2" target="_blank"><img src="<?php echo $thumbnail ?>" alt="commercial" class="img-fluid pt-4 apple"></a>
                <?php
                    }
                    
                    }
                    
                    ?>
            </div>
        </div>
    </div>
    <?php
        $id = $_GET['id'];
        
        $relatedComments = $comments->getCommentPostById($id, 5);
        
        $relatedCount = count($relatedComments);
        
        if($relatedCount > 0){
            ?>
    <div id="commentSection" class="col-md-10" style="background:#eee; padding:20px; margin-bottom:5px;">
        <?php
            } else {
            
            ?>
        <div class="col-md-10"><?php
            }
            
            ?>
        </div>
        <?php 
            if($relatedCount > 0){
                ?>
        <button id="moreComment" type="submit" class="btn btn-articles" style="margin-bottom:10px">Load More</button>
        <?php
            } else {
                echo "";
            }
            ?>
        <div class="col-md-10" style="padding:0px">
            <span class="front-error" id="result"></span>
            <form id="comment" data-parsley-validate class="form-horizontal form-label-left" action="/process/comments.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <img src="<?php  echo $userProfileImage ?>" alt="" style="width:40px;">
                        <label>प्रतिक्रिया दिनुहोस्</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <textarea type="text" rows="5" style="resize:none" name="comment" placeholder="शीर्षक प्रविष्ट गर्नुहोस्" class="form-control" value="<?php ?>"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <input type="hidden" name="user_id" value="<?php  echo $user_info[0]->id ?>">
                        <input type="hidden" name="post_id" value="<?php echo $getNews[0]->id  ?>">
                        <button id="buttonOne" type="submit" class="btn btn-articles"><i class="fas fa-comments"></i> प्रतिक्रिया दिनुहोस्</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of section  -->
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c78f8705f82c210"></script>
<!--share buttons-->
<script type="text/javascript">
    $(document).ready(function() {
    
    $('#button').click(function(){
       
       $('#icon').toggleClass("decorate");
        
    });
    
    $('#button').click(function(){
        
        var data = $('#bookmark :input').serializeArray();
        
        $.post($('#bookmark').attr('action'), data);
        
    });
    
    $('#buttonOne').click(function(){
        
        var data = $('#comment :input').serializeArray();
        
        $.post($('#comment').attr('action'), data, function(info){ $('#result').html(info); });
        
        clearField();
        
    });
    
    $('#comment').submit(function(){
        
        return false;
        
    });
    
    function clearField(){
        
        $('#comment :input').each( function (){
            $(this).val('');
        })
        
    }
    
    $('#bookmark').submit(function(){
        
        return false;
        
    });
    
    var count = 1;
    
    count = count;
        
    $('#commentSection').load('/process/data.php', {
        limit: count,
        id: <?php echo $_GET['id'] ?>
    });
    
    $('#moreComment').click(function(){
    
    var count = 3;
    
    count = count;
        
        $('#commentSection').load('/process/data.php', {
            limit: count,
            id: <?php echo $_GET['id'] ?>
        });
            
    });
    
    });
        
</script>