<x-app-layout>
    <x-slot name="slot">
        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Approved Reservation</div>
                                    </div>
                                    <div class="mb-3 h1">
                                        @php
                                            $approvedReservation = 0
                                        @endphp
                                        @foreach ($allReservations as $reservation)
                                            @if ($reservation->status == 'approved')
                                                @php
                                                    $approvedReservation++
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{ number_format($approvedReservation / $allReservations->count() * 100, 2) }} %
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <div>Approved Reservation: {{ $approvedReservation }}</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" style="width: {{$approvedReservation / $allReservations->count() * 100 }}%" role="progressbar"
                                            aria-valuenow="{{$approvedReservation / $allReservations->count() * 100 }}" aria-valuemin="0" aria-valuemax="100"
                                            aria-label="{{$approvedReservation / $allReservations->count() * 100 }}% Complete">
                                            <span class="visually-hidden">{{$approvedReservation / $allReservations->count() * 100 }}% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Rejected Reservation</div>
                                    </div>
                                    <div class="mb-3 h1">
                                        @php
                                            $rejectedReservation = 0
                                        @endphp
                                        @foreach ($allReservations as $reservation)
                                            @if ($reservation->status == 'rejected')
                                                @php
                                                    $rejectedReservation++
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{ number_format($rejectedReservation / $allReservations->count() * 100, 2) }} %
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <div>Rejected Reservation: {{ $rejectedReservation }}</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" style="width: {{$rejectedReservation / $allReservations->count() * 100 }}%" role="progressbar"
                                            aria-valuenow="{{$rejectedReservation / $allReservations->count() * 100 }}" aria-valuemin="0" aria-valuemax="100"
                                            aria-label="{{$rejectedReservation / $allReservations->count() * 100 }}% Complete">
                                            <span class="visually-hidden">{{$rejectedReservation / $allReservations->count() * 100 }}% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Pending Reservation</div>
                                    </div>
                                    <div class="mb-3 h1">
                                        @php
                                            $pendingReservation = 0
                                        @endphp
                                        @foreach ($allReservations as $reservation)
                                            @if ($reservation->status == 'pending')
                                                @php
                                                    $pendingReservation++
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{ number_format($pendingReservation / $allReservations->count() * 100, 2) }} %
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <div>Pending Reservation: {{ $pendingReservation }}</div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: {{$pendingReservation / $allReservations->count() * 100 }}%" role="progressbar"
                                            aria-valuenow="{{$pendingReservation / $allReservations->count() * 100 }}" aria-valuemin="0" aria-valuemax="100"
                                            aria-label="{{$pendingReservation / $allReservations->count() * 100 }}% Complete">
                                            <span class="visually-hidden">{{$pendingReservation / $allReservations->count() * 100 }}% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-primary avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.5 21h-4.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h10" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M18 16.5v1.5l.5 .5" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">{{ $allReservations->count() }} Total Reservations</div>
                                                    <div class="text-secondary">
                                                        @php
                                                            $pendingCount = 0;
                                                        @endphp
                                                        @foreach ($allReservations as $reservation)
                                                            @if ($reservation->status == 'pending')
                                                                @php
                                                                    $pendingCount++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        {{ $pendingCount > 0 ? $pendingCount . ' Pending' : '0 pending' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-green avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8" /><path d="M16 5l1.5 7l4.5 0" /><path d="M2 10l15 0" /><path d="M7 5l0 5" /><path d="M12 5l0 5" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium"> {{ $allFacilities->count() }} Facilities</div>
                                                    <div class="text-secondary"> {{ $facilityCategories->count() }} Categories</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-twitter avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">{{ $allUsers->count() }} Users</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="text-white bg-facebook avatar">
                                                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-skyscraper"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium"> {{$allUkers->count()}} Unit Kerja </div>
                                                    <div class="text-secondary"> {{$allSatkers->count()}} Satuan Kerja </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Most Reservations (Approved)</h3>
                              </div>
                              <table class="table card-table table-vcenter">
                                <thead>
                                  <tr>
                                    <th>Satker</th>
                                    <th>Reservations</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservationCounts as $facility => $count)
                                    <tr>
                                        <td>{{ $facility }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Most Facility Reserved (Approved)</h3>
                              </div>
                              <table class="table card-table table-vcenter">
                                <thead>
                                  <tr>
                                    <th>Facility</th>
                                    <th>Reservations</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facilityReservations as $satker => $count)
                                    <tr>
                                        <td>{{ $satker }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Facilities</h3>
                              </div>
                              <div id="chart-demo-pie"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <h1 class="text-white badge bg-info">Timeline</h1>
                                    <div class="card" style="height: 28rem">
                                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                            <div class="divide-y">
                                                @foreach ($reservations as $reservation)
                                                    <div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>{{ $reservation->user->ukerMaster->nama_unit_kerja_eselon_2 }}
                                                                    </strong>
                                                                    <span>({{ $reservation->user->name }})</span>
                                                                    <br />placed a reservation for
                                                                    <strong>{{ $reservation->facility->name }}</strong>
                                                                    <br />category: <strong>{{ $reservation->facility->facilityCategory->category_str }}</strong>
                                                                </div>
                                                                <div class="text-secondary">For
                                                                    {{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}
                                                                    -
                                                                    {{ $reservation->reservation_end->translatedFormat('l, j F Y, H:i') }}
                                                                </div>
                                                                <div class="text-secondary">
                                                                    {{ $reservation->timeDifference }}</div>
                                                            </div>
                                                            <div class="col-auto align-self-center">
                                                                @switch($reservation->status)
                                                                    @case('pending')
                                                                        <div class="badge bg-warning"></div>
                                                                    @break

                                                                    @case('approved')
                                                                        <div class="badge bg-success"></div>
                                                                    @break

                                                                    @case('rejected')
                                                                        <div class="badge bg-danger"></div>
                                                                    @break

                                                                    @default
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            {{ $reservations->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function () {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
                    chart: {
                        type: "pie",
                        fontFamily: 'inherit',
                        height: 240,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: @json($facilityByCategoryCount->values()), // Pass the counts as series data
                    labels: @json($facilityByCategoryCount->keys()), // Pass the category names as labels
                    tooltip: {
                        theme: 'dark'
                    },
                    grid: {
                        strokeDashArray: 4,
                    },
                    colors: ['#FF7F0E', '#2CA02C', '#1F77B4', '#FFD700', '#FF6347', '#BA55D3', '#7FFFD4', '#FF1493', '#00FFFF', '#32CD32'],
                    tooltip: {
                        fillSeriesColor: false
                    },
                })).render();
            });
            // @formatter:on
        </script>


    </x-slot>
</x-app-layout>
