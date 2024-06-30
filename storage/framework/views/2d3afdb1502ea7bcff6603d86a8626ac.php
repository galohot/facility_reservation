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
        Edit Reservation
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
                <form class="card" id="reservationForm"
                    action="<?php echo e(route('landing.reservation.update', $reservation->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="card-header">
                        <h3 class="card-title">Edit Reservation</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">
                        <input type="hidden" name="description" value="pending">
                        <div class="mb-4">
                            <label class="form-label required" for="facility_id">Select Facility</label>
                            <select name="facility_id" id="facility_id" class="form-select" style="width: 80%">
                                <option value="">Select Facility</option>
                                <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($facility->id); ?>"
                                        <?php echo e($facility->id == $reservation->facility_id ? 'selected' : ''); ?>>
                                        <?php echo e($facility->name); ?>, <?php echo e($facility->facilityCategory->category_str); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="my-3 form-group col-3 d-flex align-items-end">
                            <button type="button" id="checkAvailability" class="ms-2 btn btn-primary">Check
                                Availability</button>
                        </div>
                        <!-- Add the badge and hide initially -->
                        <div class="mb-4">
                            <p id="availabilitySuccess" class="text-white badge bg-success" style="display:none;">
                                Availability check successful!
                            </p>
                        </div>
                        <!-- Hide the date pickers initially -->
                        <div id="datePickers" style="display:none;">
                            <!-- Facility Card -->
                            <div id="facilityCard" style="display:none;" class="my-2 col">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-12 col-md-3">
                                            <img id="facilityImage" class="object-cover w-100 h-100 card-img-start"
                                                src="" alt="Facility Image">
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <div class="card-body">
                                                <h5 id="facilityName" class="card-title"></h5>
                                                <p id="facilityLocation" class="text-secondary"></p>
                                                <div
                                                    class="top-0 m-3 d-flex flex-column align-items-end position-absolute end-0">
                                                    <a href="#" id="viewFacilityLink"
                                                        class="btn btn-primary w-100" role="button">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="unavailableDates"></div>
                                <div class="mb-4 col col-md-6">
                                    <label class="form-label" for="reservation_start">Event Starts</label>
                                    <input type="text" name="reservation_start" id="reservation_start"
                                        value="<?php echo e($reservation->reservation_start); ?>" class="form-control flatpickr">
                                </div>
                                <div class="mb-4 col col-md-6">
                                    <label class="form-label" for="reservation_end">Event Ends</label>
                                    <input type="text" name="reservation_end" id="reservation_end"
                                        value="<?php echo e($reservation->reservation_end); ?>" class="form-control flatpickr">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label required" for="event">Event</label>
                                    <textarea name="event" id="event" class="form-control" required><?php echo e($reservation->event); ?></textarea>
                                </div>
                                <!-- Add doc input fields -->
                                <div class="mb-4">
                                    <label class="form-label" for="document">Document/Nota Dinas/Memorandum</label>
                                    <input type="file" name="document" id="document" class="form-control">
                                    <p
                                        class="badge <?php echo e($reservation->document ? 'bg-success' : 'bg-danger'); ?> text-white">
                                        <?php echo e($reservation->document ? 'A document has been uploaded' : 'No document has been uploaded'); ?>

                                    </p>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="document_attachment">Attachment/Lampiran (Not
                                        Required)</label>
                                    <input type="file" name="document_attachment" id="document_attachment"
                                        class="form-control">
                                    <p
                                        class="badge <?php echo e($reservation->document_attachment ? 'bg-success' : 'bg-danger'); ?> text-white">
                                        <?php echo e($reservation->document_attachment ? 'A document has been uploaded' : 'No document has been uploaded'); ?>

                                    </p>
                                </div>
                                <!-- End of doc input fields -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
     <?php $__env->endSlot(); ?>
     <?php $__env->slot('script', null, []); ?> 
        <script>
            $(document).ready(function() {
                $('#facility_id').select2({
                    placeholder: 'Search for Facility to reserve',
                    allowClear: true
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Flatpickr with minuteIncrement set to 15
                flatpickr('.flatpickr', {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    time_24hr: true,
                    minuteIncrement: 15
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
                            // Sort unavailable dates by start date/time (earliest first)
                            response.unavailableDates.sort(function(a, b) {
                                return new Date(a.start) - new Date(b.start);
                            });

                            // Destroy the existing Flatpickr instance
                            $('.flatpickr').each(function() {
                                const instance = $(this).data('flatpickr');
                                if (instance) {
                                    instance.destroy();
                                }
                            });

                            // Initialize Flatpickr with unavailable dates marked
                            flatpickr('.flatpickr', {
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                                time_24hr: true,
                                minuteIncrement: 15,
                                disable: response.unavailableDates.map(function(unavailable) {
                                    return {
                                        from: new Date(unavailable.start).toISOString(),
                                        to: new Date(new Date(unavailable.end).setSeconds(0,
                                                0) - 87300000)
                                        .toISOString() // End of the day
                                    };
                                }),
                                onChange: function(selectedDates, dateStr, instance) {
                                    var isUnavailable = response.unavailableDates.some(function(
                                        unavailable) {
                                        var start = new Date(unavailable.start);
                                        var end = new Date(unavailable.end);

                                        return selectedDates.some(function(date) {
                                            return date >= start && date <= end;
                                        });
                                    });

                                    if (isUnavailable) {
                                        alert("This date and time is already booked");
                                        instance.clear();
                                    }
                                },
                                onDayCreate: function(dObj, dStr, fp, dayElem) {
                                    var dateStr = dayElem.dateObj.toISOString().split('T')[0];
                                    var isUnavailable = response.unavailableDates.some(function(
                                        unavailable) {
                                        var start = new Date(unavailable.start)
                                            .toISOString().split('T')[0];
                                        var end = new Date(unavailable.end)
                                        .toISOString().split('T')[0];

                                        return dateStr >= start && dateStr <= end;
                                    });

                                    if (isUnavailable) {
                                        dayElem.classList.add('unavailable-date');
                                    }
                                }
                            });

                            // Show the date pickers and success message
                            $('#datePickers').show();
                            $('#availabilitySuccess').show();

                            // Hide the success message after 3 seconds
                            setTimeout(function() {
                                $('#availabilitySuccess').fadeOut();
                            }, 3000);

                            // Display unavailable dates in an ordered list
                            var unavailableDatesHtml = response.unavailableDates.length > 0 ?
                                '<p><strong>This Facility has been reserved on:</strong></p><ol>' + response
                                .unavailableDates
                                .map(function(date) {
                                    var start = new Date(date.start);
                                    var end = new Date(date.end);
                                    var formattedStart = start.toLocaleDateString('id-ID', {
                                        day: 'numeric',
                                        month: 'long',
                                        year: 'numeric',
                                        hour: 'numeric',
                                        minute: 'numeric'
                                    });
                                    var formattedEnd = end.toLocaleDateString('id-ID', {
                                        day: 'numeric',
                                        month: 'long',
                                        year: 'numeric',
                                        hour: 'numeric',
                                        minute: 'numeric'
                                    });
                                    return '<li class="my-1"><span class="text-white badge bg-danger">' +
                                        formattedStart + '</span>' + ' s.d. ' +
                                        '<span class="text-white badge bg-danger">' + formattedEnd +
                                        '</span></li>';
                                }).join('') + '</ol>' :
                                '<p class="text-white badge bg-teal">This facility has no upcoming reservations.</p>';
                            $('#unavailableDates').html(unavailableDatesHtml);

                            // Display the facility card
                            $('#facilityCard').show();
                            $('#facilityName').text(response.facility.name);
                            $('#facilityLocation').text(response.facility.location);
                            $('#facilityImage').attr('src', '<?php echo e(asset('storage')); ?>/' + response.facility
                                .image_main);
                            $('#viewFacilityLink').attr('href', '<?php echo e(route('facility.page', '')); ?>/' +
                                response.facility.id);
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
<?php /**PATH C:\Users\UKPBJ\Herd\facility_reservation\resources\views\landing\content\reservation\edit.blade.php ENDPATH**/ ?>