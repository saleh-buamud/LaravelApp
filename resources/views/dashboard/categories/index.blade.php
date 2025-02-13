@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Header Section -->
        {{-- <div class="row mb-4">
            <div class="col-12 text-center">
                <img src="{{ asset('assets/images/logo/e.jpg') }}" alt="الشعار" class="img-fluid" style="max-height: 100px;">
                <h2 class="mt-3">متجر سيارتك</h2>
            </div>
        </div> --}}

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow-sm bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الطلبات</h5>
                        <p class="card-text display-4">150</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">المنتجات المباعة</h5>
                        <p class="card-text display-4">320</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">العملاء الجدد</h5>
                        <p class="card-text display-4">45</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">الإيرادات</h5>
                        <p class="card-text display-4">$5,000</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">مخطط المبيعات الشهرية</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">مخطط العملاء الجدد</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="customersChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">روابط سريعة</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="#" class="btn btn-outline-primary btn-block">إدارة المنتجات</a>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="btn btn-outline-success btn-block">إدارة الطلبات</a>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="btn btn-outline-warning btn-block">إدارة العملاء</a>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="btn btn-outline-danger btn-block">التقارير</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert Scripts -->
    @if (Session::has('message'))
        <script>
            swal("تم بنجاح", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "موافق",
            });
        </script>
    @endif

    @if (session('updated'))
        <script>
            swal("تم التحديث", "{{ Session::get('updated') }}", 'warning', {
                button: true,
                button: "موافق",
            });
        </script>
    @endif

    @if (session('Deleted'))
        <script>
            swal("تم الحذف", "{{ Session::get('Deleted') }}", 'warning', {
                button: true,
                button: "موافق",
            });
        </script>
    @endif

    @if (Session::has('messages'))
        <script>
            swal("تنبيه", "{{ Session::get('messages') }}", 'warning', {
                button: true,
                button: "موافق",
            }).then(() => {
                // After the message is displayed, forget it from the session
                @php
                    session()->forget('messages');
                @endphp
            });
        </script>
    @endif

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sales Chart
        const salesChart = new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
                datasets: [{
                    label: 'المبيعات',
                    data: [120, 190, 300, 250, 200, 400],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });

        // Customers Chart
        const customersChart = new Chart(document.getElementById('customersChart'), {
            type: 'bar',
            data: {
                labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
                datasets: [{
                    label: 'العملاء الجدد',
                    data: [50, 70, 100, 80, 90, 120],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });
    </script>
@endsection
