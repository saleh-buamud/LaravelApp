@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <h1>Dashboard</h1>

    @if (Session::has('message'))
        <script>
            swal("Messages", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "OK",
            });
        </script>
    @endif

    @if (session('updated'))
        <script>
            swal("Message", "{{ Session::get('updated') }}", 'warning', {
                button: true,
                button: "OK",
            });
        </script>
    @endif

    @if (session('Deleted'))
        <script>
            swal("Message", "{{ Session::get('Deleted') }}", 'warning', {
                button: true,
                button: "OK",
            });
        </script>
    @endif
    @if (Session::has('messages'))
        <script>
            swal("Message", "{{ Session::get('messages') }}", 'warning', {
                button: true,
                button: "OK",
            }).then(() => {
                // After the message is displayed, forget it from the session
                @php
                    session()->forget('messages');
                @endphp
            });
        </script>
    @endif
@endsection
