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
                <form class="card" action="{{ route('role_masters.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create {{ $pageTitle }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="role_str">Role Name</label>
                            <input type="text" name="role_str" id="role_str" class="role_str" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
