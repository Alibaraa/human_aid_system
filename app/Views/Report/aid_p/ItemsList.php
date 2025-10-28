<div class="pageheader_custody_print">
<div class="default_page" style="margin-top: 13px;">

    <table  style="float: left;font-family: xbriyaz; width: 100%;">
        <tr>
            <td style="width: 15%;">نوع المساعدة</td>
            <td style="width: 35%;font-weight: bold;"><?php echo $personAid['aids_name'];?></td>
            <td style="width: 15%;">المؤسسة الراعية</td>
            <td style="width: 35%;font-weight: bold;"><?php echo $personAid['donation_name'];?></td>

        </tr>
    </table>
    <br>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" style="text-align: center;font-family: xbriyaz;font-size: 12px;font-weight: 700">
        <thead>
            <tr style="background-color: #ece7e7">
                <td width="6%" style="font-size: 14px"> م</td>
                <td width="20%" style="font-size: 14px">رقم الهوية </td>
                <td style="font-size: 14px">الاسم الرباعي</td>
                <td width="15%" style="font-size: 14px"> رقم الجوال </td>
                <td width="10%" style="font-size: 14px"> عدد الافراد</td>
            </tr>
        </thead>

        <tbody>
        <?php $i=0; foreach ($person as $per) { $i++; ?>
            <tr>
                <td style="width: 50px;"> <?php echo $i;?> </td>
                <td> <?php echo $per['pid'];?> </td>
                <td> <?php echo $per['fname'];?> <?php echo $per['sname'];?> <?php echo $per['tname'];?> <?php echo $per['lname'];?>  </td>
                <td> <?php echo $per['mob_1'];?> </td>
                <td> <?php echo $per['f_num'];?>  </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

    <br>
    <br>
    <table  style="float: left;font-family: xbriyaz; width: 100%;">
        <tr>
            <td style="width: 15%;"> </td>
            <td style="width: 35%;font-weight: bold;"></td>
            <td style="width: 20%;"> </td>
            <td style="width: 30%;font-weight: bold;">رئيس مجلس الإدارة</td>

        </tr>
        <tr>
            <td style="width: 15%;"> </td>
            <td style="width: 35%;font-weight: bold;"></td>
            <td style="width: 20%;"> </td>
            <td style="width: 30%;font-weight: bold;">  </td>

        </tr>
        <tr>
            <td style="width: 15%;"> </td>
            <td style="width: 35%;font-weight: bold;"></td>
            <td style="width: 20%;"> </td>
            <td style="width: 30%;font-weight: bold;">صالح عبدالله الأسطل  </td>

        </tr>
    </table>

</div>
</div>
