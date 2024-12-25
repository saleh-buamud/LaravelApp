@extends('dashboard.layout')

@section('title', 'Starter Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('content')
    <h1>لوحة التحكم</h1>

    <!-- التحقق من وجود رسالة في الجلسة وعرضها باستخدام SweetAlert -->
    @if (Session::has('messages'))
        <script>
            // عرض تنبيه باستخدام SweetAlert

            swal("Messages", "{{ Session::get('messages') }}", 'warning', {
                button: true,
                button: "OK",
            });
        </script>
    @endif
@endsection
