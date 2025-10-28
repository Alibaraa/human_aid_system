<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  تقرير بالمستفيدين    </h3>
                </div>



            </div>

            <div class="card-body">

                <form action="<?= base_url() ?>/export/filter/daly/report" method="post">

                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">من تاريخ</label>
                        <!-- <label class="col-form-label text-right col-lg-3 col-sm-12">Minimum Setup</label> -->
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker-custom-rtl" value="<?php echo isset($fromDate)?$fromDate:date("Y-m-d");?>" id="fromDate" name="fromDate"  placeholder="اختيار تاريخ">
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
                                <input type="text" class="form-control datepicker-custom-rtl" value="<?php echo isset($toDate)?$toDate:date("Y-m-d");?>" id="toDate" name="toDate"  placeholder="اختيار تاريخ">
                                <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                                </div>
                            </div>
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

                <?php if(isset($data)){ ?>
                <div class="row ">
                    <div class="col-lg-12">
                        <!--begin::Callout-->
                        <div class="card card-custom p-5">
                            <div class="card-body">
                                <div class="row">
                                    <?php

                                        foreach ($data as $row){
                                            ?>

                                            <div class="col-xl-4">
                                                <!--begin::Stats Widget 13-->
                                                <a href="#" class="card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b">
                                                    <!--begin::Body-->
                                                    <div class="card-body" style="padding-top: 10px;">

                                                        <div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5" style="font-size: 90px !important;margin: 0px !important;line-height: 1;"><?php echo $row['count'];?></div>
                                                        <div class="font-weight-bold text-inverse-danger font-size-sm" style="font-size: 17px;"> <?php echo $row['title'];?>
                                                        </div>
                                                    </div>
                                                    <!--end::Body-->
                                                </a>
                                                <!--end::Stats Widget 13-->
                                            </div>
                                            <!--end::Content-->
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>



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
        input.checkbox.checkbox-outline.checkbox-success {
            margin: 10px;
        }
    </style>

<?= $this->endSection() ?>