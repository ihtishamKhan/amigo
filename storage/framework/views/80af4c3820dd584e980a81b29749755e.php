

<?php $__env->startSection('title'); ?>
    Contact Us - Amigos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

    <body>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="card overflow-hidden">
                            <div class="bg-primary-subtle">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h4 class="text-primary fw-bold">Contact Us</h4>
                                            <p>We'd love to hear from you!</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="<?php echo e(URL::asset('build/images/profile-img.png')); ?>" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <!-- Contact Info Section -->
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="contact-info mb-4">
                                            <h5 class="text-primary">Our Information</h5>

                                            <div class="mt-4">
                                                <div class="d-flex mb-3">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-map-marker text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Address</h6>
                                                        <p class="text-muted mb-0">1 West View, Dudley, NE23 7AD</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex mb-3">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-phone text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Phone</h6>
                                                        <p class="text-muted mb-0">0191 250 2226</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-email-outline text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Email</h6>
                                                        <p class="text-muted mb-0">amigospizza23@gmail.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="hours-info">
                                            <h5 class="text-primary">Opening Hours</h5>

                                            <div class="mt-4">
                                                <div class="d-flex mb-3 align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-calendar-clock text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Monday - Thursday</h6>
                                                        <p class="text-muted mb-0">12:00 PM - 10:00 PM</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex mb-3 align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-calendar-clock text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Friday - Saturday</h6>
                                                        <p class="text-muted mb-0">12:00 PM - 11:00 PM</p>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-calendar-clock text-primary fs-4"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fw-semibold mb-1">Sunday</h6>
                                                        <p class="text-muted mb-0">12:00 PM - 10:00 PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Form Section -->
                                

                                <!-- Special Note Section -->
                                <div class="mt-5 pt-3 border-top">
                                    <h5 class="text-primary">Allergen Information</h5>
                                    <p>If you have a severe food allergy or intolerance, please contact us directly before
                                        placing your order to ensure it is safe for your consumption. We're happy to provide
                                        detailed allergen information and accommodate your dietary needs when possible.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <p>
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Amigos. Made with
                                <i class="mdi mdi-heart text-danger"></i> by Amigos Team
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\installed-application\laragon\www\amigo\resources\views/frontend/contact.blade.php ENDPATH**/ ?>