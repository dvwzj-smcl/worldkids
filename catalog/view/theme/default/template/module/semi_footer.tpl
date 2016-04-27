<div class="advanced-grid advanced-grid-22976543  " style="margin-top: 0px;margin-left: 0px;margin-right: 0px;margin-bottom: 0px;">
    <div style="">               <div class="container">
            <div style="padding-top: 0px;padding-left: 0px;padding-bottom: 0px;padding-right: 0px;">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="footer-about-us" id="semi-footer">
                            <div class="row">
                                <?php if($logo_image){ ?>
                                <div class="col-sm-4">
                                    <img src="image/<?php echo $logo_image; ?>" alt="Fastor">
                                </div>
                                <?php } ?>
                                <div class="col-sm-8">
                                    <div class="footer-block">
                                    <div class="footer-block-content">
                                    <h6 style="color: #925FAD"><?php echo $company_name; ?></h6>
                                    <p><?php echo $address; ?></p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                                                                        </div>
                    <div class="col-sm-4">
                        <div class="row footer-blocks-top" id="semi-cfooter">
                            <div class="col-sm-12">
                                <?php if($phone1 || $phone2){ ?>
                                <div class="footer-block">
                                    <img src="image/catalog/icon-phone.png" alt="Phone">
                                    <div class="footer-block-content">
                                        <h6 style="color: #925FAD">
                                            <?php
                                            if($phone1){
                                                echo $phone1;
                                            }
                                            ?>
                                            <?php if($phone1 && $phone2){ ?>
                                            ,
                                            <?php } ?>
                                            <?php
                                            if($phone2){
                                                echo $phone2;
                                            }
                                            ?>
                                        </h6>
                                        <p><?php echo $operation_time; ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if($email){ ?>
                                <div class="footer-block">
                                    <img src="image/catalog/icon-mail.png" alt="Mail">
                                    <div class="footer-block-content">
                                        <h6 style="color: #925FAD"><?php echo $email_title; ?></h6>
                                        <p><?php echo $email; ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row footer-blocks-top" id="semi-rfooter">
                            <div class="col-sm-12">
                                <div class="footer-block">
                                <?php if($line || $facebook) { ?>
                                <ul class="social-icons-default" style="padding-top: 7px">
                                    <?php if($facebook) { ?>
                                    <li><a target="_blank" href="https://www.facebook.com/<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                                    <?php } ?>
                                    <!-- li><a href="#"><i class="fa fa-facebook"></i></a></li -->
                                    <?php if($line) { ?>
                                    <li><a target="_blank" href="http://line.me/ti/p/~<?php echo $line; ?>"><i class="fa c-fa-line"></i></a></li>
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                                <?php if($contact_button){ ?>
                                <a href="contact" class="footer_button">ติดต่อเรา</a>
                                <?php } ?>
                                </div>
                            </div>
                        </div>                                                                                                                        </div>
                </div>
                <?php if($copyright){ ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <?php echo $copyright; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>