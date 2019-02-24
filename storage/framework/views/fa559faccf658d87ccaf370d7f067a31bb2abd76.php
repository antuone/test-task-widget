<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row justify-content-center">

        <div class="col-md-7">
        <?php if($is_users): ?>
        <div class="alert alert-warning" role="alert">
            Users are not in the database. The first user will be the administrator.
        </div>
        <?php endif; ?>
        <?php if(auth()->guard()->check()): ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">New messages</div>
                        <div class="card-body">
                        <?php if(count($messages) > 0): ?>
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card mt-1">
                                <div class="card-header"><?php echo e($m->name); ?></div>
                                <div class="card-body"><?php echo e($m->text); ?></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Users</div>
                        <div class="card-body">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <ul>
                                <li><a href="user/<?php echo e($user->id); ?>"><?php echo e($user->name); ?></a></li>
                            </ul>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-header">
                    Тестовое задание компании Виджет
                </div>
                <div class="card-body">
                    <ul class="my_tasks">
                        <li>Развернуть на laravel 5.2 приложение</li>
                        <li>Пользователи - могут регистрироваться, авторизовываться и писать друг-другу сообщения (не обязательно чатик в реальном времени, просто возможность послать сообщение другому пользователю и прочитать сообщение) </li>
                        <li>Администратор - может видеть всех пользователей и все их сообщения, может удалять пользователей, может авторизоваться </li>
                        <li>База - postgresql</li>
                        <li>Система - ubuntu 14.04 lts (если есть возможность - развернуть через virtualbox + vagrant на windows-машине)</li>
                        <li>Если хватит времени - можно написать unit-тесты (не обязательно)</li>
                        <li>Остальные детали реализации на усмотрение исполнителя </li>
                        <li>По срокам - 2 недели</li>
                    </ul>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Пояснения исполнителя
                </div>
                <div class="card-body">
                    <ul class="my_tasks">
                        <li>Первый зарегистрированный пользователь будет администратором</li>
                        <li>В дальнейшем можно реализовать несколько админов</li>
                        <li>Новые сообщения после просмотра сразу становятся просмотренными и больше не показываются в списке новых сообщений</li>
                        <li>Все сообщения переписки можно просмотреть кликнув по пользователю из списка справа</li>
                        <li>Удаленному пользователю нельзя писать сообщения</li>
                        <li>Удаленный пользователь не может авторизоваться</li>
                        <li>Если зайти в чат к удаленному пользователю можно увидеть сообщение что он удален</li>
                        <li>Удаленного пользователя админ может восстановить</li>
                        <li>При удалении пользователя все сообщения сохраняются, а удаленный пользователь помечается удаленным</li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>