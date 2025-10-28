<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  إدارة  الممولين </h3>
                </div>
                <!-- زر الفلتر -->
                <a href="<?php echo base_url('constants/add/Donation');?>" class="btn btn-info" >
                <span>
                    <i class="fa fa-filter"></i>
                    <span> إضافة  </span>
                </span>
                </a>

            </div>

            <div class="card-body">

                <!-- ************** start data table ************** -->
                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th> اسم  </th>
                        <th> الملاحظات  </th>
                        <th> التحكم </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($Donation as $per) { $i++; ?>
                        <tr>
                            <td style="width: 50px;"><?php echo $i;?></td>
                            <td> <?php echo $per['name'];?> </td>
                            <td> <?php echo $per['note'];?> </td>
                            <td>
                                <a href="<?= base_url(); ?>/constants/edit/Donation/<?php echo $per['id'];?>" class="btn btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    تعديل
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>



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

        #sub_category_FILTER option,
        #sub_category_FILTER option {
            display: none;
        }
    </style>

<?= $this->endSection() ?>