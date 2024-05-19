<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('slot', null, []); ?> 
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo e($pageTitle); ?> Details</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>User: </strong><?php echo e($reservation->user->name); ?></p>
                                    <p><strong>Email: </strong><?php echo e($reservation->user->email); ?></p>
                                    <p><strong>Event: </strong> <?php echo e($reservation->event); ?></p>
                                    <p><strong>Facility: </strong><a href="<?php echo e(route('facilities.show', $reservation->facility->id)); ?>"><?php echo e($reservation->facility->name); ?></a></p>
                                    <p><strong>Reservation Start: </strong><?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?></p>
                                    <p><strong>Reservation End: </strong><?php echo e($reservation->reservation_end->translatedFormat('l, j F Y, H:i')); ?></p>
                                    <p><strong>Unit Kerja Pemohon: </strong><?php echo e($reservation->user->ukerMaster->nama_unit_kerja_eselon_2); ?></p>
                                    
                                    <p>
                                        <strong>Status: </strong>
                                        <?php switch($reservation->status):
                                            case ('pending'): ?>
                                                <span class="text-white badge bg-warning"><?php echo e(strtoupper($reservation->status)); ?></span>, Verificator: <span class="text-white badge bg-info"><?php echo e($reservation->facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span>
                                                <?php break; ?>
                                            <?php case ('approved'): ?>
                                                <span class="text-white badge bg-success"><?php echo e(strtoupper($reservation->status)); ?></span>, Verificator: <span class="text-white badge bg-info"><?php echo e($reservation->facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span>
                                                <?php break; ?>
                                            <?php case ('rejected'): ?>
                                                <span class="text-white badge bg-danger"><?php echo e(strtoupper($reservation->status)); ?></span>, Verificator: <span class="text-white badge bg-info"><?php echo e($reservation->facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span>
                                                <?php break; ?>
                                            <?php default: ?>
                                                <span><?php echo e(strtoupper($reservation->status)); ?></span>
                                        <?php endswitch; ?>
                                    </p>

                                    <?php if($reservation->description != 'pending'): ?>
                                        <p><strong>Description: </strong><span class="<?php echo e($reservation->status == 'approved' ? 'badge bg-success text-white' : ($reservation->status == 'rejected' ? 'badge bg-danger text-white' : 'badge bg-warning text-white')); ?>"><?php echo e($reservation->description); ?></span></p>
                                    <?php endif; ?>
                                    <a href="./" class="btn btn-secondary">Back</a>
                                    <?php if(Auth::user()->roleMaster->role_str == 'admin' || $reservation->user->ukerMaster->id == auth()->user()->ukerMaster->id && $reservation->status == 'pending'): ?>
                                    <a href="<?php echo e(route('reservations.edit', $reservation->id)); ?>" class="btn btn-primary">Edit</a>
                                    <?php endif; ?>
                                    <?php if(auth()->check() && (auth()->user()->hasUker($reservation->facility->ukerMaster->id)) && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('verificator'))): ?>
                                    <a href="<?php echo e(route('reservations.verify', $reservation->id)); ?>" class="btn btn-primary">Verify</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views/reservations/show.blade.php ENDPATH**/ ?>