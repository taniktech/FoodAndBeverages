<?php $__env->startSection('property_grid'); ?>
<!--Content Area Begin-->
    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">Listing</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="index.html">home</a></li>
                        <li>listing</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
      <?php if($propertyCount == true): ?>
        <div class="container">
            <div class="row">
              <?php foreach($tsSubmittedProperties as $tsSubmittedProperty): ?>
                <div class="col-sm-4 listing_grid">
                    <div class="info_content row">
                        <div class="row m0 imageRow">
                          <?php if(Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg')): ?>
                            <img src="<?php echo e(route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
                          <?php else: ?>
                          <img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
                          <?php endif; ?>
                            <div class="saleTag"><?php echo e($tsSubmittedProperty->furnishFUn->prop_furnish_status); ?></div>
                        </div>
                        <div class="row m0 description">
                            <div class="row m0 priceRow">
                                <div class="price fleft">Rs. <?php echo e($tsSubmittedProperty->prop_morp); ?></div>
                                <i class="fa fa-file-text-o"></i>
                            </div>
                            <a href="<?php echo e(route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])); ?>" class="location_link"><h4 class="location"><?php echo e($tsSubmittedProperty->prop_locality); ?></h4></a>
                            <a href="<?php echo e(route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])); ?>" class="specify_btn"><i class="fa fa-arrows-alt"></i><?php echo e($tsSubmittedProperty->prop_area); ?> Sq Ft</a>
                            <a href="<?php echo e(route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])); ?>" class="specify_btn"><i class="fa fa-inbox"></i><?php echo e($tsSubmittedProperty->prop_bed); ?> bedroom</a>
                        </div>
                    </div>
                </div> <!--Grid Listing-->
              <?php endforeach; ?>
            </div>
              <!-- pagination links-->
            <!-- <nav class="row m0 paginationRow">
                <ul class="pagination">
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                </ul>
            </nav> -->
            <!-- pagination links ends-->
        </div>
        <?php endif; ?>
    </section>

    <!--Content Area End-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>