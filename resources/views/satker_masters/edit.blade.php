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
                                <a href="{{ secure_url(route('satker_masters.index') }}" class="btn btn-secondary" role="button">
                                    <i class="fas fa-pencil-alt"></i> Go To {{ $pageTitle }} Table
                                  </a>
                                <div class="card-header">
                                        <h3 class="card-title">Edit {{ $pageTitle }}</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ secure_url(route('satker_masters.update', $satkerMaster->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label class="form-label">Kode Satker</label>
                                            <input type="text" name="kd_satker" id="kd_satker" class="form-control" value="{{ $satkerMaster->kd_satker }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Satker</label>
                                            <input type="text" name="nama_satker" id="nama_satker" class="form-control" value="{{ $satkerMaster->nama_satker }}" required>
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
