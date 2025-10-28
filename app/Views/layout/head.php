<!-- <base href=""> -->
<meta charset="utf-8" />
<title>برنامج ادارة وتنظيم المساعدات  - <?= (isset($pageTitle)) ? $pageTitle : "" ?></title>
<meta name="description" content="Page with empty content" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!--begin::Fonts-->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo&family=Poppins:300,400,500,600,700" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
end::Fonts-->
<style>
    /* arabic */
    @font-face {
        font-family: 'Cairo';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(<?php echo base_url("assets/fontsgoogle/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-a1biLD-H.woff2") ?>) format('woff2');
        unicode-range: U+0600-06FF, U+0750-077F, U+0870-088E, U+0890-0891, U+0898-08E1, U+08E3-08FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE70-FE74, U+FE76-FEFC;
    }
    /* latin-ext */
    @font-face {
        font-family: 'Cairo';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(<?php echo base_url("assets/fontsgoogle/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-a13iLD-H.woff2") ?>) format('woff2');
        unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }
    /* latin */
    @font-face {
        font-family: 'Cairo';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(<?php echo base_url("assets/fontsgoogle/SLXgc1nY6HkvangtZmpQdkhzfH5lkSs2SgRjCAGMQ1z0hOA-a1PiLA.woff2") ?>) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
    .lable_passward {
        text-align: right !important;
    }
</style>
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