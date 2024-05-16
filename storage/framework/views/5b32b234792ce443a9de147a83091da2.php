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
        <?php if(session('success')): ?>
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    </div>
                    <div>
                        <?php echo e(session('success')); ?>

                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col">
                      <h2 class="page-title">
                        <?php echo e($pageTitle); ?>

                      </h2>
                    </div>
                  </div>
                <div class="flex justify-between mt-4 col-6">
                    <form action="<?php echo e(route('satker_masters.index')); ?>" method="GET" class="flex items-center">
                      <input type="text" name="search" placeholder="Search name or email, Leave blank to show all data" class="m-2 form-control d-inline-flex">
                      <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </form>
                    <a href="<?php echo e(route('satker_masters.create')); ?>" class="m-2 btn btn-success">
                        Create <?php echo e($pageTitle); ?>

                      </a>
                  </div>
              <div id="table-default" class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Kode Satuan</th>
                      <th>Nama Satuan Kerja</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    <?php $__currentLoopData = $satkerMasters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satkerMaster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="sort-name"><?php echo e($satkerMaster->kd_satker); ?></td>
                      <td class="sort-email"><?php echo e($satkerMaster->nama_satker); ?></td>
                      <td class="sort-actions">
                        <div class="mr-2" role="group" aria-label="User Actions">
                            <div class="m-1 d-block">
                                <a href="<?php echo e(route('satker_masters.show', $satkerMaster->id)); ?>" class="btn btn-primary" role="button">
                                  <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                            <div class="m-1 d-block">
                                <a href="<?php echo e(route('satker_masters.edit', $satkerMaster->id)); ?>" class="btn btn-secondary" role="button">
                                  <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                            </div>
                            <form action="<?php echo e(route('satker_masters.destroy', $satkerMaster->id)); ?>" method="POST" class="inline">
                              <?php echo csrf_field(); ?>
                              <?php echo method_field('DELETE'); ?>
                              <div class="m-1 d-block">
                                  <button type="submit" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this user?');">
                                    <i class="far fa-trash-alt"></i> Delete
                                  </button>
                              </div>
                            </form>
                          </div>

                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
              <div class="m-4"  >
                <?php echo e($satkerMasters->links()); ?> <!-- Pagination Links -->
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\satker_masters\index.blade.php ENDPATH**/ ?>