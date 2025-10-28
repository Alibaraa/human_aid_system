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
                    إضافة منطقة جديدة
                </h3>
            </div>
        </div>

        <form id="add_edit" action="<?php echo base_url('AreaManager/insert');?>" enctype="multipart/form-data" method="POST">
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">المنطقة الكبرى  <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <select class="form-control selectpicker" id="general_area" name="general_area" title="المنطقة الكبرى " data-size="7" data-live-search="true">
                            <?php foreach ($AreaManager as $row) { ?>
                                <option value="<?= esc($row['id']); ?>"> <?= esc($row['title']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">ادخل اسم المنطقة
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="text" placeholder="ادخل اسم المنطقة" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="title" name="title">
                    </div>
                </div>

                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">ادخل اسم مسؤل المنطقة
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="text" placeholder="ادخل اسم مسؤل المنطقة" value="" id="m_title" name="m_title">
                    </div>
                </div>


                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">جوال مسؤل المنطقة
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="text" placeholder="جوال مسؤل المنطقة" value="<?php // echo set_value('r_title', (isset($editData["r_title"])) ? $editData["r_title"] : ""); ?>" id="p_jawwal" name="p_jawwal">
                    </div>
                </div>



            </div>

            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12"> العنوان <span class="text-danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <!-- <div class="col-12 col-md-6"> -->
                    <textarea class="form-control" id="note" name="note" rows="7"><?php //echo set_value('r_text', (isset($editData["r_text"])) ? $editData["r_text"] : ""); ?></textarea>
                </div>
            </div>

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
        $(document).ready(() => {
            // alert("test");


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





        })
    </script>
<?= $this->endSection() ?>