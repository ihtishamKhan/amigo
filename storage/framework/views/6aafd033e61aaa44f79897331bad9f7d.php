

<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Compact_Sidebar'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

<body data-sidebar="dark" data-sidebar-size="small">
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Layouts <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> Compact Sidebar <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>


    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('script'); ?>

    <!-- dashboard init -->
    <script src="<?php echo e(URL::asset('build/js/pages/dashboard.init.js')); ?>"></script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\installed-application\laragon\www\amigo\resources\views/layouts-compact-sidebar.blade.php ENDPATH**/ ?>