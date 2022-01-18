<html>
    <head>
        <title><?=isset($pageTitle)?$pageTitle:'';?></title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <style>
            .error{
                border : 1px solid red;
            }

            input {
                border: 1px solid;
                width: 100%;
            }

            ul li {
                list-style: none;
                display: inline-block;
                margin: 5px;
            }

            .action-list{
                margin: 3px;
            }
            .action-list a {
                border: 1px solid;
                padding: 3px;
                cursor: pointer;
            }

            .success-msg{
                color : green;
            }

            .error-msg{
                color : red;
            }

            
        </style>
        <script>
            let baseUrl = '<?=base_url();?>';
        </script>
    </head>

    <body>

        <ul class="menu">
            <li>
                <a href="<?=base_url('events');?>">Event List</a> 
            </li>
            <li>
                <a href="<?=base_url('events/add-event');?>">Add New Event</a> 
            </li>
        </ul>
        <h3><?=isset($pageTitle)?$pageTitle:'';?></h3>

    
