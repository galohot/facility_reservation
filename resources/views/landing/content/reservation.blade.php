<x-landing-layout>
    <x-slot name="title">
        Make Reservation
    </x-slot>
    <x-slot name="header">
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
    </x-slot>
    <x-slot name="slot">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section>
            <div class="col">
                <form class="card" id="reservationForm" action="{{ route('landing.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Make Reservation</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="description" value="pending">
                        <div class="mb-4">
                            <label class="form-label required" for="facility_id">Select Facility</label>
                            <select name="facility_id" id="facility_id" class="form-select" style="width: 80%">
                                <option value="">Select Facility</option>
                                @foreach ($facilities as $facility)
                                    <option value="{{ $facility->id }}">{{ $facility->name }},
                                        {{ $facility->facilityCategory->category_str }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-3 form-group col-3 d-flex align-items-end">
                            <button type="button" id="checkAvailability" class="ms-2 btn btn-primary">Check
                                Availability</button>
                        </div>
                        <!-- Add the badge and hide initially -->
                        <div class="mb-4">
                            <p id="availabilitySuccess" class="text-white badge bg-success" style="display:none;">
                                Availability
                                check successful!</p>
                        </div>
                        <!-- Hide the date pickers initially -->
                        <div id="datePickers" style="display:none;">
                            <p class="text-white badge bg-warning">Please redo the availability check if different
                                facility is selected</p>
                            <div id="unavailableDates"></div>
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
        <x-slot name="script">
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
                            url: '{{ route('facility.checkAvailability') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                facility_id: facilityId
                            },
                            success: function(response) {
                                // Sort unavailable dates by start date/time (earliest first)
                                response.sort(function(a, b) {
                                    return new Date(a.start) - new Date(b.start);
                                });
                                // Process and display the response (unavailable dates)
                                console.log(response); // For debugging

                                // Initialize Flatpickr with unavailable dates marked
                                flatpickr('.flatpickr', {
                                    enableTime: true,
                                    dateFormat: "Y-m-d H:i",
                                    time_24hr: true,
                                    disableMobile: true,
                                    minuteIncrement: 15,
                                    onChange: function(selectedDates, dateStr, instance) {
                                        var isUnavailable = response.some(function(unavailable) {
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
                                        var isUnavailable = response.some(function(unavailable) {
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
                                // Display unavailable dates in an ordered list
                                var unavailableDatesHtml = response.length > 0 ?
                                    '<p><strong>This Facility has been reserved on:</strong></p><ol>' + response
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
                                            formattedStart + ' - ' + formattedEnd + '</span></li>';
                                    }).join('') + '</ol>' :
                                    '<p class="text-white badge bg-teal">This facility has no upcoming reservations.</p>';
                                $('#unavailableDates').html(unavailableDatesHtml);
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
            <style>
                .unavailable-date {
                    background-color: #ffcccb !important;
                }

                .badge {
                    display: inline-block;
                    max-width: 100%;
                    overflow: inherit;
                    text-overflow: ellipsis;
                    white-space: normal;
                    text-align: left;
                }
            </style>
        </x-slot>
    </x-slot>
</x-landing-layout>
