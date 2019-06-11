<?php $__env->startSection('admin'); ?>
<?php $__env->startSection('active'); ?>
    class="active"
<?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="main-panel">
  <?php $__env->startSection('DashboardSiteMap'); ?>
      Admin Dashboard
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('includes.adminnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-warning text-center">
                                    <i class="pe-7s-attention"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Property Requests</p>
                                    <?php echo e($pendingPropertiesCount); ?>

                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                              <?php if($pendingPropertiesCount > 0): ?>
                              <a href="<?php echo e(route('requests')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                              <?php else: ?>
                              <a href="<?php echo e(route('admin')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                    <i class="pe-7s-refresh-2"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                  <p>Edited Property</p>
                                  <?php echo e($tsEditedSubmittedPropertyCount); ?>

                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                              <?php if($tsEditedSubmittedPropertyCount > 0): ?>
                              <a href="<?php echo e(route('editedrequests')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                              <?php else: ?>
                              <a href="<?php echo e(route('admin')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                    <p>Rented Properties</p>
                                    <?php echo e($tenantUserIDCount); ?>

                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                              <?php if($tenantUserIDCount > 0): ?>
                              <a href="<?php echo e(route('tenatinfo.admin')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                              <?php else: ?>
                              <a href="<?php echo e(route('admin')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
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
                                    <i class="pe-7s-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
                                    <p>Property Managers</p>
                                    <?php echo e($totalAgent); ?>

                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                              <?php if($totalAgent > 0): ?>
                              <a href="<?php echo e(route('agentinfo.admin')); ?>"><i class="pe-7s-angle-right-circle"></i> View </a>
                              <?php else: ?>
                              <a href="<?php echo e(route('admin')); ?>"><i class="pe-7s-angle-right-circle"></i> Refresh </a>
                              <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <?php /* <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                      <div class="card" id="mgrTagFrm">
                          <div class="header">
                              <h4 class="title">Tag Property To Property Manager</h4>
                              <p class="category">Please select one owner property and Manager</p>
                          </div>
                          <div class="content">
                            <form id="tagAgentPropertyFormAdmin">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                  <label for="ownerPropertyID">Owner Property List</label>
                                  <select class="selectpicker form-control" name="ownerPropertyID" id="ownerPropertyID">
                                    <?php if($ownerPropCount==true): ?>
                                    <optgroup label="All Property">
                                      <option value="" class="ignore">Select...</option>
                                      <?php foreach($ownerPropDetails as $oneProperty): ?>
                                      <option value="<?php echo e($oneProperty->prop_id); ?>"><?php echo e($oneProperty->prop_title); ?> Located in <?php echo e($oneProperty->prop_locality); ?></option>
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
                                <label for="tagToPropMgrEmail">Property Manager email id:</label>
                                <input type="email" class="form-control" placeholder="Email ID" name="tagToPropMgrEmail" id="tagToPropMgrEmail">
                                <label for="tagToPropMgrEmail" id="tagToPropMgrEmailErr"></label>
                                </div>
                                <div class="form-group" style="display:none">
                                <label for="PropTaggedID">PropTaggedID:</label>
                                <input type="text" class="form-control" hidden placeholder="PropTaggedID" id="PropTaggedID">
                                </div>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-info btn-fill">Save</button>
                            </form>
                          </div>
                      </div>
                      <div class="modal" style="position: absolute !important;" tabindex="-1" role="dialog" id="success-tag-mgr-review-modal" data-backdrop="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div style="" class="modal-header">
                                    <h3 style="text-align:center" class="modal-title">Wow</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                       <i style="font-size: 40px;" class="pe-7s-check animated rotateIn"></i>
                                        <p id="">Successfully Tagged</p>
                                    </div>
                                </div>
                            <div style="text-align:center" class="modal-footer">
                            <button style="" type="button" class="btn btn-primary" class="button button-block" id="reloadSucModalMgr">
                              Ok
                            </button>
                            </div>
                          </div>
                        </div>
                      </div><!-- /.modal -->

                  </div>

                  <div class="col-md-6">
                      <div class="card" id="tenTagFrm">
                          <div class="header">
                              <h4 class="title">Tag Property To Tenant</h4>
                              <p class="category">Please select one property and Tenant</p>
                          </div>
                          <div class="content">
                            <form id="tagTenantPropertyFormAdmin">
                              <div class="row">
                                <div class="col-md-12 ">
                                  <div class="form-group">
                                  <label for="allPropertyIDTenant">Property List</label>
                                  <select class="selectpicker form-control" name="allPropertyIDTenant" id="allPropertyIDTenant">
                                    <?php if($activeProp==true): ?>
                                    <optgroup label="All Property">
                                      <option value="" class="ignore">Select...</option>
                                      <?php foreach($tsActiveProperties as $oneProperty): ?>
                                      <option value="<?php echo e($oneProperty->prop_id); ?>"><?php echo e($oneProperty->prop_title); ?> Located in <?php echo e($oneProperty->prop_locality); ?></option>
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
                                <div class="row" id="dynamicRowsTenant" style="display:none;">
                                <div class="col-sm-6">
                                <div id="tenatRowsdis">

                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div id="tenatRowsdis1">

                                </div>
                                </div>
                                <div class="col-sm-3">
                                <div id="tenatRowsdis2" style="margin-top:24%;">

                                </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-8">
                                <div class="form-group">
                                <label for="tagToPropTenEmail">Tenant email id:</label>
                                <input type="email" class="form-control" placeholder="Email ID" name="tagToPropTenEmail" id="tagToPropTenEmail">
                                <label for="tagToPropTenEmail" id="tagToPropTenEmailErr"></label>
                                </div>
                                </div>
                                <div class="col-sm-4">
                                <div class="form-group">
                                <label for="tagToPropTenRent">Monthly Rent:</label>
                                <input type="text" class="form-control" placeholder="Rent" name="tagToPropTenRent" id="tagToPropTenRent">
                                </div>
                                </div>
                              </div>
                                <button type="submit" class="btn btn-info btn-fill">Save</button>
                            </form>
                          </div>
                      </div>
                      <div class="modal" style="position: absolute !important;" tabindex="-1" role="dialog" id="success-tag-ten-review-modal" data-backdrop="false" aria-labelledby="myModalLabel" style="background-color:rgba(256,256,256, 0.9);">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div style="" class="modal-header">
                                  <h3 style="text-align:center" class="modal-title">Wow</h3>
                              </div>
                              <div class="modal-body">
                                  <div class="text-center">
                                     <i style="font-size: 40px;" class="pe-7s-check animated rotateIn"></i>
                                      <p id="">Successfully Tagged</p>
                                  </div>
                              </div>
                            <div style="text-align:center" class="modal-footer">
                            <button style="" type="button" class="btn btn-primary" class="button button-block" id="reloadSucModalTen">
                              Ok
                            </button>
                            </div>
                          </div>
                        </div>
                      </div><!-- /.modal -->



                  </div>
                </div>
            </div> */ ?>
        </div>
<?php echo $__env->make('includes.adminfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <script>
    var token = '<?php echo e(Session::token()); ?>';
    var UrlTagToAgentAdmin = '<?php echo e(route('tag.prop.agent.admin')); ?>';
    var UrlTagToTenatAdmin = '<?php echo e(route('tag.prop.tenat.admin')); ?>';
    var UrlTagCheckAgentAdmin = '<?php echo e(route('tag.check.prop.admin')); ?>';
    var UrlTagCheckTenatAdmin = '<?php echo e(route('tag.check.prop.tenat.admin')); ?>';
    var UrlDelOneTen = '<?php echo e(route('dele.tenat.one.prop')); ?>';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>