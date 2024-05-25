<style type="text/css">
    .prints{
        background-color: #31B404;
        color:#fff;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_stockrequest') ?></h1>
            <small><?php echo display('manage_stockrequest') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('stockrequest') ?></a></li>
                <li class="active"><?php echo display('manage_stockrequest') ?></li>
            </ol>
        </div>
    </section>

    <section class="content"><?php
        $message = $this->session->userdata('message');
        if(isset($message)) {
            ?><div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div><?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if(isset($error_message)) {
            ?><div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div><?php
            $this->session->unset_userdata('error_message');
        }
        ?><div class="row">
            <div class="col-sm-12">
                <div class="column"><?php 
                if($this->permission1->method('add_stockrequest','create')->access()){
                    ?><a href="<?php echo base_url('Cstockrequest') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_stockrequest') ?></a><?php 
                }
                ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="InvList"> 
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('stockrequest_no') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('total_amount') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <th colspan="3" style="text-align:right">Total</th>                                
                                    <th></th>  
                                    <th></th> 
                                </tfoot>
                            </table>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var mydatatable = $('#InvList').DataTable({
            responsive: true,
            "aaSorting": [[ 1, "desc" ]],
            "columnDefs": [{ "bSortable": false, "aTargets": [0,4] }],
            'processing': true,
            'serverSide': true,
            'lengthMenu':[[10, 25, 50,100,250,500, "<?php echo $total_invoice;?>"], [10, 25, 50,100,250,500, "All"]],
            dom:"'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'>Bfrtip",
            buttons:[
                {
                    extend: "copy",exportOptions: {columns: [0, 1, 2, 3]}, className: "btn-sm prints"
                }
            ],
            'serverMethod': 'post',
            'ajax': {
                'url':'<?=base_url()?>Cstockrequest/CheckStockRequestList',
                "data": function(data) {

                }
            },
            'columns': [
                { data: 'sl' },
                { data: 'stockrequests' },
                { data: 'final_date', class:"text-center" },
                { data: 'total_amount', class:"total_sale text-right"},
                { data: 'button', class:"text-right"},
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();
                api.columns('.total_sale', { page: 'current' }).every(function() {
                    var sum = this.data().reduce(function(a, b) {
                        var x = parseFloat(a) || 0;
                        var y = parseFloat(b) || 0;
                        return x + y;
                    }, 0);
                    $(this.footer()).html(sum.toFixed(2, 2));
                });
            }
        });
    });
</script>