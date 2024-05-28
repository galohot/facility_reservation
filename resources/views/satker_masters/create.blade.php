<x-app-layout>
    <x-slot name="title">
        Create {{$pageTitle}}
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
        <section>
            <div class="col">
                <form class="card" action="{{ route('satker_masters.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create {{ $pageTitle }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="name">Kode Satuan Kerja</label>
                            <input type="text" name="kd_satker" id="kd_satker" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="email">Nama Satuan Kerja</label>
                            <input type="text" name="nama_satker" id="nama_satker" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
