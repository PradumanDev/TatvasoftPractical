<table class="table" border="1" width="100%" id="eventsLists"> 
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Dates</th>
            <th>Occurrence</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        
        <?php 
        if(!empty($eventData)){
            $i = 1;
            foreach($eventData as $eventd){
                echo '<tr>
                        <td scope="row">'.$i.'</td>
                        <td>'.$eventd['title'].'</td>
                        <td>'.$eventd['start_date'].' to '.$eventd['end_date'].'</td>
                        <td>Every Day</td>
                        <td>
                            <ul class="action-list">
                                <li>
                                <a href="'.base_url('events/view-event/'.$eventd['id']).'">View</a> 
                                </li>
                                <li>
                                <a href="'.base_url('events/edit-event/'.$eventd['id']).'">Edit</a> 
                                </li>
                                <li>
                                <a class="removeEvent" data-target="'.$eventd['id'].'">Delete</a> 
                                </li>
                            </ul>
                        </td>
                    </tr>';
            }
        }else{
            echo '<tr>
                <td colspan="5" allign="center" id="loading">Data not available.</td>
            </tr>';
        }
        
        ?>
        
    </tbody>
    <p id="ermsg"></p>
</table>