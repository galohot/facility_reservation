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
                <form class="card" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create {{$pageTitle}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="uker_master_id">Select Unit Kerja</label>
                            <select name="uker_master_id" id="uker_master_id" class="form-select" style="width:80%">
                                <option value="">Select Unit Kerja</option>
                                @foreach ($ukerMasters as $ukerMaster)
                                <option value="{{ $ukerMaster->id }}">{{ $ukerMaster->nama_unit_kerja_eselon_2 }}, {{$ukerMaster->satkerMaster->nama_satker}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="role_master_id">Select Role</label>
                            <select name="role_master_id" id="role_master_id" class="form-select" style="width:80%">
                                <option value="">Select role</option>
                                @foreach ($roleMasters as $roleMaster)
                                <option value="{{ $roleMaster->id }}">{{ $roleMaster->role_str }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="has_facility">Has Facility:</label>
                            <input type="checkbox" name="has_facility" id="has_facility" class="form-check-input" value="1">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="has_reservation">Has Reservation:</label>
                            <input type="checkbox" name="has_reservation" id="has_reservation" class="form-check-input" value="1">
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                $('#uker_master_id').select2({
                    placeholder: 'Search for a UKER Master',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>

    </x-slot>
</x-app-layout>
