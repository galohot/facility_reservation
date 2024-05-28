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
                                <a href="{{ secure_url('uker_masters.index') }}" class="btn btn-secondary" role="button">
                                    <i class="fas fa-pencil-alt"></i> Go To {{ $pageTitle }} Table
                                  </a>
                                <div class="card-header">
                                        <h3 class="card-title">Edit {{ $pageTitle }}</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ secure_url('uker_masters.update', $ukerMaster->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label class="form-label">Nama Unit Kerja Eselon II</label>
                                            <input type="text" name="nama_unit_kerja_eselon_2" id="nama_unit_kerja_eselon_2" class="form-control" value="{{ $ukerMaster->nama_unit_kerja_eselon_2 }}" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label required" for="satker_master_id">Select Satuan Kerja Eselon I</label>
                                            <select name="satker_master_kd_satker" id="satker_master_kd_satker" class="form-select" style="width:80%">
                                                <option value="">Select Satuan Kerja</option>
                                                @foreach ($satkerMasters as $satkerMaster)
                                                    <option value="{{ $satkerMaster->kd_satker }}" {{ $ukerMaster->satker_master_kd_satker == $satkerMaster->kd_satker ? 'selected' : '' }}>
                                                        {{ $satkerMaster->nama_satker }}
                                                    </option>
                                                @endforeach
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
