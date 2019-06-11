<div class="sidebar">

<!--

    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
    Tip 2: you can also add an image using data-image tag

-->

  <div class="sidebar-wrapper" style="background-color:#131242;">
        <div class="logo">
            <a href="<?php echo e(route('home')); ?>" class="simple-text">
               <img src="<?php echo e(URL::to('src/images/logos/logo3.png')); ?>" alt="Mozitoo.com">
            </a>
        </div>
        <ul class="nav">
            <li <?php echo $__env->yieldContent('active'); ?>>
                <a href="<?php echo e(route('tenantaccount')); ?>">
                    <i class="pe-7s-user"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active1'); ?>>
                <a href="<?php echo e(route('tenant.propfile')); ?>">
                    <i class="pe-7s-user"></i>
                    <p>My Profile</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active2'); ?>>
                <a href="<?php echo e(route('tenant.property.all')); ?>">
                    <i class="pe-7s-home"></i>
                    <p>My Home</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active3'); ?>>
                    <a href="<?php echo e(route('tenant.invoices.all')); ?>">
                        <i class="pe-7s-home"></i>
                        <p>My Invoices</p>
                    </a>
            </li>
            <li <?php echo $__env->yieldContent('active4'); ?>>
                <a href="<?php echo e(route('tenant.service.req.form')); ?>">
                    <i class="pe-7s-volume"></i>
                    <p>Raise request</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active5'); ?>>
                <a href="<?php echo e(route('tenant.service.req.all')); ?>">
                    <i class="pe-7s-news-paper"></i>
                    <p>My Service Request</p>
                </a>
            </li>
            <li <?php echo $__env->yieldContent('active6'); ?>>
              <a href="<?php echo e(route('tenant.changepwd')); ?>">
                  <i class="pe-7s-lock"></i>
                  <p>Change Password</p>
              </a>
            </li>
        </ul>
  </div>
</div>
