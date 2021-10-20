<!-- <base href=""> -->
<meta charset="utf-8" />
<title>وزارة التنمية الإجتماعية - <?= (isset($pageTitle)) ? $pageTitle : "" ?></title>
<meta name="description" content="Page with empty content" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!--begin::Fonts-->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo&family=Poppins:300,400,500,600,700" /> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
<!--end::Fonts-->

<!--begin::Page Vendors Styles(used by this page)-->
<!--end::Page Vendors Styles-->


<!--begin::Global Theme Styles(used by all pages)-->
<link href="<?php echo base_url("assets/plugins/global/plugins.bundle.rtl.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("assets/plugins/custom/prismjs/prismjs.bundle.rtl.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("assets/css/style.bundle.rtl.css") ?>" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->

<!--begin::Layout Themes(used by all pages)-->

<link href="<?php echo base_url("assets/css/themes/layout/header/base/light.rtl.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("assets/css/themes/layout/header/menu/light.rtl.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("assets/css/themes/layout/brand/dark.rtl.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("assets/css/themes/layout/aside/dark.rtl.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("assets/css/style.css?v=10") ?>" rel="stylesheet" type="text/css" />
<!--end::Layout Themes-->

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("assets/media/favicon/apple-touch-icon.png") ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("assets/media/favicon/favicon-32x32.png") ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/media/favicon/favicon-16x16.png") ?>">
<link rel="manifest" href="<?php echo base_url("assets/media/favicon/site.webmanifest") ?>">

<link rel="shortcut icon" href="<?php echo base_url("assets/media/favicon/favicon.ico") ?>" />
<?= $this->renderSection('styles') ?>

<style>
    body,
    html {
        font-family: 'Cairo', Helvetica, "sans-serif" !important;
    }

    .tooltip {
        font-family: 'Cairo', Helvetica, "sans-serif" !important;
    }
</style>