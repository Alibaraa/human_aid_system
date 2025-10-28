<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  إدارة المناطق </h3>
                </div>



            </div>

            <div class="card-body">




                <!-- ************** start data table ************** -->


                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th> اسم المنطقة الكبرى </th>
                        <th> اسم المنطقة </th>
                        <th> اسم مسؤل المنطقة </th>
                        <th> رقم الجوال </th>
                        <th> العنوان </th>
                        <th> عدد المربعات </th>
                        <th> التحكم </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($Block as $per) { $i++; ?>
                        <tr>
                            <td style="width: 50px;"><?php echo $i;?></td>
                            <td> <?php echo $per['general_area'];?> </td>
                            <td> <?php echo $per['title'];?> </td>
                            <td> <?php echo $per['m_title'];?> </td>
                            <td> <?php echo $per['mobile'];?> </td>
                            <td> <?php echo $per['note'];?>  </td>
                            <td> <?php echo $per['count'];?>  </td>
                            <td>
                                <a href="<?= base_url(); ?>/AreaManager/edit/<?php echo $per['id'];?>" class="btn btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    تعديل
                                </a>

                                <a href="<?= base_url(); ?>/AreaManager/ExportData/<?php echo $per['id'];?>" target="_blank" class="btn btn-secondary">
                                    <i class="fas fa-file-excel"></i>
                                    تصدير المستفيدين
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

        $("#export_data_by_block").on("show.bs.modal", function(e) {
            let link = $(e.relatedTarget);
            let seq = link.data('seq');
            let name = link.data('name');
            $("#aid_id").val(seq);
            seq_id = seq;
            $("#error_mas_block").html(" ")
            $("#cobon_name_block").html(name);
        });

        $("#block_change_btn_MODAL").click(function(event) {

            event.preventDefault();
            KTApp.block('#export_data_by_block');
            $("#error_mas_block").html(' ')
            var link = "<?php echo base_url('Report/block/person');?>"+'/'+$("#aid_id").val()+'/'+$("#start").val()+'/'+$("#num").val()

            window.open(link, '_blank');
            KTApp.unblock('#export_data_by_block');
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