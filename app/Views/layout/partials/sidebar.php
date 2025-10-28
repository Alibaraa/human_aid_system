<?php
$router = service('router');
$controller  = explode("\\", $router->controllerName());
$controller_menu_name = end($controller);
$method_menu_name = $router->methodName();
?>

<div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto " id="kt_brand">
        <!--begin::Logo-->
        <!-- <a href="<?= site_url('') ?>" class="brand-logo">
            <img alt="Logo" src="<?php echo base_url("assets/media/logos/sidebarlogo.png") ?>" />
        </a> -->
        <!--end::Logo-->

        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                    </g>
                </svg>
                <!--end::Svg Icon--></span> </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav ">
                <li class="menu-item menu-item-open menu-item-here" aria-haspopup="true">
                    <a href="<?php echo site_url(''); ?>" class="menu-link ">
                        <i class="menu-icon flaticon-home">
                        </i><span class="menu-text">الصفحة الرئيسية</span></a>
                </li>

              

                <?php if($_SESSION['userData']['permissions'] == 3){ ?>
                <li class="menu-item menu-item-open menu-item-here" aria-haspopup="true">
                    <a href="<?php echo site_url('personBlock/show'); ?>" class="menu-link ">
                        <i class="menu-icon flaticon-home">
                        </i><span class="menu-text">إدارة المستفيدين للمندوبين</span></a>
                </li>
                <li class="menu-item menu-item-open menu-item-here" aria-haspopup="true">
                    <a href="<?php echo site_url('personBlock/add'); ?>" class="menu-link ">
                        <i class="menu-icon flaticon-home">
                        </i><span class="menu-text"> إضافة مستفيد</span></a>
                </li>
                <?php } ?>
                <?php if($_SESSION['userData']['permissions'] == 1 || $_SESSION['userData']['permissions'] == 2){ ?>
                <li class="menu-item menu-item-open menu-item-here" aria-haspopup="true">
                    <a href="<?php echo site_url('User/show'); ?>" class="menu-link ">
                        <i class="menu-icon flaticon-home">
                        </i><span class="menu-text">التحكم بالمستخدمين </span></a>
                </li>

                <li class="menu-item menu-item-submenu <?php if ($controller_menu_name == 'Person') { ?>menu-item-open menu-item-here<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="fas fa-database"></i>
                            </span>
                        <span class="menu-text">إدارة المستفيدين</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" <?php if ($controller_menu_name != 'Person') { ?>style="display: none; overflow: hidden;" <?php } ?> kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                                <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'add' && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="<?php echo site_url('/person/add'); ?>" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">إدخال مستفيدين</span>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'index' && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="<?php echo site_url('/person/data/search'); ?>" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">بحث بالمستفيدين</span>
                                    </a>
                                </li>
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'show_delete' && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/person/show/delete'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">مستفيدين قيد الانتظار</span>
                                </a>
                            </li>
                                <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'index' && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="<?php echo site_url('/person/show'); ?>" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">إدارة المستفيدين</span>
                                    </a>
                                </li>
                                
                                <li class="menu-item menu-item-submenu <?php if (($method_menu_name == 'uploadFile' || $method_menu_name == 'uploadCsv') && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="<?php echo site_url('/person/upload/file'); ?>" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">تحمل ملف xlsx للاسر </span>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-submenu <?php if (($method_menu_name == 'uploadFile_block' || $method_menu_name == 'uploadCsv_block') && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="<?php echo site_url('/person/upload/file/block'); ?>" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">  تحميل ملف اكسل بدون مندوب  </span>
                                    </a>
                                </li>

                                <li class="menu-item menu-item-submenu <?php if (($method_menu_name == 'uploadFileBlock' || $method_menu_name == 'uploadCsvBlock') && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="<?php echo site_url('/person/upload/file/Block'); ?>" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">حظر المستفيدين xlsx </span>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'chieckIds' && $controller_menu_name == 'Person') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="<?php echo site_url('/person/check'); ?>" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">فحص ارقام الهوايا </span>
                                    </a>
                                </li>

                        </ul>
                    </div>
                </li>



                <li class="menu-item menu-item-submenu <?php  if ($controller_menu_name == 'AdisManageControler') { ?>menu-item-open menu-item-here<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="fas fa-database"></i>
                            </span>
                        <span class="menu-text">إدارة المساعدات</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" <?php  if ($controller_menu_name != 'AdisManageControler') { ?>style="display: none; overflow: hidden;" <?php } ?> kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'index' && $controller_menu_name == 'AdisManageControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/AdisManage/show'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> عرض الكابونات</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'addCobon' && $controller_menu_name == 'AdisManageControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/AdisManage/addCobon'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">إضافة كوبون </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>


                <li class="menu-item menu-item-submenu <?php  if ($controller_menu_name == 'AreaManagerControler') { ?>menu-item-open menu-item-here<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="fas fa-database"></i>
                            </span>
                        <span class="menu-text">المناطق</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" <?php  if ($controller_menu_name != 'AreaManagerControler') { ?>style="display: none; overflow: hidden;" <?php } ?> kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'show' && $controller_menu_name == 'AreaManagerControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/AreaManager/show'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> عرض المناطق</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'add' && $controller_menu_name == 'AreaManagerControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/AreaManager/add'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">إضافة منطقة </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-item menu-item-submenu <?php  if ($controller_menu_name == 'blockControler') { ?>menu-item-open menu-item-here<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="fas fa-database"></i>
                            </span>
                        <span class="menu-text">المندوبين</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" <?php  if ($controller_menu_name != 'blockControler') { ?>style="display: none; overflow: hidden;" <?php } ?> kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'show' && $controller_menu_name == 'blockControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/block/show'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> عرض المندوبين</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'add' && $controller_menu_name == 'blockControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/block/add'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">إضافة مندوب </span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li class="menu-item menu-item-submenu <?php if ($controller_menu_name == 'exportControler') { ?>menu-item-open menu-item-here<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="fas fa-database"></i>
                            </span>
                        <span class="menu-text">احصائيات </span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" <?php if ($controller_menu_name != 'exportControler') { ?>style="display: none; overflow: hidden;" <?php } ?> kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'filter' && $controller_menu_name == 'exportControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/export/filter/pid/data'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">فلترة الهوايا </span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'general_report' && $controller_menu_name == 'exportControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/export/filter/generalReport'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">تقرير المستفيدين</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu <?php if ($method_menu_name == 'daly_report' && $controller_menu_name == 'exportControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('export/filter/daly/report'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">الاحصائية اليومية</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <?php if($_SESSION['userData']['permissions'] == 1){?>
                <li class="menu-item menu-item-submenu <?php  if ($controller_menu_name == 'constantsControler') { ?>menu-item-open menu-item-here<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i class="fas fa-database"></i>
                            </span>
                        <span class="menu-text">الثوابت</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" <?php  if ($controller_menu_name == 'constantsControler' ) {}else{ ?>style="display: none; overflow: hidden;" <?php } ?> kt-hidden-height="160">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-submenu <?php if (($method_menu_name == 'showAids' || $method_menu_name == 'editAids' || $method_menu_name == 'updateAids' || $method_menu_name == 'addAids' || $method_menu_name == 'insertAids' ) && $controller_menu_name == 'constantsControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/constants/show/Aids'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text"> عرض نوع المساعدة</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu <?php if (($method_menu_name == 'showDonation' || $method_menu_name == 'editDonation' || $method_menu_name == 'updateDonation' || $method_menu_name == 'addAids' || $method_menu_name == 'insertDonation') && $controller_menu_name == 'constantsControler') { ?>menu-item-active<?php } ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?php echo site_url('/constants/show/Donation'); ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">عرض الجهات المانحة</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>

                <?php } ?>
                <?php } ?>
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->

    <!-- Button trigger modal-->
</div>

<!-- Modal-->
<?= $this->section('mainHtml') ?>

<div class="modal fade" id="Main_CommitteMembersModel" tabindex="-1" role="dialog" aria-labelledby="Main_CommitteMembersModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Main_CommitteMembersModelLabel">اختر اللجنة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-4">
                        <!-- <label>الرجاء اختيار اللجنة <span class="text-danger">*</span></label> -->
                        <select class="form-control selectpicker" id="Main_CommitteeSelector" name="Main_CommitteeSelector" title="اختر اللجنة المراد عرض اعضاءها" data-size="7" data-live-search="true">
                        </select>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">اعرض الاعضاء</button>
            </div> -->
        </div>
    </div>
</div>
<div class="modal fade" id="Main_TOCSelectorModel" tabindex="-1" role="dialog" aria-labelledby="Main_TOCSelectorModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Main_TOCSelectorModelLabel">اختر اللجنة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-4">
                        <label>أختر اللجنة <span class="text-danger">*</span></label>
                        <select class="form-control selectpicker" id="Main_TOCCommitteeSelector" name="Main_TOCCommitteeSelector" title="اختر اللجنة" data-size="7" data-live-search="true">
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label>أدخل رقم جدول الاعمال للعرض:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control datatable-input" id="Main_TocNumber" name="Main_TocNumber" autocomplete="off" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnNavigateToTOC" class="btn btn-primary font-weight-bold">عرض</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('mainScripts') ?>
<script>
    $(document).ready(() => {
        $('#Main_CommitteMembersModel').on('shown.bs.modal', function(event) {

            KTApp.block('#Main_CommitteMembersModel .modal-content', {
                overlayColor: '#000000',
                state: 'danger',
                message: 'يرجى الانتظار ...'
            });

            $.ajax({
                url: "<?= site_url("/Committees/GetAllCommittees"); ?>",
                type: "GET",
                // data: $(formName).serialize(),
                dataType: "JSON",
                success: function(data) {
                    $('#Main_CommitteeSelector').find('option').remove();
                    $.each(data, function(key, value) {
                        $('#Main_CommitteeSelector')
                            .find('option')
                            //.remove()
                            .end()
                            .append($("<option></option>")
                                .attr("value", value.CommiteeID)
                                .text(value.CommiteeName));
                    });
                    $('#Main_CommitteeSelector').selectpicker('refresh');
                    KTApp.unblock('#Main_CommitteMembersModel .modal-content');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('حصل خطأ اثناء جلب البيانات ، يرجى المحاولة مرة اخرى');
                    KTApp.unblock('#Main_CommitteMembersModel .modal-content');
                    $("#Main_CommitteMembersModel").modal('hide');

                }
            });
        });

        $('#Main_TOCSelectorModel').on('shown.bs.modal', function(event) {

            KTApp.block('#Main_TOCSelectorModel .modal-content', {
                overlayColor: '#000000',
                state: 'danger',
                message: 'يرجى الانتظار ...'
            });
            $.ajax({
                url: "<?= site_url("/Committees/GetAllCommittees"); ?>",
                type: "GET",
                // data: $(formName).serialize(),
                dataType: "JSON",
                success: function(data) {
                    $('#Main_TOCCommitteeSelector').find('option').remove();
                    $.each(data, function(key, value) {
                        $('#Main_TOCCommitteeSelector')
                            .find('option')
                            //.remove()
                            .end()
                            .append($("<option></option>")
                                .attr("value", value.CommiteeID)
                                .text(value.CommiteeName));
                             
                    });
                    $('#Main_TOCCommitteeSelector').selectpicker('refresh');
                    KTApp.unblock('#Main_TOCSelectorModel .modal-content');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('حصل خطأ اثناء جلب البيانات ، يرجى المحاولة مرة اخرى');
                    KTApp.unblock('#Main_TOCSelectorModel .modal-content');
                    $("#Main_TOCSelectorModel").modal('hide');

                }
            });
        });

        $(document).on('change', '#Main_CommitteeSelector', function(e) {

            KTApp.block('#Main_CommitteMembersModel .modal-content', {
                overlayColor: '#000000',
                state: 'danger',
                message: 'يرجى الانتظار ...'
            });
            window.location.href = "<?php echo site_url('/Committees/members/') ?>" + $(this).val();
        });

        $(document).on('click', '#BroswerCommitteeMembers', function(e) {
            e.preventDefault();
            $("#Main_CommitteMembersModel").modal('show');

        });

        $(document).on('click', '#BrowseTocByNumber', function(e) {
            e.preventDefault();
            $("#Main_TOCSelectorModel").modal('show');
        });

        $(document).on('click', '#BtnNavigateToTOC', function(e) {
            e.preventDefault();
            KTApp.block('#Main_TOCSelectorModel .modal-content', {
                overlayColor: '#000000',
                state: 'danger',
                message: 'يرجى الانتظار ...'
            });
            var Main_TOCCommitteeSelector = $('#Main_TOCCommitteeSelector').val();
            var Main_TocNumber = $('#Main_TocNumber').val();
            var data = {
                'tocNumber': Main_TocNumber,
                'CommitteeID': Main_TOCCommitteeSelector,
            };
            $.ajax({
                url: "<?= site_url("/Toc/GetTocInfo"); ?>",
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    if (data.status === true) {
                        KTApp.unblock('#Main_TOCSelectorModel .modal-content');
                        KTApp.block('#Main_TOCSelectorModel .modal-content', {
                            overlayColor: '#000000',
                            state: 'success',
                            message: 'جاري تحويلك الى صفحة مواضيع جدول اعمال رقم : ' + Main_TocNumber + ' ...'
                        });
                        console.log(data);
                        window.location.href = "<?php echo site_url('/Toc/Sections/') ?>" + data.data.tocID;
                    } else {
                        toastr.warning('لم يتم العثور على جدول اعمال، يرجى التاكد من البيانات المدخلة');
                        KTApp.unblock('#Main_TOCSelectorModel .modal-content');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('حصل خطأ اثناء جلب البيانات ، يرجى المحاولة مرة اخرى');
                    KTApp.unblock('#Main_TOCSelectorModel .modal-content');
                }
            });

        });



    });
</script>
<?= $this->endSection() ?>