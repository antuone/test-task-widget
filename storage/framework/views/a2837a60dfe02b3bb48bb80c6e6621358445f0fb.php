<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <?php if($user->is_delete): ?>
                <div class="alert alert-warning" role="alert">
                    This user is delete.
                </div>
                <?php endif; ?>
            <div class="card">
                <div class="card-header">Chat with <?php echo e($user->name); ?></div>

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
                            <?php if($m->id_to == $id_to): ?>
                                <div class="float-right"><?php echo e($m->name); ?></div>
                            <?php else: ?>
                                <?php echo e($m->name); ?>

                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if($m->id_to == $id_to): ?>
                                <div class="float-right"><?php echo e($m->text); ?></div>
                            <?php else: ?>
                                <?php echo e($m->text); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if( ! $user->is_delete): ?>
                    <form action="/user/<?php echo e($id_to); ?>" method="post" class="form-horizontal">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <textarea class="form-control mt-1" name="message" rows="5"></textarea>
                            <button type="submit" class="btn btn-success float-right mt-1">
                                <i class="fa fa-plus"></i>
                                Post
                            </button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($is_admin): ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Correspondences <?php echo e($user->name); ?></div>
                <div class="card-body">
                    <ul>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e($user->id); ?>/<?php echo e($u->id); ?>"><?php echo e($u->name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php if( ! $user->is_delete): ?>
            <form action="/user/delete/<?php echo e($id_to); ?>" method="post" class="form-horizontal">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-warning float-right mt-1">
                        <i class="fa fa-plus"></i>
                        Delete User - <?php echo e($user->name); ?>

                    </button>
                </div>
            </form>
            <?php else: ?>
            <form action="/user/recovery/<?php echo e($id_to); ?>" method="post" class="form-horizontal">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right mt-1">
                        <i class="fa fa-plus"></i>
                        Recovery User - <?php echo e($user->name); ?>

                    </button>
                </div>
            </form>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>