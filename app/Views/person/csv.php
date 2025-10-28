<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    اضافة مستفيد
                </h3>
            </div>
            <a href="<?php echo base_url("uploads/persons.xlsx") ?>" style="height: fit-content;margin-top: 15px;" class="btn btn-info" >
                <span>
                    <i class="fa fa-file-csv"></i>
                    <span> الملف </span>
                </span>
            </a>
        </div>
        <?php if(!isset($status)){?>
        <form id="add_edit" action="<?php echo base_url('person/upload/csv');?>" enctype="multipart/form-data" method="POST">
            <div class="card-body">

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
                    <label class="col-form-label text-right col-lg-3 col-sm-12">الملف
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <input class="form-control" type="file" placeholder="إختر الملف" accept="text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" value="" id="file" name="file" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">اختر نوع العملية  <span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>
                            <input type="radio" checked name="type_add_or_convert" value="1">
                            اضافة فقط
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="type_add_or_convert" value="2">
                            اضافة مع تعديل
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label text-right col-lg-3 col-sm-12">طريقة عرض النتائج<span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-9 col-sm-12">
                        <label>
                            <input type="radio" checked name="exportType" value="1">
                             عرض النتائج في جدول
                        </label>
                        <br>
                        <label>
                            <input type="radio" name="exportType" value="2">
                            تحميل النتائج في ملف اكسل
                        </label>
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
        <?php }else{ ?>
            <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th> رقم الهوية </th>
                    <th> الاسم الرباعي </th>
                    <th> الرسالة </th>
                    <th> المربع السابق إن وجد </th>
                    <th> التحكم </th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach ($status as $per) { $i++; ?>
                    <tr>
                        <td style="width: 50px;"><?php echo $i;?></td>
                        <td> <?php echo $per['id'];?> </td>
                        <td> <?php echo $per['fname'];?> <?php echo $per['sname'];?> <?php echo $per['tname'];?> <?php echo $per['lname'];?>  </td>
                        <td> <?php echo $per['massage'];?> </td>
                        <td> <?php echo $per['old'];?> </td>
                        <td>
                            <?php echo $per['action'];?>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        <?php } ?>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <script src="<?php echo base_url("assets/plugins/custom/formvalidation/AutoFocus.js") ?>"></script>
    <script src="<?php echo base_url("assets/plugins/custom/ckeditor/new/ckeditor.js") ?>"></script>
    <script>



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