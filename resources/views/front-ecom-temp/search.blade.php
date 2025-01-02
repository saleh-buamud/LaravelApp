<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ShopGrids - قالب التجارة الإلكترونية باستخدام Bootstrap 5</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- ========================= CSS هنا ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
</head>
<style>
    /* التنسيق في الاتجاه من اليمين لليسار */
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

    .saleh {
        background: #EEECF7;
        border: 0;
        color: #5535F0;
        width: 98%;
        font-weight: bold;
        border-radius: 20px;
        height: 40px;
        transition: all 0.2s ease;
    }

    .saleh:hover {
        background: #441CFF;
    }

    .saleh:focus {
        background: #441CFF;
        outline: 0;
    }

    .search-container {
        position: relative;
    }

    .search-input {
        height: 50px;
        border-radius: 30px;
        padding-left: 35px;
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #888;
    }

    .box {
        position: relative;
    }

    .input {
        padding: 10px;
        width: 80px;
        height: 80px;
        background: none;
        border: 4px solid #5535F0;
        border-radius: 50px;
        box-sizing: border-box;
        font-family: Comic Sans MS;
        font-size: 26px;
        color: #5535F0;
        outline: none;
        transition: .5s;
    }

    .box:hover input {
        width: 350px;
        background: #ffffff;
        border-radius: 10px;
    }

    .box i {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translate(-50%, -50%);
        font-size: 26px;
        color: #5535F0;
        transition: .2s;
    }

    .box:hover i {
        opacity: 0;
        z-index: -1;
    }

    #ytb {
        height: 50px;
        width: 50px;
        text-align: center;
        line-height: 52px;
        border: 2px solid transparent;
        color: #ff1717;
        font-size: 25px;
        transition: 0.3s;
    }

    #ytb:hover {
        border-radius: 50%;
        border-color: #ff1717;
        box-shadow: 0 0 10px #ff4040;
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
        <h1 class="text-center mb-4">البخث عن قطع غيار</h1>
        <div class="text-center flex justify-center">
            <form action="{{ route('products.search') }}" method="GET" class="flex items-center space-x-1">
                <div class="search-container flex items-center" style="display: flex">
                    <input type="search"
                        class="form-control search-input w-17 h-10 px-4 rounded-full border border-gray-300"
                        placeholder="ابحث..." name="search" value="{{ request('search') }}">
                    <button type="submit"
                        class="btn btn-primary h-2 px-6 rounded-full bg-blue-500 text-white hover:bg-blue-600 focus:outline-none pointer"
                        style="border-radius: 25px;">
                        بحث
                    </button>
                </div>
            </form>
            <div class="box">
                <form name="search">
                    <input type="search" class="input" name="search" value="{{ request('search') }}"
                        onmouseout="this.value = ''; this.blur();">
                </form>
                <i class="fas fa-search"></i>
            </div>
        </div>

        @if (isset($products) && $products->count() > 0)
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 container">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                </div>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <a href="{{ route('product-details', ['id' => $product->id]) }}"
                                    class="btn btn-primary saleh">عرض التفاصيل</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center mt-2 text-blue-700">
                <p class="text-center" style="color: #441CFF; font-weight:bold; font-size: 30px ">لم يتم العثور على
                    منتجات</p>
            </div>
        @endif
    </div>

    @include('front-ecom-temp.footer')

    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS هنا ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>
