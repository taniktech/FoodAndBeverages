<?php $__env->startSection('tenant'); ?>
<?php $__env->startSection('active1'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Tenant Dashboard/ My Profile
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                        <div class="card">
                                <div class="header">
                                    <h4 class="title">Personal Information</h4>
                                </div>
                                <div class="content">
                                    <ul class="list-unstyled team-members">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            Name
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form id="user-name-update">
                                                                <input type="text" class="form-control" disabled="disabled" placeholder="Your Name" name="user_name" id="user-name" value="<?php echo $tenant->name; ?>">
                                                            </form>
                                                        </div>
                                                        <div class="col-md-3" id="name-update-save-b" hidden>
                                                            <button type="button" onClick="submitNameUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                                        </div>
                                                        <div class="col-md-3" id="name-check">
                                                            <?php if($tenant->name): ?>
                                                            <i class="fa fa-check icon-success"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-md-1 text-right">
                                                            <button type="button" onclick="dasNameUpdate();" id="user-name-u-b" class="btn btn-info btn-simple btn-md">
                                                                <i class="fa fa-edit"></i>
                                                            </button>  
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            Email
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form id="user-email-update">
                                                                <input type="email" class="form-control" disabled="disabled" placeholder="Your Email" name="user_email" id="user-email" value="<?php echo $tenant->email; ?>">       
                                                            </form>
                                                            <form id="email-otp-verify">
                                                                <div id="dyn-email-veri">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-3" id="gen-email-otp">
                                                                <?php if(($tenant->email) && ($tenant->email_verified == 0 )): ?>
                                                                <a href="javascript:sendEmailOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a><?php endif; ?> 
                                                                <?php if(($tenant->email) && ($tenant->email_verified == 1)): ?><i class="fa fa-check icon-success"></i><?php endif; ?>
                                                        </div>
                                                        <div class="col-md-3" id="email-update-save-b" hidden>
                                                            <button type="button" onClick="submitEmailUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                                        </div>
                                                        <div class="col-md-1 text-right">
                                                            <button type="button" onclick="dasEmailUpdate();" id="user-email-u-b" class="btn btn-info btn-simple btn-md">
                                                                <i class="fa fa-edit"></i>
                                                            </button> 
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            Mobile
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form id="user-mobile-update">
                                                                <input type="text" class="form-control" disabled="disabled" placeholder="Your Email" name="user_mobile" id="user-mobile" value="<?php echo $tenant->mobile; ?>">       
                                                            </form>
                                                            <form id="mobile-otp-verify">
                                                                <div id="dyn-mobile-veri">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-3" id="gen-mobile-otp">
                                                                <?php if(($tenant->mobile) && ($tenant->mobile_verified == 0 )): ?><a href="javascript:sendMobileOTP();"><i class="fa fa-warning icon-danger"></i> Click here to generate OTP</a><?php endif; ?> 
                                                                <?php if(($tenant->mobile) && ($tenant->mobile_verified == 1)): ?><i class="fa fa-check icon-success"></i><?php endif; ?>
                                                        </div>
                                                        <div class="col-md-3" id="mobile-update-save-b" hidden>
                                                            <button type="button" onClick="submitMobileUpForm();" class="btn btn-info btn-fill pull-left">Save</button>
                                                        </div>
                                                        <div class="col-md-1 text-right">
                                                            <button type="button" onclick="dasMobileUpdate();" id="user-mobile-u-b" class="btn btn-info btn-simple btn-md">
                                                                <i class="fa fa-edit"></i>
                                                            </button>    
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                </div>
                            </div>
                     <div class="card">
                         <div class="header">
                             <h4 class="title">Address Information</h4>
                         </div>
                         <form method="POST" id="tenant-address-form">
                         <div class="content">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="add-line-1">Address Line 1</label>
                                         <input type="text" class="form-control" name="add_line_1" id="add-line-1" placeholder="Address Line 1" <?php if($other_data && $other_data->address_line_1): ?> value="<?php echo e($other_data->address_line_1); ?>" disabled <?php endif; ?>>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="add-line-2">Address Line 2</label>
                                         <input type="text" class="form-control" name="add_line_2" id="add-line-2" placeholder="Address Line 2" <?php if($other_data && $other_data->address_line_2): ?> value="<?php echo e($other_data->address_line_2); ?>" disabled <?php endif; ?>>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">  
                                 <div class="col-md-4">
                                     <div class="form-group">
                                        <label for="input-state">State</label>
                                        <select class="form-control selectpicker" <?php if($other_data && $other_data->state): ?> disabled <?php endif; ?> data-live-search="true" data-size="10" name="input_state" id="input-state">
                                            <option value="" class="ignore">Select...</option> 
                                            <?php if(isset($ts_states) && count($ts_states) > 0): ?>
                                                <?php foreach($ts_states as $ts_state): ?>
                                                <option value="<?php echo e($ts_state->state_id); ?>"  <?php if($other_data && $other_data->state && $other_data->state == $ts_state->state_id): ?> selected <?php endif; ?> class="ignore"><?php echo e($ts_state->name); ?></option>
                                                <?php endforeach; ?>       
                                            <?php endif; ?>                                  
                                        </select>                             
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="input-city">City/District/Town</label>
                                            <select class="form-control selectpicker" <?php if($other_data && $other_data->city): ?> disabled <?php endif; ?> data-live-search="true" data-size="10" name="input_city" id="input-city">
                                                <option value="" class="ignore">Select...</option>
                                                <?php if($other_data && $other_data->city): ?>
                                                <?php if(isset($ts_cities) && count($ts_cities) > 0): ?>
                                                <?php foreach($ts_cities as $ts_city): ?>
                                                <option value="<?php echo e($ts_city->city_id); ?>"  <?php if($other_data && $other_data->city && $other_data->city == $ts_city->city_id): ?> selected <?php endif; ?> class="ignore"><?php echo e($ts_city->name); ?></option>
                                                <?php endforeach; ?>       
                                                <?php endif; ?>       
                                                <?php endif; ?>                             
                                            </select>
                                        </div>
                                    </div>
                                 <div class="col-md-4">
                                     <div class="form-group">
                                         <label for="pin">Pincode</label>
                                         <input type="text" class="form-control" name="pin" id="pin" placeholder="Pincode" <?php if($other_data && $other_data->pincode): ?> value="<?php echo e($other_data->pincode); ?>" disabled <?php endif; ?>>
                                     </div>
                                 </div>
                             </div>
                             <?php if(!$other_data or !$other_data->state or !$other_data->address_line_1 or !$other_data->address_line_2): ?>
                             <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                             <?php endif; ?>
                             <?php if($other_data && $other_data->state && $other_data->address_line_1 && $other_data->address_line_2): ?>
                             <div class="text-right">
                             <button type="button" class="btn btn-info btn-fill" id="action-tenant-add-form" onclick="tenAddEdit();">Edit</button>
                             <button type="button" class="btn btn-success btn-fill" id="action-up-tenant-add-form" style="display:none;" onclick="tenAddEditSubForm();">Update</button>
                             </div>
                             <?php endif; ?>
                             <div class="clearfix"></div>
                         </div>
                         </form>
                     </div>
                     <div class="card">
                         <div class="header">
                             <h4 class="title">About Me</h4>
                         </div>
                         <div class="content">
                            <form id="tenant-about-form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="about-me">About Me</label>
                                            <textarea rows="5" class="form-control" placeholder="Here can be your description" name="about_me" id="about-me" <?php if($other_data && $other_data->about_me): ?> disabled <?php endif; ?>><?php if($other_data && $other_data->about_me): ?><?php echo e($other_data->about_me); ?><?php endif; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php if(!$other_data or !$other_data->about_me): ?>
                             <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                             <?php endif; ?>
                             <?php if($other_data && $other_data->about_me): ?>
                             <div class="text-right">
                                <button type="button" class="btn btn-info btn-fill" id="action-tenant-about-form" onclick="tenAboutEdit();">Edit</button>
                                <button type="button" class="btn btn-success btn-fill" id="action-tenant-up-about-form" style="display:none;" onclick="tenAboutEditSubForm();">Update</button>
                                </div>
                            <?php endif; ?>
                             <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                         <div class="header">
                             <h4 class="title">Bank Details</h4>
                         </div>
                         <form method="POST" id="tenant-bank-form">
                         <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pan-no">PAN no.</label>
                                            <input type="text" class="form-control" name="pan_no" id="pan-no" placeholder="PAN no." <?php if($other_data && $other_data->pan_no): ?> value="<?php echo e($other_data->pan_no); ?>" disabled <?php endif; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="adhaar-no">Adhaar no.</label>
                                            <input type="text" class="form-control" name="adhaar_no" id="adhaar-no" placeholder="Adhaar no." <?php if($other_data && $other_data->adhaar_no): ?> value="<?php echo e($other_data->adhaar_no); ?>" disabled <?php endif; ?>>
                                        </div>
                                    </div>
                                </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="acc-holder-name">A/c holder name</label>
                                         <input type="text" class="form-control" name="acc_holder_name" id="acc-holder-name" placeholder="A/c holder name" <?php if($other_data && $other_data->acc_holder_name ): ?> value="<?php echo e($other_data->acc_holder_name); ?>" disabled <?php endif; ?>>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="form-group">
                                         <label for="acc-no">Account no.</label>
                                         <input type="text" class="form-control" name="acc_no" id="acc-no" placeholder="Account no." <?php if($other_data && $other_data->acc_no ): ?> value="<?php echo e($other_data->acc_no); ?>" disabled <?php endif; ?>>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="bank-name">Bank name</label>
                                         <input type="text" class="form-control" name="bank_name" id="bank-name" placeholder="Bank name" <?php if($other_data && $other_data->bank_name ): ?> value="<?php echo e($other_data->bank_name); ?>" disabled <?php endif; ?>>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="branch-name">Branch name</label>
                                         <input type="text" class="form-control" name="branch_name" id="branch-name" placeholder="Branch name" <?php if($other_data && $other_data->branch_name ): ?> value="<?php echo e($other_data->branch_name); ?>" disabled <?php endif; ?>>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label for="ifsc">IFSC code</label>
                                             <input type="text" class="form-control" name="ifsc" id="ifsc" placeholder="IFSC code" <?php if($other_data && $other_data->ifsc ): ?> value="<?php echo e($other_data->ifsc); ?>" disabled <?php endif; ?>>
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label for="type">Account Type</label>
                                             <input type="text" class="form-control" name="type" id="type" placeholder="Account Type" <?php if($other_data && $other_data->type ): ?> value="<?php echo e($other_data->type); ?>" disabled <?php endif; ?>>
                                         </div>
                                     </div>
                                     <div class="col-md-4">
                                         <div class="form-group">
                                             <label for="micr">MICR code</label>
                                             <input type="text" class="form-control" name="micr" id="micr" placeholder="MICR code" <?php if($other_data && $other_data->micr ): ?> value="<?php echo e($other_data->micr); ?>" disabled <?php endif; ?>>
                                         </div>
                                     </div>
                                 </div>
                             <div class="row">
                                 <div class="col-md-12">
                                 <div class="form-group">
                                         <label for="cheque">Attach cancelled cheque</label>
                                         <input id="check" name="cheque" class="file" type="file" data-show-upload="false">
                                </div>
                                 </div>
                             </div>
                             <?php if(!$other_data or !$other_data->pan_no or !$other_data->adhaar_no or !$other_data->acc_no or !$other_data->bank_name or !$other_data->ifsc): ?>
                             <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                             <?php endif; ?>
                             <?php if($other_data && $other_data->pan_no && $other_data->adhaar_no && $other_data->acc_no && $other_data->bank_name && $other_data->ifsc): ?>
                             <div class="text-right">
                             <button type="button" class="btn btn-info btn-fill" id="action-tenant-bank-form" onclick="tenBankEdit();">Edit</button>
                             <button type="button" class="btn btn-success btn-fill" id="action-up-tenant-bank-form" style="display:none;" onclick="tenBankEditSubForm();">Update</button>
                             </div>
                             <?php endif; ?>
                             <div class="clearfix"></div>
                         </div>
                         </form>
                     </div>
                </div>
        </div>
        </div>
        </div>
<div id="divLoading"> 

</div>

<script>
var token = '<?php echo e(Session::token()); ?>';
var url_send_email_otp = '<?php echo e(route('user.send.email.otp')); ?>';
var url_send_mobile_otp = '<?php echo e(route('user.send.mobile.otp')); ?>';
var url_get_respective_cities = '<?php echo e(route('get.respective.cities')); ?>';
var url_verify_otp = '<?php echo e(route('user.verify.email.otp')); ?>';
var url_update_em = '<?php echo e(route('user.update.email.mobile')); ?>';
var url_update_name = '<?php echo e(route('user.update.name')); ?>';
var url_tenant_post_address = '<?php echo e(route('tenant.save.address')); ?>';
var url_tenant_post_bank = '<?php echo e(route('tenant.save.bank.details')); ?>';
var url_tenant_post_about = '<?php echo e(route('tenant.save.about.me')); ?>';
</script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>