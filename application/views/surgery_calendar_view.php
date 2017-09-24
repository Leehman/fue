<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FUE Client List</title>
    <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assests/bootstrap/css/starter-template.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel='stylesheet' href='<?php echo base_url(); ?>application/libraries/fullcalendar/fullcalendar.css' />
    <script src='<?php echo base_url(); ?>application/libraries/lib/moment.min.js'></script>
    <script src='<?php echo base_url(); ?>application/libraries/lib/jquery.min.js'></script>
    <link href='<?php echo base_url(); ?> application/libraries/lib/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='<?php echo base_url(); ?>application/libraries/fullcalendar/fullcalendar.js'></script>

      <script type="text/javascript">
        $(document).ready( function () {

          $('#calendar').fullCalendar({
              // put your options and callbacks here
          })
        });
      </script>
  </head>

  <body>
    <?php $this->load->view('layouts/_header.html');  ?>

  <div class="container">
    <h1>FUE Calendar</h1>

    <div id='calendar'></div>

  </div>

  </body>
</html>
