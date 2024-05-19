<x-landing-layout>
    <x-slot name="title">
        Kemlu Facility Reservation
    </x-slot>
    <x-slot name="slot">
        <div>
            <h1>Search for Facilities</h1>
            <form action="{{ route('landing.search') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-3">
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
                    <div class="form-group col-3">
                        <label for="start_date">Start Date</label>
                        <p>(This cannot be empty)</p>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $startDate ?? '') }}">
                    </div>
                    <div class="form-group col-3" id="end-date-group" style="{{ old('end_date', $endDate ?? '') ? 'display:block;' : 'display:none;' }}">
                        <label for="end_date">End Date</label>
                        <p>(Fill in the end date)</p>
                        <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $endDate ?? '') }}">
                    </div>
                </div>
                <div class="my-3 form-group col-3 d-flex align-items-end">
                    <button type="button" id="toggle-end-date" class="btn btn-secondary">{{ old('end_date', $endDate ?? '') ? 'Remove End Date' : 'Add End Date' }}</button>
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
                                    <img src="{{ asset('storage/' . $facility->image_main) }}" class="object-cover w-100 h-100 card-img-start" alt="Main Image for Facility" />
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="card-body">
                                        <h3 class="card-title">{{ $facility->name }}</h3>
                                        <p class="text-secondary">Capacity: {{ $facility->capacity }}, location: {{ $facility->location }}</p>
                                        @foreach ($facility->reservations as $reservation)
                                        @if ( time() < strtotime($reservation->reservation_start) && strtotime($reservation->reservation_start) < $startDate && $startDate > time())
                                        <p>upcoming reservation: <span class="text-white badge bg-warning">{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}</span> to <span class="text-white badge bg-warning">{{ $reservation->reservation_end->translatedFormat('l, j F Y, H:i') }}</span></p>
                                        @break
                                        @endif
                                        @endforeach
                                        <p>Managed by: <span class="text-white badge bg-info">{{ $facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span></p>
                                    </div>
                                    <div class="top-0 m-3 d-flex flex-column align-items-end position-absolute end-0">
                                        <a href="{{ route('reservation.make') }}?facility_id={{ $facility->id }}" class="my-2 btn btn-success w-100">Make reservation</a>
                                        <a href="{{ route('facility.page', $facility->id) }}" class="btn btn-primary w-100" role="button">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                        <li class="list-group-item">No facilities available for the selected date range and category.
                        </li>
                    @endforelse
                </ul>
                <!-- Pagination Links -->
                @endif
            </div>
    </x-slot>
    <x-slot name="script">
        <script>
            document.getElementById('toggle-end-date').addEventListener('click', function() {
                var endDateGroup = document.getElementById('end-date-group');
                if (endDateGroup.style.display === 'none') {
                    endDateGroup.style.display = 'block';
                    this.textContent = 'Remove End Date';
                } else {
                    endDateGroup.style.display = 'none';
                    document.getElementById('end_date').value = '';
                    this.textContent = 'Add End Date';
                }
            });
        </script>
    </x-slot>
</x-landing-layout>
