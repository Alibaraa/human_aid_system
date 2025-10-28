<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">  عرض المستفيدين على كوبون / <?php echo $personAid['title'];?> </h3>
                </div>

                <!-- زر الفلتر -->


            </div>

            <div class="card-body">
                <?php if($tag == 1){?>
                    <div class="alert alert-success">
                        تمت عملية الحذف بنجاح
                    </div>
                <?php } ?>

                <?php if($tag == 2){?>
                    <div class="alert alert-success">
                        هناك خطأ! يرجى المحاولة فيما بعد
                    </div>
                <?php } ?>

                <form  target="_blank" action="<?php echo base_url("person/data/search/export");?>" method="post" class="kt-form kt-form--fit mb-15" <?php if(isset($_GET['find']) && $_GET['find'] == 'show'){?>style="visibility: hidden;" <?php } ?> id="search-form">
                    <div class="row mb-6">
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> رقم الهوية:</label>
                            <input type="number" class="form-control datatable-input"  name="pid" data-col-index="pid" />
                        </div>

                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> الاسم الاول:</label>
                            <input type="text" class="form-control datatable-input" name="fname"  data-col-index="fname" />
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> اسم الأب:</label>
                            <input type="text" class="form-control datatable-input" name="sname" data-col-index="sname" />
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> اسم الجد:</label>
                            <input type="text" class="form-control datatable-input" name="tname"  data-col-index="tname" />
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> اسم العائلة:</label>
                            <input type="text" class="form-control datatable-input" name="lname"  data-col-index="lname" />
                        </div>

                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> رقم الجوال:</label>
                            <input type="number" class="form-control datatable-input" name="mobile"  data-col-index="mobile"/>
                        </div>

                        <div class="col-lg-2  mb-lg-0 mb-6 mt-5">
                            <label>التجمع:</label>
                            <select class="form-control datatable-input selectpicker" title="اختر التجمع" data-size="7" data-live-search="true"  name="block" data-col-index="block">
                                <option value="0">الكل</option>
                                <?php foreach ($users as $row) {
                                    ?>
                                    <option value="<?= esc($row['id']); ?>"> <?= esc($row['title']); ?></option>
                                <?php  } ?>
                            </select>
                        </div>


                        <div class="row mt-8">
                            <div class="col-lg-12">
                                <button class="btn btn-primary btn-primary--icon" id="kt_search">
                                    <span> <i class="la la-search"></i> <span>بحث</span></span>
                                </button>
                                &nbsp;&nbsp;
                                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                    <span>
                                        <i class="la la-close"></i>
                                        <span>تفريغ</span>
                                    </span>
                                </button>

                            </div>
                        </div>
                    </div>

                </form>


                <!-- ************** start data table ************** -->
                <form action="<?= base_url() ?>/AdisManage/deleteAidsFromPersonInsert" method="post">
                    <input type="hidden" name="cobon_id" value="<?php echo $cobon_id;?>">
                    <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                        <thead>
                        <tr>
                            <th style="width: 50px;"> حذف </th>
                            <th> رقم الهوية </th>
                            <th> الاسم الرباعي </th>
                            <th> رقم الجوال </th>
                            <th> الجوال البديل </th>
                            <th> عدد الافراد  </th>
                            <th> الكمية </th>
                            <th> المربع </th>
                            <th> التاريخ </th>
                            <th>  جوال مسؤل المربع </th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-info" value="حذف">


                </form>
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


        var table = $('#reports_and_statistics_dt').on('preXhr.dt', function(e, settings, data) {

            $('.dataTables_processing .card').attr('display', 'none !important');
            KTApp.block('#kt_datatable3_wrapper', {
                overlayColor: '#000000',
                state: 'danger',
                message: 'جاري التحميل'
            });
        }).on('xhr.dt', function(e, settings, json, xhr) {
            KTApp.unblock('#kt_datatable3_wrapper');
        }).DataTable({

            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html
            "serverMethod": 'POST',
            "searching": false,
            // "ajax": urlAjaxSearch,
            "ajax": {
                "url": "<?php echo site_url('AdisManage/get/person/aids/data') ?>/<?php echo $cobon_id;?>",
                "data": function(d) {
                    var params = {};
                    $('.datatable-input').each(function() {
                        var i = $(this).data('col-index');
                        console.log(i);
                        if (params[i]) {
                            params[i] += '|' + $(this).val();
                        } else {
                            params[i] = $(this).val();
                        }
                    });

                    d.params = params;
                },
                'error': function(jqXHR, textStatus, errorThrown){
                    //$('#kt_datatable3').DataTable().clear().draw();
                }
            },

            "columns": [
                {
                    "data": function (row, type, val, meta) {
                        return '<input type="checkbox" name="user_id[]" value="'+row.cobon_id+'">';
                    }
                },

                {
                    "data": "pid"
                },
                {
                    "data": function (row, type, val, meta) {
                        return row.fname+' '+row.sname+' '+row.tname+' '+row.lname;
                    }
                },

                {
                    "data": "mob_1"
                },
                {
                    "data": "mob_2"
                },
                {
                    "data": "f_num"
                },
                {
                    "data": "quantity"
                },
                {
                    "data": "block_title"
                },
                {
                    "data": "insert_date"
                },
                {
                    "data": "block_p_mob"
                }
            ],
            "order": [
                [0, 'desc']
            ],
            "aLengthMenu": [
                [10, 50, 100],
                [10, 50, 100]
            ],
        });



        $(document).on('click', '#kt_search', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });


        $(document).on('click', '#kt_reset', function(e) {
            e.preventDefault();
            $('#search-form').trigger('reset');

            table.ajax.reload();
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