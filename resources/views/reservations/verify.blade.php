<x-app-layout>
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
                                    <h3 class="card-title">{{ $pageTitle }} Details</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>User: </strong>{{ $reservation->user->name }}</p>
                                    <p><strong>Event: </strong> {{ $reservation->event }}</p>
                                    <p><strong>Facility: </strong><a href="{{ route('facilities.show', $reservation->facility->id ) }}">{{ $reservation->facility->name }}</a></p>
                                    <p><strong>Reservation Start: </strong>{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}</p>
                                    <p><strong>Reservation End: </strong>{{ $reservation->reservation_start->translatedFormat('l, j F Y, H:i') }}</p>
                                    <p><strong>Unit Kerja Pemohon: </strong>{{ $reservation->user->ukerMaster->nama_unit_kerja_eselon_2 }}</p>
                                    {{-- <p><strong>Satuan Kerja: </strong>{{ $reservation->user->ukerMaster->satkerMaster->nama_satker }}</p> --}}
                                    <p>
                                        <strong>Status: </strong>
                                        @switch($reservation->status)
                                            @case('pending')
                                                <span class="badge bg-warning text-white">{{ strtoupper($reservation->status) }}</span>, Verificator: <span class="badge bg-info text-white">{{ $reservation->facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span>
                                                @break
                                            @case('approved')
                                                <span class="badge bg-success text-white">{{ strtoupper($reservation->status) }}</span>, Verificator: <span class="badge bg-info text-white">{{ $reservation->facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger text-white">{{ strtoupper($reservation->status) }}</span>, Verificator: <span class="badge bg-info text-white">{{ $reservation->facility->ukerMaster->nama_unit_kerja_eselon_2 }}</span>
                                                @break
                                            @default
                                                <span>{{ strtoupper($reservation->status) }}</span>
                                        @endswitch
                                    </p>
                                    @if ($reservation->document)
                                    <p><a href="{{ url(Storage::url($reservation->document)) }}" target="_blank">Download Document</a></p>
                                    @endif
                                    <!-- Add a link to download the document attachment -->
                                    @if ($reservation->document_attachment)
                                        <p><a href="{{ Storage::url($reservation->document_attachment) }}" target="_blank">Download Document Attachment</a></p>
                                    @endif
                                    <!-- Buttons for verifying and rejecting -->
                                    @if(auth()->check() && (auth()->user()->hasRole('admin')))
                                    <form method="POST" action="{{ route('reservations.admin.verify', $reservation->id)}}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-4">
                                            <label class="form-label required" for="description">Description</label>
                                            <p>Contoh: <span class="badge bg-success text-white">"Disetujui"</span> atau <span class="badge bg-danger text-white">"Dokumen tidak lengkap"</span></p>
                                            <textarea name="description" id="description" class="form-control" required>{{ $reservation->description }}</textarea>
                                        </div>
                                        <button type="submit" name="status" value="approved" class="btn btn-success">Verify</button>
                                        <button type="submit" name="status" value="pending" class="btn btn-warning">Pending</button>
                                        <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                                    </form>
                                    @endif
                                    @if (auth()->user()->hasUker($reservation->facility->ukerMaster->id))
                                    <form method="POST" action="{{ route('reservations.verify', $reservation->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-4">
                                            <label class="form-label required" for="description">Description</label>
                                            <p>Contoh: <span class="badge bg-success text-white">"Disetujui"</span> atau <span class="badge bg-danger text-white">"Dokumen tidak lengkap"</span></p>
                                            <textarea name="description" id="description" class="form-control" required>{{ $reservation->description }}</textarea>
                                        </div>
                                        <button type="submit" name="status" value="approved" class="btn btn-success">Verify</button>
                                        <button type="submit" name="status" value="pending" class="btn btn-warning">Pending</button>
                                        <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                                    </form>
                                    @endif
                                    <a href="./" class="btn btn-secondary mt-3">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
