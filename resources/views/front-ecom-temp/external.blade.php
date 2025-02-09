<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ShopGrids - قالب HTML للتجارة الإلكترونية Bootstrap 5</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Custom CSS -->
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

    .card {
        border-radius: 20px;
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

    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap');
</style>

<body style="font-family: 'Amiri', serif;">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header -->
    @include('front-ecom-temp.header')

    <!-- Main Content -->
    <div class="container my-4">
        <h1 class="text-center mb-4">الفئات الفرعية للأجزاء الخارجية</h1>
        <div class="row">
            @foreach ($subCategories as $subCategory)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subCategory->name }}</h5>
                            <p class="card-text">{{ $subCategory->description }}</p>
                            <a href="{{ route('subCategory.products', $subCategory->id) }}" class="btn btn-primary">عرض
                                المنتجات</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-container mb-2">
            {{ $subCategories->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Footer -->
    @include('front-ecom-temp.footer')

    <!-- Scroll to Top -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- JS Scripts -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
