<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark"> اضافة ارقام هوايا على الكوبون \ <?php echo $cobone['title']; ?> </h3>
                </div>



            </div>

            <div class="card-body">
                <?php if(!isset($AdisSow)){ ?>
                <form action="<?= base_url() ?>/AdisManage/addAidsPersonIds/add/<?php echo $id;?>" method="post">
                    <div class="card-body">
                        <div class="form-group row  cct-1">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">الكمية
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input class="form-control" type="number" placeholder="الكمية" value="1" id="quantity" name="quantity">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12"> ارقام الهوايا <span class="text-danger">*</span></label>
                        <div class="col-lg-6 col-md-9 col-sm-12">
                            <textarea name="idsnumber" rows="20"></textarea>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="اضافة">
                </form>
                <?php } ?>


                <!-- ************** start data table ************** -->
                <?php if(isset($AdisSow)){ ?>

                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الهوية</th>
                        <th>سبب الرفض</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($AdisSow as $aid) { $i++; ?>
                        <tr>
                            <td style="width: 50px;"><?php echo $i;?></td>
                            <td> <?php echo $aid['id'];?> </td>
                            <td> <?php echo $aid['error'];?> </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
                <?php } ?>
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

        var seq_id = 0;
        var reports_and_statistics_dt = $('#reports_and_statistics_dt').DataTable({
            "pageLength": 10,
            "processing": true,
            "serverSide": false,
            "searching": true,
            "scrollX": true,
            "emptyTable": "لا يوجد بيانات لعرضها",
            "language": {
                "url": "<?= base_url() ?>/assets/plugins/custom/datatables/ar.json"
            },
            "order": false,
            "aLengthMenu": [
                [20, 100, 500],
                [20, 100, 500]
            ],


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