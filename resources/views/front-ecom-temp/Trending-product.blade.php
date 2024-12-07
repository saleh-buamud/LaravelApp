@extends('front-ecom-temp.layouts')
@section('Template')
    <section class="trending-product section" style="margin-top: 12px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>قطع غيار السيارات الرائجة</h2>
                        <p>لدينا مجموعة واسعة من قطع غيار السيارات عالية الجودة التي تلبي احتياجات جميع المركبات. جميع
                            المنتجات تم اختيارها بعناية لضمان الأداء الأمثل.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <div class="single-product">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="#">

                                <div class="button">
                                    <a href="{{ route('product-details', ['id' => $product->id]) }}"
                                        class="btn btn-primary">
                                        <i class="lni lni-cart"></i> إضافة إلى السلة
                                    </a>
                                </div>
                            </div>
                            <div class="product-info p-3">
                                <h4 class="title">
                                    <a
                                        href="{{ route('product-details', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                </h4>
                                <p class="description text-muted">{{ $product->description }}</p>
                                @if ($product->subCategory)
                                    <span class="sub-category d-block mb-1">{{ $product->subCategory->name }}</span>
                                    <!-- عرض اسم الفئة الفرعية -->
                                @else
                                    <span class="sub-category d-block mb-1">No Category</span>
                                @endif
                                <span class="quantity d-block mb-2">الكمية: {{ $product->quantity }}</span>

                                <div class="price font-weight-bold text-danger">
                                    <span>${{ $product->price }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
