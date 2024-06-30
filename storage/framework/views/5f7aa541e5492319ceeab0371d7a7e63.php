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
        Find Facility
     <?php $__env->endSlot(); ?>
     <?php $__env->slot('header', null, []); ?> 
        <!-- Include Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Include Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <style>
            /* Custom styles for the WhatsApp contact card */
            .custom-card {
                border: 1px solid #e3e6f0;
                border-radius: 8px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                background-color: #ffffff;
            }

            .custom-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .custom-card .card-title {
                color: #343a40;
                font-weight: bold;
            }

            .custom-card .card-text {
                color: #6c757d;
                margin-bottom: 1.5rem;
            }

            .custom-card .btn-whatsapp {
                background-color: #25d366;
                border-color: #25d366;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .custom-card .btn-whatsapp:hover {
                background-color: #1ebe53;
                border-color: #1ebe53;
            }

            .custom-card .btn-whatsapp i {
                margin-right: 8px;
            }
        </style>
     <?php $__env->endSlot(); ?>
     <?php $__env->slot('slot', null, []); ?> 
        <div>
            <h1>Search for Facilities</h1>
            <form action="<?php echo e(route('landing.search')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="category">Category</label>
                        <p>(Leave blank for all categories)</p>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>">
                                    <?php echo e($category->category_str); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="start_date">Start Date</label>
                        <p>(This cannot be empty)</p>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control flatpickr"
                            value="<?php echo e(old('start_date', $startDate ?? '')); ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="end_date">End Date</label>
                        <p>(Fill in the end date)</p>
                        <input type="datetime-local" name="end_date" id="end_date" class="form-control flatpickr"
                            value="<?php echo e(old('end_date', $endDate ?? '')); ?>">
                    </div>
                </div>
                <div class="my-3 form-group col-3 d-flex align-items-end">
                    <button type="submit" class="ms-2 btn btn-primary">Search</button>
                </div>
            </form>

            <?php if(isset($facilities)): ?>
                <div class="my-5">
                    <h2 class="page-title">
                        Available Facilities
                    </h2>
                </div>
                <ul class="list-group">
                    <?php $__empty_1 = true; $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col">
                            <div class="my-1 card">
                                <div class="row g-0">
                                    <div class="col-12 col-md-3">
                                        <!-- Photo -->
                                        <img src="<?php echo e(asset('storage/' . $facility->image_main)); ?>"
                                            class="object-cover w-100 h-100 card-img-start"
                                            alt="Main Image for Facility" />
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="card-body">
                                            <h3 class="card-title"><?php echo e($facility->name); ?></h3>
                                            <p class="text-secondary">Capacity: <?php echo e($facility->capacity); ?>, Location:
                                                <?php echo e($facility->location); ?></p>
                                            <?php $hasUpcomingReservation = false; ?>
                                            <?php $__currentLoopData = $facility->reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(time() < $startDate && $reservation->status == 'approved'): ?>
                                                    <p>Upcoming Reservation: <span
                                                            class="text-white badge bg-warning"><?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?></span>
                                                        to <span
                                                            class="text-white badge bg-warning"><?php echo e($reservation->reservation_end->translatedFormat('l, j F Y, H:i')); ?></span>
                                                    </p>
                                                    <?php $hasUpcomingReservation = true; ?>
                                                <?php break; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!$hasUpcomingReservation): ?>
                                            <p class="text-white badge bg-success">No Upcoming Reservations</p>
                                        <?php endif; ?>
                                        <p>Managed by: <span
                                                class="text-white badge bg-info"><?php echo e($facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span>
                                        </p>
                                    </div>
                                    <div
                                        class="top-0 m-3 d-flex flex-column align-items-end position-absolute end-0">
                                        <a href="<?php echo e(route('reservation.make')); ?>?facility_id=<?php echo e($facility->id); ?>"
                                            class="my-2 btn btn-success w-100">Make Reservation</a>
                                        <a href="<?php echo e(route('facility.page', $facility->id)); ?>"
                                            class="btn btn-primary w-100" role="button"><i class="fas fa-eye"></i>
                                            View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item">No facilities available for the selected date range and
                            category.
                        </li>
                <?php endif; ?>

            </ul>
            <!-- Pagination Links -->
        <?php endif; ?>
    </div>
    <div>
        <div class="mt-5 row row-cards">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-xl-3">
                    <a class="card card-link" href="<?php echo e(route('available.facilities.show', $category->id)); ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <span class="rounded avatar"
                                        style="background-image: url(<?php echo e(asset('storage/' . $category->facilities->first()->image_main)); ?>)"></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium"><?php echo e($category->category_str); ?></div>
                                    <div class="text-secondary"><?php echo e($category->facilities->count()); ?> Facilities
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="m-1 card custom-card">
                    <div class="text-center card-body">
                        <h5 class="card-title">Pengaduan Fasilitas</h5>
                        <p class="card-text">Description</p>
                        <a href="https://wa.me/1234567890" class="btn btn-whatsapp" target="_blank">
                            <i class="fab fa-whatsapp"></i> Contact Us on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="m-1 card custom-card">
                    <div class="text-center card-body">
                        <h5 class="card-title">Pengaduan Layanan</h5>
                        <p class="card-text">Description</p>
                        <a href="https://wa.me/1234567890" class="btn btn-whatsapp" target="_blank">
                            <i class="fab fa-whatsapp"></i> Contact Us on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <?php $__env->endSlot(); ?>
 <?php $__env->slot('script', null, []); ?> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr with minuteIncrement set to 30
            flatpickr('.flatpickr', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                disableMobile: true,
                minuteIncrement: 30
            });
        });
    </script>
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\landing\content\search.blade.php ENDPATH**/ ?>