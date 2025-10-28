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
                    تعدل نوع المساعدة
                </h3>
            </div>
        </div>

        <form id="add_edit" action="<?php echo base_url('constants/update/Aids/'.$id);?>" enctype="multipart/form-data" method="POST">
            <div class="card-body">


                <div class="form-group row  cct-1">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">ادخل عنوان
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input required class="form-control" type="text" placeholder="ادخل عنوان " value="<?php  echo isset($data["name"])? $data["name"] : ""; ?>" id="title" name="title">
                    </div>
                </div>

            </div>

            <div class="form-group row">
                <label class="col-form-label text-right col-lg-3 col-sm-12"> ملاحظات <span class="text-danger">*</span></label>
                <div class="col-lg-6 col-md-9 col-sm-12">
                    <!-- <div class="col-12 col-md-6"> -->
                    <textarea class="form-control" id="note" name="note" rows="7"><?php echo isset($data["note"])? $data["note"] : ""; ?></textarea>
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


        });

    </script>
<?= $this->endSection() ?>