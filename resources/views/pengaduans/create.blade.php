<x-app-layout>
    <x-slot name="title">
        Create {{ $pageTitle }}
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
                <form class="card" action="{{ route('pengaduans.store') }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create {{ $pageTitle }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label required" for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label required" for="is_active">Active</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </x-slot>
</x-app-layout>
