
<x-app-layout>
    <x-slot name="slot">
        @if(session('success'))
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
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
                        {{$pageTitle}}
                      </h2>
                    </div>
                  </div>
                <div class="flex justify-between mt-4 col-6">
                    <form action="{{ route('users.index') }}" method="GET" class="flex items-center">
                      <input type="text" name="search" placeholder="Search name or email, Leave blank to show all data" class="m-2 form-control d-inline-flex">
                      <button type="submit" class="mx-2 btn btn-primary">Search</button>
                    </form>
                    <a href="{{ route('users.create') }}" class="m-2 btn btn-success">
                        Create {{$pageTitle}}
                      </a>
                  </div>
              <div id="table-default" class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Unit Kerja</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                    @foreach ($users as $user)
                    <tr>
                      <td class="sort-name">{{ $user->name }}</td>
                      <td class="sort-email">{{ $user->email }}</td>
                      <td class="sort-role">{{ $user->roleMaster->role_str }}</td>
                      <td class="sort-satker">{{ $user->ukerMaster->nama_unit_kerja_eselon_2 }}</td>
                      <td class="sort-actions">
                        <div class="mr-2" role="group" aria-label="User Actions">
                            <div class="m-1 d-block">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary" role="button">
                                  <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                            <div class="m-1 d-block">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary" role="button">
                                  <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                            </div>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                              @csrf
                              @method('DELETE')
                              <div class="m-1 d-block">
                                  <button type="submit" class="btn btn-danger" role="button" onclick="return confirm('Are you sure you want to delete this user?');">
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
              <div class="m-4"  >
                {{ $users->links() }} <!-- Pagination Links -->
              </div>
            </div>
          </div>
    </x-slot>
</x-app-layout>
