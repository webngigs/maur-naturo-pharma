
<style type="text/css">
    .prints{
        background-color: #31B404;
        color:#fff;
    }
    .action{
        color:#fff;
    }

.dropdown-menu>li>a {
    color: #fff;
}
</style>
<div class="content-wrapper">
       <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('customer') ?></h1>
            <small><?php echo display('manage_customer') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('customer') ?></a></li>
                <li class="active"><?php echo display('manage_customer') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">

        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

              <div class="row">
            <div class="col-sm-12">
                <div class="column">
                 <?php if($this->permission1->method('add_customer','create')->access()){ ?>
                    <a href="<?php echo base_url('Ccustomer') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_customer') ?> </a>
    <?php }?>
    <?php if($this->permission1->method('credit_customer','read')->access()){ ?>
                    <a href="<?php echo base_url('Ccustomer/credit_customer') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('credit_customer') ?> </a>
                    <?php }?>
     <?php if($this->permission1->method('paid_customer','read')->access()){ ?>
                    <a href="<?php echo base_url('Ccustomer/paid_customer') ?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('paid_customer') ?> </a>
                    <?php }?>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <?php echo form_open('', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <div class="form-group">
                            <label class="" for="to_date"><?php echo display('status') ?></label>
                            <select name="status" id="status" class="form-control">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" id="btn-filter" class="btn btn-success"><?php echo display('find') ?></button>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>            
        </div>

        <!-- Manage Product report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_customer') ?></h4>


                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="customerLIst"> 
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('mr_name') ?></th>
                                        <th><?php echo display('customer_name') ?></th>
                                        <th><?php echo display('mobile') ?></th>
                                        <th><?php echo display('balance') ?></th>
                                        <th>GST Number</th>
                                        <th>Active</th>
                                        <th align="center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right">Total:</th>
                                        <th id="stockqty"></th>
                                        <th></th> 
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot> 
                            </table>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Manage Product End -->
<script type="text/javascript">
function ActiveOrInactiveCustomer(thisObj, user_ref_id){
    var status = 2;
    if($(thisObj).prop('checked') == true) status = 1;
    
    var dataString = 'status='+status+'&user_ref_id='+user_ref_id;
    
    $.ajax({
        type: "POST",
        url: '<?=base_url()?>Ccustomer/ActiveOrInactiveCustomer',
        data: dataString,
        cache: false,
        success: function(data)
        {
        } 
    });
}

$(document).ready(function() { 
var mydatatable = $('#customerLIst').DataTable({ 
             responsive: true,

             "aaSorting": [[ 2, "asc" ]],
             "columnDefs": [
                { "bSortable": false, "aTargets": [0,3,5,6] },

            ],
           'processing': true,
           'serverSide': true,

          
           'lengthMenu':[[10, 25, 50,100,250,500, "<?php echo $total_customer;?>"], [10, 25, 50,100,250,500, "All"]],

             dom:"'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'>Bfrtip", buttons:[ {
                extend: "copy", className: "btn-sm prints"
            }
            , {
                extend: "csv", title: "CustomerList", exportOptions: {
                       columns: [ 0, 1, 2, 3,4] //Your Colume value those you want
                           }, className: "btn-sm prints"
            }
            , {
                extend: "excel", title: "CustomerList", exportOptions: {
                       columns: [ 0, 1, 2, 3,4] //Your Colume value those you want
                           },className: "btn-sm prints"
            }
            , {
                extend: "pdf", title: " CustomerList",exportOptions: {
                       columns: [ 0, 1, 2, 3,4] //Your Colume value those you want
                           }, className: "btn-sm prints"
            }
            , {
                extend: "print",exportOptions: {
                       columns: [ 0, 1, 2, 3,4] //Your Colume value those you want
                           },title: "<center> CustomerList</center>", className: "btn-sm prints"
            }
            ],
            
            'serverMethod': 'post',
            'ajax': {
               'url':'<?=base_url()?>Ccustomer/CheckCustomerList',
               "data": function ( data) {
                    data.status = $('#status').val();
                }
            },
          'columns': [
             { data: 'sl' },
             { data: 'mr_name' },
             { data: 'customer_name' },
             { data: 'mobile' },
             { data: 'balance',class:"balance" },
             { data: 'gst_no',class:"text-center" },
             { data: 'checkinput',class:"text-center" },
             { data: 'button',class:"text-center"},
          ],

  "footerCallback": function(row, data, start, end, display) {
  var api = this.api();
 
  api.columns('.balance', {
    page: 'current'
  }).every(function() {
    var sum = this
      .data()
      .reduce(function(a, b) {
        var x = parseFloat(a) || 0;
        var y = parseFloat(b) || 0;
        return x + y;
      }, 0);
    $(this.footer()).html(sum.toFixed(2, 2));
  });


}



    });



    $('#btn-filter').click(function(){ 
        mydatatable.ajax.reload();  
    });
});




</script>