<x-app-layout>
    <x-slot name="title">
        Edit {{ $pageTitle }}
    </x-slot>
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
                                <a href="{{ route('pengaduans.index') }}" class="btn btn-secondary" role="button">
                                    <i class="fas fa-pencil-alt"></i> Go To {{ $pageTitle }} Table
                                </a>
                                <div class="card-header">
                                    <h3 class="card-title">Edit {{ $pageTitle }}</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('pengaduans.update', $pengaduan->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label class="form-label">ID</label>
                                            <input type="text" name="id" id="id" class="form-control"
                                                value="{{ $pengaduan->id }}" readonly required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ $pengaduan->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $pengaduan->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number"
                                                class="form-control" value="{{ $pengaduan->phone_number }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ $pengaduan->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Active</label>
                                            <select name="is_active" id="is_active" class="form-control" required>
                                                <option value="1" {{ $pengaduan->is_active ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="0" {{ !$pengaduan->is_active ? 'selected' : '' }}>
                                                    No</option>
                                            </select>
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
    </x-slot>
</x-app-layout>
