<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">

<body>
    @include('front-ecom-temp.header')

    <div class="container my-5">
        <h2 class="mb-4">Checkout</h2>

        <!-- Checkout Form -->
        <form action="{{ route('saveOrder') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Full Name -->
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Enter your full name" />
                </div>

                <!-- Phone Number -->
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                        placeholder="Enter your phone number" />
                </div>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control"
                    placeholder="Enter your address" />
            </div>

            <!-- City -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" id="city" name="city" class="form-control"
                    placeholder="Enter your city" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Order</button>
            <button type="submit" class="btn btn-primary">Submit Order</button>
            <button type="submit" class="btn btn-primary">Submit Order</button>


        </form>
    </div>

    @include('front-ecom-temp.footer')

    <!-- Bootstrap 5 JS (من CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
