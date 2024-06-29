<x-landing-layout>
    <x-slot name="title">
        Find Facility
    </x-slot>
    <x-slot name="header">
        <!-- Include Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Include Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    </x-slot>
    <x-slot name="slot">
        <div>
            <h1>Search for Facilities</h1>
            <form action="{{ route('landing.search') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="category">Category</label>
                        <p>(Leave blank for all categories)</p>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->category_str }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="start_date">Start Date</label>
                        <p>(This cannot be empty)</p>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control flatpickr"
                            value="{{ old('start_date', $startDate ?? '') }}">
                    </div>
                    <div class="form-group col-sm-12 col-md-3">
                        <label for="end_date">End Date</label>
                        <p>(Fill in the end date)</p>
                        <input type="datetime-local" name="end_date" id="end_date" class="form-control flatpickr"
                            value="{{ old('end_date', $endDate ?? '') }}">
                    </div>
                </div>
                <div class="my-3 form-group col-3 d-flex align-items-end">
                    <button type="submit" class="ms-2 btn btn-primary">Search</button>
                </div>
            </form>

            @if (isset($facilities))
                <div class="my-5">
                    <h2 class="page-title">
                        Available Facilities
                    </h2>
                </div>
                <ul class="list-group">
                    @forelse($facilities as $facility)
                        <div class="col">
                            <div class="my-1 card">
                                <div class="row g-0">
                                    <div class="col-12 col-md-3">
                                        <!-- Photo -->
                                        <img src="{{ asset('storage/' . $facility->image_main) }}"
                                            class="object-cover w-100 h-100 card-img-start"
                                            alt="Main Image for Facility" />
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="card-body">
                                            <h3 class="card-title">{{ $facility->name }}</h3>
                                            <p class="text-secondary">Capacity: {{ $facility->capacity }}, Location:
                                                {{ $facility->location }}</p>
                                            @php $hasUpcomingReservation = false; @endphp
                                            @foreach ($facility->reservations as $reservation)
                                                @if (time() < $startDate && $reservation->status == 'approved')
                                                    <p>Upcoming Reservation: <span
                                                            class="text-white badge bg-warning">{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}</span>
                                                        to <span
                                                            class="text-white badge bg-warning">{{ $reservation->reservation_end->translatedFormat('l, j F Y, H:i') }}</span>
                                                    </p>
                                                    @php $hasUpcomingReservation = true; @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if (!$hasUpcomingReservation)
                                            <p class="text-white badge bg-success">No Upcoming Reservations</p>
                                        @endif
                                        <p>Managed by: <span
                                                class="text-white badge bg-info">{{ $facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span>
                                        </p>
                                    </div>
                                    <div
                                        class="top-0 m-3 d-flex flex-column align-items-end position-absolute end-0">
                                        <a href="{{ route('reservation.make') }}?facility_id={{ $facility->id }}"
                                            class="my-2 btn btn-success w-100">Make Reservation</a>
                                        <a href="{{ route('facility.page', $facility->id) }}"
                                            class="btn btn-primary w-100" role="button"><i class="fas fa-eye"></i>
                                            View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <li class="list-group-item">No facilities available for the selected date range and
                            category.
                        </li>
                @endforelse

            </ul>
            <!-- Pagination Links -->
        @endif
    </div>
    <div>
        <div class="mt-5 row row-cards">
            @foreach ($categories as $category)
                <div class="col-md-6 col-xl-3">
                    <a class="card card-link" href="{{ route('available.facilities.show', $category->id) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <span class="rounded avatar"
                                        style="background-image: url({{ asset('storage/' . $category->facilities->first()->image_main) }})"></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">{{ $category->category_str }}</div>
                                    <div class="text-secondary">{{ $category->facilities->count() }} Facilities
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-slot>
<x-slot name="script">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr with minuteIncrement set to 30
            flatpickr('.flatpickr', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: true,
                minuteIncrement: 30
            });
        });
    </script>
</x-slot>
</x-landing-layout>
