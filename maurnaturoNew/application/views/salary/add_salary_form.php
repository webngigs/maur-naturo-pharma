<!-- Add New gift start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('salary') ?></h1>
            <small><?php echo display('add_salary') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('salary') ?></a></li>
                <li class="active"><?php echo display('add_salary') ?></li>
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
                    if($this->permission1->method('manage_salary','read')->access()) { 
                        ?><a href="<?php echo base_url('Csalary/manage_salary')?>" class="btn btn-info m-b-5 m-r-2">
                            <i class="ti-align-justify"> </i> <?php echo display('manage_salary')?> 
                        </a><?php 
                    } 
                ?></div>
            </div>
        </div><?php
        if($this->permission1->method('add_salary','create')->access()) { 
            ?><div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('add_salary') ?> </h4>
                            </div>
                        </div><?php 
                        echo form_open('Csalary/insert_salary', array('class' => 'form-vertical', 'id' => 'insert_salary'))
                        ?><div class="panel-body">
                            <div class="form-group row">
                                <label for="mr_id" class="col-sm-3 col-form-label"><?php echo display('mr') ?> <i class="text-danger">*</i></label>
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
                                <label for="salary_date" class="col-sm-3 col-form-label">Salary Date <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control datepicker" name="salary_date" id="salary_date" type="text" placeholder="Salary Date" readonly required="" tabindex="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name="title" id="title" type="text" placeholder="<?php echo display('title') ?>"  required="" tabindex="2">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="amount" class="col-sm-3 col-form-label"><?php echo display('amount') ?></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name="amount" id="amount" type="text" placeholder="<?php echo display('amount') ?>" tabindex="3"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label"><?php echo display('description') ?></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="description" id="description" placeholder="<?php echo display('description') ?>" tabindex="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-6">
                                    <input type="submit" id="add-salary" class="btn btn-primary btn-large" name="add_salary" value="<?php echo display('save') ?>" tabindex="6"/>
                                    <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add_salary_another" class="btn btn-large btn-success" id="add-salary-another" tabindex="7">
                                </div>
                            </div>
                        </div><?php 
                        echo form_close();
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
<!-- Add New gift end -->