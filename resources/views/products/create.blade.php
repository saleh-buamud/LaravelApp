@extends('dashboard.layout')

@section('content')
    <h1 class="h2 mb-4">إضافة منتج جديد</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="row g-3">
            <!-- اسم المنتج -->
            <div class="col-md-6">
                <label for="name" class="form-label">اسم المنتج</label>
                <input type="text" class="form-control" id="name" name="name" required
                    value="{{ old('name') }}">
            </div>

            <!-- الوصف -->
            <div class="col-md-6">
                <label for="description" class="form-label">الوصف</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <!-- الكمية -->
            <div class="col-md-6">
                <label for="quantity" class="form-label">الكمية</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required min="0"
                    value="{{ old('quantity') }}">
            </div>

            <!-- السعر -->
            <div class="col-md-6">
                <label for="price" class="form-label">السعر</label>
                <input type="number" class="form-control" id="price" name="price" required min="0"
                    step="0.01" value="{{ old('price') }}">
            </div>

            <!-- الفئة الفرعية -->
            <div class="col-md-6">
                <label for="sub_category_id" class="form-label">الفئة الفرعية</label>
                <select class="form-select" name="sub_category_id" id="subcategory_id" required>
                    <option value="">اختر فئة فرعية</option>
                    @foreach ($subCategories as $subCategory)
                        <option value="{{ $subCategory->id }}"
                            {{ old('sub_category_id') == $subCategory->id ? 'selected' : '' }}>
                            {{ $subCategory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- الموديل -->
            <div class="col-md-6">
                <label for="model" class="form-label">الموديل</label>
                <select class="form-select" name="model_id[]" id="model" multiple required>
                    <option value="">اختر موديل</option>
                    @foreach ($models as $model)
                        <option value="{{ $model->id }}"
                            {{ in_array($model->id, old('model_id', [])) ? 'selected' : '' }}>
                            {{ $model->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- الصورة -->
            <div class="col-12">
                <label for="image" class="form-label">الصورة</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <!-- زر الإضافة -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary">إضافة المنتج</button>
            </div>
        </div>
    </form>
@endsection
