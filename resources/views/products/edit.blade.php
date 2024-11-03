@extends('dashboard.layout')

@section('content')
    <h1>تعديل المنتج</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">اسم المنتج</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">الكمية</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required min="0">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required min="0" step="0.01">
        </div>
        <div class="mb-3">
            <label for="subcategory_id" class="form-label">الفئة الفرعية</label>
            <select class="form-select" name="subcategory_id" id="subcategory_id" required>
                <option value="">اختر فئة فرعية</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}" {{ $product->subcategory_id == $subCategory->id ? 'selected' : '' }}>
                        {{ $subCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">الصورة (اختياري)</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" style="width: 100px; height: auto; margin-top: 10px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">تحديث المنتج</button>
    </form>
@endsection
