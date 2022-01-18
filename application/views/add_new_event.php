
<?php 
$isEdit = false;

$eventId = $title = $start_date = $end_date = $recurrence_type = $duration = $type = '';
if(!empty($eventData)){
    $isEdit = true;
    extract($eventData);
    extract(json_decode($recurrence_data , true));
}
?>
<form action="<?=base_url('manage_ajax/add_event');?>" method="post" redirect="<?=base_url('events');?>">
    <?php 
    if($isEdit){
        echo '<input type="hidden" name="targetId" value="'.$id.'">';
    }
    ?>
<table class="table" border="1"> 
    <tbody>
        <tr>
            <th>Event Title*</th>
            <th><input type="" name="title" class="require" value="<?=$title;?>"/></th>
        </tr>
        <tr>
            <th>Start Date*</th>
            <th><input type="" name="start_date" class="require date-picker" readonly  value="<?=$start_date;?>"/></th>
        </tr>

        <tr>
            <th>End Date*</th>
            <th><input type="" name="end_date"  class="require date-picker" readonly  value="<?=$end_date;?>"/></th>
        </tr>
        <tr>
            <th>Recurrence*</th>
            <th>
                <p>
                    <span><input type="radio" name="recurrence" value="1" <?=$recurrence_type == 1?'checked':'';?> />Repeat</span> 
                      
                    <select name="repeat_duration"  class="require">
                        <?php 
                            foreach(['Every' , 'Every Other' , 'Every Third' , 'Every Fourth'] as $key =>  $lbl){
                                $ind = $key+1;
                                echo '<option value="'.$ind.'" '.($duration == $ind?'selected':'').'>'.$lbl.'</option>';
                            }
                        ?>
                    </select>
                    <select name="repeat_type"  class="require">
                        <option value="d" <?=$type == 'd'?'selected':'';?>>Day</option>
                        <option value="w" <?=$type == 'w'?'selected':'';?>>Week</option>
                        <option value="m" <?=$type == 'm'?'selected':'';?>>Month</option>
                        <option value="y" <?=$type == 'y'?'selected':'';?>>Year</option>
                    </select>

                </p>
                <span></span> 
                <p>
                    <span><input type="radio" name="recurrence" value="2"  <?=$recurrence_type == 2?'checked':'';?>/> Repeat on the</span> 
                    <select name="repeat_duration1"  class="require">
                        <option value="1">First</option>
                        <option value="2">Second</option>
                        <option value="3">third</option>
                        <option value="4">Fourth</option>
                    </select>
                    <select name="repeat_day"  class="require">
                        <option value="0">Sun</option>
                        <option value="1">Mon</option>
                        <option value="2">Tue</option>
                        <option value="3">Wed</option>
                        <option value="4">Thu</option>
                        <option value="5">Fri</option>
                        <option value="6">Sat</option>
                    </select>
                    <select name="repeat_type2"  class="require">
                        <option value="1">Month</option>
                        <option value="3">3 Months</option>
                        <option value="4">4 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">Year</option>
                    </select>

                </p>

            
            </th>
        </tr>
        <tr> 
            <th colspan="2"><button submit-form="true" type="button">Submit</button></th>
        </tr>
    </tbody>
</table>
</form>