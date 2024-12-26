@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <h1>Dashboard</h1>

    @if (Session::has('messages'))
        <script>
            swal("Messages", "{{ Session::get('messages') }}", 'success', {
                button: true,
                button: "OK",
            });
        </script>
    @endif

    @if (session('Deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('Deleted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
