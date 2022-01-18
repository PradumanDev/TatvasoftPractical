<table class="table" border="1"> 
    <thead>
        <tr>
            <th>Date</th>
            <th>Day Name</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($eventList as $eventData){
                echo '<tr>
                        <td >'.$eventData.'</td>
                        <td >'.date('l', strtotime($eventData)).'</td>
                    </tr>';
            }
        ?>
        
    </tbody>
</table>

<p>Total Recurrence Event: <?=count($eventList);?></p>