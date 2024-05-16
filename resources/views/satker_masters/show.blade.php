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
                                    <p><strong>Kode Satuan Kerja</strong> {{ $satkerMaster->kd_satker }}</p>
                                    <p><strong>Nama Satuan Kerja</strong> {{ $satkerMaster->nama_satker }}</p>
                                    <a href="./" class="btn btn-secondary">Back</a>
                                    <a href="{{ route('satker_masters.edit', $satkerMaster->id) }}" class="btn btn-primary">edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
              <div id="table-default" class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th><button class="table-sort" data-sort="sort-uker">Unit Kerja</button></th>
                        <th><button class="table-sort" data-sort="sort-satker">Actiom</button></th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                      @foreach ($ukerMasters as $ukerMaster)
                        @if ($satkerMaster->kd_satker == $ukerMaster->satker_master_kd_satker)
                            <tr>
                                <td class="sort-uker">{{ $ukerMaster->nama_unit_kerja_eselon_2 }}</td>
                                <td class="sort-satker"><a href="{{ route('uker_masters.show', $ukerMaster->id) }}" class="btn btn-primary" role="button">
                                    <i class="fas fa-eye"></i> View
                                </a></td>
                            </tr>
                            @endif
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
