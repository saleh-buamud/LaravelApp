@extends('dashboard.layout')

@section('title', 'Admin List')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Admin List</li>
@endsection

@section('content')
    {{-- <x-alert /> --}}

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

    <a href="{{ route('admin.create') }}" class="btn btn-primary">Add Admin</a>
    <hr>
    <br>

    {{-- جدول الأدمنز --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">الصورة الشخصية</th> <!-- إضافة عمود للصورة الشخصية -->
                <th scope="col">الاسم</th>
                <th scope="col">البريد الإلكتروني</th>
                <th scope="col">الدور</th>
                <th scope="col">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <!-- عرض صورة الأدمن -->
                    <td>
                        @if ($admin->image)
                            <img src="{{ asset('storage/' . $admin->image) }}" alt="صورة الأدمن"
                                style="width: 50px; height: auto;">
                        @else
                            <span>لا توجد صورة</span> <!-- في حال عدم وجود صورة -->
                        @endif
                    </td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @if ($admin->is_admin)
                            <span class="badge bg-success">Admin</span>
                        @else
                            <span class="badge bg-secondary">User</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-dark btn-sm mr-1">Edit</a>
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="alert alert-primary text-center mt-3 p-2">
                            <h3 class="display-3">لا يوجد أدمنز</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $admins->links('pagination::bootstrap-5') }}
    </div>
@endsection
