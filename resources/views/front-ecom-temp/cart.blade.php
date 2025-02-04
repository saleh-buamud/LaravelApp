<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>عربة التسوق</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

    <style>
        /* تغيير لون الخلفية عند التمرير */
        .btn:hover {
            background-color: #0056b3;
            color: white;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* تحسين الأزرار الصغيرة */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* تخصيص الأزرار الأساسية */
        .btn-success {
            background-color: #28a745;
            border-color: #000000;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #f8f9fa;
            border-color: #ffffff;
        }

        .btn-light {
            background-color: #f8f9fa;
            border-color: #000000;
        }

        .btn-outline-danger {
            color: white;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>

<body style="direction: rtl;">
    @include('front-ecom-temp.header')

    <section class="bg-light my-5 mt-4 ">
        <div class="container">
            <div class="row">
                <!-- cart -->
                <div class="col-lg-9">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <div class="card border shadow-0">
                        <div class="m-4">
                            <div class="mb-3 d-flex flex-column align-items-start">
                                <!-- زر المسح -->
                                <a href="{{ route('clear') }}" class="btn btn-danger mb-2">مسح الكل السلة</a>

                                <!-- عنوان سلة التسوق -->
                                <span class="card-title mb-4 h4">سلة التسوق الخاصة بك</span>
                            </div>

                            <hr />
                            @foreach ($items as $item)
                                <div class="row gy-3 mb-4">
                                    <div class="col-lg-5">
                                        <div class="me-lg-5">
                                            <div class="d-flex">
                                                <img src="{{ $item->attributes->image }}" class="border rounded me-3"
                                                    style="width: 96px; height: 96px" />
                                                <div class="">
                                                    <a href="#" class="nav-link">{{ $item->name }}</a>
                                                    {{-- <p class="text-muted">{{ Number::currency($item->price) }}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                                        <td>
                                            <div class="input-group bootstrap-touchspin">
                                                <span class="input-group-btn"><a
                                                        href="{{ route('decrease.quantity', $item->id) }}"
                                                        class="btn btn-default bootstrap-touchspin-down"
                                                        type="button">-</a></span><span
                                                    class="input-group-addon bootstrap-touchspin-prefix"
                                                    style="display: none"></span>
                                                <input type="text" name="" value="{{ $item->quantity }}"
                                                    class="form-control mx-1 px-3" />
                                                <span class="input-group-addon bootstrap-touchspin-postfix"
                                                    style="display: none"></span><span class="input-group-btn">
                                                    <a href="{{ route('add.quantity', $item->id) }}"
                                                        class="btn btn-default bootstrap-touchspin-up"
                                                        type="button">+</a></span>
                                            </div>
                                        </td>
                                        <div class="">
                                            <p class="h6">
                                                {{ $item->quantity * $item->price }}
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                                        <div class="float-md-end">
                                            <a href="{{ route('remove.item', $item->id) }}"
                                                class="btn btn-light btn-outline-danger text-black shadow-none hover-scale">
                                                إزالة
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>


                    </div>
                </div>
                <!-- cart -->
                <!-- summary -->
                <div class="col-lg-3">
                    <div class="card mb-3 border shadow-0">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-0 border">
                        <div class="card-body">

                            <hr />
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">السعر الإجمالي:</p>
                                <p class="mb-2 fw-bold">{{ '$' . number_format($total, 2) }}</p>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('checkout') }}" class="btn btn-success w-100 shadow-0 mb-2">
                                    إتمام الشراء
                                </a>
                                <a href="{{ route('home') }}" class="btn btn-light w-100 border mt-2 hover-scale">
                                    العودة إلى المتجر
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- summary -->
            </div>
        </div>
        {{-- <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg w-40 mt-1">إتمام الشراء</a> --}}
        <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg w-40 mt-1">اتمام الشراء</a>
    </section>
    @include('front-ecom-temp.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
