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
     <?php $__env->slot('title', null, []); ?> 
        Facility Detail
     <?php $__env->endSlot(); ?>
     <?php $__env->slot('slot', null, []); ?> 
        <div class="container">
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
                            <div class="row g-0">
                                <div class="col-12 col-md-3">
                                    <img src="<?php echo e(asset('storage/' . $facility->image_main)); ?>"
                                         class="object-cover w-100 h-100 card-img-start" alt="Main Image for Facility" />
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo e($facility->name); ?></h3>
                                        <p class="text-secondary">Capacity: <?php echo e($facility->capacity); ?>, Location: <?php echo e($facility->location); ?></p>
                                        <?php
                                            $hasUpcomingReservation = false;
                                            $currentTimestamp = time();
                                            $nextReservation = null;
                                        ?>
                                        <?php $__currentLoopData = $facility->reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($reservation->status == 'approved'): ?>
                                                <?php if($currentTimestamp <= strtotime($reservation->reservation_start)): ?>
                                                    <p>Upcoming Reservation <span class="text-white badge bg-warning"><?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?></span></p>
                                                    <?php
                                                        $hasUpcomingReservation = true;
                                                        break;
                                                    ?>
                                                <?php elseif(strtotime($reservation->reservation_start) <= $currentTimestamp && $currentTimestamp <= strtotime($reservation->reservation_end)): ?>
                                                    <p class="text-white badge bg-danger">Currently Booked | Unavailable until: <?php echo e($reservation->reservation_end->translatedFormat('l, j F Y, H:i')); ?></p>
                                                    <?php
                                                        $hasUpcomingReservation = true;
                                                    ?>
                                                    <?php $__currentLoopData = $facility->reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nextReservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($nextReservation->status == 'approved' && strtotime($nextReservation->reservation_start) > strtotime($reservation->reservation_end)): ?>
                                                            <p>Next Approved Booking: <span class="text-white badge bg-warning"><?php echo e($nextReservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?></span></p>
                                                            <?php break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php break; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!$hasUpcomingReservation): ?>
                                            <p class="text-white badge bg-success">No Upcoming Reservations</p>
                                        <?php endif; ?>
                                        <p>Managed by: <span class="text-white badge bg-info"><?php echo e($facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span></p>
                                    </div>
                                    <div class="top-0 m-3 d-flex flex-column align-items-end position-absolute end-0">
                                        <a href="<?php echo e(route('reservation.make')); ?>?facility_id=<?php echo e($facility->id); ?>" class="my-2 btn btn-success w-100">Make reservation</a>
                                        <a href="<?php echo e(route('facility.page', $facility->id)); ?>" class="btn btn-primary w-100" role="button"><i class="fas fa-eye"></i> View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="m-4">
                <?php echo e($facilities->links()); ?> <!-- Pagination Links -->
            </div>
        </div>
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views/landing/content/facility/show.blade.php ENDPATH**/ ?>