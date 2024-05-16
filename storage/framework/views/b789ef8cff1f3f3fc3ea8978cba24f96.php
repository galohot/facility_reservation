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
        <!-- Include Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Include jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Include Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary" role="button">
                                    <i class="fas fa-pencil-alt"></i> Go To <?php echo e($pageTitle); ?> Table
                                  </a>
                                <div class="card-header">
                                        <h3 class="card-title">Edit <?php echo e($pageTitle); ?></h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo e(route('users.update', $user->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <div class="mb-3">
                                            <label class="form-label">Name:</label>
                                            <input type="text" name="name" id="name" class="form-control" value="<?php echo e($user->name); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control" value="<?php echo e($user->email); ?>" required>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label required" for="uker_master_id">Select Unit Kerja</label>
                                            <select name="uker_master_id" id="uker_master_id" class="form-select" style="width:80%">
                                                <option value="">Select Unit Kerja</option>
                                                <?php $__currentLoopData = $ukerMasters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ukerMaster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($ukerMaster->id); ?>" <?php echo e($user->uker_master_id == $ukerMaster->id ? 'selected' : ''); ?>><?php echo e($ukerMaster->nama_unit_kerja_eselon_2); ?>, <?php echo e($ukerMaster->satkerMaster->nama_satker); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label required" for="role_master_id">Select Role</label>
                                            <select name="role_master_id" id="role_master_id" class="form-select" style="width:80%">
                                                <option value="">Select role</option>
                                                <?php $__currentLoopData = $roleMasters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleMaster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($roleMaster->id); ?>" <?php echo e($user->role_master_id == $roleMaster->id ? 'selected' : ''); ?>><?php echo e($roleMaster->role_str); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="has_facility" id="has_facility" value="1" <?php echo e($user->has_facility ? 'checked' : ''); ?>>
                                                <label class="form-check-label" for="has_facility">Has Facility</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="has_reservation" id="has_reservation" value="1" <?php echo e($user->has_reservation ? 'checked' : ''); ?>>
                                                <label class="form-check-label" for="has_reservation">Has Reservation</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Reset Password (leave blank to keep user's current password)</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#uker_master_id').select2({
                    placeholder: 'Search for Unit Kerja',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>

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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\users\edit.blade.php ENDPATH**/ ?>