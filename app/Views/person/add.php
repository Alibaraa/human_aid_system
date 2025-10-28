<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php if (isset($editsuccess)) : ?>
    <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-interface-5"></i></div>
        <div class="alert-text">تمت عملية التعديل بنجاح </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($chick) && $chick == 3) { ?>
    <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-interface-5"></i></div>
        <div class="alert-text">تمت عملية الإضافة بنجاح </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php } ?>

<?php if (isset($chick) && $chick == 1) { ?>
    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">
            رقم الهوية المدخل مكرر
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php } ?>
<?php if (isset($chick) && $chick == 2) { ?>
    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">
            هناك حقول فارغة يرجى التأكد من البيانات
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php } ?>
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    اضافة مستفيد
                </h3>
            </div>
        </div>

        <form id="add_edit111" action="<?php echo base_url('person/insert');?>" enctype="multipart/form-data" method="POST">
            <div class="card-body">


                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">رقم الهوية
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="ادخل رقم الهوية " value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="id" name="id" onfocusout="chcikval(this.value)">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">الاسم الاول
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" placeholder="الاسم الاول" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="fname" name="fname">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اسم الاب
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" placeholder="اسم الاب" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="sname" name="sname">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اسم الجد
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" placeholder="اسم الجد" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="tname" name="tname">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اسم العائلة
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" placeholder="اسم العائلة" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="lname" name="lname">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">عدد افراد العائلة
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number"  placeholder="عدد افراد العائلة " value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="fcount" name="fcount">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">رقم الجوال
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="رقم الجوال" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="mob_1" name="mob_1">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">الجوال البديل
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="الجوال البديل" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="mob_2" name="mob_2">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">التجمع  <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control selectpicker" id="block" name="block" title="التجمع " data-size="7" data-live-search="true">
                            <?php foreach ($Block as $row) { ?>
                                <option value="<?= esc($row['id']); ?>"> <?= esc($row['title']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>


                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">رقم هوية الزوجة
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="رقم هوية الزوجة" value="" id="wifi_id" name="wifi_id"  onfocusout="chcikvalWife(this.value)">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اسم الزوجة
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" placeholder="اسم الزوجة" value="" id="wifi_name" name="wifi_name">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">عدد الذكور
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="عدد الذكور " value="" id="num_mail" name="num_mail">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">عدد الاناث
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="عدد الاناث" value="" id="num_femail" name="num_femail">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">عدد الافراد اقل من 3 سنوات
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="عدد الافراد اقل من 3 سنوات" value="" id="f_num_liss_3" name="f_num_liss_3">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">عدد الافراد ذوي الأمراض المزمنه
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="عدد الافراد ذوي الأمراض المزمنه" value="" id="f_num_ill" name="f_num_ill">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">عدد الافراد ذوي الاعاقة
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="number" placeholder="عدد الافراد ذوي الاعاقة" value="" id="f_num_sn" name="f_num_sn">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">معيل الاسرة  <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control selectpicker" id="income" name="income" title="معيل الاسرة" data-size="7" data-live-search="true">
                            <option value="1">لا يعمل</option>
                            <option value="2">عامل</option>
                            <option value="3">موظف</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">حالة المسكن  <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control selectpicker" id="home_status" name="home_status" title="حالة المسكن " data-size="7" data-live-search="true">
                            <option value="1">سيئ</option>
                            <option value="2">جيد</option>
                            <option value="3">ممتاز</option>
                        </select>
                    </div>
                </div>



            </div>

            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12"> ملاحظات <span class="text-danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <!-- <div class="col-12 col-md-6"> -->
                    <textarea class="form-control" id="note" name="note" rows="7"><?php //echo set_value('r_text', (isset($editData["r_text"])) ? $editData["r_text"] : ""); ?></textarea>
                </div>
            </div>

<!--            <div class="form-group row">-->
<!--                <label class="col-form-label text-right col-lg-3 col-sm-12">حالة المستفيد  <span class="text-danger">*</span></label>-->
<!--                <div class="col-lg-6 col-md-9 col-sm-12">-->
<!--                    <select class="form-control selectpicker" id="status" name="status" title="حالة المستفيد" data-size="7" data-live-search="true">-->
<!--                        <option value="0" selected> فعال</option>-->
<!--                        <option value="1"> غير فعال</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->


            <div class="card-footer">
                <div class="row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12"></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <button type="submit" id="save-btn" class="btn btn-primary mr-2">
                            إضافة
                        </button>
                        <button type="reset" class="btn btn-secondary">الغاء الامر</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script src="<?php echo base_url("assets/plugins/custom/formvalidation/AutoFocus.js") ?>"></script>
    <script src="<?php echo base_url("assets/plugins/custom/ckeditor/new/ckeditor.js") ?>"></script>
    <script>
        function chcikval(val){
            if(!Check(val)){
                alert("تأكد من رقم الهوية, رقم الهوية خطأ");
                jQuery("#id").val("")
                return false;
            }else {
                $.ajax({
                    url: '<?= base_url(); ?>/person/chickPid/pid',
                    type: "POST",
                    data: {
                        'pid': jQuery("#id").val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        alert(data.fname+" "+data.sname+" "+data.tname+" "+data.lname + " المندوب / " + data.title);
                        jQuery("#id").val(" ");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        KTApp.unblock('#add-item');
                        toastr.error("يوجد حطأ! في الاجراءات, يرجى المحاوله فيما بعد.");
                        return false;
                    }
                });
            }
            return true;
        }

        function chcikvalWife(val){

            if(jQuery("#wife_id").val() == jQuery("#id").val()  && jQuery("#wife_id").val() != '' && jQuery("#id").val() != ''){
                alert("رقم هوية الزوج هو نفسه رقم رقم هوية المستفيدين");
                jQuery("#wife_id").val("")
                return false;
            }
            if(!Check(val) && val != ''){
                alert("تأكد من رقم الهوية, رقم الهوية خطأ");
                jQuery("#wife_id").val("")
                return false;
            }else if(val != ''){
                $.ajax({
                    url: '<?= base_url(); ?>/person/chickPid/pid',
                    type: "POST",
                    data: {
                        'pid': jQuery("#wife_id").val()
                    },
                    dataType: "JSON",
                    success: function(data) {
                        alert(data.fname+" "+data.sname+" "+data.tname+" "+data.lname + " المندوب / " + data.title);
                        jQuery("#wife_id").val(" ");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        KTApp.unblock('#add-item');
                        toastr.error("يوجد حطأ! في الاجراءات, يرجى المحاوله فيما بعد.");
                        return false;
                    }
                });
            }
            return true;
        }

        $(document).ready(() => {
            // alert("test");


            var arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }


            $('.datepicker-custom-rtl').datepicker({
                rtl: true,
                todayHighlight: true,
                orientation: "bottom left",
                format: "yyyy-mm-dd",
                autoclose: true,
                templates: arrows,
                clearBtn: true,
                todayBtn: "linked",
            }).on('changeDate', function(e) {
                // Revalidate field
                validator.revalidateField($(this).attr("id"));
            });


            let CKOPTIONS = {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'alignment',
                        'indent',
                        'outdent',
                        '|',
                        'insertTable',
                        'undo',
                        'redo'
                    ]
                },
                language: 'ar',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableCellProperties',
                        'tableProperties'
                    ]
                },
            };
            let editorSummary;
            ClassicEditor.create(document.querySelector('#r_text'), CKOPTIONS).then(newEditor => {
                editorSummary = newEditor;
                editorSummary.model.document.on('change:data', () => {
                    const editorSummaryData = editorSummary.getData();
                    $("#r_text").val(editorSummaryData);
                    validator.revalidateField('r_text');
                });

            });



        })







        jQuery(document).ready(function() {
            jQuery('#add_edit111').submit(function () {
                if(!Check(jQuery("#id").val())){
                    alert("تأكد من رقم الهوية, رقم الهوية خطأ");
                    jQuery("#id").val("")
                    return false;
                }
                return true;
            });
        });



        function Check(idno) {
            var MultID = [1, 2, 1, 2, 1, 2, 1, 2];
            var SumID = 0;
            var i = 0;
            var x = 0;
            var r = "" + idno;

            if (r.length === 9 && !isNaN(r)) {
                while (i < 8) {
                    x = MultID[i] * parseInt(r.charAt(i));
                    if (x > 9) {
                        var t = String(x);
                        x = parseInt(t.charAt(0)) + parseInt(t.charAt(1));
                    }
                    SumID += x;
                    i++;
                }

                if (SumID % 10 !== 0) {
                    SumID = 10 * (Math.floor(SumID / 10) + 1) - SumID;
                } else {
                    SumID = 0;
                }

                if (SumID === parseInt(r.charAt(8))) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

    </script>
<?= $this->endSection() ?>