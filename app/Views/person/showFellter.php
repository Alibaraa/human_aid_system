<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">فلترة المستفيدين</h3>
                </div>
            </div>
            <div class="card-body">
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

                        <div class="col-lg-2  mb-lg-0 mb-6">
                            <label>المندوب:</label>
                            <select class="form-control datatable-input selectpicker" title="اختر المندوب" data-size="7" data-live-search="true"  name="block" data-col-index="block">
                                <option value="0">الكل</option>
                                <?php foreach ($users as $row) {
                                    ?>
                                    <option value="<?= esc($row['id']); ?>"> <?= esc($row['title']); ?></option>
                                <?php  } ?>
                            </select>
                        </div>
                        <div class="col-lg-2  mb-lg-0 mb-6">
                            <label>معامل عدد الافراد:</label>
                            <select class="form-control datatable-input selectpicker" title="معامل عدد الافراد" data-size="7" data-live-search="true"  name="operator" data-col-index="operator">
                                <option value="0">الكل</option>
                                <option value="1">اكبر من</option>
                                <option value="2">اصغر من</option>
                                <option value="3">يساوي</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> عدد الافراد :</label>
                            <input type="number" class="form-control datatable-input" name="fcount" data-col-index="fcount" />
                        </div>

                        <div class="col-lg-2  mb-lg-0 mb-6">
                            <label>معامل عدد المساعدات:</label>
                            <select class="form-control datatable-input selectpicker" title="معامل عدد المساعدات" data-size="7" data-live-search="true"  name="operatoraids" data-col-index="operatoraids">
                                <option value="0">الكل</option>
                                <option value="1">اكبر من</option>
                                <option value="2">اصغر من</option>
                                <option value="3">يساوي</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-lg-0 mb-6">
                            <label> عدد المساعدات المستلمة :</label>
                            <input type="number" min="1" class="form-control datatable-input" name="countaids" data-col-index="countaids" />
                        </div>
                        <div class="col-lg-2  mb-lg-0 mb-6">
                            <label>حالة المستفيد</label>
                            <select class="form-control datatable-input selectpicker" title="حالة المستفيد" data-size="7" data-live-search="true" name="active" data-col-index="active">
                                <option value="0">فعال</option>
                                <option value="1">غير فعال</option>
                            </select>
                        </div>

                        <div class="row mt-8">
                            <div class="col-lg-12">
                                <button class="btn btn-primary btn-primary--icon" id="kt_search">
                        <span>
                            <i class="la la-search"></i>
                            <span>بحث</span>
                        </span>
                                </button>
                                &nbsp;&nbsp;
                                <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                        <span>
                            <i class="la la-close"></i>
                            <span>تفريغ</span>
                        </span>
                                </button>
                                <button type="submit" class="btn btn-primary btn-primary--icon">
                                    <span>
                                        <i class="la la-file-excel"></i>
                                        <span>تصدير اكسل</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-8">
                        <div class="col-lg-12">

                            &nbsp;&nbsp;

                        </div>
                    </div>
                </form>

                <!-- ************** start data table ************** -->


                <table class="table table-separate table-head-custom table-checkable table-striped" id="reports_and_statistics_dt">
                    <thead>
                    <tr>
                        <th> رقم الهوية </th>
                        <th> الاسم الرباعي </th>
                        <th> رقم الجوال </th>
                        <th> عدد الافراد </th>
                        <th> عدد المساعدات </th>
                        <th> المربع </th>
                        <th> حالة المستفيد </th>
                        <th> الملاحظات </th>
                        <th> تاريخ الاضافة </th>
                        <th> التحكم </th>
                    </tr>
                    </thead>
                    <tbody>

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
                "url": "<?php echo site_url('person/data/felter/get') ?>",
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
            "columnDefs": [{
                targets: -1,
                title: 'الاجراءات',
                orderable: false,
                render: function(data, type, full, meta) {
                    return '\
                        \<a href="<?= base_url(); ?>/AdisManage/viewAidsPerson/'+full.p_id+'" class="btn btn-secondary"><i class="fas fa-first-aid"></i>عرض المساعدات </a>\
                        \<a href="<?= base_url(); ?>/person/editPerson/'+full.p_id+'" class="btn btn-secondary"> <i class="fas fa-first-aid"></i>تعديل </a>\
                       ';
                },
            }],


            "columns": [{
                "data": "pid"
                //"visible": false
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
                    "data": "f_num"
                },
                {
                    "data": "aids_count"
                },
                {
                    "data": "title"
                },
                {
                    "data": function (row, type, val, meta) {
                        if(row.isdelet == 0){
                            return 'فعال';
                        }else{
                            return 'غير فعال';
                        }
                    }
                },
                {
                    "data": "note"
                },
                {
                    "data": "person_insert_date"
                },
                {
                    "data": "Actions"
                },
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