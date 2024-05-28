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
                                    <p><strong>Nama Unit Kerja Eselon II</strong> {{ $ukerMaster->nama_unit_kerja_eselon_2 }}</p>
                                    <p><strong>Nama Satuan Kerja Eselon I</strong> {{ $ukerMaster->satkerMaster->nama_satker }}</p>
                                    <p><strong>Kode Satuan Kerja</strong> {{ $ukerMaster->satkerMaster->kd_satker }}</p>
                                    <a href="./" class="btn btn-secondary">Back</a>
                                    <a href="{{ secure_url('uker_masters.edit', $ukerMaster->id) }}" class="btn btn-primary">edit</a>
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
                        <th><button class="table-sort" data-sort="sort-uker">User</button></th>
                        <th><button class="table-sort" data-sort="sort-satker">Actiom</button></th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    @foreach ($users as $user)
                        @if ($user->uker_master_id == $ukerMaster->id)
                        <tr>
                            <td class="sort-uker">{{ $user->name }}</td>
                            <td class="sort-satker"><a href="{{ secure_url('users.show', $user->id) }}" class="btn btn-primary" role="button">
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

        <div class="card">
            <div class="card-body">
              <div id="table-default" class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th><button class="table-sort" data-sort="sort-managed-facilites">Managed Facilities</button></th>
                        <th><button class="table-sort" data-sort="sort-category">Category</button></th>
                        <th><button class="table-sort" data-sort="sort-satker">Actiom</button></th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    @foreach ($facilities as $facility)
                        @if ($facility->uker_masters_id == $ukerMaster->id)
                        <tr>
                            <td class="sort-uker">{{ $facility->name }}</td>
                            <td class="sort-uker">{{ $facility->facilityCategory->category_str }}</td>
                            <td class="sort-satker"><a href="{{ secure_url('facilities.show', $facility->id) }}" class="btn btn-primary" role="button">
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
