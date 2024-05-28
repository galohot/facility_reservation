<x-landing-layout>
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
        <x-slot name="header">
            <!-- Include Select2 CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

            <!-- Include jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Include Select2 JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        </x-slot>
        <section>

            <div class="col">
                <form class="card" action="{{ route('landing.reservation.update', $reservation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-header">
                        <h3 class="card-title">Edit Reservation</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="description" value="pending">
                        <div class="mb-4">
                            <label class="form-label required" for="facility_category_id">Select Facility</label>
                            <select name="facility_id" id="facility_id" class="form-select" style="width: 80%">
                                <option value="">Select Facility</option>
                                @foreach ($facilities as $facility)
                                    <option value="{{ $facility->id }}" {{ $facility->id == $reservation->facility_id ? 'selected' : '' }}>{{ $facility->name }}, {{ $facility->facilityCategory->category_str }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="name">Event</label>
                            <textarea name="event" id="event" class="form-control" required>{{ $reservation->event }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="reservation_start">Event Starts</label>
                            <input value="{{ $reservation->reservation_start }}" type="datetime-local" name="reservation_start" id="reservation_start" class="form-control"></input>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="reservation_end">Event Ends</label>
                            <input value="{{ $reservation->reservation_end }}" type="datetime-local" name="reservation_end" id="reservation_end" class="form-control"></input>
                        </div>
                        <!-- Add doc input fields -->
                        <div class="mb-4">
                            <label class="form-label" for="document">Document/Nota Dinas/Memorandum</label>
                            <input type="file" name="document" id="document" class="form-control">
                            <p class="badge {{ $reservation->document ? 'bg-success' : 'bg-danger' }} text-white">{{ $reservation->document ? 'A document has been uploaded' : 'No document has been uploaded' }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="document_attachment">Attachment/Lampiran (Not Required)</label>
                            <input type="file" name="document_attachment" id="document_attachment" class="form-control">
                            <p class="badge {{ $reservation->document_attachment ? 'bg-success' : 'bg-danger' }} text-white">{{ $reservation->document_attachment ? 'A document has been uploaded' : 'No document has been uploaded' }}</p>
                        </div>
                        <!-- End of doc input fields -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </x-slot>
    <x-slot name="script">
        <script>
            $(document).ready(function() {
                $('#facility_id').select2({
                    placeholder: 'Search for Facility to reserve',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>
    </x-slot>
</x-app-layout>
