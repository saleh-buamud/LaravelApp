@extends('dashboard.layout')

@section('content')
    <h1>تعديل المنتج</h1>
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors }}</div>
    @endif

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
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}"
                required min="0">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required
                min="0" step="0.01">
        </div>
        <div class="mb-3">
            <label for="sub_category_id" class="form-label">الفئة الفرعية</label>
            <select class="form-select" name="sub_category_id" id="sub_category_id" required>
                <option value="">اختر فئة فرعية</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}"
                        {{ $product->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                        {{ $subCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="mode_id" class="form-label">الموديلات</label>
            <select class="form-select" name="mode_id[]" id="mode_id" multiple required>
                <option value="">اختر الموديلات</option>
                @foreach ($modes as $mode)
                    <option value="{{ $mode->id }}"
                        {{ in_array($mode->id, old('mode_id', $product->modes->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $mode->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="image" class="form-label">الصورة (اختياري)</label>
            <input type="file" class="form-control" id="image" name="image">

            <!-- عرض الصورة القديمة إذا كانت موجودة -->
            @if ($product->image)
                <div class="mt-2">
                    <label>الصورة الحالية</label>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج"
                        style="width: 100px; height: auto;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">تحديث المنتج</button>
    </form>
@endsection
