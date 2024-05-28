<x-landing-layout>
    <x-slot name="title">
        Facilities
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
        <div class="page-wrapper">
            <div class="page-header">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col">
                    <a href="./" class="my-2 btn btn-secondary">Back</a>
                    <a href="{{ route('reservation.make') }}?facility_id={{ $facility->id }}" class="my-2 btn btn-success">Make reservation</a>
                    @if (Auth::user()->roleMaster->role_str == 'admin' || Auth::user()->roleMaster->role_str == 'manager' && $facility->ukerMaster->id == Auth::user()->ukerMaster->id)
                    <a href="{{ route('facilities.edit', $facility->id) }}" class="my-2 btn btn-info">Edit Facility</a>
                    @endif
                    <h1 class="fw-bold">{{ $facility->name }}</h1>
                    <div class="my-2">{{ $facility->description }}</div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
              <div class="container-xl">
                <div class="row g-3">
                  <div class="col">
                    <ul class="timeline">
                    @if ($facility->image_main)
                    <li class="timeline-event">
                            <div class="card timeline-event-card">
                                <div class="card-body">
                                <div class="text-secondary float-end">{{ $facility->updated_at->format('F j, Y, g:i a') }}</div>
                                <h4>{{ $facility->name }} Main Image</h4>
                                <img src="{{ asset('storage/' . $facility->image_main ) }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </li>
                    @endif
                    @if ($facility->image_1)
                    <li class="timeline-event">
                        <div class="card timeline-event-card">
                        <div class="card-body">
                            <div class="text-secondary float-end">{{ $facility->updated_at->format('F j, Y, g:i a') }}</div>
                            <h4>{{ $facility->name }} Image 1</h4>
                            <img src="{{ asset('storage/' . $facility->image_1 ) }}" alt="" class="img-fluid">
                        </div>
                        </div>
                    </li>
                    @endif
                    @if ($facility->image_2)
                      <li class="timeline-event">
                        <div class="card timeline-event-card">
                          <div class="card-body">
                            <div class="text-secondary float-end">{{ $facility->updated_at->format('F j, Y, g:i a') }}</div>
                            <h4>{{ $facility->name }} Image 2</h4>
                            <img src="{{ asset('storage/' . $facility->image_2 ) }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </li>
                    @endif
                    @if ($facility->image_3)
                      <li class="timeline-event">
                        <div class="card timeline-event-card">
                          <div class="card-body">
                            <div class="text-secondary float-end">{{ $facility->updated_at->format('F j, Y, g:i a') }}</div>
                            <h4>{{ $facility->name }} Image 3</h4>
                            <img src="{{ asset('storage/' . $facility->image_3 ) }}" alt="" class="img-fluid">
                            </div>
                            </div>
                        </li>
                    @endif
                    </ul>
                  </div>
                  <div class="col-lg-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Reservations</div>
                                    @php
                                        // Filter past reservations and sort the remaining reservations by their proximity to the current datetime
                                        $sortedReservations = $reservations->where('facility_id', $facility->id)
                                                                            ->where('status', 'approved')
                                                                            ->filter(function ($reservation) {
                                                                                return strtotime($reservation->reservation_end) > time();
                                                                            })
                                                                            ->sortBy(function($reservation) {
                                                                                return abs(strtotime($reservation->reservation_start) - time());
                                                                            })
                                                                            ->values();

                                        // Limit the number of reservations to 3
                                        $limitedReservations = $sortedReservations->take(3);
                                    @endphp

                                    @foreach ($limitedReservations as $reservation)
                                        <div class="mb-2 text-center border">
                                            <p>{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }} <br /> s/d {{ $reservation->reservation_end->translatedFormat('l, j F Y, H:i') }}</p>
                                            <div class="reservation-info"> <!-- Add this container -->
                                                <strong><span class="text-white badge bg-success text-wrap" style="display: inline-block; word-break: break-all;">{{ $reservation->user->ukerMaster->nama_unit_kerja_eselon_2 }}</span></strong>
                                            </div>
                                            <br />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                      <div class="col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title">Facility info</div>
                            <div class="mb-2">
                              Category: <br /> <strong>{{ $facility->facilityCategory->category_str }}</strong>
                            </div>
                            <div class="mb-2">
                              Floor <br /> <strong>{{ $facility->floor }}</strong>
                            </div>
                            <div class="mb-2">
                              Capacity <br /> <strong>{{ $facility->capacity ? $facility->capacity : 'No data available' }}</strong>
                            </div>
                            <div class="mb-2">
                              Facility Manager <br /> <strong>{{ $facility->ukerMaster->nama_unit_kerja_eselon_2 }}</strong>
                            </div>
                            <div class="mb-2">
                              Satuan Kerja <br /> <strong>{{ $facility->ukerMaster->satkerMaster->nama_satker }}</strong>
                            </div>
                            <div class="mb-2">
                              Addons: <br />
                            <ul style="list-style-type: none;">
                                @foreach ($facility->addons as $addon)
                                    <li><strong>{{ $addon->addon_str }}</strong></li>
                                @endforeach
                            </ul>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title">Location</div>
                            <div class="card-body">
                                <h4>{{ $facility->location }}</h4>
                                @if ($facility->google_map_link)
                                    <a href="{{ $facility->google_map_link }}" target="_blank"><img src="{{ asset('build/assets/img/google-maps.png') }}" alt=""></a>
                                @else
                                    No Google Map link/Location provided
                                @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </x-slot>
</x-landing-layout>
