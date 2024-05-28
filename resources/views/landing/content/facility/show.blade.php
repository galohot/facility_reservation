<x-landing-layout>
    <x-slot name="slot">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="my-4">
                <form action="{{ route('available.facilities.show', $facilityCategory->id) }}" method="GET">
                    <input type="text" name="search" placeholder="Search name or location" class="form-control">
                    <button type="submit" class="mt-2 btn btn-primary">Search</button>
                </form>
            </div>

            <h2 class="mt-2 mb-5 page-title">
                Available Facilities for {{ $selectedCategory }}
            </h2>

            @foreach ($facilities as $facility)
                @if ($facility->facility_category_id == $facilityCategory->id)
                    <div class="my-2 col">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-12 col-md-3">
                                    <img src="{{ asset('storage/' . $facility->image_main) }}"
                                         class="object-cover w-100 h-100 card-img-start" alt="Main Image for Facility" />
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $facility->name }}</h3>
                                        <p class="text-secondary">Capacity: {{ $facility->capacity }}, Location: {{ $facility->location }}</p>
                                        @php
                                            $hasUpcomingReservation = false;
                                            $currentTimestamp = time();
                                            $nextReservation = null;
                                        @endphp
                                        @foreach ($facility->reservations as $reservation)
                                            @if ($reservation->status == 'approved')
                                                @if ($currentTimestamp <= strtotime($reservation->reservation_start))
                                                    <p>Upcoming Reservation <span class="text-white badge bg-warning">{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}</span></p>
                                                    @php
                                                        $hasUpcomingReservation = true;
                                                        break;
                                                    @endphp
                                                @elseif (strtotime($reservation->reservation_start) <= $currentTimestamp && $currentTimestamp <= strtotime($reservation->reservation_end))
                                                    <p class="text-white badge bg-danger">Currently Booked | Unavailable until: {{ $reservation->reservation_end->translatedFormat('l, j F Y, H:i') }}</p>
                                                    @php
                                                        $hasUpcomingReservation = true;
                                                    @endphp
                                                    @foreach ($facility->reservations as $nextReservation)
                                                        @if ($nextReservation->status == 'approved' && strtotime($nextReservation->reservation_start) > strtotime($reservation->reservation_end))
                                                            <p>Next Approved Booking: <span class="text-white badge bg-warning">{{ $nextReservation->reservation_start->translatedFormat('l, j F Y, H:i') }}</span></p>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    @break
                                                @endif
                                            @endif
                                        @endforeach
                                        @if (!$hasUpcomingReservation)
                                            <p class="text-white badge bg-success">No Upcoming Reservations</p>
                                        @endif
                                        <p>Managed by: <span class="text-white badge bg-info">{{ $facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span></p>
                                    </div>
                                    <div class="top-0 m-3 d-flex flex-column align-items-end position-absolute end-0">
                                        <a href="{{ route('reservation.make') }}?facility_id={{ $facility->id }}" class="my-2 btn btn-success w-100">Make reservation</a>
                                        <a href="{{ route('facility.page', $facility->id) }}" class="btn btn-primary w-100" role="button"><i class="fas fa-eye"></i> View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="m-4">
                {{ $facilities->links() }} <!-- Pagination Links -->
            </div>
        </div>
    </x-slot>
</x-landing-layout>
