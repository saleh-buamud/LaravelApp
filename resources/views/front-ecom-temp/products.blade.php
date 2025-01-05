<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ShopGrids - Bootstrap 5 eCommerce HTML Template.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
</head>
<style>
    .pagination-container {
        display: flex;

        justify-content: center;
    }

    .small {
        display: none;

    }


    .pagination {
        display: flex;
    }

    .pagination li {
        margin: 0;
    }

    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap');

    .card {
        border-radius: 40px;
        overflow: hidden;
        border: 0;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06),
            0 2px 4px rgba(0, 0, 0, 0.07);
        transition: all 0.15s ease;
    }

    .card:hover {
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1),
            0 10px 8px rgba(0, 0, 0, 0.015);
    }

    .card-body .card-title {
        font-family: 'Lato', sans-serif;
        font-weight: 700;
        letter-spacing: 0.3px;
        font-size: 24px;
        color: #121212;
    }

    .card-text {
        font-family: 'Lato', sans-serif;
        font-weight: 400;
        font-size: 15px;
        letter-spacing: 0.3px;
        color: #4E4E4E;

    }

    .card .container {
        width: 88%;
        background: #F0EEF8;
        border-radius: 30px;
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container:hover>img {
        transform: scale(1.2);
    }

    .container img {
        padding: 75px;
        margin-top: -40px;
        margin-bottom: -40px;
        transition: 0.4s ease;
        cursor: pointer;
    }

    .btn {
        background: #EEECF7;
        border: 0;
        color: #5535F0;
        width: 98%;
        font-weight: bold;
        border-radius: 20px;
        height: 40px;
        transition: all 0.2s ease;
    }

    .btn:hover {
        background: #441CFF;
    }

    .btn:focus {
        background: #441CFF;
        outline: 0;
    }
</style>

<body style="font-family: 'Amiri', serif;">
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    @include('front-ecom-temp.header')

    <div class="container my-4">
        <h1 class="text-center mb-4">Products for Subcategory: {{ $subCategory->name }}</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="animate__animated animate bounce card " style="width: 18rem;">
                    <div class="container mt-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product image" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title ms-1">{{ $product->name }}</h5>
                        <p class="card-text mb-5 ms-1">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        <p>quentity : {{ $product->quantity }}</p>
                        <a href="{{ route('add.cart', $product->id) }}" target="_blank"
                            class="btn btn-primary mb-1 mt-1 ">Add to Cart</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @include('front-ecom-temp.footer')

    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
