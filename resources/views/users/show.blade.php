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
                                <div class="card-header">
                                    <h3 class="card-title">{{ $pageTitle }} Details</h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>Satuan Kerja:</strong> {{ $user->ukerMaster->satkerMaster->nama_satker }}</p>
                                    <p><strong>Unit Kerja:</strong> {{ $user->ukerMaster->nama_unit_kerja_eselon_2 }}</p>
                                    <p><strong>Role</strong> {{ $user->roleMaster->role_str }}</p>
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
