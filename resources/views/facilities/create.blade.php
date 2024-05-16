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
                <form class="card" action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create {{ $pageTitle }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="capacity">Capacity (People/Orang)</label>
                            <input type="number" name="capacity" id="capacity" class="form-control"></input>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="floor">Floor</label>
                            <input type="number" name="floor" id="floor" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="facility_category_id">Select Category</label>
                            <select name="facility_category_id" id="facility_category_id" class="form-select" style="width: 80%">
                                <option value="">Select Category</option>
                                @foreach ($facilityCategories as $facilityCategory)
                                    <option value="{{ $facilityCategory->id }}">{{ $facilityCategory->category_str }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="uker_masters_id">Select Unit Kerja</label>
                            @if(auth()->check() && auth()->user()->hasRole('admin'))
                            <select name="uker_masters_id" id="uker_masters_id" class="form-select" style="width: 80%">
                                <option value="">Select Unit Kerja</option>
                                @foreach ($ukerMasters as $ukerMaster)
                                    <option value="{{ $ukerMaster->id }}">{{ $ukerMaster->nama_unit_kerja_eselon_2 }}</option>
                                @endforeach
                            </select>
                            @else
                            <div class="mb-4">
                                <label class="form-label" for="uker"></label>
                                <input type="text" value="{{ Auth::user()->ukerMaster->id }}" name="uker_masters_id" id="uker_masters_id" class="form-control" readonly required>
                                <p>{{ Auth::user()->ukerMaster->nama_unit_kerja_eselon_2 }}</p>
                            </div>
                            @endif
                        </div>
                        <!-- Add image input fields -->
                        <div class="mb-4">
                            <label class="form-label" for="image_main">Main Image (Not Required)</label>
                            <input type="file" name="image_main" id="image_main" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="image_1">Image 1 (Not Required)</label>
                            <input type="file" name="image_1" id="image_1" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="image_2">Image 2 (Not Required)</label>
                            <input type="file" name="image_2" id="image_2" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="image_3">Image 3 (Not Required)</label>
                            <input type="file" name="image_3" id="image_3" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="google_map_link">Location</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="google_map_link">Google Map Link (Example/Contoh: https://maps.app.goo.gl/j9tuxnVLYkgQzbjx8)</label>
                            <input type="text" name="google_map_link" id="google_map_link" class="form-control">
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
