<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>





    <div class="row ">
        <div class="col-lg-12">
            <?php if(isset($_GET['success'])){?>
                <div class="alert alert-success">
                    <?php echo $_GET['success'];?>
                </div>
            <?php } ?>
            <?php if(isset($_GET['error'])){?>
                <div class="alert alert-dark">
                    <?php echo $_GET['error'];?>
                </div>
            <?php } ?>
        </div>
    </div>


    <div class="card card-custom wave wave-animate p-6 mb-8">
        <div class="card-body">
            <!--begin::Heading-->
            <h2 class="text-dark mb-8">لجنة الإغاثة - محافظة خان يونس </h2>
            <!--end::Heading-->
            <!--begin::Content-->
            <h4 class="font-weight-bold text-dark mb-4">نظام إدارة المساعدات </h4>
            <!--
            <div class="text-dark-70 line-height-lg mb-8">
                <p class="font-weight-bolder">
                     </p>
                <ul style="list-style-type: circle;">
                    <li>
                        <p>إدارة المساعدات الغذائية
                        </p>
                    </li>
                    <li>
                        <p> إدارة المساعدات الصحية
                        </p>
                    </li>
                    <li>
                        <p>إدارة المساعات الإغاثية
                        </p>
                    </li>
                </ul>
            </div>
            -->
            <!--end::Content-->
        </div>
    </div>
<?php if(isset($admin_set) && $admin_set){ ?>
    <div class="row">
        <div class="col-12 col-md-12 mb-8">
            <div class="vertical-bar-chart border border-radius-5 simple-shadow bg-white">
                <canvas class="p-2" id="linear_chart" height="300px"></canvas>
            </div>
        </div>
    </div>
<?php } ?>
<?php
$a=array("card card-custom bg-danger bg-hover-state-danger card-stretch gutter-b",
    "card card-custom bg-primary bg-hover-state-primary card-stretch gutter-b",
    "card card-custom bg-success bg-hover-state-success card-stretch gutter-b",
    "card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b",
    "card card-custom bg-info bg-hover-state-info card-stretch card-stretch gutter-b");
?>


    <div class="row ">
        <div class="col-lg-12">
            <!--begin::Callout-->
            <div class="card card-custom p-5">
                <div class="card-body">
                    <div class="row">
                        <?php
                        if(!empty($reportAll)){
                            foreach ($reportAll as $row){
                                $random_keys=array_rand($a,2);
                                ?>

                                <div class="col-xl-4">
                                    <!--begin::Stats Widget 13-->
                                    <a href="#" class="<?php echo $a[$random_keys[0]];?>">
                                        <!--begin::Body-->
                                        <div class="card-body" style="padding-top: 10px;">

                                            <div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5" style="font-size: 90px !important;margin: 0px !important;line-height: 1;"><?php echo $row['count'];?></div>
                                            <div class="font-weight-bold text-inverse-danger font-size-sm" style="font-size: 17px;"> <?php echo $row['name'];?>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Stats Widget 13-->
                                </div>
                                <!--end::Content-->
                            <?php }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 col-md-6 mt-8">
            <h3>حالة المسكن</h3>
            <div class="vertical-bar-chart border border-radius-5 simple-shadow bg-white">
                <canvas class="p-2" id="pie_chart" height="300px"></canvas>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-8">
            <h3> حالة دخل الاسر</h3>
            <div class="vertical-bar-chart border border-radius-5 simple-shadow bg-white">
                <canvas class="p-2" id="pie_chart2" height="300px"></canvas>
            </div>
        </div>
    </div>



<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="<?php echo base_url("assets/chart.js") ?>"></script>
    <script>
        const pie_chart = document.getElementById('pie_chart');
        new Chart(pie_chart, {
            type: 'pie',
            data: {
                labels: [<?php
                    foreach ($home_status as $keyhome_status=>$valhome_status) {
                        echo'"'.$keyhome_status.'",';
                    }?>],
                datasets: [{
                    display: true,
                    label: '#',
                    data: [<?php
                        foreach ($home_status as $keyhome_status=>$valhome_status) {
                            echo'"'.$valhome_status.'",';
                        }?>],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(255, 203, 114)',
                        'rgb(73, 214, 133)',
                        'rgb(236, 58, 58)',
                        // 'rgb(254, 201, 112)',
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: false,
                        beginAtZero: false,
                    },
                    y: {
                        display: false,
                        beginAtZero: false,
                    }
                }
            }
        });

        const pie_chart2 = document.getElementById('pie_chart2');
        new Chart(pie_chart2, {
            type: 'pie',
            data: {
                labels: [<?php
                    foreach ($income as $keyincome=>$valincome) {
                        echo'"'.$keyincome.'",';
                    }?>],
                datasets: [{
                    display: true,
                    label: '#',
                    data: [<?php
                        foreach ($income as $keyincome=>$valincome) {
                            echo'"'.$valincome.'",';
                        }?>],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgb(255, 203, 114)',
                        'rgb(73, 214, 133)',
                        'rgb(236, 58, 58)',
                        // 'rgb(254, 201, 112)',
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: false,
                        beginAtZero: false,
                    },
                    y: {
                        display: false,
                        beginAtZero: false,
                    }
                }
            }
        });

        <?php if(isset($admin_set) && $admin_set){ ?>
        const linear_chart = document.getElementById('linear_chart');
        new Chart(linear_chart, {
            type: 'bar',
            data: {
                labels: [<?php
                    foreach ($person_dates as $val) {
                        echo'"'.$val->month.'",';
                    }
                    ?>],
                datasets: [{
                    label: "عدد المسجلين",
                    data: [<?php
                        foreach ($person_dates as $val) {
                            echo'"'.$val->total_data.'",';
                        }
                        ?>],
                    backgroundColor: 'rgba(236, 58, 58, 1)',
                    borderColor: 'rgb(236, 58, 58)',
                    borderWidth: 2
                },
                    {
                        label: "عدد المشاريع المنفذة",
                        // fillColor: "rgba(220,220,220,0.2)",
                        // strokeColor: "rgba(220,220,220,1)",
                        // pointColor: "rgba(220,220,220,1)",
                        // pointStrokeColor: "#fff",
                        // pointHighlightFill: "#fff",
                        // pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [
                            <?php
                            foreach ($aidPerson_dates as $valaid) {
                                echo'"'.$valaid->total_data.'",';
                            }
                            ?>
                        ],
                        backgroundColor: 'rgba(0, 128, 0, 1)',
                        borderColor: 'rgb(0, 128, 0)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                lineTension: 0.5,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'عدد المسجلين والكابونات الموزعة خلال العام الحالي',
                            font: {
                                size: 16,
                                weight: 900,
                            }
                        }
                    },
                }
            }
        });
        <?php } ?>
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