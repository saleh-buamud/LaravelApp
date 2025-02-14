<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ShopGrids - متجر قطع غيار</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />
    <!-- ========================= CSS here ========================= -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', serif;
            font-weight: 700;
            font-style: normal;
            font-optical-sizing: auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
        }

        .card-text {
            color: #555;
        }

        .btn-primary {
            background-color: #5535F0;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #441CFF;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon"><span></span><span></span></div>
        </div>
    </div>

    @include('front-ecom-temp.header')

    <div class="container my-4">
        <h1 class="text-center mb-4">منتجات الفئة الفرعية: {{ $subCategory->name }}</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="container mt-3 text-center">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج" class="img-fluid"
                                style="max-height: 200px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>السعر:</strong> ${{ $product->price }}</p>
                            <p class="card-text"><strong>الكمية:</strong> {{ $product->quantity }}</p>
                            <a href="{{ route('add.cart', $product->id) }}" class="btn btn-primary w-100">إضافة إلى
                                السلة</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

    @include('front-ecom-temp.footer')

    <a href="#" class="scroll-top"><i class="lni lni-chevron-up"></i></a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
