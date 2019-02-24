<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat between <?php echo e($user1->name); ?> and <?php echo e($user2->name); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card mt-1">
                        <div class="card-header">
                            <?php if($m->id_to == $user1->id): ?>
                                <div class="float-right"><?php echo e($m->name); ?></div>
                            <?php else: ?>
                                <?php echo e($m->name); ?>

                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if($m->id_to == $user1->id): ?>
                                <div class="float-right"><?php echo e($m->text); ?></div>
                            <?php else: ?>
                                <?php echo e($m->text); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>