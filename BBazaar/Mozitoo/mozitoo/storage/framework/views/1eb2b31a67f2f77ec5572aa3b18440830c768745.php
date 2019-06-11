<?php $__env->startSection('contactus'); ?>
<!--Content Area Begin-->

    <section class="row pageCover">
        <div class="container">
            <div class="row m0">
                <div class="fleft page_name">Contact Us</div>
                <div class="fright page_dir">
                    <ul class="list-inline">
                        <li><a href="index.html">home</a></li>
                        <li>contact us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="row contentRow">
        <div class="container">
            <div class="row">
                    <div class="row commentForm m0">
                        <h3>Leave a Comment</h3>
                        <form action="contact_process.php" class="row m0">
                            <div class="col-sm-6 p0 commenterInfoInputs">
                                <div class="row m0">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                        <input type="email" class="form-control" placeholder="e-mail">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="url" class="form-control" placeholder="website">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 p0">
                                <div class="row m0">
                                    <div class="input-group">
                                        <textarea placeholder="Message" class="form-control"></textarea>
                                    </div>
                                    <button class="btn btn-default" type="submit">send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4 sidebar">
                </div>
            </div>
        </div>
    </section>

    <!--Content Area End-->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>