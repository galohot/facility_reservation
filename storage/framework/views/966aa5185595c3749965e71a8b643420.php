<?php if (isset($component)) { $__componentOriginal61b7c119be9b054fc3033ecd71de14c0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61b7c119be9b054fc3033ecd71de14c0 = $attributes; } ?>
<?php $component = App\View\Components\LandingLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('landing-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\LandingLayout::class))->getConstructor()): ?>
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

        <div class="my-4">
            <form action="<?php echo e(route('available.facilities.show', $facilityCategory->id)); ?>" method="GET">
                <input type="text" name="search" placeholder="Search name or location" class="form-control">
                <button type="submit" class="mt-2 btn btn-primary">Search</button>
            </form>
        </div>

        <h2 class="mt-2 mb-5 page-title">
            Available Facilities for <?php echo e($selectedCategory); ?>

        </h2>

        <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($facility->facility_category_id == $facilityCategory->id): ?>
                <div class="my-2 col">
                    <div class="card">
                        <div class="row row-0">
                            <div class="col-3">
                                <img src="<?php echo e(asset('storage/' . $facility->image_main)); ?>" class="object-cover w-100 h-100 card-img-start" alt="Main Image for Facility" />
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo e($facility->name); ?></h3>
                                    <p class="text-secondary">Capacity: <?php echo e($facility->capacity); ?>, location: <?php echo e($facility->location); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61b7c119be9b054fc3033ecd71de14c0)): ?>
<?php $attributes = $__attributesOriginal61b7c119be9b054fc3033ecd71de14c0; ?>
<?php unset($__attributesOriginal61b7c119be9b054fc3033ecd71de14c0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61b7c119be9b054fc3033ecd71de14c0)): ?>
<?php $component = $__componentOriginal61b7c119be9b054fc3033ecd71de14c0; ?>
<?php unset($__componentOriginal61b7c119be9b054fc3033ecd71de14c0); ?>
<?php endif; ?>
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\landing\content\facility\show.blade.php ENDPATH**/ ?>