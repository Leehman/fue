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

  </head>

  <body>
    <?php $this->load->view('layouts/_header.html');  ?>

  <div class="container">
    <h1>FUE Techies</h1>
    
  <h3>Techies</h3>
  <br />
  <button class="btn btn-success" onclick="add_techie()"><i class="glyphicon glyphicon-plus"></i> Add techie</button>
  <br />
  <br />
  <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>State</th>
        <th>Category</th>
        <th>Note</th>
        <th style="width:125px;">Action
        </p></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($techies as $techie){?>
           <tr>
               <td><?php echo $techie->id;?></td>
               <td><?php echo $techie->first_name;?></td>
               <td><?php echo $techie->last_name;?></td>
              <td><?php echo $techie->state;?></td>
              <td><?php echo $techie->category;?></td>
              <td><?php echo $techie->note;?></td>
              <td>
                <button class="btn btn-warning" onclick="edit_techie(<?php echo $techie->id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                <button class="btn btn-danger" onclick="delete_techie(<?php echo $techie->id;?>)"><i class="glyphicon glyphicon-remove"></i></button>


              </td>
            </tr>
           <?php }?>



    </tbody>

    <tfoot>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </tfoot>
  </table>

</div>

<script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js')?>"></script>
<script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js')?>"></script>


<script type="text/javascript">
$(document).ready( function () {
    $('#table_id').DataTable();
} );
  var save_method; //for save method string
  var table;


  function add_techie()
  {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal_form').modal('show'); // show bootstrap modal
  //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
  }

  function edit_techie(id)
  {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('index.php/techies/ajax_edit/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {

          $('[name="id"]').val(data.id);
          $('[name="first_name"]').val(data.first_name);
          $('[name="last_name"]').val(data.last_name);
          $('[name="state"]').val(data.state);
          $('[name="category"]').val(data.category);
          $('[name="note"]').val(data.note);

          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Edit client'); // Set title to Bootstrap modal title

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error get data from ajax');
      }
  });
  }



  function save()
  {
    var url;
    if(save_method == 'add')
    {
        url = "<?php echo site_url('index.php/techies/techies_add')?>";
    }
    else
    {
      url = "<?php echo site_url('index.php/techies/techies_update')?>";
    }

     // ajax adding data to database
        $.ajax({
          url : url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data)
          {
             //if success close modal and reload ajax table
             $('#modal_form').modal('hide');
            location.reload();// for reload a page
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
          }
      });
  }

  function delete_techie(id)
  {
    if(confirm('Are you sure delete this data?'))
    {
      // ajax delete data from database
        $.ajax({
          url : "<?php echo site_url('index.php/techies/techies_delete')?>/"+id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {

             location.reload();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error deleting data');
          }
      });

    }
  }

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title">Techies Form</h3>
    </div>
    <div class="modal-body form">
      <form action="#" id="form" class="form-horizontal">
        <input type="hidden" value="" name="id"/>
        <div class="form-body">
          <div class="form-group">
            <label class="control-label col-md-3">First Name</label>
            <div class="col-md-9">
              <input name="first_name" placeholder="First Name" class="form-control" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Last Name</label>
            <div class="col-md-9">
              <input name="last_name" placeholder="Last Name" class="form-control" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">State</label>
            <div class="col-md-9">
              <input name="state" placeholder="State" class="form-control" type="text">

            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Category</label>
            <div class="col-md-9">
              <input name="category" placeholder="Category" class="form-control" type="text">

            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Note</label>
            <div class="col-md-9">
              <input name="note" placeholder="Note" class="form-control" type="text">

            </div>
          </div>
        </div>
      </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!-- End Bootstrap modal -->

</body>
</html>
