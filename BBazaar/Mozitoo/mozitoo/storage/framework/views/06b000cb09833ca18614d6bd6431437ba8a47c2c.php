<?php $__env->startSection('tenantserreqform'); ?>
<?php $__env->startSection('active4'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Tenant Dashboard / Raise Service Request
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.tenantnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Raise Service Request</h4>
                                <p class="category">Please select Your property and Service type</p>
                            </div>
                            <div class="content">
                              <form id="ser-req-tenant-form">
                                <div class="row">
                                  <div class="col-md-12 ">
                                    <div class="form-group">
                                    <label for="prop-id">My Property</label>
                                    <select class="selectpicker form-control" name="prop_id" id="prop-id">
                                    <?php if(isset($tenant_prop) && count($tenant_prop) > 0): ?>
                                    <optgroup label="All Property">
                                        <option value="" class="ignore">Select...</option>
                                      <?php foreach($tenant_prop as $oneProperty): ?>
                                      <option value="<?php echo e($oneProperty->prop_id); ?>"><?php echo e($oneProperty->prop_title); ?></option>
                                      <?php endforeach; ?>
                                    </optgroup>
                                    <?php else: ?>
                                    <optgroup label="No Property added yet">
                                      <option value="" class="ignore">Select...</option>
                                    </optgroup>
                                    <?php endif; ?>
                                    </select>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="service-req-type">Service Type</label>
                                    <select class="selectpicker form-control" name="service_req_type" id="service-req-type">
                                    <optgroup label="Type Preference">
                                      <option class="ignore" value="">Select...</option>
                                      <?php if(isset($ms_ser_req_types) && count($ms_ser_req_types) > 0): ?>
                                      <?php foreach($ms_ser_req_types as $oneType): ?>
                                      <option value="<?php echo e($oneType->service_req_type_id); ?>"><?php echo e($oneType->service_req_type); ?></option>
                                      <?php endforeach; ?>
                                      <?php endif; ?>
                                    </optgroup>
                                    </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                  <div class="form-group">
                                  <label for="service-msg">Message: (Optionl)</label>
                                  <textarea name="service_msg" type="textarea" class="form-control" rows="3" id="service-msg" placeholder="Message"></textarea>
                                  </div>
                                  </div>
                                </div>
                                  <button type="submit" class="btn btn-info btn-fill">Send</button>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divLoading"> 

            </div>
        </div>
        <script>
        var token = '<?php echo e(Session::token()); ?>';
        var url_tenant_service_req = '<?php echo e(route('tenantservicerequest')); ?>';
        var url_tenant_all_service_req = '<?php echo e(route('tenant.service.req.all')); ?>';
        </script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.tenant', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>