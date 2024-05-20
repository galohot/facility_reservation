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
        <div class="page-wrapper">
            <div class="page-header">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col">
                    <a href="./" class="my-2 btn btn-secondary">Back</a>
                    <a href="<?php echo e(route('reservations.create')); ?>?facility_id=<?php echo e($facility->id); ?>" class="my-2 btn btn-success">Make reservation</a>
                    <?php if(Auth::user()->roleMaster->role_str == 'admin' || Auth::user()->roleMaster->role_str == 'manager' && $facility->ukerMaster->id == Auth::user()->ukerMaster->id): ?>
                    <a href="<?php echo e(route('facilities.edit', $facility->id)); ?>" class="my-2 btn btn-info">Edit Facility</a>
                    <?php endif; ?>
                    <h1 class="fw-bold"><?php echo e($facility->name); ?></h1>
                    <div class="my-2"><?php echo e($facility->description); ?></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
              <div class="container-xl">
                <div class="row g-3">
                  <div class="col">
                    <ul class="timeline">
                    <?php if($facility->image_main): ?>
                    <li class="timeline-event">
                            <div class="card timeline-event-card">
                                <div class="card-body">
                                <div class="text-secondary float-end"><?php echo e($facility->updated_at->format('F j, Y, g:i a')); ?></div>
                                <h4><?php echo e($facility->name); ?> Main Image</h4>
                                <img src="<?php echo e(asset('storage/' . $facility->image_main )); ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if($facility->image_1): ?>
                    <li class="timeline-event">
                        <div class="card timeline-event-card">
                        <div class="card-body">
                            <div class="text-secondary float-end"><?php echo e($facility->updated_at->format('F j, Y, g:i a')); ?></div>
                            <h4><?php echo e($facility->name); ?> Image 1</h4>
                            <img src="<?php echo e(asset('storage/' . $facility->image_1 )); ?>" alt="" class="img-fluid">
                        </div>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if($facility->image_2): ?>
                      <li class="timeline-event">
                        <div class="card timeline-event-card">
                          <div class="card-body">
                            <div class="text-secondary float-end"><?php echo e($facility->updated_at->format('F j, Y, g:i a')); ?></div>
                            <h4><?php echo e($facility->name); ?> Image 2</h4>
                            <img src="<?php echo e(asset('storage/' . $facility->image_2 )); ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if($facility->image_3): ?>
                      <li class="timeline-event">
                        <div class="card timeline-event-card">
                          <div class="card-body">
                            <div class="text-secondary float-end"><?php echo e($facility->updated_at->format('F j, Y, g:i a')); ?></div>
                            <h4><?php echo e($facility->name); ?> Image 3</h4>
                            <img src="<?php echo e(asset('storage/' . $facility->image_3 )); ?>" alt="" class="img-fluid">
                            </div>
                            </div>
                        </li>
                    <?php endif; ?>
                    </ul>
                  </div>
                  <div class="col-lg-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Reservations</div>
                                    <?php
                                        // Filter past reservations and sort the remaining reservations by their proximity to the current datetime
                                        $sortedReservations = $reservations->where('facility_id', $facility->id)
                                                                            ->where('status', 'approved')
                                                                            ->filter(function ($reservation) {
                                                                                return strtotime($reservation->reservation_end) > time();
                                                                            })
                                                                            ->sortBy(function($reservation) {
                                                                                return abs(strtotime($reservation->reservation_start) - time());
                                                                            })
                                                                            ->values();

                                        // Limit the number of reservations to 3
                                        $limitedReservations = $sortedReservations->take(3);
                                    ?>

                                    <?php $__currentLoopData = $limitedReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-2 text-center border">
                                            <p><?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?> <br /> s/d <?php echo e($reservation->reservation_end->translatedFormat('l, j F Y, H:i')); ?></p>
                                            <div class="reservation-info"> <!-- Add this container -->
                                                <strong><span class="text-white badge bg-success text-wrap" style="display: inline-block; word-break: break-all;"><?php echo e($reservation->user->ukerMaster->nama_unit_kerja_eselon_2); ?></span></strong>
                                            </div>
                                            <br />
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>

                      <div class="col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title"><?php echo e($pageTitle); ?> info</div>
                            <div class="mb-2">
                              Category: <br /> <strong><?php echo e($facility->facilityCategory->category_str); ?></strong>
                            </div>
                            <div class="mb-2">
                              Floor <br /> <strong><?php echo e($facility->floor); ?></strong>
                            </div>
                            <div class="mb-2">
                              Capacity <br /> <strong><?php echo e($facility->capacity ? $facility->capacity : 'No data available'); ?></strong>
                            </div>
                            <div class="mb-2">
                              Facility Manager <br /> <strong><?php echo e($facility->ukerMaster->nama_unit_kerja_eselon_2); ?></strong>
                            </div>
                            <div class="mb-2">
                              Satuan Kerja <br /> <strong><?php echo e($facility->ukerMaster->satkerMaster->nama_satker); ?></strong>
                            </div>
                            <div class="mb-2">
                              Addons: <br />
                            <ul style="list-style-type: none;">
                                <?php $__currentLoopData = $facility->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><strong><?php echo e($addon->addon_str); ?></strong></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title"><?php echo e($pageTitle); ?> Location</div>
                            <div class="card-body">
                                <h4><?php echo e($facility->location); ?></h4>
                                <?php if($facility->google_map_link): ?>
                                    <a href="<?php echo e($facility->google_map_link); ?>" target="_blank"><img src="<?php echo e(asset('build/assets/img/google-maps.png')); ?>" alt=""></a>
                                <?php else: ?>
                                    No Google Map link/Location provided
                                <?php endif; ?>
                            </div>
                          </div>
                        </div>
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views/facilities/show.blade.php ENDPATH**/ ?>