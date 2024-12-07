 <header class="header navbar-area">
     <div class="topbar">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-lg-4 col-md-4 col-12">
                     <div class="top-left">
                         <div class="top-middle">
                             <ul class="useful-links">
                                 <li><a href="index.html">Home</a></li>
                                 <li><a href="about-us.html">About Us</a></li>
                                 <li><a href="contact.html">Contact Us</a></li>
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
                             Hello
                         </div>
                         <ul class="user-login">
                             @if (Auth::check())
                                 <!-- تحقق إذا كان هناك مستخدم مسجل دخول -->
                                 <li>
                                     مرحبًا، {{ Auth::user()->name }} <!-- عرض اسم المستخدم -->
                                 </li>
                                 <li>
                                     <a href="{{ route('logout') }}"
                                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                     <!-- رابط لتسجيل الخروج -->
                                 </li>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                     style="display: none;">
                                     @csrf
                                 </form>
                             @else
                                 <li>
                                     <a href="{{ route('login') }}">log in</a>
                                 </li>
                                 <li>
                                     <a href="{{ route('register') }}">Register</a>
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
                     <a class="navbar-brand" href="index.html">
                         <img src="assets/images/logo/logo.svg" alt="Logo">
                     </a>
                 </div>
                 <div class="col-lg-5 col-md-7 d-xs-none">
                     <div class="main-menu-search">
                         <div class="navbar-search search-style-5">
                             <div class="search-select">

                             </div>
                             <div class="search-input">
                                 <input type="text" placeholder="Search">
                             </div>
                             <div class="search-btn">
                                 <button><i class="lni lni-search-alt"></i></button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-2 col-5">
                     <div class="middle-right-area">
                         <div class="nav-hotline">
                             <i class="lni lni-phone"></i>
                             <h3>Hotline:
                                 <span>(+100) 123 456 7890</span>
                             </h3>
                         </div>
                         <div class="navbar-cart">
                             <div class="wishlist">
                                 <a href="javascript:void(0)">
                                     <i class="lni lni-heart"></i>
                                     <span class="total-items">0</span>
                                 </a>
                             </div>
                             <div class="cart-items">
                                 <a href="javascript:void(0)" class="main-btn">
                                     <i class="lni lni-cart"></i>
                                     <span class="total-items">2</span>
                                 </a>
                                 <div class="shopping-item">
                                     <div class="dropdown-cart-header">
                                         <span>2 Items</span>
                                         <a href="cart.html">View Cart</a>
                                     </div>
                                     <ul class="shopping-list">
                                         <li>
                                             <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                                                     class="lni lni-close"></i></a>
                                             <div class="cart-img-head">
                                                 <a class="cart-img" href="product-details.html"><img
                                                         src="assets/images/header/cart-items/item1.jpg"
                                                         alt="#"></a>
                                             </div>

                                             <div class="content">
                                                 <h4><a href="product-details.html">
                                                         Apple Watch Series 6</a></h4>
                                                 <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                             </div>
                                         </li>
                                         <li>
                                             <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                                                     class="lni lni-close"></i></a>
                                             <div class="cart-img-head">
                                                 <a class="cart-img" href="product-details.html"><img
                                                         src="assets/images/header/cart-items/item2.jpg"
                                                         alt="#"></a>
                                             </div>
                                             <div class="content">
                                                 <h4><a href="product-details.html">Wi-Fi Smart Camera</a></h4>
                                                 <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                             </div>
                                         </li>
                                     </ul>
                                     <div class="bottom">
                                         <div class="total">
                                             <span>Total</span>
                                             <span class="total-amount">$134.00</span>
                                         </div>
                                         <div class="button">
                                             <a href="checkout.html" class="btn animate">Checkout</a>
                                         </div>
                                     </div>
                                 </div>
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
                             aria-expanded="false" aria-label="Toggle navigation">
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                         </button>
                         <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                             <ul id="nav" class="navbar-nav ms-auto">
                                 <!-- إضافة قسم قطع الغيار -->
                                 <li class="nav-item">
                                     <a class="nav-link" href="internal-parts.html">قطع غيار داخلية</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="internal-parts.html">قطع غيار كهرابائية</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="external-parts.html">قطع غيار خارجية</a>
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
