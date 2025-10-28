<div class="pageheader_custody_print">
<div class="default_page" style="margin-top: 13px;">

    <table  style="float: left;font-family: xbriyaz; width: 100%;">
        <tr>
            <td style="width: 14%;">اسم التجمع </td>
            <td style="width: 22%;font-weight: bold;"><?php echo $block['title'];?></td>
            <td style="width: 14%;"> اسم المندوب</td>
            <td style="width: 22%;font-weight: bold;"><?php echo $block['p_name'];?></td>
            <td style="width: 9%;"></td>
            <td style="width: 10%;font-weight: bold;"></td>

        </tr>
    </table>
    <br>
    <table width="100%" border="1" cellpadding="0"  cellspacing="0" style="text-align: center;font-family: xbriyaz;font-size: 14px;font-weight: 700">
        <thead>
            <tr style="background-color: #ece7e7">
                <td width="6%" style="font-size: 16px;padding: 5px"> م</td>
                <td width="20%" style="font-size: 16px;padding: 5px">رقم الهوية </td>
                <td style="font-size: 16px;padding: 5px">الاسم الرباعي</td>
                <td width="15%" style="font-size: 16px;padding: 5px"> رقم الجوال </td>
                <td width="15%" style="font-size: 16px;padding: 5px"> عدد الافراد</td>
            </tr>
        </thead>

        <tbody>
        <?php $i=0; foreach ($person as $per) { $i++; ?>
            <tr>
                <td style="width: 50px;padding: 5px"> <?php echo $i;?> </td>
                <td style="padding: 5px"> <?php echo $per['pid'];?> </td>
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
