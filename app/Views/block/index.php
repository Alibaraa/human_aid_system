<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark"> إدارة التجمعات التابعة للمناطق </h3>
                </div>
            </div>

            <div class="card-body">




                <!-- ************** start data table ************** -->


                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th> عنوان العام </th>
                        <th> عنوان المندوب </th>
                        <th> اسم المندوب </th>
                        <th> اسم المسؤل </th>
                        <th> رقم الجوال </th>
                        <th> العنوان </th>
                        <th> عدد الافراد الفعالين </th>
                        <th> عدد الافراد الغير فعالين </th>
                        <th> الحد الاقصى لإستعاب المربع </th>
                        <th> التحكم </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($Block as $per) { $i++; ?>
                        <tr>
                            <td style="width: 50px;"><?php echo $i;?></td>
                            <td> <?php echo $per['area_title'];?> </td>
                            <td> <?php echo $per['area_manager_title'];?> </td>
                            <td> <?php echo $per['title'];?> </td>
                            <td> <?php echo $per['p_name'];?> </td>
                            <td> <?php echo $per['p_mob'];?> </td>
                            <td> <?php echo $per['note'];?>  </td>
                            <td> <?php echo $per['count'];?>  </td>
                            <td> <?php echo $per['removecount'];?>  </td>
                            <td> <?php echo $per['limit_num'];?>  </td>
                            <td>
                                <a href="<?= base_url(); ?>/block/edit/<?php echo $per['id'];?>" class="btn btn-secondary">
                                    <i class="fas fa-edit"></i>
                                    تعديل
                                </a>
                                <a href="<?= base_url(); ?>/block/showPerson/<?php echo $per['id'];?>" target="_blank" class="btn btn-secondary">
                                    <i class="fas fa-street-view"></i>
                                    عرض المستفيدين
                                </a>
                                <a href="<?= base_url(); ?>/block/ExportData/<?php echo $per['id'];?>" target="_blank" class="btn btn-secondary">
                                    <i class="fas fa-file-excel"></i>
                                    تصدير المستفيدين
                                </a>
                                <button type="button"  data-SEQ="<?php echo $per['id'];?>" data-NAME="<?php echo $per['title'];?>" class="btn btn-secondary" href="javascript:;" data-target="#export_data_by_block" data-toggle="modal">
                                    <i class="fas fa-boxes"></i>
                                    تصدير pdf حسب العدد
                                </button>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>



            </div>

        </div>

    </div>






    <!-- مودال الحذف -->
    <div class="modal fade" id="export_data_by_block" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                                <span>
                                    <span><i class="far fa-save"></i></span>
                                    <span>تصدير الاسماء </span>
                                    <span> من الكوبوت \ </span>
                                    <span id="cobon_name_block">  </span>
                                </span>
                    </h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body fs-1-15rem">

                    <form action="#" id="block_change_pdf"  method="get">
                        <div class="form-group row  cct-1">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">البدء من
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input class="form-control" type="number" placeholder="ادخل عنوان الكوبون" value="0" id="start" name="start">
                            </div>
                        </div>
                        <div class="form-group row  cct-1">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">عدد الاسماء
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <input class="form-control" type="number" placeholder="ادخل عنوان الكوبون" value="100" id="num" name="num">
                            </div>
                        </div>

                        <input type="hidden" value="" id="aid_id">
                    </form>
                    <div id="cobon_name_block"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                                <span>
                                    <span><i class="fa fa-times"></i></span>
                                    <span>إغلاق</span>
                                </span>
                    </button>
                    <button type="button" id="block_change_btn_MODAL" class="btn btn-sm btn-danger">
                                <span>
                                    <span><i class="far fa-save"></i></span>
                                    <span>تصدير PDF</span>
                                </span>
                    </button>

                </div>
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