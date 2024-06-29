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
                <form class="card" action="{{ route('landing.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Make Reservation</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="description" value="pending">
                        <div class="mb-4">
                            <label class="form-label required" for="facility_category_id">Select Facility</label>
                            <select name="facility_id" id="facility_id" class="form-select" style="width: 80%">
                                <option value="">Select Facility</option>
                                @foreach ($facilities as $facility)
                                    <option value="{{ $facility->id }}">{{ $facility->name }},
                                        {{ $facility->facilityCategory->category_str }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="name">Event</label>
                            <textarea name="event" id="event" class="form-control" required></textarea>
                        </div>
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
            </script>
        </x-slot>
    </x-slot>
</x-landing-layout>
