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
        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

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
                    <form action="<?php echo e(route('facilities.index')); ?>" method="GET" class="flex items-center">
                        <input type="text" name="search" placeholder="Search name or location, Leave blank to show all data" class="m-2 form-control d-inline-flex">
                        <select name="category" class="m-2 form-control d-inline-flex"> <!-- New select input for category filter -->
                            <option value="">All Categories</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_str); ?>" <?php echo e(request('category') == $category->category_str ? 'selected' : ''); ?>><?php echo e($category->category_str); ?> (jumlah fasilitas: <?php echo e($category->facilities->count()); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </form>
                    <?php if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))): ?>
                    <a href="<?php echo e(route('facilities.create')); ?>" class="m-2 btn btn-success">
                        Create <?php echo e($pageTitle); ?>

                    </a>
                    <?php endif; ?>
                </div>
                <div id="table-default" class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><button class="table-sort" data-sort="sort-location">Location</button></th>
                                <th><button class="table-sort" data-sort="sort-name">Facility Name</button></th>
                                <th><button class="table-sort" data-sort="sort-description">Description</button></th>
                                <th><button class="table-sort" data-sort="sort-category">Category</button></th>
                                <th><button class="table-sort" data-sort="sort-capacity">Capacity</button></th>
                                <th><button class="table-sort" data-sort="sort-facilitymanager">Managed by</button></th>
                                <th><button class="table-sort" data-sort="sort-actions">Actions</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="sort-location">
                                    <?php echo e($facility->location); ?>

                                    </td>
                                <td class="sort-name"><a href="<?php echo e(route('facilities.show', $facility->id)); ?>"><?php echo e($facility->name); ?></a></td>
                                <td class="sort-description"><?php echo e($facility->description); ?></td>
                                <td class="sort-category"><?php echo e($facility->facilityCategory->category_str); ?></td>
                                <td class="sort-capacity"><?php echo e($facility->capacity == null ? 'No data' : $facility->capacity); ?></td>
                                <td class="sort-facilitymanager"><?php echo e($facility->ukerMaster->nama_unit_kerja_eselon_2); ?>, <?php echo e($facility->ukerMaster->satkerMaster->nama_satker); ?></td>
                                <td class="sort-actions">
                                    <div class="mr-2" role="group" aria-label="User Actions">
                                        <div class="m-1 d-block">
                                            <a href="<?php echo e(route('facilities.show', $facility->id)); ?>" class="btn btn-primary" role="button">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </div>
                                        <?php if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager'))): ?>
                                        <div class="m-1 d-block">
                                            <a href="<?php echo e(route('facilities.edit', $facility->id)); ?>" class="btn btn-secondary" role="button">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                        </div>
                                        <form action="<?php echo e(route('facilities.destroy', $facility->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <div class="m-1 d-block">
                                                <button type="submit" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </button>
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    <?php echo e($facilities->links()); ?> <!-- Pagination Links -->
                </div>
            </div>
        </div>
        <script src="<?php echo e(asset('../build/assets/libs/list.js/dist/list.min.js?1692870487')); ?>" defer></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            const list = new List('table-default', {
                sortClass: 'table-sort',
                listClass: 'table-tbody',
                valueNames: [ 'sort-location', 'sort-name', 'sort-description', 'sort-category','sort-capacity','sort-facilitymanager',
                ]
            });
            })
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\facilities\index.blade.php ENDPATH**/ ?>