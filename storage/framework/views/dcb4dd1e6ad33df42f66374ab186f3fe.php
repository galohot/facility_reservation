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
                                    <p><strong>Nama Unit Kerja Eselon II</strong> <?php echo e($ukerMaster->nama_unit_kerja_eselon_2); ?></p>
                                    <p><strong>Nama Satuan Kerja Eselon I</strong> <?php echo e($ukerMaster->satkerMaster->nama_satker); ?></p>
                                    <p><strong>Kode Satuan Kerja</strong> <?php echo e($ukerMaster->satkerMaster->kd_satker); ?></p>
                                    <a href="./" class="btn btn-secondary">Back</a>
                                    <a href="<?php echo e(route('uker_masters.edit', $ukerMaster->id)); ?>" class="btn btn-primary">edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
              <div id="table-default" class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th><button class="table-sort" data-sort="sort-uker">User</button></th>
                        <th><button class="table-sort" data-sort="sort-satker">Actiom</button></th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->uker_master_id == $ukerMaster->id): ?>
                        <tr>
                            <td class="sort-uker"><?php echo e($user->name); ?></td>
                            <td class="sort-satker"><a href="<?php echo e(route('users.show', $user->id)); ?>" class="btn btn-primary" role="button">
                                <i class="fas fa-eye"></i> View
                              </a></td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
              <div id="table-default" class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th><button class="table-sort" data-sort="sort-managed-facilites">Managed Facilities</button></th>
                        <th><button class="table-sort" data-sort="sort-category">Category</button></th>
                        <th><button class="table-sort" data-sort="sort-satker">Actiom</button></th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($facility->uker_masters_id == $ukerMaster->id): ?>
                        <tr>
                            <td class="sort-uker"><?php echo e($facility->name); ?></td>
                            <td class="sort-uker"><?php echo e($facility->facilityCategory->category_str); ?></td>
                            <td class="sort-satker"><a href="<?php echo e(route('facilities.show', $facility->id)); ?>" class="btn btn-primary" role="button">
                                <i class="fas fa-eye"></i> View
                              </a></td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\uker_masters\show.blade.php ENDPATH**/ ?>