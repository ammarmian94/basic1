<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
               

                {{-- Add Category --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Add Categories</div>
                        <div class="card-body">
                            <form action="{{ url('/category/update/'.$categories->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Update Category Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        name="category_name" value="{{ $categories->category_name }}">

                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update Category</button>
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
