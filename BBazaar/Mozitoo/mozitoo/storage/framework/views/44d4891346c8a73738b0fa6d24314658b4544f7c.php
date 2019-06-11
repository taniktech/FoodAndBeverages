<?php $__env->startSection('oneblog'); ?>
<!--Content Area Begin-->
<section class="row pageCover">
    <div class="container">
        <div class="row m0">
            <div class="fleft page_name">Our Blog</div>
            <div class="fright page_dir">
                <ul class="list-inline">
                    <li><a href="index-2.html">home</a></li>
                    <li>our blog</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="row contentRow blogWsidebar">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blogCol">
                <div class="row m0 single_blog">
                    <img src="<?php echo e(URL::to('src/images/blog/blog.jpg')); ?>" alt="Single Blog - Feature Image" class="img-responsive featureImg">
                    <div class="row m0 post_meta">
                        <!-- <a href="#"><i class="fa fa-comment-o"></i>6 comments</a> -->
                        <a href="#"><i class="fa fa-calendar"></i>17 April</a>
                    </div>
                    <div class="post_desc">
                        <h4 class="blogTitle">Is Your Rental Agreement Fool-proof ?</h4>
                        <p>
                          A rent agreement is an important document that legally lays down the terms and conditions agreed upon by the tenant and the landlord. It sets the ground rules to resolve any disputes between the tenant and the landlord. Therefore, it becomes very important for the document to clearly state all the obligations and rights of both parties. Below are the eight most important terms that every rent agreement should cover:
                        </p>
                      <h4>1) Names of both parties</h4>
                      <p>
                        The licensee refers to the tenant while the licensor is the landlord. In order to make the agreement fool-proof, it should establish and define right in the beginning the names and other such details to avoid the ambiguity of any nature.
                      </p>
                      <h4>2) Ownership</h4>
                      <p>
                        A rent agreement should clearly establish the nature of tenant’s conditional authority. Self-evident as it may seem, it is important to state that while the tenant has been given the rights to use and occupy the property, the ownership, and legal possession remains with the landlord. The tenant under no circumstance may assume any other title or claim over the property. This term ensures that activities such re-renting the property or usage of the property for unspecified businesses does not occur.
                      </p>
                      <h4>3) Occupancy </h4>
                      <p>
                        Clearly, mention the entry restrictions & what would be a violation of the property. It is important to state that the given area of the property will solely be used and occupied by the tenant and not by anyone else. Usually, an exception is made in a limited entry of the tenant’s immediate blood-relatives, as long as they have been introduced or specified as family members to the landlord. This term ensures that all the occupants are verified and unwanted situations are avoided.
                      </p>
                      <h4>4) Term of residence</h4>
                      <p>
                        A rental agreement should clearly state the period of the tenant’s stay agreed upon by both parties. Mention clearly the exact date of commencement and the end date.
                      </p>
                      <h4>5) Renewal and Termination</h4>
                      <p>
                        Apart from mentioning the exact period of stay, every rent agreement should contain the procedure for renewal or early termination the agreement and whether or not there is a possibility to do so. Usually, these terms specify the percentage of increase in rent if the tenant wishes to continue, the compensation to be paid in a case of early termination, the rights of the landlord, the circumstances under which the tenant may be evicted and notice period to be served by the tenant.
                      </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Content Area End-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>