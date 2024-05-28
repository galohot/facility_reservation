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
        Verify <?php echo e($pageTitle); ?>

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
                                    <p><strong>User: </strong><?php echo e($reservation->user->name); ?></p>
                                    <p><strong>Event: </strong> <?php echo e($reservation->event); ?></p>
                                    <p><strong>Facility: </strong><a
                                            href="<?php echo e(route('facilities.show', $reservation->facility->id)); ?>"><?php echo e($reservation->facility->name); ?></a>
                                    </p>
                                    <p><strong>Reservation Start:
                                        </strong><?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?>

                                    </p>
                                    <p><strong>Reservation End:
                                        </strong><?php echo e($reservation->reservation_start->translatedFormat('l, j F Y, H:i')); ?>

                                    </p>
                                    <p><strong>Unit Kerja Pemohon:
                                        </strong><?php echo e($reservation->user->ukerMaster->nama_unit_kerja_eselon_2); ?></p>
                                    
                                    <p>
                                        <strong>Status: </strong>
                                        <?php switch($reservation->status):
                                            case ('pending'): ?>
                                                <span
                                                    class="text-white badge bg-warning"><?php echo e(strtoupper($reservation->status)); ?></span>,
                                                Verificator: <span
                                                    class="text-white badge bg-info"><?php echo e($reservation->facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span>
                                            <?php break; ?>

                                            <?php case ('approved'): ?>
                                                <span
                                                    class="text-white badge bg-success"><?php echo e(strtoupper($reservation->status)); ?></span>,
                                                Verificator: <span
                                                    class="text-white badge bg-info"><?php echo e($reservation->facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span>
                                            <?php break; ?>

                                            <?php case ('rejected'): ?>
                                                <span
                                                    class="text-white badge bg-danger"><?php echo e(strtoupper($reservation->status)); ?></span>,
                                                Verificator: <span
                                                    class="text-white badge bg-info"><?php echo e($reservation->facility->ukerMaster->nama_unit_kerja_eselon_2); ?></span>
                                            <?php break; ?>

                                            <?php default: ?>
                                                <span><?php echo e(strtoupper($reservation->status)); ?></span>
                                        <?php endswitch; ?>
                                    </p>
                                    <?php if($reservation->document): ?>
                                        <p><a href="<?php echo e(url(Storage::url($reservation->document))); ?>"
                                                target="_blank">Download Document</a></p>
                                    <?php endif; ?>
                                    <!-- Add a link to download the document attachment -->
                                    <?php if($reservation->document_attachment): ?>
                                        <p><a href="<?php echo e(Storage::url($reservation->document_attachment)); ?>"
                                                target="_blank">Download Document Attachment</a></p>
                                    <?php endif; ?>
                                    <!-- Buttons for verifying and rejecting -->
                                    <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
                                        <form method="POST"
                                            action="<?php echo e(route('reservations.admin.verify', $reservation->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <div class="mb-4">
                                                <label class="form-label required" for="description">Description</label>
                                                <p>Contoh: <span class="text-white badge bg-success">"Disetujui"</span>
                                                    atau <span class="text-white badge bg-danger">"Dokumen tidak
                                                        lengkap"</span></p>
                                                <textarea name="description" id="description" class="form-control" required><?php echo e($reservation->description); ?></textarea>
                                            </div>
                                            <button type="submit" name="status" value="approved"
                                                class="btn btn-success">Verify</button>
                                            <button type="submit" name="status" value="pending"
                                                class="btn btn-warning">Pending</button>
                                            <button type="submit" name="status" value="rejected"
                                                class="btn btn-danger">Reject</button>
                                        </form>
                                    <?php endif; ?>
                                    <?php if(auth()->user()->hasUker($reservation->facility->ukerMaster->id)): ?>
                                        <form method="POST"
                                            action="<?php echo e(route('reservations.verify', $reservation->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <div class="mb-4">
                                                <label class="form-label required" for="description">Description</label>
                                                <p>Contoh: <span class="text-white badge bg-success">"Disetujui"</span>
                                                    atau <span class="text-white badge bg-danger">"Dokumen tidak
                                                        lengkap"</span></p>
                                                <textarea name="description" id="description" class="form-control" required><?php echo e($reservation->description); ?></textarea>
                                            </div>
                                            <button type="submit" name="status" value="approved"
                                                class="btn btn-success">Verify</button>
                                            <button type="submit" name="status" value="pending"
                                                class="btn btn-warning">Pending</button>
                                            <button type="submit" name="status" value="rejected"
                                                class="btn btn-danger">Reject</button>
                                        </form>
                                    <?php endif; ?>
                                    <a href="./" class="mt-3 btn btn-secondary">Back</a>
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\reservations\verify.blade.php ENDPATH**/ ?>