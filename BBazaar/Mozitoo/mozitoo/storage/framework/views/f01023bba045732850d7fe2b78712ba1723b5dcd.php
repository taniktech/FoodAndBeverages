<h4>We want to help you reset your password</h4>
<h5>Hi <?php echo e($name); ?>,</h5>

<p>Just click on the button or copy and paste the link below into your browser
  to reset your password. (It's only good for 24 hours)
</p>
<a href="<?php echo e($url); ?>"><?php echo e($url); ?></a>
<p>
  If you don't want to reset your password or if you didn't request this change, you can ignore this email.
  No one else can change your password with this link.
</p>
<a href="<?php echo e($url); ?>"><button>Click here to reset password</button></a>
