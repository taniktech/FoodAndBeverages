<?php $__env->startSection('searchpage'); ?>
<!--Content Area Begin-->

<?php if($propertyCount == true): ?>
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-3 col-md-offset-1 bod" id="fix">
	<h3 class="heading"> F<u>ilte</u>r</h3>
	<form name='myform'>
	<div class="row pad">
	<input type='reset'  class="rset" value='Reset' name='reset' id="set">
	</div>
	<div class="row pad colours">
		<label class="lab"> Apartment Type: </label><br>
		<span class="pad"><input type="checkbox" class="flsearch" name="at" data-value="1" data-type="at" value="1"> 1BHK</input></span>
		<span class="pad"><input type="checkbox" class="flsearch" name="at" data-value="2" data-type="at" value="2"> 2BHK</input></span>
		<span class="pad"><input type="checkbox" class="flsearch" name="at" data-value="3" data-type="at" value="3"> 3BHK</input></span><br>
	</div>
	<!-- <div class="row pad">
	<span class="pad"><label class="lab">Rent Range(per month)</label></span>
	<input id="ex6" type="text" data-slider-min="0" data-slider-max="20000" data-slider-step="1" data-slider-value="0"/><br>
	<span id="ex6CurrentSliderValLabel">Price range: ₹ <span id="ex6SliderVal">0</span></span>
	</div> -->
  <div class="row pad colours">
	  <label class="lab"> Preferred Tenants: </label><br>
	  <span class="pad"><input type="checkbox" class="flsearch1" name="pt" data-value="1" data-type="pt" value="1"> Family</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch1" name="pt" data-value="2" data-type="pt" value="2"> Bachelor's</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch1" name="pt" data-value="4" data-type="pt" value="4"> Any</input></span><br>
	</div>
	<div class="row pad">
	  <label class="lab"> Furnishing: </label><br>
	  <span class="pad"><input type="checkbox" class="flsearch2" name="ft" data-value="3" data-type="ft"> Full</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch2" name="ft" data-value="2" data-type="ft"> Semi</input></span>
	  <span class="pad"><input type="checkbox" class="flsearch2" name="ft" data-value="1" data-type="ft"> No</input></span><br>
	</div>
  </form>
</div>
<div class="col-sm-12 col-md-6 col-md-offset-5 listing_list">
			<div id="mainSearch">
				<div id="defaultSearch">
			<?php foreach($tsSubmittedProperties as $tsSubmittedProperty): ?>
    	<div class="info_content row">
        <div class="col-sm-6 p0 imageRow">
					<?php if(Storage::disk('public_uploads')->has($tsSubmittedProperty->prop_id.'.jpg')): ?>
						<img src="<?php echo e(route('prop.image', ['filename' => $tsSubmittedProperty->prop_id.'.jpg'])); ?>" alt="..." class="img-responsive"/>
					<?php else: ?>
					<img src="<?php echo e(route('prop.image', ['filename' => 'default.jpg'])); ?>" alt="" class="img-responsive">
					<?php endif; ?>
        </div>
        <div class="col-sm-6 p0 description">
            <div class="row m0 priceRow">
							 <div class="saleTag fleft"><?php echo e($tsSubmittedProperty->furnishFUn->prop_furnish_status); ?></div>
                <div class="price fleft">Rs. <?php echo e($tsSubmittedProperty->prop_morp); ?></div>
            </div>
						<a href="<?php echo e(route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])); ?>" class="location_link"><h4 class="location"><?php echo e($tsSubmittedProperty->prop_locality); ?></h4></a>
						<a href="<?php echo e(route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])); ?>" class="specify_btn"><i class="fa fa-arrows-alt"></i><?php echo e($tsSubmittedProperty->prop_area); ?> Sq Ft</a>
						<a href="<?php echo e(route('property_details',['prop_id'=>$tsSubmittedProperty->prop_id])); ?>" class="specify_btn"><i class="fa fa-inbox"></i><?php echo e($tsSubmittedProperty->prop_bed); ?> bedroom</a>
        </div>
    	</div>
			<br>
		<?php endforeach; ?>
    </div> <!--List Listing-->
</div>
</div>
</div>
</div>
	<?php else: ?>
	<div class="container" style="padding-bottom:50px;text-align:center">
 	<h3 class="section_title mozi" style="padding-bottom:20px">Alert</h3>
	<div class="item active">
		<p>“Apologies, we don't service in <?php echo e($location); ?> currently.”</P>
	</div>
	</div>
	<?php endif; ?>
<!--Content Area End-->
<script>
var UrlSearchCustom = '<?php echo e(route('customsearch')); ?>';
var UrlSearchCustom1 = '<?php echo e(route('customsearch1')); ?>';
var UrlSearchCustom2 = '<?php echo e(route('customsearch2')); ?>';
</script>
<script>
var token = '<?php echo e(Session::token()); ?>';
var urlSignIn = '<?php echo e(route('dosignin')); ?>';
var urlSignUp = '<?php echo e(route('dosignup')); ?>';
</script>
<!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
        $(window).on("scroll", function() {
            var wn = $(window).scrollTop();
            if (wn > 10) {
                $(".topHeader").hide();
                $(".navbar").addClass("navbar-fixed-top");
								$("#fix").css({'margin-top':'100px'});

            } else {
                $(".topHeader").show();
                $(".navbar").removeClass("navbar-fixed-top");
								$("#fix").css({'margin-top':'10px'});
            }

        });
				$("#myform")[0].reset();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>