<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>







    <div class="card card-custom wave wave-animate p-6 mb-8">
        <div class="card-body">
            <!--begin::Heading-->
            <h2 class="text-dark mb-8">التنمية الاجتماعية </h2>
            <!--end::Heading-->
            <!--begin::Content-->
            <h4 class="font-weight-bold text-dark mb-4">البرنامج الشامل </h4>
            <div class="text-dark-70 line-height-lg mb-8">
                <p>نبذه خاصه عن المشروع </p>
                <p class="font-weight-bolder">
                    نبذه بسيطه </p>
                <ul style="list-style-type: circle;">
                    <li>
                        <p> النبذه هنا هنا هنا هان
                        </p>
                    </li>
                    <li>
                        <p> النبذه هنا هنا هنا هان
                        </p>
                    </li>
                    <li>
                        <p> النبذه هنا هنا هنا هان
                        </p>
                    </li>
                </ul>
            </div>
            <!--end::Content-->
        </div>
    </div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        console.log("load custom scripts here")
    </script>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
    <style>
        .dash_table_fo_content_body {
            border-top-left-radius: .42rem;
            border-bottom-left-radius: .42rem;
            border-top-right-radius: .42rem;
            border-bottom-right-radius: .42rem;
            border-bottom: 0;
            letter-spacing: 0px;
            font-weight: 600;
            font-size: .9rem;
            width: 100%;
            margin: auto;
        }

        .dash_table_fo_content_body .dash_table_item {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
            padding: .75rem;
        }


        .dash_table_fo_content_head {
            border-top-left-radius: .42rem;
            border-bottom-left-radius: .42rem;
            border-top-right-radius: .42rem;
            border-bottom-right-radius: .42rem;
            background-color: #f3f6f9;
            border-bottom: 0;
            letter-spacing: 0px;
            font-weight: 600;
            color: #b5b5c3 !important;
            font-size: .9rem;
            width: 100%;
            margin: auto;
        }

        .dash_table_fo_content_head .dash_table_item {
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
            padding: .75rem;
        }

        @media screen and (max-width: 786px) {
            .dash_table_fo_content_body .dash_table_item {
                padding-top: 6px !important;
                padding-bottom: 0px !important;
                padding: 0.5rem;
            }

            .dash_table_fo_content_body {
                margin-bottom: 25px !important;
            }
        }
    </style>
<?= $this->endSection() ?>