<div class="sidebar">

<!--

    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag

-->

  <div class="sidebar-wrapper" style="background-color:#3c3e0a;">
        <div class="logo">
            <a href="<?php echo e(route('home')); ?>" class="simple-text">
              <img src="<?php echo e(URL::to('src/images/logos/logo3.png')); ?>" alt="Mozitoo.com">
            </a>
        </div>

        <ul class="nav">
            <li <?php echo $__env->yieldContent('active'); ?>>
                <a href="<?php echo e(route('admin')); ?>">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active1'); ?>>
                <a href="<?php echo e(route('property.all')); ?>">
                    <i class="pe-7s-check"></i>
                    <p>All Properties</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active2'); ?>>
                <a href="<?php echo e(route('adminsubmitform')); ?>">
                    <i class="pe-7s-plus"></i>
                    <p>Add property</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active3'); ?>>
                <a href="<?php echo e(route('servicerequests.all')); ?>">
                    <i class="pe-7s-news-paper"></i>
                    <p>Service Requests</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active4'); ?>>
                <a href="<?php echo e(route('admin.inventory.review.createnew')); ?>">
                    <i class="pe-7s-plus"></i>
                    <p>inventory</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active5'); ?>>
                <a href="<?php echo e(route('admin.invoices.views')); ?>">
                    <i class="pe-7s-plus"></i>
                    <p>Invoices</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active6'); ?>>
                    <a href="<?php echo e(route('admin.changepwd')); ?>">
                        <i class="pe-7s-lock"></i>
                        <p>Change Password</p>
                    </a>
            </li>
        </ul>
  </div>
</div>
