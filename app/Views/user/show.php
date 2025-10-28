<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  إدارة المستخدمين </h3>
                </div>

                <!-- زر الفلتر -->
                <a href="<?php echo base_url('User/add');?>" class="btn btn-info" >
                <span>
                    <i class="fa fa-filter"></i>
                    <span> إضافة مستخدم </span>
                </span>
                </a>
            </div>

            <div class="card-body">

                <!-- ************** start data table ************** -->

                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>  الاسم  </th>
                        <th> البريد </th>
                        <th> الحالة </th>
                        <th> اجراءات </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($user as $aid) { $i++; ?>
                        <tr>
                            <td style="width: 50px;"><?php echo $i;?></td>
                            <td> <?php echo $aid['name'];?> </td>
                            <td> <?php echo $aid['email'];?> </td>
                            <td> <?php echo $aid['active'] == 1 ?'فعال':'غير فعال';?> </td>
                            <td>
                                <a href="<?= base_url(); ?>/User/Group/<?php echo $aid['id'];?>" class="btn btn-secondary">
                                    <i class="fas fa-user"></i>
                                    تحديد التجمعات
                                </a>
                                <a href="<?= base_url(); ?>/User/change/status/<?php echo $aid['id'];?>/<?php echo $aid['active'] == 1 ?'0':'1';?>" class="btn btn-secondary">
                                    <i class="fas <?php echo $aid['active'] == 1 ?'fa-user-lock':'fa-user-check';?>"></i>
                                     تغيير حالة المستخدم
                                </a>
                                <a href="<?= base_url(); ?>/User/update/<?php echo $aid['id'];?>" class="btn btn-secondary">
                                    <i class="fas fa-user-edit"></i>
                                      تعديل المستخدم
                                </a>
                            </td>

                        </tr>
                    <?php } ?>

                    </tbody>
                </table>

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