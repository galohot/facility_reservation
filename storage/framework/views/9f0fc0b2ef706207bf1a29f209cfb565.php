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
        Make Reservation
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
                <form class="card" action="<?php echo e(route('landing.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-header">
                        <h3 class="card-title">Make Reservation</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">
                        <input type="hidden" name="description" value="pending">
                        <div class="mb-4">
                            <label class="form-label required" for="facility_category_id">Select Facility</label>
                            <select name="facility_id" id="facility_id" class="form-select" style="width: 80%">
                                <option value="">Select Facility</option>
                                <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($facility->id); ?>"><?php echo e($facility->name); ?>, <?php echo e($facility->facilityCategory->category_str); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="name">Event</label>
                            <textarea name="event" id="event" class="form-control" required></textarea>
                        </div>
                        <div class="mb-4 col-6">
                            <label class="form-label" for="reservation_start">Event Starts</label>
                            <input type="datetime-local" name="reservation_start" id="reservation_start" class="form-control"></input>
                        </div>
                        <div class="mb-4 col-6">
                            <label class="form-label" for="reservation_end">Event Ends</label>
                            <input type="datetime-local" name="reservation_end" id="reservation_end" class="form-control"></input>
                        </div>
                        <!-- Add doc input fields -->
                        <div class="mb-4">
                            <label class="form-label" for="document">Document/Nota Dinas/Memorandum</label>
                            <input type="file" name="document" id="document" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="document_attachment">Attachment/Lampiran (Not Required)</label>
                            <input type="file" name="document_attachment" id="document_attachment" class="form-control">
                        </div>
                        <!-- End of doc input fields -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
         <?php $__env->slot('script', null, []); ?> 
            <script>
                $(document).ready(function() {
                    $('#facility_id').select2({
                        placeholder: 'Search for Facility to reserve',
                        allowClear: true // Add this line if you want to allow clearing the selection
                    });
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Retrieve the start date query parameter from the URL
                    const urlParams = new URLSearchParams(window.location.search);
                    const startDate = urlParams.get('start_date');
                    // If the start date query parameter is present, set the value of the reservation start date input field
                    if (startDate) {
                        // Append 'T08:00' to set the default time to 8am
                        document.getElementById('reservation_start').value = startDate + 'T08:00';
                    }
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Retrieve the start date query parameter from the URL
                    const urlParams = new URLSearchParams(window.location.search);
                    const facilityId = urlParams.get('facility_id');

                    // If the start date query parameter is present, set the value of the reservation start date input field
                    if (facilityId) {
                        // Append 'T08:00' to set the default time to 8am
                        document.getElementById('facility_id').value = facilityId;
                    }
                });
            </script>
         <?php $__env->endSlot(); ?>
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\landing\content\reservation.blade.php ENDPATH**/ ?>