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
     <?php $__env->slot('title', null, []); ?> 
        Create <?php echo e($pageTitle); ?>

     <?php $__env->endSlot(); ?>
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
        <section>
            <!-- Include Select2 CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

            <!-- Include jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Include Select2 JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

            <div class="col">
                <form class="card" action="<?php echo e(route('facilities.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-header">
                        <h3 class="card-title">Create <?php echo e($pageTitle); ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="capacity">Capacity (People/Orang)</label>
                            <input type="number" name="capacity" id="capacity" class="form-control"></input>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="floor">Floor</label>
                            <input type="number" name="floor" id="floor" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="facility_category_id">Select Category</label>
                            <select name="facility_category_id" id="facility_category_id" class="form-select"
                                style="width: 80%">
                                <option value="">Select Category</option>
                                <?php $__currentLoopData = $facilityCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facilityCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($facilityCategory->id); ?>"><?php echo e($facilityCategory->category_str); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="uker_masters_id">Select Unit Kerja</label>
                            <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
                                <select name="uker_masters_id" id="uker_masters_id" class="form-select"
                                    style="width: 80%">
                                    <option value="">Select Unit Kerja</option>
                                    <?php $__currentLoopData = $ukerMasters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ukerMaster): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ukerMaster->id); ?>">
                                            <?php echo e($ukerMaster->nama_unit_kerja_eselon_2); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php else: ?>
                                <div class="mb-4">
                                    <label class="form-label" for="uker"></label>
                                    <input type="text" value="<?php echo e(Auth::user()->ukerMaster->id); ?>"
                                        name="uker_masters_id" id="uker_masters_id" class="form-control" readonly
                                        required>
                                    <p><?php echo e(Auth::user()->ukerMaster->nama_unit_kerja_eselon_2); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Add image input fields -->
                        <div class="mb-4">
                            <label class="form-label" for="image_main">Main Image (Not Required)</label>
                            <input type="file" name="image_main" id="image_main" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="image_1">Image 1 (Not Required)</label>
                            <input type="file" name="image_1" id="image_1" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="image_2">Image 2 (Not Required)</label>
                            <input type="file" name="image_2" id="image_2" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="image_3">Image 3 (Not Required)</label>
                            <input type="file" name="image_3" id="image_3" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="google_map_link">Location</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="google_map_link">Google Map Link (Example/Contoh:
                                https://maps.app.goo.gl/j9tuxnVLYkgQzbjx8)</label>
                            <input type="text" name="google_map_link" id="google_map_link" class="form-control">
                        </div>
                        <!-- End of image input fields -->

                        <!-- Addon Checkboxes -->
                        <div class="mb-4">
                            <label class="form-label" for="addons">Select Addons</label>
                            <div>
                                <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="addons[]"
                                            value="<?php echo e($addon->id); ?>" id="addon<?php echo e($addon->id); ?>">
                                        <label class="form-check-label" for="addon<?php echo e($addon->id); ?>">
                                            <?php echo e($addon->addon_str); ?>

                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                $('#facility_category_id').select2({
                    placeholder: 'Search for Category',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#uker_masters_id').select2({
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\facilities\create.blade.php ENDPATH**/ ?>