<x-app-layout>
    <x-slot name="slot">
        @if(session('success'))
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                    </div>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{$pageTitle}}
                        </h2>
                    </div>
                </div>
                <div class="flex justify-between mt-4 col-6">
                    <form action="{{ route('reservations.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search" placeholder="(leave blank to show all data) Search event, date, unit kerja or description" class="m-2 form-control d-inline-flex">
                        <select name="status" class="m-2 form-control d-inline-flex"> <!-- New select input for status filter -->
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </form>
                    <a href="{{ route('reservations.create') }}" class="m-2 btn btn-success">
                        Make {{$pageTitle}}
                    </a>
                </div>
                <div id="table-default" class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><button class="table-sort" data-sort="sort-status">Status</button></th>
                                <th><button class="table-sort" data-sort="sort-facility">Facility Reserved</button></th>
                                <th><button class="table-sort" data-sort="sort-event">event</button></th>
                                <th><button class="table-sort" data-sort="sort-start">Start</button></th>
                                <th><button class="table-sort" data-sort="sort-end">End</button></th>
                                <th><button class="table-sort" data-sort="sort-pemohon">Requested By</button></th>
                                <th><button class="table-sort" data-sort="sort-manager">Managed By</button></th>
                                <th><button class="table-sort" data-sort="sort-actions">Actions</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach ($reservations as $reservation)
                            @if (auth()->user()->hasRole('admin') ||
                            ((auth()->user()->hasRole('manager') || auth()->user()->hasRole('verificator')) && $reservation->facility->ukerMaster->id == Auth::user()->ukerMaster->id) ||
                            ($reservation->user->ukerMaster->id == Auth::user()->ukerMaster->id))
                                <tr>
                                    <td class="sort-status">
                                        @switch($reservation->status)
                                            @case('pending')
                                                <span class="text-white badge bg-warning">{{ strtoupper($reservation->status) }}</span>
                                                @break
                                            @case('approved')
                                                <span class="text-white badge bg-success">{{ strtoupper($reservation->status) }}</span>
                                                @break
                                            @case('rejected')
                                                <span class="text-white badge bg-danger">{{ strtoupper($reservation->status) }}</span>
                                                @break
                                            @default
                                                <span>{{ strtoupper($reservation->status) }}</span>
                                        @endswitch
                                    </td>
                                    <td class="sort-facility"><a href="{{ route('facilities.show', $reservation->facility->id) }}">{{ $reservation->facility->name }}</a></td>
                                    <td class="sort-event">{{ $reservation->event }}</td>
                                    <td class="sort-start">{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}</td>
                                    <td class="sort-end">{{ $reservation->reservation_end->translatedFormat('l, j F Y, H:i') }}</td>
                                    <td class="sort-pemohon">
                                        <span><h6>{{ $reservation->user->name }}</h6></span>
                                        <span><h6>{{$reservation->user->ukerMaster->nama_unit_kerja_eselon_2}}</h6></span>
                                        <span class="text-blue">{{ $reservation->user->email }}</span>
                                    </td>
                                    <td class="sort-manager">{{ $reservation->facility->ukerMaster->nama_unit_kerja_eselon_2 }}</td>
                                    <td class="sort-actions">
                                        <div class="mr-2" role="group" aria-label="User Actions">
                                            <div class="m-1 d-block">
                                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-primary" role="button">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </div>
                                            @if (Auth::user()->roleMaster->role_str == 'admin' || $reservation->status == 'pending')
                                            <div class="m-1 d-block">
                                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-secondary" role="button">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                            </div>
                                            @endif
                                            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') || auth()->check() && (auth()->user()->hasRole('verificator'))))
                                            <div class="m-1 d-block">
                                                @if(auth()->user()->hasRole('admin'))
                                                <a href="{{ route('reservations.admin.verify', $reservation->id)}}" class="btn btn-info" role="button">
                                                    <i class="fas fa-pencil-alt"></i> Verify
                                                </a>
                                            @elseif(auth()->user()->hasRole('manager') || auth()->user()->hasRole('verificator'))
                                                <a href="{{ route('reservations.verify', $reservation->id)}}" class="btn btn-info" role="button">
                                                    <i class="fas fa-pencil-alt"></i> Verify
                                                </a>
                                            @endif
                                            </div>
                                            @endif
                                            <div class="m-1 d-block">
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this user?');">
                                                        <i class="far fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endif
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    {{ $reservations->links() }} <!-- Pagination Links -->
                </div>
            </div>
        </div>
        <script src="{{ asset('../build/assets/libs/list.js/dist/list.min.js?1692870487') }}" defer></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            const list = new List('table-default', {
                sortClass: 'table-sort',
                listClass: 'table-tbody',
                valueNames: [ 'sort-status', 'sort-facility', 'sort-event', 'sort-start','sort-end','sort-pemohon','sort-uker'
                ]
            });
            })
          </script>
    </x-slot>
</x-app-layout>
