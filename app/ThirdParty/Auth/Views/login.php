<!DOCTYPE html>
<html dir="rtl" lang="ar" class="no-js">
   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام ادارة المساعدات - تسجيل الدخول</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="shortcut icon" href="images/icon.png">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>/login_page/css/bootstrap.min.css" type="text/css">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/login_page/css/materialdesignicons.min.css" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/login_page/css/style.css" />
    <style>
        /* arabic */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(<?php echo base_url("assets/fontsgoogle/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-a1biLD-H.woff2") ?>) format('woff2');
            unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0898-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC;
        }
        /* latin-ext */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(<?php echo base_url("assets/fontsgoogle/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-a13iLD-H.woff2") ?>) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(<?php echo base_url("assets/fontsgoogle/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-a1PiLA.woff2") ?>) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
</head>

<body>

    <!-- START -->
    <div class="account-pages">
        <div class="container">
            <div class="row g-0 bg-white align-items-center">

                <div class="col-lg-6">
                    <div class="bg-login">
                        <div class="bg-overlay"></div>
                            
                        <img src="<?php echo base_url();?>/images/back2.jpg"  class="img-fluid" alt="" style="width:700px; height:740px;">
                        <div class="auth-contain">
                            <div class="container">

                                <div class="row mr-0">
                                    <!--
                                    <div class="col-lg-3"><img src="images/logo.png" height="130" class="img-responsive floatRight ml10 mr10 mt10 mb10"></div>
                                    -->
                                    <div class="col-lg-9 mt-4">
                                        <!-- <span class="text-white fw-bold my-2 p-2">جمعية الفجر الشبابي</span> -->
                                        <span class="text-white fw-bold p-2" style="display: block;">برنامج إدارة المساعدات</span>
                                    </div>
                                </div>

               
                                <div class="clearBoth"></div>
                                <div class="clearBoth"><br></div>
                                <span class="text-white fw-bold">منظومة إدارة المساعدات</span>

                                <p class="text-white-50 f-18 mt-3">

                                </p>

                                <ul class="text-white-50 f-18 mt-3">
                                    <li >تسجل الاسر المحتاجة</li>
                                    <li >تسجل المساعدات</li>
                                    <li >إدارة المستفيدين</li>
                                    <li >إدارة المندوبين</li>
                                    <li > إدارة التجمعات</li>
                                    <li >  إستخراج الاحصائيات</li>
                                </ul>

                                <!-- end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-lg-6">
                    <div class="auth-box">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="javascript:void(0);" class="auth-logo">
                                <!-- <img src="<?php echo base_url();?>/images/logo.jpg" height="80" alt="منظومة دعم القرار الألكترونية">
                            </a> -->
                        </div>

                        <div class="auth-content">
                            <div class="mb-3 pb-3 text-center">
                                <h4 class="fw-normal"> أهلا وسهلاً بكم في <span class="fw-bold">منظومة إدارة المساعدات   </span></h4>
                                <p class="text-muted mb-0">للأستمرار قم بتسجيل الدخول</p>
                            </div>
                            <form method="POST" class="form-custom mt-3" action="<?= site_url('login'); ?>" accept-charset="UTF-8">
                
                                <div class="mb-3">
                                    <label class="form-label" for="username">البريد الألكتروني</label>
                                    <input type="text" class="form-control" value="<?= old('email') ?>" name="email" placeholder="أدخل بريدك الألكتروني هنا">
                                </div>

                                <div class="form-password mb-3 auth-pass-inputgroup">
                                    <label class="form-label" for="userpassword">كلمة المرور</label>
                                    <div class="position-relative">
                                        <input required minlength="5" type="password" name="password" autocomplete="off" class="form-control" id="password-input" placeholder="أدخل كلمة المرور الخاصة بك هنا">
                                        <button type="button" class="btn btn-link position-absolute h-100 start-0 top-0 shadow-none" id="password-addon">
                                            <i class="mdi mdi-eye-outline f-16 text-muted"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <div class="form-checkbox">
                                            <input type="checkbox" class="form-check-input me-1 shadow-none" id="customControlInline">
                                            <label class="form-label text-muted f-15 fw-medium" for="customControlInline">تذكرني</label>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col-sm-6 text-start">
                                        <a href="" class="text-muted f-15 fw-medium"><i class="mdi mdi-lock"></i> هل نسيت كلمة المرور؟</a>
                                    </div><!-- end col -->
                                </div><!-- end row -->

                                <div class="text-center mt-3">
                                    <button class="btn btn-success shadow-none w-50 rounded-pill" type="submit">تسجيل الدخول</button>
                                </div>
                                <hr>
                                <!-- <div class="mt-3 text-center">
                                    <p class="mb-0 text-muted">لأنشاء حساب يمكنك التواصل مع وحدة البرمجة على البريد<a href="" class="text-success fw-bold text-decoraton-underline ms-1"> web_u@hotmail.com
                                        </a></p>
                                </div> -->
                            </form>
                            <!-- end -->
                    
                        </div><!-- auth content -->
                    </div>
                    <!-- end authbox -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>>
    <!-- END -->

    <!-- bootstrap -->
    <script src="<?php echo base_url();?>/login_page/js/bootstrap.bundle.min.js"></script>
    <!-- CUSTOM JS -->
    <script src="<?php echo base_url();?>/login_page/js/app.js"></script>
</body>

</html>
