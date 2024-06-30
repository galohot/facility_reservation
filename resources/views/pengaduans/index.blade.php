<x-app-layout>
    <x-slot name="title">
        {{ $pageTitle }}
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
                    <form action="{{ route('pengaduans.index') }}" method="GET" class="flex items-center">
                        <input type="text" name="search"
                            placeholder="Search title or description, Leave blank to show all data"
                            class="m-2 form-control d-inline-flex">
                        <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </form>
                    <a href="{{ route('pengaduans.create') }}" class="m-2 btn btn-success">
                        Create {{ $pageTitle }}
                    </a>
                </div>
                <div id="table-default" class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @foreach ($pengaduans as $pengaduan)
                                <tr>
                                    <td>{{ $pengaduan->id }}</td>
                                    <td>{{ $pengaduan->title }}</td>
                                    <td>{{ $pengaduan->description }}</td>
                                    <td>{{ $pengaduan->phone_number }}</td>
                                    <td>{{ $pengaduan->email }}</td>
                                    <td>{{ $pengaduan->is_active ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <div class="mr-2" role="group" aria-label="Pengaduan Actions">
                                            <div class="m-1 d-block">
                                                <a href="{{ route('pengaduans.show', $pengaduan->id) }}"
                                                    class="btn btn-primary" role="button">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </div>
                                            <div class="m-1 d-block">
                                                <a href="{{ route('pengaduans.edit', $pengaduan->id) }}"
                                                    class="btn btn-secondary" role="button">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                            </div>
                                            <form action="{{ route('pengaduans.destroy', $pengaduan->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <div class="m-1 d-block">
                                                    <button type="submit" class="btn btn-danger" role="button"
                                                        onclick="return confirm('Are you sure you want to delete this Pengaduan?');">
                                                        <i class="far fa-trash-alt"></i> Delete
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-4">
                    {{ $pengaduans->links() }} <!-- Pagination Links -->
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
