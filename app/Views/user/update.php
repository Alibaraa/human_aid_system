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
<?php if (isset($success)) : ?>
    <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-interface-5"></i></div>
        <div class="alert-text">تمت عملية الإضافة بنجاح </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($validation)) : ?>
    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
        <div class="alert-icon"><i class="flaticon-warning"></i></div>
        <div class="alert-text">
            <?= $validation->listErrors() ?>
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php endif; ?>
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    اضافة مستفيد
                </h3>
            </div>
        </div>

        <form id="add_edit111" action="<?php echo base_url('User/update/data/'.$id);?>" enctype="multipart/form-data" method="POST">
            <div class="card-body">



                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اسم المستخدم
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" placeholder="اسم المستخدم" value="<?php echo isset($editData["name"]) ? $editData["name"] : ""; ?>" id="name" name="name">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">البريد الإلكتروني
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="email" placeholder="البريد الإلكتروني" value="<?php echo isset($editData["email"]) ? $editData["email"] : ""; ?>" id="email" name="email">
                    </div>
                </div>


                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">كلمة المرور
                        <span class="text-danger"></span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="password" placeholder="" value="" id="password_hash" name="password_hash">
                    </div>
                </div>






            </div>

            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12">صلاحية المسخدم  <span class="text-danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <select class="form-control selectpicker" id="permissions" name="permissions" title="صلاحية المسخدم" data-size="7" data-live-search="true">
                        <option value="1" <?php if(1 == $editData["permissions"]){?>selected<?php } ?>> مدير</option>
                        <option value="2" <?php if(2 == $editData["permissions"]){?>selected<?php } ?>> إداري</option>
                        <option value="3" <?php if(3 == $editData["permissions"]){?>selected<?php } ?>> مندوب منطقة</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12">حالة المسخدم  <span class="text-danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <select class="form-control selectpicker" id="active" name="active" title="حالة المسخدم" data-size="7" data-live-search="true">
                        <option value="1" <?php if(1 == $editData["active"]){?>selected<?php } ?>> فعال</option>
                        <option value="0" <?php if(0 == $editData["active"]){?>selected<?php } ?>> غير فعال</option>
                    </select>
                </div>
            </div>


            <div class="card-footer">
                <div class="row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12"></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <button type="submit" id="save-btn" class="btn btn-primary mr-2">
                            تعديل
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

            })




        })



    </script>
<?= $this->endSection() ?>