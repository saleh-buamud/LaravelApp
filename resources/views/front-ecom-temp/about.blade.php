<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ShopGrids - متجر قطع غيار سيارات</title>
    <meta name="description" content="متجر يقدم قطع غيار السيارات عالية الجودة بأسعار منافسة." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />
    <!-- ========================= CSS هنا ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Amiri', serif;
        }

        .box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #ff0000;
        }
    </style>
</head>

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

    <section class="py-5">
        <div class="container">
            <div class="row align-items-center gx-4">
                <div class="col-md-5">
                    <div class="ms-md-2 ms-lg-5"><img class="img-fluid rounded-3"
                            src="{{ asset('assets/images/about.webp') }}"></div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="ms-md-2 ms-lg-5">
                        <span class="text-muted">قصتنا</span>
                        <h2 class="display-5 fw-bold">عن متجرنا</h2>
                        <p class="lead" style="margin-bottom: 10px; color: black; line-height: 1.8;">
                            نحن نقدم مجموعة واسعة من قطع غيار السيارات عالية الجودة لتلبية احتياجات سياراتك.
                        </p>
                        <p class="lead mb-0" style="color: black; line-height: 1.8;">
                            فريقنا يعمل بشكل دؤوب لتوفير أفضل الأسعار والخدمات لعملائنا الكرام.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front-ecom-temp.footer')
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>
    <!-- ========================= JS هنا ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
