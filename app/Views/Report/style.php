<style>
    /*
genral
*/
    body {
        direction: rtl;
        font-family: cairo;
    }
    * {
        direction: rtl;
        font-family: cairo;
    }

    /*
End genral
*/

    .cover-image {
        /* margin-top: 11%; */
        display: block;
        text-align: center;
    }

    .pdfContener_home {
        /* margin-top: 11%; */
        /* height: 50%; */
    }

    .pdfContener_home h1.home_title_pdf {
        margin-top: 100px;
        text-align: center;
        font-size: 50px;
        color: black;
        margin-bottom: 10px;
    }

    .pdfContener_home h2.home_sup_title_pdf {
        text-align: center;
        font-size: 35px;
        max-width: 460px;
        color: white;
        padding: 10px;
        width: auto;
        background-color: #2364aa;
        margin: auto;
        border-right: 45px solid #00296b;
        border-left: 45px solid #00296b;
    }

    .file_info {
        margin-top: 100px;
    }

    .file_info .file_info_table td:nth-child(1) {
        text-align: center;
        background: #2364aa;
        color: #fff;
        font-size: 16px;
        padding: 2px;
        font-weight: 600;
    }

    .file_info .file_info_table td:nth-child(2) {
        text-align: center;
        background: #f2f2f2;
        color: #020116;
        font-size: 16px;
        padding: 2px;
        font-weight: 600;
    }


    /* PAGE 2 */


    .pdfContener_two h1.title_pdf {
        text-align: center;
        font-size: 40px;
        color: black;
    }

    .pdfContener_two table.member_data td:nth-child(2) {
        text-align: center;
        width: 350px;
    }

    .pdfContener_two table.member_data {
        font-size: 20px;
        margin: 60px auto 0px;
        border-top: 5px solid #003f88;
        border-bottom: 5px solid #003f88;
    }

    .pdfContener_two table.member_data td {
        padding: 10px;
    }


    table.member_data tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table.member_data tr:nth-child(odd) {
        background-color: rgba(0,77,216,0.15);
    }

    tr.last_tr {
        border-top: 5px solid #003f88;
    }

    tr.last_tr td {
        text-align: center;
        border-top: 5px solid #003f88;
        padding: 5px !important;
    }


    /* PAGE 3 */


    .table_of_content2 {
        padding: 0px 10px 10px;
        font-size: 18px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 0px;
        margin-top: 40px;
    }
    .table_of_content2 td{
        padding: 59px;
    }

    .table_of_content {
        padding: 0px 10px 10px;
        font-size: 18px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
        margin-top: -40px;
    }

    table.table_of_content_elemint_one_colomn thead tr {
        text-align: right;
        background-color: rgba(0,77,216,0.1);
        font-size: 18px;
    }

    table.table_of_content_elemint_one_colomn thead tr td {
        padding: 7px;
        font-size: 20px;
        font-weight: 600;
    }

    table.table_of_content_elemint_one_colomn tbody tr td {
        background-color: #f2f2f2;
        padding: 5px;
        font-weight: 600;
    }


    table.table_of_content_elemint_5_colomn thead tr {

        background-color: rgba(0,77,216,0.1);
        font-size: 18px;
    }

    table.table_of_content_elemint_5_colomn thead tr td {
        padding: 7px;
        font-size: 20px;
        font-weight: 600;
    }

    table.table_of_content_elemint_5_colomn thead tr td:nth-child(1) {
        text-align: right;

    }

    table.table_of_content_elemint_5_colomn tbody tr td {
        background-color: #f2f2f2;
        padding: 5px;
        font-weight: 600;
    }

    table.table_of_content_elemint_5_colomn tbody tr td:nth-child(1) {
        width: 6%;
        text-align: center;
    }

    table.table_of_content_elemint_one_colomn thead tr td {
        text-align: right;
    }


    /* PAGE 4 CSS*/
    .default_page h2.default_page_title {
        background-color: rgba(0,77,216,0.1);
        padding: 7px;
        border: 2px solid #00296b;
        color: black;
    }

    .legend_int {
        background-color: rgba(0,77,216,0.2);
        text-align: right;
        padding: 10px;
        font-size: 20px;
        font-weight: 600;
        width: 100%;
        display: block;
        color: black;
        margin: 0px;
    }

    .default_page .fieldset_type_int {
        margin-bottom: 30px;
        padding: 0px;
        border: 0px;
    }





    .fieldset_type_int ul li {
        font-size: 20px;
        color: #885713;
    }

    /* .current-session-decisions-draft {

    } */

    .current-session-decisions-draft,
    .current-session-decisions-draft th,
    .current-session-decisions-draft td {
        border: 1px solid black;
    }

    .current-session-decisions-draft {
        border-collapse: collapse;
    }

    .current-session-decisions-draft .right-side {
        padding: 6px !important;
        font-size: 18px;
        background-color: #fff2cc;
    }


    .current-session-decisions-draft .left-side {
        padding: 7px !important;
        font-size: 18px;
    }

    .fieldset_type_int {
        page-break-inside: avoid;
    }

    @page withheader_addition {
        margin-top: 40mm;
        margin-bottom: 60mm;
        header: html_header;
        footer: html_footer;
    }
    @page withheader_qr {
        margin-top: 10mm;
        margin-bottom: 0mm;
        header: html_header;
        footer: html_footer;
    }
    @page withheader_custody {
        margin-top: 60mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 55mm;
    }
    @page withheader_custody_print {
        margin-top: 48mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 25mm;
    }
    @page withheader_cancelcustody {
        margin-top: 95mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 55mm;
    }
    @page withheader_cancelcustody1 {
        margin-top: 5mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 5mm;
    }
    @page withheader_tranfercustody {
        margin-top: 95mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 55mm;
    }
    @page withheader_statistics {
        margin-top: 55mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 25mm;
    }
    @page withheader_assets {
        margin-top: 55mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 20mm;
    }
    @page withheader_items {
        margin-top: 50mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 55mm;
    }
    @page withheader_items_suppliers {
        margin-top: 70mm;
        header: html_header;
        footer: html_footer;
        margin-bottom: 95mm;
    }

    @page withheader {
        margin-top: 40mm;
        header: html_header;
        footer: html_footer;
    }

    @page :first {
        header: _blank;
        footer: _blank;
    }

    div.pageheader {
        page: withheader;
    }
    div.pageheader_addition {
        page: withheader_addition;
    }
    div.pageheader_qr {
        page: withheader_qr;
    }
    div.pageheader_custody {
        page: withheader_custody;
    }
    div.pageheader_custody_print {
        page: withheader_custody_print;
    }
    div.pageheader_cancelcustody {
        page: withheader_cancelcustody;
    }
    div.pageheader_cancelcustody1 {
        page: withheader_cancelcustody1;
    }
    div.pageheader_tranfercustody {
        page: withheader_tranfercustody;
    }
    div.pageheader_statistics {
        page: withheader_statistics;
    }
    div.pageheader_assets {
        page: withheader_assets;
    }
    div.pageheader_items {
        page: withheader_items;
    }
    div.pageheader_items_suppliers {
        page: withheader_items_suppliers;
    }
    .ddd{
        margin-top: 90px;
    }
    /*
    div.noheader {
        page: firstpage;
    } */

    .fieldset_type_int table,
    .fieldset_type_int td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .table_project .table_project_title {
        padding: 6px !important;
        font-size: 18px;
        background-color: rgba(0,77,216,0.2);
        /* float: right; */
    }

    .fieldset_type_int .table_project_title {
        padding: 6px !important;
        font-size: 18px;
        background-color: rgba(0,77,216,0.2);
        /* background-color: #fff2cc; */
    }



    .fieldset_type_int div.table_project_desc,
    .fieldset_type_int div.table_project_desc p {
        color: black;
    }


    .fieldset_type_int div.table_project_desc table {
        margin: auto auto auto auto;
        width: 100%;
    }

    .fieldset_type_int div.table_project_desc table,
    .fieldset_type_int div.table_project_desc td,
    .fieldset_type_int div.table_project_desc th {
        border: 1px solid black;
        border-collapse: collapse;
    }



    .fieldset_type_int div.table_project_title,
    .fieldset_type_int div.table_project_desc {
        border: 1px solid black;
        border-top: 0px;
    }

    .fieldset_type_int .table_project_desc {
        padding: 7px !important;
        font-size: 18px;
    }


    .table_project .table_project_desc {
        padding: 7px !important;
        font-size: 18px;
        border-right: 1px solid;
        width: calc(100% - 130px);
        /* float: left; */
    }

    .fieldset_type_int .table_project_desc p {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .table_project {
        border: 1px solid;
    }

    /* .clear {
        float: none !important;
        clear: both;
    } */

    .none_border_top {
        border-top: 0 !important;
    }






    /* PAGE 5 CSS*/
    /* .default_page h2.default_page_title {
        background-color: #fff2cc;
        padding: 7px;
        border: 2px solid #996600;
        color: #996600;
    } */

    .default_page .fieldset_type .legend {
        z-index: 2;
        margin-top: 0cm;
        margin-right: 0cm;
        background-color: rgba(0,77,216,0.25);
        padding: 0px;
        font-size: 20px;
        font-weight: 600;
        width: 250px;
        color: black;
        text-align: center;
    }


    /* .no-break {
        page-break-inside: avoid;
    } */

    .default_page .fieldset_type {
        margin-bottom: 30px;
        margin-top: 60px;
        border: 1px solid rgba(0,77,216,0.25);


    }

    /*
    .fieldset_type ul li {
        font-size: 20px;
        color: #885713;
        clear: both;
    } */

    .fieldset_type p {
        font-size: 18px;
        color: black;
        margin: 0px;
        padding: 10px;
        font-weight: normal;
        /* margin: 28px; */
    }







    /* PAGE 6 CSS*/
    .item_number_center {
        padding: 10px;
        text-align: center;
        color: black;
        font-size: 20px;
        font-weight: 600;
        margin-bottom:40px
    }
    .item_number {
        padding: 10px;
        background-color: rgba(0,77,216,0.25);
        color: black;
        font-size: 20px;
        font-weight: 600;
    }
.monestry_and_date{

    width: 100%;
    color: black;
    font-size: 20px;
    font-weight: 600;

}
.monestry_and_date_div_title{
    float: right;
    width: 16%;
    padding: 8px;
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    border-right: 1px solid black;

    margin-right: 2px;
}
.monestry_and_date_div_value{
    float: right;
    width: 30%;
    padding: 8px;
    border-top: 1px solid black;
    border-bottom: 1px solid black;
}
.monestry_and_date_div_date{
    float: right;
    width: 46%;
    text-align: left;
    padding: 8px;
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
}
    tr.f_item_number_tr {
        color: black;font-size: 20px;font-weight: 600;
        /* border:1px solid black; */
        /* border:0px; */
    }

    tr.f_item_number_tr td {
        padding: 8px;
        color: black;
        /* border: 1px solid rgba(0,77,216,0.25); */
        /* border-style: hidden; */
    }

    tr.f_item_number_tr td:nth-child(2) {
        text-align: right;
        font-weight: bolder;
        font-size: 18px;
    }

    tr.f_item_number_tr td:nth-child(3) {
        text-align: left;
        font-weight: bolder;
        font-size: 18px;
    }

    tr.f_item_number_tr td:nth-child(1) {
        width: 140px;
        font-weight: bolder;
        font-size: 18px;
    }











    .table_project {
        background-color: #fff2cc;
    }

    .table_project_desc {
        background-color: #fff;
    }




    /*
    new
    */

    .item_det tr td:nth-child(1) {
        width: 160px;
        background-color: rgba(0,77,216,0.25);
        padding: 8px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        border-right: 1px solid #000;
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
    }

    .item_det tr td:nth-child(2) {
        padding: 8px;
        font-size: 20px;
        font-weight: 600;
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
    }

    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_title {
        padding: 6px !important;
        font-size: 18px;
        background-color: rgba(0,77,216,0.25);
    }

    .AffairsOfMinistriesGovernmentInstitutions div.MinistriesGovernment_title,
    .fieldset_type_int div.MinistriesGovernment_desc {
        border: 1px solid black;
        border-top: 0px;
    }

    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc {
        padding: 7px !important;
        font-size: 18px;
    }






    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc table {
        margin: auto auto auto auto;
        width: 100%;
    }

    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc table,
    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc td,
    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc th {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc p {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    table.item_det {
        margin-top: -4px !important;
    }

    .AffairsOfMinistriesGovernmentInstitutions {
        margin: -2px 2px -2px;
    }

    .MinistriesGovernment_desc {
        border-right: 1px solid black;
        border-left: 1px solid black;
        border-bottom: 1px solid black;
    }

    tr.f_item_number_tr td:nth-child(3) {
        text-align: left;
    }

    .leg {
        margin-top: 0cm;
        margin-right: 0cm;
        background-color: rgba(0,77,216,0.25);
        padding: 8px;
        font-size: 20px;
        font-weight: 600;
        width: 100%;
        color: black;
        text-align: right;
    }

    .Draft_resolution_ul {
        /* margin-right: 1.5cm; */
        padding: 7px;
        font-size: 18px;
    }

    /* .item_det tr td:nth-child(1) {
        width: 160px;
        background-color: rgba(0,77,216,0.25);
        padding: 8px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        border-right: 1px solid #000;
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
    } */

    /* .item_det tr td:nth-child(2) {
        padding: 8px;
        font-size: 20px;
        font-weight: 600;
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
    } */

    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_title {
        padding: 6px !important;
        font-size: 18px;
        background-color: rgba(0,77,216,0.25);
    }

    .AffairsOfMinistriesGovernmentInstitutions div.MinistriesGovernment_title,
    .fieldset_type_int div.MinistriesGovernment_desc {
        border: 1px solid black;
        border-top: 0px;
    }

    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc {
        padding: 7px !important;
        font-size: 18px;
    }

    .AffairsOfMinistriesGovernmentInstitutions .MinistriesGovernment_desc p {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .AffairsOfMinistriesGovernmentInstitutions {
        margin: -2px 2px -2px;
    }

    .MinistriesGovernment_desc {
        border-right: 1px solid black;
        border-left: 1px solid black;
        border-bottom: 1px solid black;
    }

    tr.f_item_number_tr td:nth-child(3) {
        text-align: left;
    }

    /* .leg {
        margin-top: 0.5cm;
        margin-right: 1cm;
        background-color: #960;
        padding: 5px;
        font-size: 20px;
        font-weight: 600;
        width: 165px;
        color: #fff;
        text-align: center;
    } */

    /* .Draft_resolution_ul{
    margin-right: 1.5cm;
} */

    .Draft_resolution p {
        margin-top: 0px;
    }


    .Draft_resolution_ul table {
        margin: auto auto auto auto;
        width: 100%;
    }

    .Draft_resolution_ul table,
    .Draft_resolution_ul td,
    .Draft_resolution_ul th {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .Draft_resolution {
        /* margin: -2px 2px -2px; */

        /* border-top: 1px solid black; */
        border-right: 1px solid black;
        border-left: 1px solid black;
        border-bottom: 1px solid black;
    }
</style>