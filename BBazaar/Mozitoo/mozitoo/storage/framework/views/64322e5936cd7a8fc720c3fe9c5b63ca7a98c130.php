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
        <!--Payment Options Modal -->
        <!-- Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="payment-option-modal" data-backdrop="false" data-keyboard="false" aria-labelledby="payment-option-modal" style="background-color: rgba(0, 0, 0, .5);">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div style="" class="modal-header">
                      <h4 class="modal-title">Select a Payment Method</h4>
                  </div>
                  <form id="payment-options-form">
                  <div class="modal-body">  
                        <p class="title text-info"><b><u>Server 1</u></b></p>
                        <label>
                            <input type="radio" name="pay_option" value="1"> Pay by Net Banking (Zero Convenience charges)
                        </label><br/>
                        <label>
                            <input type="radio" name="pay_option" value="2"> Pay by Debit Card (1 % charges)  
                        </label><br/>
                        <label>
                            <input type="radio" name="pay_option" value="3"> Pay by Credit Card, Wallets and EMI (1.5 % charges)  
                        </label><br/>
                        <p class="title text-info"><b><u>Server 2</u></b></p>
                        <label>
                            <input type="radio" name="pay_option" value="4"> Server 2  
                        </label><br/>
                        <label id="err_pay_options"></label><br/>
                  </div>
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-fill">Pay</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      <!--Payment Options Modal ends-->
      </div>
    </div>
    <div id="divLoading"> 

    </div>
</div>
<script>
var token = '<?php echo e(Session::token()); ?>';
var url_payment = '<?php echo e(route('tenant.go.to.pay')); ?>';
</script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>