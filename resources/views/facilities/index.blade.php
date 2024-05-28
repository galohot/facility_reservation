<x-app-layout>
    <x-slot name="title">
        {{$pageTitle}}
    </x-slot>
    <x-slot name="slot">
        @if (session('success'))
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
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
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            {{ $pageTitle }}
                        </h2>
                    </div>
                </div>
                <div class="flex justify-between mt-4 col-6">
                    <form action="{{ route('facilities.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            placeholder="Search name or location, Leave blank to show all data"
                            class="m-2 form-control d-inline-flex">
                        <select name="category" class="m-2 form-control d-inline-flex">
                            <!-- New select input for category filter -->
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_str }}"
                                    {{ request('category') == $category->category_str ? 'selected' : '' }}>
                                    {{ $category->category_str }} (jumlah fasilitas:
                                    {{ $category->facilities->count() }})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </form>
                    @if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager')))
                        <a href="{{ route('facilities.create') }}" class="m-2 btn btn-success">
                            Create {{ $pageTitle }}
                        </a>
                    @endif
                </div>
                <div id="table-default" class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><button class="table-sort" data-sort="sort-location">Location</button></th>
                                <th><button class="table-sort" data-sort="sort-name">Facility Name</button></th>
                                <th><button class="table-sort" data-sort="sort-description">Description</button></th>
                                <th><button class="table-sort" data-sort="sort-category">Category</button></th>
                                <th><button class="table-sort" data-sort="sort-capacity">Capacity</button></th>
                                <th><button class="table-sort" data-sort="sort-facilitymanager">Managed by</button></th>
                                <th><button class="table-sort" data-sort="sort-actions">Actions</button></th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach ($facilities as $facility)
                                <tr>
                                    <td class="sort-location">
                                        {{ $facility->location }}
                                    </td>
                                    <td class="sort-name"><a
                                            href="{{ route('facilities.show', $facility->id) }}">{{ $facility->name }}</a>
                                    </td>
                                    <td class="sort-description">{{ $facility->description }}</td>
                                    <td class="sort-category">{{ $facility->facilityCategory->category_str }}</td>
                                    <td class="sort-capacity">
                                        {{ $facility->capacity == null ? 'No data' : $facility->capacity }}</td>
                                    <td class="sort-facilitymanager">
                                        {{ $facility->ukerMaster->nama_unit_kerja_eselon_2 }},
                                        {{ $facility->ukerMaster->satkerMaster->nama_satker }}</td>
                                    <td class="sort-actions">
                                        <div class="mr-2" role="group" aria-label="User Actions">
                                            <div class="m-1 d-block">
                                                <a href="{{ route('facilities.show', $facility->id) }}"
                                                    class="btn btn-primary" role="button">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </div>
                                            @if (auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager')))
                                                <div class="m-1 d-block">
                                                    <a href="{{ route('facilities.edit', $facility->id) }}"
                                                        class="btn btn-secondary" role="button">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                </div>
                                                <form action="{{ route('facilities.destroy', $facility->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="m-1 d-block">
                                                        <button type="submit" class="btn btn-danger" role="button"
                                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                                            <i class="far fa-trash-alt"></i> Delete
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    {{ $facilities->links() }} <!-- Pagination Links -->
                </div>
            </div>
        </div>
        <script src="{{ asset('../build/assets/libs/list.js/dist/list.min.js?1692870487') }}" defer></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const list = new List('table-default', {
                    sortClass: 'table-sort',
                    listClass: 'table-tbody',
                    valueNames: ['sort-location', 'sort-name', 'sort-description', 'sort-category',
                        'sort-capacity', 'sort-facilitymanager',
                    ]
                });
            })
        </script>
    </x-slot>
</x-app-layout>
