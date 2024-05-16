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
                <form class="card" action="{{ route('facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                    <a href="{{ route('facilities.index') }}" class="btn btn-secondary" role="button">
                        <i class="fas fa-pencil-alt"></i> Go To {{ $pageTitle }} Table
                      </a>
                    @csrf
                    @method('PATCH')
                    <div class="card-header">
                        <h3 class="card-title">Edit {{ $pageTitle }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $facility->name }}"required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $facility->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="capacity">Capacity (People/Orang)</label>
                            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $facility->capacity }}"></input>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="floor">Floor</label>
                            <input type="number" name="floor" id="floor" class="form-control" value="{{ $facility->floor }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="facility_category_id">Select Category</label>
                            <select name="facility_category_id" id="facility_category_id" class="form-select" style="width: 80%">
                                <option value="">Select Category</option>
                                @foreach ($facilityCategories as $facilityCategory)
                                    <option value="{{ $facilityCategory->id }}" {{ $facility->facility_category_id == $facilityCategory->id ? 'selected' : '' }}>{{ $facilityCategory->category_str }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="uker_masters_id">Select Unit Kerja</label>
                            <select name="uker_masters_id" id="uker_masters_id" class="form-select" style="width: 80%">
                                <option value="">Select Unit Kerja</option>
                                @foreach ($ukerMasters as $ukerMaster)
                                    <option value="{{ $ukerMaster->id }}" {{ $ukerMaster->id == $facility->uker_masters_id ? 'selected' : '' }}>{{ $ukerMaster->nama_unit_kerja_eselon_2 }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Add image input fields -->
                        @if ($facility->image_main)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $facility->image_main ) }}" alt="Main Image" style="max-width: 200px; max-height: 200px;">
                        </div>
                        @else
                        <label class="form-label" for="image_main">No image has been uploaded</label>
                        @endif
                        <div class="mb-4">
                            <label class="form-label" for="image_main">Main Image (Not Required)</label>
                            <input type="file" name="image_main" id="image_main" class="form-control">
                        </div>
                        @if ($facility->image_1)
                        <div class="mb-4">
                            <img src="{{ asset($facility->image_1) }}" alt="Image" style="max-width: 200px; max-height: 200px;">
                        </div>
                        @else
                        <label class="form-label" for="image_1">No image has been uploaded</label>
                        @endif
                        <div class="mb-4">
                            <label class="form-label" for="image_1">Image 1 (Not Required)</label>
                            <input type="file" name="image_1" id="image_1" class="form-control">
                        </div>
                        @if ($facility->image_2)
                        <div class="mb-4">
                            <img src="{{ asset($facility->image_2) }}" alt="Image" style="max-width: 200px; max-height: 200px;">
                        </div>
                        @else
                        <label class="form-label" for="image_2">No image has been uploaded</label>
                        @endif
                        <div class="mb-4">
                            <label class="form-label" for="image_2">Image 2 (Not Required)</label>
                            <input type="file" name="image_2" id="image_2" class="form-control">
                        </div>
                        @if ($facility->image_3)
                        <div class="mb-4">
                            <img src="{{ asset($facility->image_3) }}" alt="Image" style="max-width: 200px; max-height: 200px;">
                        </div>
                        @else
                        <label class="form-label" for="image_3">No image has been uploaded</label>
                        @endif
                        <div class="mb-4">
                            <label class="form-label" for="image_3">Image 3 (Not Required)</label>
                            <input type="file" name="image_3" id="image_3" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="google_map_link">Location</label>
                            <input type="text" name="location" id="location" class="form-control" value="{{ $facility->location }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="google_map_link">Google Map Link (Example/Contoh: https://maps.app.goo.gl/j9tuxnVLYkgQzbjx8)</label>
                            <input type="text" name="google_map_link" id="google_map_link" class="form-control" value="{{ $facility->google_map_link }}">
                        </div>
                        <!-- End of image input fields -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                $('#facility_category_id').select2({
                    placeholder: 'Search for Category',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#uker_masters_id').select2({
                    placeholder: 'Search for Unit Kerja',
                    allowClear: true // Add this line if you want to allow clearing the selection
                });
            });
        </script>

    </x-slot>
</x-app-layout>
