<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                {{-- Show All Categories --}}
                <div class="col-md-8">
                    <div class="card">

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        {{-- End Success Message --}}

                        <div class="card-header">All Categories</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- End Show All Categories --}}

                {{-- Add Category --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Categories</div>
                        <div class="card-body">
                            <form action="{{ route('add.category') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        name="category_name">

                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Add Category --}}
            </div>
        </div>
    </div>
</x-app-layout>
