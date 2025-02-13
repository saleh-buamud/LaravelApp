<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ShopGrids - قالب HTML للتجارة الإلكترونية Bootstrap 5</title>
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
    body {
        font-family: "Cairo", serif;
        font-optical-sizing: auto;
        font-weight: 700;
        /* يمكنك تغيير القيمة من 200 إلى 1000 */
        font-style: normal;
        font-variation-settings: "slnt" 1;
    }

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
</style>

<body>
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
        <h1 class="text-center mb-4">فئات فرعية للأجزاء الكهربائية</h1>
        <div class="row">
            @foreach ($subCategories as $subCategory)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subCategory->name }}</h5>
                            <p class="card-text">{{ $subCategory->description }}</p>
                        </div>
                        <a href="{{ route('subCategory.products', $subCategory->id) }}" class="btn btn-primary">عرض
                            المنتجات</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $subCategories->links('pagination::bootstrap-5') }}
    </div>

    @include('front-ecom-temp.footer')

    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
