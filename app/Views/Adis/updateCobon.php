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
                    تعديل كوبون
                </h3>
            </div>
        </div>

        <form id="add_edit" action="<?php echo base_url('AdisManage/update');?>" enctype="multipart/form-data" method="POST">
            <div class="card-body">
                <input type="hidden" name="id" value="<?php echo $id;?>">

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">ادخل عنوان الكوبون
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="text" placeholder="ادخل عنوان الكوبون" value="<?php  echo isset($AidManage["title"]) ? $AidManage["title"] : ""; ?>" id="title" name="title">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">تصنيف الكوبون <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control selectpicker" id="Adis" name="Adis" title="تصنيف الكوبون" data-size="7" data-live-search="true">
                            <?php foreach ($Adis as $row) { ?>
                                <option value="<?= esc($row['id']); ?>" <?php if($AidManage["aids_id"] == $row['id']){?> selected <?php } ?>> <?= esc($row['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اختر المؤسسة المانحة <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control selectpicker" id="donation" name="donation" title="اختر المؤسسة المانحة" data-size="7" data-live-search="true">
                            <?php foreach ($donation as $row) { ?>
                                <option value="<?= esc($row['id']); ?>"  <?php if($AidManage["donation_id"] == $row['id']){?> selected <?php } ?>> <?= esc($row['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">تاريخ الإصدار<span class="text-danger">*</span></label>
                    <!-- <label class="col-form-label text-right col-lg-3 col-sm-12">Minimum Setup</label> -->
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <div class="input-group date">
                            <input type="text" class="form-control datepicker-custom-rtl" value="<?php  echo isset($AidManage["date"]) ? $AidManage["date"] : ""; ?>" id="Date" name="Date"  placeholder="اختيار تاريخ">
                            <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12"> ملاحظات <span class="text-danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <!-- <div class="col-12 col-md-6"> -->
                    <textarea class="form-control" id="note" name="note" rows="7"><?php  echo isset($AidManage["note"]) ? $AidManage["note"] : ""; ?></textarea>
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


            const validator = FormValidation.formValidation(
                document.getElementById('add_edit'), {
                    fields: {
                        DateOfCreation: {
                            validators: {
                                notEmpty: {
                                    message: 'ادخل تاريخ إنشاء القرار '
                                },
                                date: {
                                    format: 'YYYY-MM-DD',
                                    message: 'الرجاء ادخل صيغة تاريخ صحيحة ، YYYY-MM-DD ',
                                    min: '2010-12-22',
                                }
                            }
                        },

                        r_text: {
                            validators: {
                                notEmpty: {
                                    message: 'الرجاء ادخل وصف القرار'
                                }
                            }
                        },
                    },

                    plugins: { //Learn more: https://formvalidation.io/guide/plugins
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap({
                            eleInvalidClass: '',
                            eleValidClass: '',
                        }),
                        // Validate fields when clicking the Submit button
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    }
                }
            );




            <?php if (isset($executive)) { ?> $('#executive').selectpicker('val', <?php echo $tags =  '[' . implode(', ', array_values($executive)) . ']'; ?>);
            <?php } ?>

            <?php if (isset($cat_general)) { ?> $('#cat_general').selectpicker('val', <?php echo $tags =  '[' . implode(', ', array_values($cat_general)) . ']'; ?>);
            <?php } ?>




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

            $('.custom-file-input').on('change', function() {
                //get the file name
                var fileName = $(this).val().replace(/C:\\fakepath\\/, '');
                $(this).next('.custom-file-label').html(fileName);
            })




            <?php if (isset($validation)) : ?>
            document.getElementById('CommitteCreationType').value = "<?php echo set_value('CommitteCreationType'); ?>";
            $('.CommiteeTypeSelector').selectpicker('val', "<?php echo set_value('FK_ConstantId_CommiteeType'); ?>");
            $('#CommitteCreationType').change();

            <?php endif ?>

            <?php if (isset($editData["FK_CommitteCreationType"])) { ?>
            $('.CommitteCreationTypeSelector').selectpicker('val', <?php echo $editData["FK_CommitteCreationType"]; ?>);
            $('#CommitteCreationType').change();
            <?php } ?>
            <?php if (isset($editData["FK_ConstantId_CommiteeType"])) { ?>
            $('.CommiteeTypeSelector').selectpicker('val', "<?php echo $editData["FK_ConstantId_CommiteeType"]; ?>");
            <?php } ?>


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
                .catch(error => {
                    console.error(error);
                });



        })
    </script>
<?= $this->endSection() ?>