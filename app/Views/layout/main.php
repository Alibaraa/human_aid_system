<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->

<head>
    <?= $this->include('layout/head') ?>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed subheader-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <?= $this->include('layout/partials/header-mobile') ?>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--begin::Aside-->
            <?= $this->include('layout/partials/sidebar') ?>
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header  header-fixed ">
                    <!--begin::Container-->
                    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <!--begin::Header Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-mobile  header-menu-layout-default ">
                                <!--begin::Header Nav-->
                                <ul class="menu-nav d-flex align-items-center">
                                    <span class="text-muted">وزارة التنمية الاجتماعية - البرنامج الشامل</span>
                                </ul>
                                <!--end::Header Nav-->
                            </div>
                            <!--end::Header Menu-->
                        </div>
                        <!--end::Header Menu Wrapper-->

                        <!--begin::Topbar-->
                        <div class="topbar">
                            <!--begin::Search-->
                            <!--end::Search-->

                            <!--begin::Notifications-->
							<?php
                            //$notifications = service('Notify');
                            ?>
                            <div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px"  id="notif_btn">
										<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
											<span class="svg-icon svg-icon-xl svg-icon-primary">
											<?php //if($notifications->notificationsUnread > 0){?>
												<span class="number_of_unread">2<?php //echo $notifications->notificationsUnread;?></span>
											<?php //}?>
											
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Compiling.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
														<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
											<span class="pulse-ring"></span>
										</div>
									</div>
									<!--end::Toggle-->
									<!--begin::Dropdown-->
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<form>
											<!--begin::Header-->
											<div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(<?= base_url('assets/media/bg/bg-12.jpg');?>)">
												<!--begin::Title-->
                                                
												<h4 class="d-flex flex-center rounded-top">
													<span class="text-white">عدد الإشعارات </span>
													<span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">3<? //$notifications->notificationsUnread;?> جديد</span>
												</h4>
												<!--end::Title-->
												<!--begin::Tabs-->
												<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
													<li class="nav-item">
														<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications">أحدث الإشعارات</a>
													</li>
												</ul>
												<!--end::Tabs-->
											</div>
											<!--end::Header-->
											<!--begin::Content-->
											<div class="tab-content">
												<!--begin::Tabpane-->
												<div class="tab-pane active show p-8" id="topbar_notifications_notifications" role="tabpanel">
													<!--begin::Scroll-->
													<div class="scroll pr-7 mr-n7 navi navi-icon-circle navi-spacer-x-0" data-scroll="true" data-height="300" data-mobile-height="200" id="notif_data">
													

                                                   
														
                                                        
													</div>
													<!--end::Scroll-->
													<!--begin::Action-->
													<div class="d-flex flex-center pt-7">
														<a href="#" id="kt_quick_panel_toggle" class="btn btn-light-primary font-weight-bold text-center">المزيد</a>
													</div>
													<!--end::Action-->
												</div>
												<!--end::Tabpane-->
										
												



											</div>
											<!--end::Content-->
										</form>
									</div>
									<!--end::Dropdown-->
								</div>
								
                            <!--end::Notifications-->

                            <!--begin::Quick Actions-->
                            <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
			<!--begin::Header-->
			<div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
				<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10" role="tablist">
					
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_notifications">الإشعارات </a>
					</li>
					
				</ul>
				<div class="offcanvas-close mt-n1 pr-5">
					<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
						<i class="ki ki-close icon-xs text-muted"></i>
					</a>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content px-10">
				<div class="tab-content">
					
				
					<!--begin::Tabpane-->
					<div class="tab-pane fade show pt-2 pr-5 mr-n5 active" id="kt_quick_panel_notifications" role="tabpanel">
						<!--begin::Nav-->
						<div class="navi navi-icon-circle navi-spacer-x-0" id="read_all_data_notif">
							
						

						
						</div>
						<!--end::Nav-->
					</div>
					<!--end::Tabpane-->
					
				</div>
			</div>
			<!--end::Content-->
		</div>
		<!--end::Quick Panel-->
							<!--end::Quick Actions-->

                            <!--begin::Cart-->

                            <!--end::Cart-->

                            <!--begin::Quick panel-->

                            <!--end::Quick panel-->

                            <!--begin::Chat-->

                            <!--end::Chat-->

                            <!--begin::Languages-->

                            <!--end::Languages-->

                            <!--begin::User-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                    <span class="symbol symbol-lg-35 symbol-25 mr-2">
                                        <span class="symbol-label font-size-h5 font-weight-bold">
                                            <i class="icon-2x text-dark-50 flaticon2-user"></i>
                                        </span>
                                    </span>
                                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">مرحباً ، </span>
                                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"> mohmmed alagha<? // $_SESSION["user_NAME"] ?></span>

                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="hideOnMobile">
                        <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
                            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-1">
                                    <!--begin::Mobile Toggle-->
                                    <div id="ShowTocItemsMenu" style="display: none;">
                                        <button class="burger-icon burger-icon-right mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                                            <span></span>
                                        </button>
                                    </div>
                                    <!--end::Mobile Toggle-->


                                    <!--begin::Page Heading-->
                                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                                        <!--begin::Page Title-->
                                        <h5 class="text-dark font-weight-bold my-1 mr-5 titleHasSpans">

                                            test 1<?// (isset($pageTitle)) ? $pageTitle : "" ?>test 2<? // (isset($HeaderTocDate)) ? $HeaderTocDate : "" ?>test3<? //(isset($HeaderTotalItems)) ? $HeaderTotalItems : "" ?>
                                        </h5>
                                        <!--end::Page Title-->

                                        <!--begin::Breadcrumb-->
                                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                            <?php // if (isset($breadcrumb)) : ?>
                                                <?php //foreach ($breadcrumb as $value) { ?>
                                                    <li class="breadcrumb-item">
                                                        <a href="#" class="text-muted">
                                                            test<?// $value["Text"] ?>
                                                        </a>
                                                    </li>
                                            <li class="breadcrumb-item">
                                                <a href="#" class="text-muted">
                                                    test<?// $value["Text"] ?>
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a href="#" class="text-muted">
                                                    test<?// $value["Text"] ?>
                                                </a>
                                            </li>
                                                <?php // } ?>
                                            <?php // endif ?>
                                        </ul>
                                        <!--end::Breadcrumb-->
                                    </div>
                                    <!--end::Page Heading-->
                                </div>
                                <!--end::Info-->

                                <!--begin::Toolbar-->

                                <!--end::Toolbar-->
                            </div>
                        </div>
                    </div>
                    <!--end::Subheader-->

                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class=" container ">
                            <?= $this->renderSection('content') ?>
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                <?= $this->include('layout/partials/page-footer') ?>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
        <?= $this->renderSection('mainHtml') ?>
    </div>
    <!--end::Main-->





    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">
                <small class="text-muted font-size-sm ml-2"></small>
            </h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->

        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    <div class="symbol-label"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column">
                    <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                        mohmmed alagha<? // $_SESSION["user_NAME"]; ?>
                    </a>
                    <!-- <div class="text-muted mt-1">
                        Application Developer
                    </div> -->
                    <div class="navi mt-2">
                        <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">تسجيل خروج</a>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Separator-->
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <!--end::Separator-->

            <!--begin::Nav-->
            <div class="navi navi-spacer-x-0 p-0">
					<!--begin::Item-->
					<a href="<?php echo base_url('/profile/edite/');?>" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-success">
										<!--begin::Svg Icon | path:/metronic/theme/html/demo13/dist/assets/media/svg/icons/General/Notification2.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"></rect>
												<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"></path>
												<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"></circle>
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">ملفي الشخصي</div>
								<div class="text-muted"> تعديل معلومات الملف الشخصي وطرق التواصل
								<span class="label label-light-danger label-inline font-weight-bold">تعديل</span></div>
							</div>
						</div>
					</a>
            </div>
            <!--end::Nav-->
        </div>
        <!--end::Content-->
    </div>
    <!-- end::User Panel-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon--></span></div>
    <!--end::Scrolltop-->

    <!--begin::Sticky Toolbar-->

    <!--end::Sticky Toolbar-->

    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };


    </script>
    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <?= $this->include('layout/bundle') ?>
    <!--end::Global Theme Bundle-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="<?php echo base_url("assets/js/pages/widgets.js") ?>"></script>
    <script src="<?php echo base_url("assets/plugins/custom/datatables/datatables.bundle.js") ?>"></script>
    <script src="<?php echo base_url("assets/js/pages/crud/datatables/advanced/multiple-controls.js") ?>"></script>
    <?= $this->renderSection('scripts') ?>
    <?= $this->renderSection('mainScripts') ?>
<script>
		jQuery(document).ready(() => {
			var limit  = 10;
			var offset =0;
			jQuery( "#notif_btn" ).on( "click", function() {
				
			KTApp.block('#notif_data', {
                overlayColor: '#000000',
                state: 'danger',
                message: 'يرجى الانتظار ...'
            });
			
            
			var data = {
					'limit': limit,
					'offset': offset,
				};
				$.ajax({
					url: "<?= base_url();?>/Notifications/get",
					// data: $(formName).serialize(),
					type: "POST",
					data: data,
					dataType: "JSON",
					success: function(data) {
                        $(".number_of_unread").html(data.unread);
                        if(data.unread == 0){
                            $(".number_of_unread").hide();
                        }else{
                            $(".number_of_unread").show();
                        }
						var html ='';
						$.each(data.data, function(key, value) {
							var title = value.NotifyText;
							var json_data = JSON.parse(value.Data);
							var link = '';//json_data.<?php // echo ConstantManager::getDataNotificationsKey('url');?>;
							var day = new Date(value.created_at).getFullYear()+'-'+new Date(value.created_at).getMonth()+'-'+new Date(value.created_at).getDate();
							var time = new Date(value.created_at).getHours()+':'+new Date(value.created_at).getMinutes();
							
							
							if(value.read_at){
								html += '<a href="'+link+'" class="navi-item">';
							}else{
								html += '<a href="'+link+'" class="navi-item" style="margin: 5px 0;background-color: aliceblue;">';
							}
							html +=	'<div class="navi-link rounded">'+
									'	<div class="symbol symbol-50 mr-3">'+
									'		<div class="symbol-label">'+
									'			<i class="flaticon-bell text-success icon-lg"></i>'+
									'		</div>'+
									'	</div>'+
									'	<div class="navi-text">'+
									'		<div class="font-weight-bold font-size-lg">'+title+'</div>'+
									'		<div class="text-muted">بتاريخ '+day+' الساعة '+time+'</div>'+
									'	</div>'+
									'</div>'+
									'</a>'
							
						});
						$('#notif_data').html(html);
						$('#read_all_data_notif').html(html);
						KTApp.unblock('#notif_data');
						offset = offset + limit;
					},
					error: function(jqXHR, textStatus, errorThrown) {
						toastr.error('حصل خطأ اثناء جلب البيانات ، يرجى المحاولة مرة اخرى');
						KTApp.unblock('#notif_data');
					}
				});



			});
	



			$('#kt_quick_panel_notifications').on('scroll', function() {
				if(Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10)) {
					KTApp.block('#read_all_data_notif', {
						overlayColor: '#000000',
						state: 'danger',
						message: 'يرجى الانتظار ...'
					});
			
					var data = {
					'limit': limit,
					'offset': offset,
				};
				$.ajax({
					url: "<?= base_url();?>/Notifications/get",
					// data: $(formName).serialize(),
					type: "POST",
					data: data,
					dataType: "JSON",
					success: function(data) {
                        $(".number_of_unread").html(data.unread);
                        if(data.unread == 0){
                            $(".number_of_unread").hide();
                        }else{
                            $(".number_of_unread").show();
                        }
                      
						$.each(data.data, function(key, value) {
							var title = value.NotifyText;
							var json_data = JSON.parse(value.Data);
							var link = '';//json_data.<?php // echo ConstantManager::getDataNotificationsKey('url');?>;
							var day = new Date(value.created_at).getFullYear()+'-'+new Date(value.created_at).getMonth()+'-'+new Date(value.created_at).getDate();
							var time = new Date(value.created_at).getHours()+':'+new Date(value.created_at).getMinutes();
							
							var html ='';
							if(value.read_at){
								html += '<a href="'+link+'" class="navi-item">';
							}else{
								html += '<a href="'+link+'" class="navi-item" style="margin: 5px 0;background-color: aliceblue;">';
							}
							html +=	'<div class="navi-link rounded">'+
									'	<div class="symbol symbol-50 mr-3">'+
									'		<div class="symbol-label">'+
									'			<i class="flaticon-bell text-success icon-lg"></i>'+
									'		</div>'+
									'	</div>'+
									'	<div class="navi-text">'+
									'		<div class="font-weight-bold font-size-lg">'+title+'</div>'+
									'		<div class="text-muted">بتاريخ '+day+' الساعة '+time+'</div>'+
									'	</div>'+
									'</div>'+
									'</a>'
									$('#read_all_data_notif').append(html);
							

									//<span class="text-muted">بتاريخ <?php // date("Y-m-d", strtotime($notf_row['created_at'])) ;?> الساعة <?php // date("H:i", strtotime($notf_row['created_at'])) ;?></span>

							
						});
						KTApp.unblock('#read_all_data_notif');
						offset = offset + limit;
					
					},
					error: function(jqXHR, textStatus, errorThrown) {
						toastr.error('حصل خطأ اثناء جلب البيانات ، يرجى المحاولة مرة اخرى');
						KTApp.unblock('#read_all_data_notif');
					}
				});

				}
			})



			
			


		});




</script>


    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>