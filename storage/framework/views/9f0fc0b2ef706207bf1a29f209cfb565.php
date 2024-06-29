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
     <?php $__env->slot('header', null, []); ?> 
        <!-- Include Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Include jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Include Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <!-- Include Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Include Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
            <div class="col">
                <form class="card" id="reservationForm" action="<?php echo e(route('landing.store')); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-header">
                        <h3 class="card-title">Make Reservation</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">
                        <input type="hidden" name="description" value="pending">
                        <div class="mb-4">
                            <label class="form-label required" for="facility_id">Select Facility</label>
                            <select name="facility_id" id="facility_id" class="form-select" style="width: 80%">
                                <option value="">Select Facility</option>
                                <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($facility->id); ?>"><?php echo e($facility->name); ?>,
                                        <?php echo e($facility->facilityCategory->category_str); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="my-3 form-group col-3 d-flex align-items-end">
                            <button type="button" id="checkAvailability" class="ms-2 btn btn-primary">Check
                                Availability</button>
                        </div>
                        <!-- Add the badge and hide initially -->
                        <div class="mb-4">
                            <p id="availabilitySuccess" class="text-white badge bg-success" style="display:none;">Availability
                                check successful!</p>
                            </div>
                        <!-- Hide the date pickers initially -->
                        <div id="datePickers" style="display:none;">
                            <p class="text-white badge bg-warning">Please redo the availibility check if different facility is selected</p>
                            <div class="mb-4 col-6">
                                <label class="form-label" for="reservation_start">Event Starts</label>
                                <input type="text" name="reservation_start" id="reservation_start"
                                    class="form-control flatpickr"></input>
                            </div>
                            <div class="mb-4 col-6">
                                <label class="form-label" for="reservation_end">Event Ends</label>
                                <input type="text" name="reservation_end" id="reservation_end"
                                    class="form-control flatpickr"></input>
                            </div>
                            <div class="mb-4">
                                <label class="form-label required" for="event">Event</label>
                                <textarea name="event" id="event" class="form-control" required></textarea>
                            </div>
                            <!-- Add doc input fields -->
                            <div class="mb-4">
                                <label class="form-label" for="document">Document/Nota Dinas/Memorandum</label>
                                <input type="file" name="document" id="document" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="document_attachment">Attachment/Lampiran (Not
                                    Required)</label>
                                <input type="file" name="document_attachment" id="document_attachment"
                                    class="form-control">
                            </div>
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
                        allowClear: true
                    });
                });

                document.addEventListener('DOMContentLoaded', function() {
                    // Initialize Flatpickr with minuteIncrement set to 30
                    flatpickr('.flatpickr', {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        time_24hr: true,
                        minuteIncrement: 30
                    });

                    // Retrieve and set query parameters if present
                    const urlParams = new URLSearchParams(window.location.search);
                    const startDate = urlParams.get('start_date');
                    if (startDate) {
                        document.getElementById('reservation_start')._flatpickr.setDate(startDate + 'T08:00');
                    }

                    const facilityId = urlParams.get('facility_id');
                    if (facilityId) {
                        document.getElementById('facility_id').value = facilityId;
                    }
                });

                $('#checkAvailability').on('click', function() {
                    var facilityId = $('#facility_id').val();
                    if (facilityId) {
                        $.ajax({
                            url: '<?php echo e(route('facility.checkAvailability')); ?>',
                            type: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                facility_id: facilityId
                            },
                            success: function(response) {
                                // Process and display the response (unavailable dates)
                                // You can use a modal, alert, or update a section of the page with the data
                                console.log(response); // For debugging

                                // Initialize Flatpickr with disabled dates and times
                                flatpickr('.flatpickr', {
                                    enableTime: true,
                                    dateFormat: "Y-m-d H:i",
                                    time_24hr: true,
                                    minuteIncrement: 30,
                                    disable: [
                                        function(date) {
                                            for (var i = 0; i < response.length; i++) {
                                                var unavailable = response[i];
                                                var start = new Date(unavailable.start);
                                                var end = new Date(unavailable.end);

                                                if (date >= start && date <= end) {
                                                    return true;
                                                }
                                            }
                                            return false;
                                        }
                                    ]
                                });

                                // Show the date pickers and success message
                                $('#datePickers').show();
                                $('#availabilitySuccess').show();
                            },
                            error: function(xhr) {
                                // Handle any errors that occurred during the request
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        alert('Please select a facility first.');
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