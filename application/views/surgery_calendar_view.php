<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FUE Client List</title>
    <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
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
    <link href='<?php echo base_url(); ?>application/libraries/lib/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='<?php echo base_url(); ?>application/libraries/fullcalendar/fullcalendar.js'></script>
    <!--<script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js')?>"></script>-->
    <script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js')?>"></script>

      <script type="text/javascript">
        $(document).ready( function () {

          var date_last_clicked = null;

          $('#calendar').fullCalendar({
              eventSources: [
              {
                  events: function(start, end, timezone, callback) {
                      $.ajax({
                          url: '<?php echo base_url() ?>calendar/get_events',
                          dataType: 'json',
                          data: {
                              start: start.unix(),
                              end: end.unix()
                          },
                          success: function(msg) {
                              var events = msg.events;
                              callback(events);
                          }
                      });
                 }
              },
              ],
              dayClick: function(date, jsEvent, view) {
                  date_last_clicked = $(this);
                  $(this).css('background-color', '#bed7f3');
                  $('#addModal').modal();
              }
          });
        });
      </script>
  </head>

  <body>
    <?php $this->load->view('layouts/_header.html');  ?>

  <div class="container">
    <h1>FUE Calendar</h1>

    <div id='calendar'></div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
          </div>
          <div class="modal-body">

          <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading">Event Name</label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="name" value="">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading">Description</label>
                    <div class="col-md-8 ui-front">
                        <input type="text" class="form-control" name="description">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading">Start Date</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="start_date">
                    </div>
            </div>
            <div class="form-group">
                    <label for="p-in" class="col-md-4 label-heading">End Date</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="end_date">
                    </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Add Event">
          
          </div>
        </div>
      </div>
</div>

  </div>



  </body>
</html>
