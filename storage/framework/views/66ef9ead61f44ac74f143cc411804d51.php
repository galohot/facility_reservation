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
     <?php $__env->slot('title', null, []); ?> Dashboard <?php $__env->endSlot(); ?>
     <?php $__env->slot('slot', null, []); ?> 
        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Approved Reservation</div>
                                    </div>
                                    <div class="mb-3 h1">
                                        <?php
                                            $approvedReservation = 0;
                                        ?>
                                        <?php $__currentLoopData = $allReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($reservation->status == 'approved'): ?>
                                                <?php
                                                    $approvedReservation++;
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e(number_format(($approvedReservation / $allReservations->count()) * 100, 2)); ?> %
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <div>Approved Reservation: <?php echo e($approvedReservation); ?></div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success"
                                            style="width: <?php echo e(($approvedReservation / $allReservations->count()) * 100); ?>%"
                                            role="progressbar"
                                            aria-valuenow="<?php echo e(($approvedReservation / $allReservations->count()) * 100); ?>"
                                            aria-valuemin="0" aria-valuemax="100"
                                            aria-label="<?php echo e(($approvedReservation / $allReservations->count()) * 100); ?>% Complete">
                                            <span
                                                class="visually-hidden"><?php echo e(($approvedReservation / $allReservations->count()) * 100); ?>%
                                                Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Rejected Reservation</div>
                                    </div>
                                    <div class="mb-3 h1">
                                        <?php
                                            $rejectedReservation = 0;
                                        ?>
                                        <?php $__currentLoopData = $allReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($reservation->status == 'rejected'): ?>
                                                <?php
                                                    $rejectedReservation++;
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e(number_format(($rejectedReservation / $allReservations->count()) * 100, 2)); ?> %
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <div>Rejected Reservation: <?php echo e($rejectedReservation); ?></div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger"
                                            style="width: <?php echo e(($rejectedReservation / $allReservations->count()) * 100); ?>%"
                                            role="progressbar"
                                            aria-valuenow="<?php echo e(($rejectedReservation / $allReservations->count()) * 100); ?>"
                                            aria-valuemin="0" aria-valuemax="100"
                                            aria-label="<?php echo e(($rejectedReservation / $allReservations->count()) * 100); ?>% Complete">
                                            <span
                                                class="visually-hidden"><?php echo e(($rejectedReservation / $allReservations->count()) * 100); ?>%
                                                Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Pending Reservation</div>
                                    </div>
                                    <div class="mb-3 h1">
                                        <?php
                                            $pendingReservation = 0;
                                        ?>
                                        <?php $__currentLoopData = $allReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($reservation->status == 'pending'): ?>
                                                <?php
                                                    $pendingReservation++;
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e(number_format(($pendingReservation / $allReservations->count()) * 100, 2)); ?> %
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <div>Pending Reservation: <?php echo e($pendingReservation); ?></div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning"
                                            style="width: <?php echo e(($pendingReservation / $allReservations->count()) * 100); ?>%"
                                            role="progressbar"
                                            aria-valuenow="<?php echo e(($pendingReservation / $allReservations->count()) * 100); ?>"
                                            aria-valuemin="0" aria-valuemax="100"
                                            aria-label="<?php echo e(($pendingReservation / $allReservations->count()) * 100); ?>% Complete">
                                            <span
                                                class="visually-hidden"><?php echo e(($pendingReservation / $allReservations->count()) * 100); ?>%
                                                Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-primary avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-clock">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                                                            <path d="M16 3v4" />
                                                            <path d="M8 3v4" />
                                                            <path d="M4 11h10" />
                                                            <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                            <path d="M18 16.5v1.5l.5 .5" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium"><?php echo e($allReservations->count()); ?>

                                                        Total Reservations</div>
                                                    <div class="text-secondary">
                                                        <?php
                                                            $pendingCount = 0;
                                                        ?>
                                                        <?php $__currentLoopData = $allReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($reservation->status == 'pending'): ?>
                                                                <?php
                                                                    $pendingCount++;
                                                                ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($pendingCount > 0 ? $pendingCount . ' Pending' : '0 pending'); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-green avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-bus">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                            <path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                            <path
                                                                d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8" />
                                                            <path d="M16 5l1.5 7l4.5 0" />
                                                            <path d="M2 10l15 0" />
                                                            <path d="M7 5l0 5" />
                                                            <path d="M12 5l0 5" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium"> <?php echo e($allFacilities->count()); ?>

                                                        Facilities</div>
                                                    <div class="text-secondary"> <?php echo e($facilityCategories->count()); ?>

                                                        Categories</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-twitter avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium"><?php echo e($allUsers->count()); ?> Users
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-facebook avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M3 21l18 0" />
                                                            <path d="M5 21v-14l8 -4v18" />
                                                            <path d="M19 21v-10l-6 -4" />
                                                            <path d="M9 9l0 .01" />
                                                            <path d="M9 12l0 .01" />
                                                            <path d="M9 15l0 .01" />
                                                            <path d="M9 18l0 .01" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium"> <?php echo e($allUkers->count()); ?> Unit
                                                        Kerja </div>
                                                    <div class="text-secondary"> <?php echo e($allSatkers->count()); ?> Satuan
                                                        Kerja </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Most Reservations (Approved)</h3>
                                </div>
                                <table class="table card-table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Satker</th>
                                            <th>Reservations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $reservationCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($facility); ?></td>
                                                <td><?php echo e($count); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Most Facility Reserved (Approved)</h3>
                                </div>
                                <table class="table card-table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th>Facility</th>
                                            <th>Reservations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $facilityReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satker => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($satker); ?></td>
                                                <td><?php echo e($count); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Facilities</h3>
                                </div>
                                <div id="chart-demo-pie"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <h1 class="text-white badge bg-info">Timeline</h1>
                                    <div class="card" style="height: 28rem">
                                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                            <div class="divide-y">
                                                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong><?php echo e($reservation->user->ukerMaster->nama_unit_kerja_eselon_2); ?>

                                                                    </strong>
                                                                    <span>(<?php echo e($reservation->user->name); ?>)</span>
                                                                    <br />requested to reserve
                                                                    <strong><?php echo e($reservation->facility->name); ?></strong>
                                                                    <br />category:
                                                                    <strong><?php echo e($reservation->facility->facilityCategory->category_str); ?></strong>
                                                                </div>
                                                                <div class="text-secondary">For
                                                                    <?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?>

                                                                    -
                                                                    <?php echo e($reservation->reservation_end->translatedFormat('l, j F Y, H:i')); ?>

                                                                </div>
                                                                <div class="text-secondary">
                                                                    <?php echo e($reservation->timeDifference); ?></div>
                                                            </div>
                                                            <div class="col-auto align-self-center">
                                                                <?php switch($reservation->status):
                                                                    case ('pending'): ?>
                                                                        <div class="badge bg-warning"></div>
                                                                    <?php break; ?>

                                                                    <?php case ('approved'): ?>
                                                                        <div class="badge bg-success"></div>
                                                                    <?php break; ?>

                                                                    <?php case ('rejected'): ?>
                                                                        <div class="badge bg-danger"></div>
                                                                    <?php break; ?>

                                                                    <?php default: ?>
                                                                <?php endswitch; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php echo e($reservations->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
                    chart: {
                        type: "pie",
                        fontFamily: 'inherit',
                        height: 240,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: <?php echo json_encode($facilityByCategoryCount->values(), 15, 512) ?>, // Pass the counts as series data
                    labels: <?php echo json_encode($facilityByCategoryCount->keys(), 15, 512) ?>, // Pass the category names as labels
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    colors: ['#FF7F0E', '#2CA02C', '#1F77B4', '#FFD700', '#FF6347', '#BA55D3', '#7FFFD4',
                        '#FF1493', '#00FFFF', '#32CD32'
                    ],
                    tooltip: {
                        fillSeriesColor: false
                    },
                })).render();
            });
            // @formatter:on
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\dashboard.blade.php ENDPATH**/ ?>