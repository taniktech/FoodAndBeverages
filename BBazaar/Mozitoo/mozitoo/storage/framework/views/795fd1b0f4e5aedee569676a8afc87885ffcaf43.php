<?php $__env->startSection('ownerserreqform'); ?>
<?php $__env->startSection('active5'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownerheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Owner Dashboard / Raise Service Request
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.ownernav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                                  <form id="owner-ser-req-form">
                                  <div class="row">
                                  <div class="col-md-12 ">
                                    <div class="form-group">
                                    <label for="owner-prop-id">My Property</label>
                                    <select class="selectpicker form-control" name="owner_prop_id" id="owner-prop-id">
                                    <?php if(isset($owner_prop) && count($owner_prop) > 0): ?>
                                    <optgroup label="All Property">
                                    <option value="" class="ignore">Select...</option>
                                      <?php foreach($owner_prop as $one_prop): ?>
                                      <option value="<?php echo e($one_prop->prop_id); ?>"><?php echo e($one_prop->prop_title); ?> <?php if($one_prop->prop_locality): ?> Located in <?php echo e($one_prop->prop_locality); ?><?php endif; ?></option>
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
                                    <?php if(isset($ms_ser_req_type) && count($ms_ser_req_type) > 0): ?>
                                    <optgroup label="Type Preference">
                                      <option value="" class="ignore">Select...</option>
                                      <?php foreach($ms_ser_req_type as $one_type): ?>
                                      <option value="<?php echo e($one_type->service_req_type_id); ?>"><?php echo e($one_type->service_req_type); ?></option>
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
        </div>
        <script>
        var token = '<?php echo e(Session::token()); ?>';
        var url_owner_post_ser_req = '<?php echo e(route('ownerservicerequest')); ?>';
        var url_owner_get_ser_reqs = '<?php echo e(route('owner.service.req.all')); ?>';
        </script>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.owner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>