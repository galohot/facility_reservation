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
        <section>
            <!-- Include Select2 CSS -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

            <!-- Include jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Include Select2 JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

            <div class="col">
                <form class="card" action="{{ route('uker_masters.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create {{$pageTitle}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="name">Nama Unit Kerja Eselon II</label>
                            <input type="text" name="nama_unit_kerja_eselon_2" id="nama_unit_kerja_eselon_2" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="satker_master_id">Select Satuan Kerja Eselon I</label>
                            <select name="satker_master_kd_satker" id="satker_master_kd_satker" class="form-select" style="width:80%">
                                <option value="">Select Satuan Kerja</option>
                                @foreach ($satkerMasters as $satkerMaster)
                                <option value="{{ $satkerMaster->kd_satker }}">{{ $satkerMaster->nama_satker }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                $('#satker_master_id').select2({
                    placeholder: 'Search Satuan Kerja',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>
    </x-slot>
</x-app-layout>
