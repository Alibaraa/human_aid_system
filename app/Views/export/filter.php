<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  فلترة أرقام الهوايا  </h3>
                </div>



            </div>

            <div class="card-body">

                    <form action="<?= base_url() ?>/export/filterExportData" method="post">

                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">من تاريخ</label>
                            <!-- <label class="col-form-label text-right col-lg-3 col-sm-12">Minimum Setup</label> -->
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker-custom-rtl" value="<?php echo date("Y-m-d",strtotime("-1 month", time()));?>" id="fromDate" name="fromDate"  placeholder="اختيار تاريخ">
                                    <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12"> إلى تاريخ</label>
                            <!-- <label class="col-form-label text-right col-lg-3 col-sm-12">Minimum Setup</label> -->
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <div class="input-group date">
                                    <input type="text" class="form-control datepicker-custom-rtl" value="<?php echo date("Y-m-d");?>" id="toDate" name="toDate"  placeholder="اختيار تاريخ">
                                    <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">اسم الكوبون </label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" id="cobon_name" name="cobon_name" title="اسم الكوبون" data-size="7" data-live-search="true">
                                    <?php foreach ($cobone as $row) { ?>
                                        <option value="<?= esc($row['id']); ?>"> <?= esc($row['title']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">تصنيف الكوبون </label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" id="Adis" name="Adis" title="تصنيف الكوبون" data-size="7" data-live-search="true">
                                    <?php foreach ($Adis as $row) { ?>
                                        <option value="<?= esc($row['id']); ?>"> <?= esc($row['name']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">اختر المؤسسة المانحة </label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" id="donation" name="donation" title="اختر المؤسسة المانحة" data-size="7" data-live-search="true">
                                    <?php foreach ($donation as $row) { ?>
                                        <option value="<?= esc($row['id']); ?>"> <?= esc($row['name']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">ارقام الهوايا <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <textarea required name="idsnumber" rows="20"></textarea>
                            </div>
                        </div>



                        <div class="card-footer">
                            <div class="row">
                                <label class="col-form-label text-right col-lg-3 col-sm-12"></label>
                                <div class="col-lg-6 col-md-9 col-sm-12">
                                    <button type="submit" id="check-btn" class="btn btn-primary mr-2">
                                        فحص
                                    </button>
                                    <button type="reset" class="btn btn-secondary">الغاء الامر</button>
                                </div>
                            </div>
                        </div>
                    </form>



                <!-- ************** start data table ************** -->

                <!-- ************** end data table **************** -->

                <!-- **************************************************************** -->
                <!-- *******************  نهاية  سجل الحركات   ****************** -->
                <!-- **************************************************************** -->


            </div>

        </div>

    </div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
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

            });


        });

        // ------------------------------------------------------------------------------------
    </script>
<?= $this->endSection() ?>


    <!-- *********************************************** -->
<?= $this->section('styles') ?>
    <style>
        /* #kt_wrapper {
            padding-top: 35px;
        } */

        .select2.select2-container.select2-container--default {
            width: 100% !important;
        }

        div#error_mas {
            color: red;
            font-weight: 800;
            font-size: 16px;
        }

        div#error_mas ul li {
            font-size: 14px;
            color: black;
        }

        div#error_mas ul {
            list-style-type: auto !important;
            margin-right: 25px;
            margin-top: 5px;
        }
        #sub_category_FILTER option,
        #sub_category_FILTER option {
            display: none;
        }
    </style>

<?= $this->endSection() ?>