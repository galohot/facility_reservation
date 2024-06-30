<x-app-layout>
    <x-slot name="title">
        {{ $pageTitle }} Detail
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
                                <div class="card-header">
                                    <h3 class="card-title">{{ $pageTitle }} Details</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>ID</strong> {{ $pengaduan->id }}</p>
                                    <p><strong>Title</strong> {{ $pengaduan->title }}</p>
                                    <p><strong>Description</strong> {{ $pengaduan->description }}</p>
                                    <p><strong>Phone Number</strong> {{ $pengaduan->phone_number }}</p>
                                    <p><strong>Email</strong> {{ $pengaduan->email }}</p>
                                    <p><strong>Active</strong> {{ $pengaduan->is_active ? 'Yes' : 'No' }}</p>
                                    <a href="{{ route('pengaduans.index') }}" class="btn btn-secondary">Back</a>
                                    <a href="{{ route('pengaduans.edit', $pengaduan->id) }}"
                                        class="btn btn-primary">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
