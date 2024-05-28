<x-app-layout>
    <x-slot name="title">
        {{$pageTitle}} Detail
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
                                    <p><strong>Category ID</strong> {{ $facilityCategory->id }}</p>
                                    <p><strong>Category Name</strong> {{ $facilityCategory->category_str }}</p>
                                    <a href="./" class="btn btn-secondary">Back</a>
                                    <a href="{{ route('facility_categories.edit', $facilityCategory->id) }}"
                                        class="btn btn-primary">edit</a>
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
                            @foreach ($facilities as $facility)
                                @if ($facility->facility_category_id == $facilityCategory->id)
                                    <tr>
                                        <td class="sort-uker">{{ $facility->name }}</td>
                                        <td class="sort-satker"><a href="{{ route('facilities.show', $facility->id) }}"
                                                class="btn btn-primary" role="button">
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
