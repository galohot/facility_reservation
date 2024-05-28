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
        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Reservation Details</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>User: </strong>{{ $reservation->user->name }}</p>
                                    <p><strong>Email: </strong>{{ $reservation->user->email }}</p>
                                    <p><strong>Event: </strong> {{ $reservation->event }}</p>
                                    <p><strong>Facility: </strong><a
                                            href="{{ secure_url(route('facilities.show', $reservation->facility->id) }}">{{ $reservation->facility->name }}</a>
                                    </p>
                                    <p><strong>Reservation Start:
                                        </strong>{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}
                                    </p>
                                    <p><strong>Reservation End:
                                        </strong>{{ $reservation->reservation_end->translatedFormat('l, j F Y, H:i') }}
                                    </p>
                                    <p><strong>Unit Kerja Pemohon:
                                        </strong>{{ $reservation->user->ukerMaster->nama_unit_kerja_eselon_2 }}</p>
                                    {{-- <p><strong>Satuan Kerja Pemohon: </strong>{{ $reservation->user->ukerMaster->satkerMaster->nama_satker }}</p> --}}
                                    <p>
                                        <strong>Status: </strong>
                                        @switch($reservation->status)
                                            @case('pending')
                                                <span
                                                    class="text-white badge bg-warning">{{ strtoupper($reservation->status) }}</span>
                                                Verificator: <span
                                                    class="text-white badge bg-info">{{ $reservation->facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span>
                                            @break

                                            @case('approved')
                                                <span
                                                    class="text-white badge bg-success">{{ strtoupper($reservation->status) }}</span>,
                                                Verificator: <span
                                                    class="text-white badge bg-info">{{ $reservation->facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span>
                                            @break

                                            @case('rejected')
                                                <span
                                                    class="text-white badge bg-danger">{{ strtoupper($reservation->status) }}</span>,
                                                Verificator: <span
                                                    class="text-white badge bg-info">{{ $reservation->facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span>
                                            @break

                                            @default
                                                <span>{{ strtoupper($reservation->status) }}</span>
                                        @endswitch
                                    </p>

                                    @if ($reservation->description != 'pending')
                                        <p><strong>Description: </strong><span
                                                class="{{ $reservation->status == 'approved' ? 'badge bg-success text-white' : ($reservation->status == 'rejected' ? 'badge bg-danger text-white' : 'badge bg-warning text-white') }}">{{ $reservation->description }}</span>
                                        </p>
                                    @endif
                                    <a href="./" class="btn btn-secondary">Back</a>
                                    @if (Auth::user()->roleMaster->role_str == 'admin' ||
                                            ($reservation->user->ukerMaster->id == auth()->user()->ukerMaster->id && $reservation->status == 'pending'))
                                        <a href="{{ secure_url(route('landing.reservation.edit', $reservation->id) }}"
                                            class="btn btn-primary">Edit</a>
                                    @endif
                                    @if (auth()->check() &&
                                            auth()->user()->hasUker($reservation->facility->ukerMaster->id) &&
                                            (auth()->user()->hasRole('admin') ||
                                                auth()->user()->hasRole('manager') ||
                                                auth()->user()->hasRole('verificator')))
                                        <a href="{{ secure_url(route('reservations.verify', $reservation->id) }}"
                                            class="btn btn-primary">Verify</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-landing-layout>
