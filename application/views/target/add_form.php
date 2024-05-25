<!-- Add New MR start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('target') ?></h1>
            <small><?php echo display('add_new_target') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('target') ?></a></li>
                <li class="active"><?php echo display('add_target') ?></li>
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
        if (isset($error_message)) {
            ?><div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div><?php 
            $this->session->unset_userdata('error_message');
        }

        ?><div class="row">
            <div class="col-sm-12">
                <div class="column"><?php
                    if($this->permission1->method('manage_target','read')->access()) { 
                        ?><a href="<?php echo base_url('Ctarget/manage_target')?>" class="btn btn-info m-b-5 m-r-2">
                            <i class="ti-align-justify"> </i> <?php echo display('manage_target')?> 
                        </a><?php 
                    } 
                ?></div>
            </div>
        </div><?php
        if($this->permission1->method('add_target', 'create')->access()) { 
            ?><div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('add_target') ?> </h4>
                            </div>
                        </div><?php 
                        echo form_open('Ctarget/insert_target', array('class' => 'form-vertical','id' => 'insert_target'))
                        ?><div class="panel-body">
                            <div class="form-group row">
                                <label for="minpurchase" class="col-sm-3 col-form-label"><?php echo display('mr') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="mr_id" id="mr_id" required>
                                        <option value="">Select <?php echo display('mr') ?></option><?php
                                        if($all_mr){ 
                                            foreach ($all_mr as $mr) {
                                                ?><option value="<?php echo $mr['mr_id']?>"><?php echo $mr['mr_name']?></option><?php
                                            }
                                        }
                                    ?></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="minpurchase" class="col-sm-3 col-form-label"><?php echo display('minpurchase') ?> (₹) <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name="minpurchase" id="minpurchase" type="text" placeholder="<?php echo display('minpurchase') ?>"  required="" tabindex="1">
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label for="maxpurchase" class="col-sm-3 col-form-label"><?php echo display('maxpurchase') ?> (₹) </label>
                                <div class="col-sm-6">
                                    <input class="form-control" name="maxpurchase" id="maxpurchase" type="text" placeholder="<?php echo display('maxpurchase') ?>" tabindex="2"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="commission"  class="col-sm-3 col-form-label"><?php echo display('commission') ?></label>
                                <div class="col-sm-3">
                                    <input class="form-control" name="commission" id="commission" type="text" placeholder="<?php echo display('commission') ?>" tabindex="2"> 
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="commission_type" id="commission_type" required>
                                        <option value="Fixed (₹)">Fixed (₹)</option>
                                        <option value="%">Percentage (%) </option>
                                    </select> 
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="note"  class="col-sm-3 col-form-label">Note</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="note" id="note" rows="4" placeholder="Note" tabindex="4"></textarea>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-6">
                                    <input type="submit" id="add-target" class="btn btn-primary btn-large" name="add-target" value="<?php echo display('save') ?>" tabindex="7"/>
                                    <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-target-another" class="btn btn-large btn-success" id="add-target-another" tabindex="6">
                                </div>
                            </div>
                        </div><?php 
                        echo form_close()
                    ?></div>
                </div>
            </div><?php
        }
        else{
            ?><div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('You do not have permission to access. Please contact with administrator.');?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php
        }
    ?></section>
</div>
<!-- Add New MR end -->