<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">تحديد التجمعات التابعة ل /
                    <?php echo $user['name'];?>
                    </h3>
                </div>



            </div>

            <div class="card-body">




                <!-- ************** start data table ************** -->
                <form method="post" action="<?= base_url() ?>/User/update/block/group">
                    <input type="hidden" value="<?php echo $user_data;?>"  name="user_data">
                    <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                        <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th> تحديد  </th>
                            <th> اسم التجمع </th>
                            <th> اسم المسؤل </th>
                            <th> رقم الجوال </th>
                            <th> العنوان </th>
                            <th> عدد الافراد  </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; foreach ($Block as $per) { $i++; ?>
                            <tr>
                                <td style="width: 50px;"><?php echo $i;?></td>
                                <td> <input type="checkbox" name="group[]" value="<?php echo $per['id'];?>" <?php echo in_array($per['id'],$userBlock)?'checked':'';?>> </td>
                                <td> <?php echo $per['title'];?> </td>
                                <td> <?php echo $per['p_name'];?> </td>
                                <td> <?php echo $per['p_mob'];?> </td>
                                <td> <?php echo $per['note'];?>  </td>
                                <td> <?php echo $per['count'];?>  </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                    <input type="submit" value="تعديل">
                </form>

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