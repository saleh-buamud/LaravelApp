@extends('dashboard.layout')
@section('edit')
    <h2 style="margin-bottom: 15px">Edit Category</h2>
    <div class="container">
        <form action="{{ route('subCategories.update', $supcategories->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label bold ">Name Category</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
                @error('name')
                    <div class="alert  m-2" style="background-color: #007bff;">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label">Category Parent</label><br>
                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="parent_id">
                    <option value="" class="form-control">Primary Category</option>

                    @foreach ($perants as $parent)
                        <option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{ $parent->name }}</option>
                    @endforeach

                </select>
                @error('parent_id')
                    <div class="alert  m-2" style="background-color: #007bff;">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" name="image" id="img" class="form-control" value="{{ old('image') }}">
                @if (!is_null($category->image))
                    <img src="{{ asset('storage/' . $category->image) }}" alt="" style="margin: 10px;"
                        width="100">
                @endif
                @error('image')
                    <div class="alert  m-2" style="background-color: #007bff;">
                        <p>{{ $message }}</p>
                        <p>Please re-upload the image.</p>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="exampleRadio1" name="status"value="Active"
                            {{ $category->status == 'active' ? 'checked' : '' }}>
                        <label for="exampleRadio1" class="form-check-label">Active</label>

                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="exampleRadio2" name="status" value="inactive"
                            {{ $category->status == 'inactive' ? 'checked' : '' }}>

                        <label for="exampleRadio2" class="form-check-label">Inactive</label>
                    </div>
                </div>
                @error('status')
                    <div class="alert alert-danger m-2">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3">UPDATE</button>
        </form>
    </div>
@endsection
