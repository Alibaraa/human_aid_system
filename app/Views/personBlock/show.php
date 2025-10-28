<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  إدارة المستفيدين التابعن للمندوب</h3>
                </div>



            </div>

            <div class="card-body">




                <!-- ************** start data table ************** -->


                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th> رقم الهوية </th>
                        <th> الاسم الرباعي </th>
                        <th> رقم الجوال </th>
                        <th> الجوال البديل </th>
                        <th> عدد الافراد  </th>
                        <th> المربع </th>
                        <th> مسؤل المربع </th>
                        <th>  جوال مسؤل المربع </th>
                        <th> حالة المستفيد </th>
                        <th> ملاحظات </th>
                        <th> التحكم </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($person as $per) { $i++; ?>
                    <tr>
                        <td style="width: 50px;"><?php echo $i;?></td>
                        <td> <?php echo $per['pid'];?> </td>
                        <td> <?php echo $per['fname'];?> <?php echo $per['sname'];?> <?php echo $per['tname'];?> <?php echo $per['lname'];?>  </td>
                        <td> <?php echo $per['mob_1'];?> </td>
                        <td> <?php echo $per['mob_2'];?> </td>
                        <td> <?php echo $per['f_num'];?>  </td>
                        <td> <?php echo $per['title'];?> </td>
                        <td> <?php echo $per['p_name'];?> </td>
                        <td> <?php echo $per['p_mob'];?> </td>
                        <td> <?php if($per['isdelet'] == 0){echo'فعال';}else{echo'غير فعال';} ?> </td>
                        <td> <?php echo $per['note'];?> </td>
                        <td>
                            <a href="<?= base_url(); ?>/AdisManage/viewAidsPerson/<?php echo $per['p_id'];?>" class="btn btn-secondary">
                                <i class="fas fa-first-aid"></i>
                                عرض المساعدات
                            </a>
                            <a href="<?= base_url(); ?>/personBlock/editPerson/<?php echo $per['p_id'];?>" class="btn btn-secondary">
                                <i class="fas fa-first-aid"></i>
                                تعديل
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

        #sub_category_FILTER option,
        #sub_category_FILTER option {
            display: none;
        }
    </style>

<?= $this->endSection() ?>