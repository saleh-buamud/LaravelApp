@extends('dashboard.layout')
@section('create')
    <h2 style="margin-bottom: 15px">Create SubCategory</h2>
    <div class="container">
        <form action="{{ route('subcategories.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label bold ">Name SubCategory</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="alert m-2" style="background-color: #007bff;">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select class="form-select" name="category_id" id="category_id">
        <option value="" class="form-control">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="alert m-2" style="background-color: #007bff;">
            <p>{{ $message }}</p>
        </div>
    @enderror
</div>
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </form>
    </div>
@endsection
