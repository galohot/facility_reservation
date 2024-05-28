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
                                <a href="{{ secure_url(route('addons.index') }}" class="btn btn-secondary" role="button">
                                    <i class="fas fa-pencil-alt"></i> Go To {{ $pageTitle }} Table
                                  </a>
                                <div class="card-header">
                                        <h3 class="card-title">Edit {{ $pageTitle }}</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ secure_url(route('addons.update', $addon->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label class="form-label">Facility Category ID</label>
                                            <input type="text" name="id" id="id" class="form-control" value="{{ $addon->id }}" readonly required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Facility Category Name</label>
                                            <input type="text" name="addon_str" id="addon_str" class="form-control" value="{{ $addon->addon_str }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="description" id="description" class="form-control" value="{{ $addon->description }}">
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
