@extends('front-ecom-temp.layouts')
@section('content')
    <div class="container">
        <h1>Internal Products</h1>
        @php
            dd($products); // طباعة الكولكشن للتأكد من وجود البيانات
        @endphp

        <!-- إذا كانت هناك منتجات -->
        @if ($products->count() > 0)
            <div class="row">
                <!-- عرض المنتجات باستخدام @foreach -->
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <!-- عرض الصورة إذا كانت موجودة -->
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><strong>Price: </strong>${{ $product->price }}</p>
                                {{-- <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Product</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No products available in this category.</p>
        @endif
    </div>
@endsection
