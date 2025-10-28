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
                    تعديل بيانات تجمع
                </h3>
            </div>
        </div>

        <form id="add_edit" action="<?php echo base_url('block/update/'.$data['id']);?>" enctype="multipart/form-data" method="POST">
            <div class="card-body">


                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اسم مسؤل المنطقة  <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select required class="form-control selectpicker" id="area_manager" name="area_manager" title="مسؤل المنطقة " data-size="7" data-live-search="true">
                            <?php foreach ($Block as $row) { ?>
                                <option value="<?= esc($row['id']); ?>" <?php if($row['id'] == $data["area_manager_id"]){?>selected<?php } ?> > <?= esc($row['title']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">ادخل عنوان التجمع
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="text" placeholder="ادخل عنوان التجمع" value="<?php  echo $data["title"]; ?>" id="title" name="title">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">إسم مسؤل التجمع
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="text" placeholder="إسم مسؤل التجمع" value="<?php echo $data["p_name"]; ?>" id="p_name" name="p_name">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">جوال مسؤل التجمع
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="text" placeholder="جوال مسؤل التجمع" value="<?php echo $data["p_mob"]; ?>" id="p_jawwal" name="p_jawwal">
                    </div>
                </div>


                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">الحد الاقصى لإستعاب المربع
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="number" placeholder="الحد الاقصى لإستعاب المربع" value="<?php echo $data["limit_num"]; ?>" id="limit_num" name="limit_num">
                    </div>
                </div>
                <h3>الموقع</h3>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">X
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="number" placeholder="X" value="<?php echo $data["lan"]; ?>" id="lan" name="lan">
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">Y
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="number" placeholder="Y" value="<?php echo $data["lat"]; ?>" id="lat" name="lat">
                    </div>
                </div>



            </div>

            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12"> العنوان <span class="text-danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <!-- <div class="col-12 col-md-6"> -->
                    <textarea class="form-control" id="note" name="note" rows="7"><?php echo $data["note"]; ?></textarea>
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