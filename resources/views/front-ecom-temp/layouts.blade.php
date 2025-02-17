<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>متجر قطع غيار السيارات - ShopGrids</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:slnt,wght@1,200..1000&family=Noto+Sans+Arabic:wght@100..900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: "Cairo", serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            font-variation-settings: "slnt" 1;
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
    @include('front-ecom-temp.hero-secation')
    @yield('test')
    @include('front-ecom-temp.Start-Call-Action')
    <section class="contact-us section" style="background-color: #f9f9f9; padding: 50px 0;" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2>اتصل بنا</h2>
                        <p>لأي استفسارات أو مساعدة، لا تتردد في التواصل معنا. نحن هنا لمساعدتك!</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" style="text-align: center">
                <div class="col-lg-6 col-md-8 col-12">
                    <form action="#" method="POST" class="contact-form">
                        <div class="form-group">
                            <label for="name" class="text-center">الاسم الكامل</label>
                            <input type="text" id="name" class="form-control" placeholder="أدخل اسمك">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-center">البريد الإلكتروني</label>
                            <input type="email" id="email" class="form-control"
                                placeholder="أدخل بريدك الإلكتروني">
                        </div>
                        <div class="form-group">
                            <label for="message" class="text-center">الرسالة</label>
                            <textarea id="message" class="form-control" rows="5" placeholder="أدخل رسالتك هنا"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('front-ecom-temp.footer')
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>
    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
    </script>
</body>

</html>
