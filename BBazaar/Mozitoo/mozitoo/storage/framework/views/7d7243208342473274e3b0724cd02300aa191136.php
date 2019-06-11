<?php $__env->startSection('blogs'); ?>
<!--Content Area Begin-->

   <section class="row pageCover">
       <div class="container">
           <div class="row m0">
               <div class="fleft page_name">Our Blog</div>
               <div class="fright page_dir">
                   <ul class="list-inline">
                       <li><a href="index.html">home</a></li>
                       <li>our blog</li>
                   </ul>
               </div>
           </div>
       </div>
   </section>
   <section class="row contentRow">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 blog">
                <div class="row m0 inner">
                    <div class="row m0 imageRow">
                        <img src="<?php echo e(URL::to('src/images/blog/1.jpg')); ?>" alt="">
                        <div class="meta_row row m0">
                            <!-- <a href="#" class="comments"><i class="fa fa-comment-o"></i>6 comments</a> -->
                            <a href="#" class="date"><i class="fa fa-calendar"></i>17 April</a>
                        </div>
                    </div>
                    <div class="row m0 desc">
                        <a href="single-post.html"><h4 class="blogtitle">Is Your Rental Agreement Fool-proof ?</h4></a>
                        <p>A rent agreement is an important document that legally lays down the terms and conditions agreed upon by the tenant and the landlord..<a href="<?php echo e(route('blog.one')); ?>" class="read_more">[ read more ]</a></p>
                    </div>
                </div>
            </div> <!--blog-->
        </div>
    </div>
</section>

   <!--Content Area End-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>