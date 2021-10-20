<div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto " id="kt_brand">
        <!--begin::Logo-->
        <a href="<?= site_url('') ?>" class="brand-logo">
            <img alt="Logo" src="<?php echo base_url("assets/media/logos/sidebarlogo.png") ?>" />
        </a>
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
                    <a href="<?php echo site_url('/'); ?>" class="menu-link ">
                        <i class="menu-icon flaticon-home">
                        </i><span class="menu-text">الصفحة الرئيسية</span></a>
                </li>
                <? // RenderMenu(); ?>

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