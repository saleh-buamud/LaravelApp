<header class="header navbar-area">
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-left">
                        <div class="top-middle">
                            <ul class="useful-links">
                                <li><a href="{{ route('home') }}">الرئيسية</a></li>
                                <li><a href="{{ route('about') }}">من نحن</a></li>
                                <li><a href="#contact">اتصل بنا</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-end">
                        <div class="user">
                            <i class="lni lni-user"></i>
                            مرحباً
                        </div>
                        <ul class="user-login">
                            @if (Auth::check())
                                <!-- تحقق إذا كان هناك مستخدم مسجل دخول -->
                                <li>
                                    مرحباً، {{ Auth::user()->name }} <!-- عرض اسم المستخدم -->
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل
                                        خروج</a>
                                    <!-- رابط لتسجيل الخروج -->
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <li>
                                    <a href="{{ route('login') }}">تسجيل دخول</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">تسجيل</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-7">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="assets/images/logo/e.jpg" alt="الشعار" style="width: 150px; height: 100px">
                    </a>
                </div>
                <div class="col-lg-5 col-md-7 d-xs-none">
                    <div class="main-menu-search">
                        <div class="navbar-search search-style-5">
                            <div class="search-select">
                            </div>
                            {{-- <div class="search-input">
                                <input type="text" placeholder="بحث">
                            </div>
                            <div class="search-btn">
                                <button><i class="lni lni-search-alt"></i></button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-2 col-5">
                    <div class="middle-right-area">
                        <div class="nav-hotline">
                            <i class="lni lni-phone"></i>
                            <h3>الخط الساخن:
                                <span>(+100) 123 456 7890</span>
                            </h3>
                        </div>
                        <!-- الجزء الجديد لإظهار عدد العناصر في السلة -->
                        <div class="navbar-cart">
                            <div class="cart-items">
                                <a href="{{ route('cart') }}" class="main-btn">
                                    <i class="lni lni-cart"></i>
                                    <span class="total-items" id="cart-item-count">{{ Cart::getTotalQuantity() }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="تبديل التنقل">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <!-- Adding spare parts section -->
                                <li class="nav-item">
                                    <a class="nav-link" style="font-family: sans-serif ; font-weight: bold"
                                        href="{{ route('allInternal') }}">قطع غيار داخلية</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="font-family: sans-serif ; font-weight: bold"
                                        href="{{ route('allExternal') }}">قطع غيار خارجية</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" style="font-family: sans-serif ; font-weight: bold"
                                        href="{{ route('allElectrical') }}">قطع غيار كهربائية</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Header Bottom -->
</header>
