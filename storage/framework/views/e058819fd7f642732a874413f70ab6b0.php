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
        <?php echo e($pageTitle); ?>

     <?php $__env->endSlot(); ?>
     <?php $__env->slot('slot', null, []); ?> 
        <?php if(session('success')): ?>
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
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
                    <form action="<?php echo e(route('reservations.index')); ?>" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            placeholder="(leave blank to show all data) Search event, date, unit kerja or description"
                            class="m-2 form-control d-inline-flex">
                        <select name="status" class="m-2 form-control d-inline-flex">
                            <!-- New select input for status filter -->
                            <option value="">All Status</option>
                            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending
                            </option>
                            <option value="approved" <?php echo e(request('status') == 'approved' ? 'selected' : ''); ?>>Approved
                            </option>
                            <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Rejected
                            </option>
                        </select>
                        <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </form>
                    <a href="<?php echo e(route('reservations.create')); ?>" class="m-2 btn btn-success">
                        Make <?php echo e($pageTitle); ?>

                    </a>
                </div>
                <div id="table-default" class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><button class="table-sort" data-sort="sort-status">Status</button></th>
                                <th><button class="table-sort" data-sort="sort-facility">Facility Reserved</button></th>
                                <th><button class="table-sort" data-sort="sort-event">event</button></th>
                                <th><button class="table-sort" data-sort="sort-start">Start</button></th>
                                <th><button class="table-sort" data-sort="sort-end">End</button></th>
                                <th><button class="table-sort" data-sort="sort-pemohon">Requested By</button></th>
                                <th><button class="table-sort" data-sort="sort-manager">Managed By</button></th>
                                <th><button class="table-sort" data-sort="sort-actions">Actions</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(auth()->user()->hasRole('admin') ||
                                        ((auth()->user()->hasRole('manager') || auth()->user()->hasRole('verificator')) &&
                                            $reservation->facility->ukerMaster->id == Auth::user()->ukerMaster->id) ||
                                        $reservation->user->ukerMaster->id == Auth::user()->ukerMaster->id): ?>
                                    <tr>
                                        <td class="sort-status">
                                            <?php switch($reservation->status):
                                                case ('pending'): ?>
                                                    <span
                                                        class="text-white badge bg-warning"><?php echo e(strtoupper($reservation->status)); ?></span>
                                                <?php break; ?>

                                                <?php case ('approved'): ?>
                                                    <span
                                                        class="text-white badge bg-success"><?php echo e(strtoupper($reservation->status)); ?></span>
                                                <?php break; ?>

                                                <?php case ('rejected'): ?>
                                                    <span
                                                        class="text-white badge bg-danger"><?php echo e(strtoupper($reservation->status)); ?></span>
                                                <?php break; ?>

                                                <?php default: ?>
                                                    <span><?php echo e(strtoupper($reservation->status)); ?></span>
                                            <?php endswitch; ?>
                                        </td>
                                        <td class="sort-facility"><a
                                                href="<?php echo e(route('facilities.show', $reservation->facility->id)); ?>"><?php echo e($reservation->facility->name); ?></a>
                                        </td>
                                        <td class="sort-event"><?php echo e($reservation->event); ?></td>
                                        <td class="sort-start">
                                            <?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?>

                                        </td>
                                        <td class="sort-end">
                                            <?php echo e($reservation->reservation_end->translatedFormat('l, j F Y, H:i')); ?></td>
                                        <td class="sort-pemohon">
                                            <span>
                                                <h6><?php echo e($reservation->user->name); ?></h6>
                                            </span>
                                            <span>
                                                <h6><?php echo e($reservation->user->ukerMaster->nama_unit_kerja_eselon_2); ?></h6>
                                            </span>
                                            <span class="text-blue"><?php echo e($reservation->user->email); ?></span>
                                        </td>
                                        <td class="sort-manager">
                                            <?php echo e($reservation->facility->ukerMaster->nama_unit_kerja_eselon_2); ?></td>
                                        <td class="sort-actions">
                                            <div class="mr-2" role="group" aria-label="User Actions">
                                                <div class="m-1 d-block">
                                                    <a href="<?php echo e(route('reservations.show', $reservation->id)); ?>"
                                                        class="btn btn-primary" role="button">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </div>
                                                <?php if(Auth::user()->roleMaster->role_str == 'admin' || $reservation->status == 'pending'): ?>
                                                    <div class="m-1 d-block">
                                                        <a href="<?php echo e(route('reservations.edit', $reservation->id)); ?>"
                                                            class="btn btn-secondary" role="button">
                                                            <i class="fas fa-pencil-alt"></i> Edit
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(auth()->check() &&
                                                        (auth()->user()->hasRole('admin') ||
                                                            auth()->user()->hasRole('manager') ||
                                                            (auth()->check() && auth()->user()->hasRole('verificator')))): ?>
                                                    <div class="m-1 d-block">
                                                        <?php if(auth()->user()->hasRole('admin')): ?>
                                                            <a href="<?php echo e(route('reservations.admin.verify', $reservation->id)); ?>"
                                                                class="btn btn-info" role="button">
                                                                <i class="fas fa-pencil-alt"></i> Verify
                                                            </a>
                                                        <?php elseif(auth()->user()->hasRole('manager') || auth()->user()->hasRole('verificator')): ?>
                                                            <a href="<?php echo e(route('reservations.verify', $reservation->id)); ?>"
                                                                class="btn btn-info" role="button">
                                                                <i class="fas fa-pencil-alt"></i> Verify
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="m-1 d-block">
                                                    <form
                                                        action="<?php echo e(route('reservations.destroy', $reservation->id)); ?>"
                                                        method="POST" class="inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger" role="button"
                                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                                            <i class="far fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    <?php echo e($reservations->links()); ?> <!-- Pagination Links -->
                </div>
            </div>
        </div>
        <script src="<?php echo e(asset('../build/assets/libs/list.js/dist/list.min.js?1692870487')); ?>" defer></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const list = new List('table-default', {
                    sortClass: 'table-sort',
                    listClass: 'table-tbody',
                    valueNames: ['sort-status', 'sort-facility', 'sort-event', 'sort-start', 'sort-end',
                        'sort-pemohon', 'sort-uker'
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views/reservations/index.blade.php ENDPATH**/ ?>