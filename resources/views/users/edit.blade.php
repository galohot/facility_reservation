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
        <!-- Include Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Include jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Include Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <div class="page">
            <div class="content">
                <div class="container-xl">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary" role="button">
                                    <i class="fas fa-pencil-alt"></i> Go To {{ $pageTitle }} Table
                                  </a>
                                <div class="card-header">
                                        <h3 class="card-title">Edit {{ $pageTitle }}</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label class="form-label">Name:</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label required" for="uker_master_id">Select Unit Kerja</label>
                                            <select name="uker_master_id" id="uker_master_id" class="form-select" style="width:80%">
                                                <option value="">Select Unit Kerja</option>
                                                @foreach ($ukerMasters as $ukerMaster)
                                                <option value="{{ $ukerMaster->id }}" {{ $user->uker_master_id == $ukerMaster->id ? 'selected' : ''}}>{{ $ukerMaster->nama_unit_kerja_eselon_2 }}, {{$ukerMaster->satkerMaster->nama_satker}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label required" for="role_master_id">Select Role</label>
                                            <select name="role_master_id" id="role_master_id" class="form-select" style="width:80%">
                                                <option value="">Select role</option>
                                                @foreach ($roleMasters as $roleMaster)
                                                <option value="{{ $roleMaster->id }}" {{ $user->role_master_id == $roleMaster->id ? 'selected' : '' }}>{{ $roleMaster->role_str }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="has_facility" id="has_facility" value="1" {{ $user->has_facility ? 'checked' : '' }}>
                                                <label class="form-check-label" for="has_facility">Has Facility</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="has_reservation" id="has_reservation" value="1" {{ $user->has_reservation ? 'checked' : '' }}>
                                                <label class="form-check-label" for="has_reservation">Has Reservation</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Reset Password (leave blank to keep user's current password)</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#uker_master_id').select2({
                    placeholder: 'Search for Unit Kerja',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>

    </x-slot>
</x-app-layout>
