<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

    <div class="flex-row-fluid">
        <!-- ml-lg-8 -->
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header position-relative align-items-center py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark"> فحص ارقام الهوايا </h3>
                </div>



            </div>

            <div class="card-body">

                    <form action="<?= base_url() ?>/person/data/check" method="post">
                        <textarea name="idsnumber" rows="20"></textarea>
                        <br>
                        <input type="submit" value="فحص">
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