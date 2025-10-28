<div class="pageheader_cancelcustody1">
<div class="default_page" style="margin-top: 0px;">
    <div style="font-family: xbriyaz;">
        <?php $i=0;$e=1; foreach ($person as $per) { $i++; ?>
                <?php if($e % 10 == 0){ ?>
                    <pagebreak>
                <?php } ?>
        <div style="width: 47%;float: right;border: 1px solid black;margin: 5px 7px 20px 7px;padding: 5px">
            <div style="width: 100%; margin: 0px;padding: 0px;border-bottom: 1px solid black">
                <div style="width: 100%;text-align: center"><?php echo $personAid['donation_name'];?></div>
            </div>
            <div style="width: 100%; margin: 0px;padding: 0px;">
                <div style="width: 30%;float: right;">نوع المساعدة</div>
                <div style="width: 50%;float: right;"><?php echo $personAid['aids_name'];?></div>
                <div style="width: 19%;float: right;border: 1px solid;border-radius: 50%;text-align: center "><?php echo $i;?></div>
            </div>

            <div style="width: 100%; margin: 0px;padding: 0px;">
                <div style="width: 30%;float: right;">الكمية</div>
                <div style="width: 70%;float: right;"><?php echo $per['quantity'];?></div>
            </div>
            <div style="width: 100%; margin: 0px;padding: 0px;">
                <div style="width: 30%;float: right;">رقم الهوية</div>
                <div style="width: 70%;float: right;"><?php echo $per['pid'];?></div>
            </div>
            <div style="width: 100%; margin: 0px;padding: 0px;">
                <div style="width: 30%;float: right;">الاسم</div>
                <div style="width: 70%;float: right;"><?php echo $per['fname'];?> <?php echo $per['sname'];?> <?php echo $per['tname'];?> <?php echo $per['lname'];?></div>
            </div>
            <div style="width: 100%; margin: 0px;padding: 0px;">
                <div style="width: 30%;float: right;">رقم الجوال</div>
                <div style="width: 70%;float: right;"><?php echo $per['mob_1'];?></div>
            </div>

            <div style="width: 100%; margin: 0px;padding: 0px;">
                <?php  echo $personAid['aids_note'];?>
            </div>
        </div>

        <?php $e++; } ?>
    </div>



</div>
</div>
