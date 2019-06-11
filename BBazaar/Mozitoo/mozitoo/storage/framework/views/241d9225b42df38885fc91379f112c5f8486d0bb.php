<?php $__env->startSection('tenant'); ?>
<?php $__env->startSection('active'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
  Tenant Dashboard
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="content">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="icon-big icon-warning text-center">
                                                    <i class="pe-7s-home"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="numbers">
                                                    <p>Total Occupied <br/>Units</p>
                                                    <?php if(isset($assigned_invnt_check)): ?>
                                                    <?php echo e(count($assigned_invnt_check)); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              <?php if(isset($assigned_invnt_check) && count($assigned_invnt_check) > 0): ?>
                                              <a href="<?php echo e(route('tenant.property.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              <?php else: ?>
                                              <a href="<?php echo e(route('tenantaccount')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                                              <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="pe-7s-check"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="numbers">
                                                  <p>Total Outstanding Invoices</p>
                                                    <?php if(isset($invoice_data)): ?>
                                                    <?php echo e(count($invoice_data)); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              <?php if(isset($invoice_data) && count($invoice_data) > 0): ?>
                                              <a href="<?php echo e(route('tenant.invoices.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              <?php else: ?>
                                              <a href="<?php echo e(route('tenantaccount')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                                              <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="icon-big icon-danger text-center">
                                                    <i class="pe-7s-volume2"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="numbers">
                                                    <p>Raised Service Request</p>
                                                    <?php if(isset($ts_ser_reqs)): ?>
                                                    <?php echo e(count($ts_ser_reqs)); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              <?php if(count($ts_ser_reqs) > 0): ?>
                                              <a href="<?php echo e(route('tenant.service.req.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              <?php else: ?>
                                              <a href="<?php echo e(route('tenantaccount')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                                              <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="icon-big icon-info text-center">
                                                    <i class="pe-7s-attention"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="numbers">
                                                    <p>Pending Service Requests</p>
                                                    <?php if(isset($ts_p_ser_reqs)): ?>
                                                    <?php echo e(count($ts_p_ser_reqs)); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <hr />
                                            <div class="stats">
                                              <?php if(count($ts_p_ser_reqs) > 0): ?>
                                              <a href="<?php echo e(route('tenant.service.req.all')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                                              <?php else: ?>
                                              <a href="<?php echo e(route('tenantaccount')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                                              <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
          <div class="container-fluid">
               <div class="row">
                        <div class="col-md-8">
            <?php if($tenant->email_verified == 0 or $tenant->mobile_verified == 0): ?>
            <!-- If email or mobile is not verified show -->
            <div class="card">
                <div class="header">
                    <h4 class="title">Verification Pending</h4>
                </div>
                <div class="content">
                    <ul class="list-unstyled team-members">              
                        <?php if($tenant->email_verified == 0 ): ?>
                        <!-- If email is not verified show -->
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
                        <?php endif; ?>
                        <?php if($tenant->mobile_verified == 0 ): ?>
                        <!-- If mobile is not verified show -->
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
                        <?php endif; ?>
                    </ul>
                </div>                      
            </div>
            <?php endif; ?>
        </div>
                   <div class="col-md-4">
                    <?php if(isset($invoice_flag) && $invoice_flag): ?>
                    <?php if(isset($invoice_data) && !empty($invoice_data)): ?>
                    <?php foreach($invoice_data as $item): ?>    
                        <div class="row">
                                <div class="col-md-12">
                                <div class="card">
                                    <div class="header text-center">
                                        <?php 
                                        $f_d_date=date_create($item->due_date);
                                        $f_m=date_create($item->for_month);
                                         ?>
                                        <h4 class="title">Outstanding Invoice</h4>
                                        <p class="category">For Month : <span class="text-info"><?php echo e(date_format($f_m,"M Y")); ?></span></p><br/>
                                        <h5 class="title">Amount :<strong class="text-info"> <?php echo e($item->payable_amount); ?></strong> ( Due Date <span class="text-warning"><?php echo e(date_format($f_d_date,"d-m-Y")); ?></span>)</h5>
                                        <?php 
                                            $tmp_id_0 = Crypt::encrypt($item->ts_invoice_id);                         
                                            $tmp_id_1 = $item->for_month;
                                            $tmp_id_2 = $item->due_date;
                                         ?>    
                                         <a href="<?php echo e(route('tenant.invoices.get.one',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1,'tmp_id_2'=>$tmp_id_2])); ?>" target="_blank"><p class="category">Check Invoice</p></a>
                                    </div>
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a href="<?php echo e(route('tenant.payment.options',['tmp_id_0'=>$tmp_id_0,'tmp_id_1'=>$tmp_id_1])); ?>"><button type="submit" class="btn btn-success btn-fill">Pay Now</button></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>                               
                                    </div>
                                </div>
                            </div>
                       </div>
                       <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <div class="row">
                            <div class="col-md-12">
                            <div class="card">
                                <div class="header text-center">
                                    <h4 class="title">Do You own any property ?</h4>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="<?php echo e(route('tenantsubmitform')); ?>"><button type="submit" class="btn btn-info btn-fill">Rent Your Property</button></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                            <div class="header text-center">
                                <h4 class="title">Relax at your new home</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success btn-fill">Apply fro Rent Deposit Loan</button>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
               </div>
               </div>
           </div>
          </div>
        </div>
        <div id="divLoading"> 

        </div>
        <!--Modal -->
        <?php if(isset($payment_flag) && $payment_flag && isset($payment_modal_data) && is_array($payment_modal_data) && !empty($payment_modal_data)): ?>
        <div class="modal show" id="payment-info-modal" tabindex="-1" role="dialog" aria-labelledby="payment-info-modal" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div style="" class="modal-header">
                        <h4 class="modal-title">
                            <?php if(isset($payment_modal_data['info'])): ?>
                            <?php echo e($payment_modal_data['info']); ?>

                            <?php else: ?> 
                            N/A
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <?php if(isset($payment_modal_data['msg'])): ?>
                        <h5>
                            <?php if(isset($payment_modal_data['msg'])): ?>
                            <?php echo e($payment_modal_data['msg']); ?>

                            <i class="pe-7s-check icon-success"></i>
                            <?php else: ?> 
                            N/A 
                            <?php endif; ?>                      
                        </h5>
                        <?php endif; ?>
                        <p class="category">
                        Transaction ID : 
                        <strong>
                        <?php if(isset($payment_modal_data['transaction_id'])): ?>
                            <?php echo e($payment_modal_data['transaction_id']); ?>

                        <?php else: ?> 
                        N/A
                        <?php endif; ?>
                        </strong>
                        </p>
                        <?php if(isset($payment_modal_data['created_at'])): ?>
                        <p class="category">
                        Payment Date : 
                        <strong>
                        <?php if(isset($payment_modal_data['created_at'])): ?>
                            <?php echo e($payment_modal_data['created_at']); ?>

                        <?php else: ?> 
                        N/A
                        <?php endif; ?>
                        </strong>
                        </p>
                        <?php endif; ?>
                    </div>  
                    <div class="modal-footer">
                        <?php if(isset($payment_modal_data['created_at'])): ?>
                        <p class="category"> You can view your Invoice through <a href= "<?php echo e(route('tenant.invoices.all')); ?>">My Invoice </a>page.
                        <?php else: ?>
                        <a href= "<?php echo e(route('tenantaccount')); ?>"><button type="button" class="btn btn-success btn-fill">Go Back</button></a>
                        <?php endif; ?>
                    </div>
              </div>
            </div>
          </div><!-- /.modal -->
        <?php endif; ?>
<script>
var token = '<?php echo e(Session::token()); ?>';
var url_send_email_otp = '<?php echo e(route('user.send.email.otp')); ?>';
var url_send_mobile_otp = '<?php echo e(route('user.send.mobile.otp')); ?>';
var url_verify_otp = '<?php echo e(route('user.verify.email.otp')); ?>';
var url_update_em = '<?php echo e(route('user.update.email.mobile')); ?>';
var url_update_name = '<?php echo e(route('user.update.name')); ?>';
var url_tenant_dashboard = '<?php echo e(route('tenantaccount')); ?>';
</script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>