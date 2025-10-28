<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  إدارة المساعدات </h3>
                </div>

                <!-- زر الفلتر -->
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#dt_filters">
                <span>
                    <i class="fa fa-filter"></i>
                    <span> الفلاتر </span>
                </span>
                </button>

            </div>

            <div class="card-body">




                <!-- ************** start data table ************** -->


                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>  اسم المشروع </th>
                        <th> الجهة المانحة </th>
                        <th> نوع الاستفادة </th>
                        <th> التاريخ </th>
                        <th> عدد المستفيدين </th>
                        <th> الملاحظات </th>
                        <th> اجراءات </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($AdisSow as $aid) { $i++; ?>
                    <tr>
                        <td style="width: 50px;"><?php echo $i;?></td>
                        <td> <?php echo $aid['title'];?> </td>
                        <td> <?php echo $aid['donation_name'];?> </td>
                        <td> <?php echo $aid['aids_name'];?> </td>
                        <td> <?php echo $aid['date'];?> </td>
                        <td> <?php echo $aid['count'];?>  </td>
                        <td> <?php echo $aid['note'];?>  </td>
                        <td>
                            <button type="button"  data-SEQ="<?php echo $aid['id'];?>" data-NAME="<?php echo $aid['title'];?>" class="btn btn-secondary" href="javascript:;" data-target="#add-item" data-toggle="modal">
                                <i class="fas fa-boxes"></i>
                                إضافة مجموعة
                            </button>
                            <a href="<?= base_url(); ?>/AdisManage/addAidsFromPerson/<?php echo $aid['id'];?>" class="btn btn-secondary">
                                <i class="fas fa-user"></i>
                                إختيار افراد
                            </a>
                            <a href="<?= base_url(); ?>/AdisManage/addAidsPersonIds/<?php echo $aid['id'];?>" class="btn btn-secondary">
                                <i class="fas fa-user"></i>
                                إضافة ارقام هوايا
                            </a>
                            <a href="<?= base_url(); ?>/AdisManage/viewAidsFromPerson/<?php echo $aid['id'];?>" class="btn btn-secondary">
                                <i class="fas fa-user-check"></i>
                                عرض المستفيدين
                            </a>
                            <a href="<?= base_url(); ?>/export/exportAidsFromPerson/<?php echo $aid['id'];?>" class="btn btn-secondary">
                                <i class="fas fa-file-excel"></i>
                                تصدير المستفيدين
                            </a>
                            <a href="<?= base_url(); ?>/Report/aid_p/<?php echo $aid['id'];?>" class="btn btn-secondary" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                                تصدير pdf
                            </a>
                            <a href="<?= base_url(); ?>/AdisManage/updateCobon/<?php echo $aid['id'];?>" class="btn btn-secondary">
                                <i class="fas fa-edit"></i>
                                تعديل
                            </a>
                            <button type="button"  data-SEQ="<?php echo $aid['id'];?>" data-NAME="<?php echo $aid['title'];?>" class="btn btn-secondary" href="javascript:;" data-target="#export_data_by_block" data-toggle="modal">
                                <i class="fas fa-boxes"></i>
                                تصدير pdf حسب المندوب
                            </button>
                            <a href="<?= base_url(); ?>/Report/aid_p/person/<?php echo $aid['id'];?>" class="btn btn-secondary" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                                تصدير المستفيدين pdf
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



    <!-- مودال الحذف -->
    <div class="modal fade" id="add-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                                <span>
                                    <span><i class="far fa-save"></i></span>
                                    <span>إضافة التجمعات</span>
                                    <span> على الكوبوت \ </span>
                                    <span id="cobon_name">  </span>
                                </span>
                    </h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body fs-1-15rem">

                    <form action="#" id="form_add_group" method="post">


                                    <table class="table table-separate table-head-custom table-checkable table-striped dataTable no-footer">
                                        <tr>
                                            <th>#</th>
                                            <th>اسم التجمع</th>
                                            <th>المفوض</th>
                                            <th>رقم الجوال</th>
                                            <th>عدد المستفيدين </th>
                                        </tr>
                                        <?php foreach ($block as $item) { ?>
                                        <tr>
                                            <td>
                                                <label class="checkbox checkbox-single checkbox-primary mb-0">
                                                    <input type="checkbox" name ="block" value="<?php echo $item['id'];?>" class="checkable checkable_group"/>
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>
                                                <?php echo $item['title'];?>
                                            </td>
                                            <td>
                                                <?php echo $item['p_name'];?>
                                            </td>
                                            <td>
                                                <?php echo $item['p_mob'];?>
                                            </td>
                                            <td>
                                                <?php echo $item['count'];?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </table>


                        <input type="hidden" value="" id="add_group_id">

                    </form>
                    <div id="error_mas"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                                <span>
                                    <span><i class="fa fa-times"></i></span>
                                    <span>إغلاق</span>
                                </span>
                    </button>
                    <button type="button" id="add_btn_MODAL" class="btn btn-sm btn-danger">
                                <span>
                                    <span><i class="far fa-save"></i></span>
                                    <span>إضافة</span>
                                </span>
                    </button>
                </div>
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
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">التجمع  <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" id="block_num" name="block_num" title="التجمع " data-size="7" data-live-search="true">
                                    <?php foreach ($BlockList as $row) { ?>
                                        <option value="<?= esc($row['id']); ?>"> <?= esc($row['title']); ?></option>
                                    <?php } ?>
                                </select>
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



        $("#add-item").on("show.bs.modal", function(e) {
            let link = $(e.relatedTarget);
            let seq = link.data('seq');
            let name = link.data('name');
            $("#add_group_id").val(seq);
            seq_id = seq;
            $("#error_mas").html(" ")
            $("#cobon_name").html(name);
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



        $("#add_btn_MODAL").click(function(event) {

            event.preventDefault();
            KTApp.block('#add-item');
            $("#error_mas").html(' ')
            //var data_input = new FormData();
            var group_id = [];
            jQuery(".checkable_group:checked").each(function() {
                group_id.push(jQuery(this).val());
            });
            //data_input.append("group_data_id", seq_id);
            //data_input.append("group_id", group_id);

            // data_input.push({
            //     name: "group_data_id",
            //     value: seq_id
            // });
            // data_input.push({
            //     name: "group_id",
            //     value: data_input
            // });
            $.ajax({
                url: '<?= base_url(); ?>/AdisManage/addAidsFromGroup',
                type: "POST",
                data: {
                    'group_data_id': seq_id,
                    'group_id': group_id
                },
                dataType: "JSON",
                success: function(data) {
                    toastr.success(data.message);
                    KTApp.unblock('#add-item');
                    if(data.error_count){
                        $("#error_mas").html('الاسماء المدخلة سابقا لنفس الكوبون<ul>'+data.error_html+'</ul>')
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    KTApp.unblock('#add-item');
                    toastr.error("يوجد حطأ! في الاجراءات, يرجى المحاوله فيما بعد.");
                    return false;
                }
            });
        });

        $("#block_change_btn_MODAL").click(function(event) {

            event.preventDefault();
            KTApp.block('#export_data_by_block');
            $("#error_mas_block").html(' ')
            var link = "<?php echo base_url('Report/aid/person');?>"+'/'+$("#block_num").val()+'/'+$("#aid_id").val()

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