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
        <section>
            <div class="col">
                <form class="card" action="{{ secure_url('addons.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create {{$pageTitle}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="role_str">Addon String</label>
                            <input type="text" name="addon_str" id="addon_str" class="addon_str" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="role_str">Description</label>
                            <input type="text" name="description" id="description" class="description">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
