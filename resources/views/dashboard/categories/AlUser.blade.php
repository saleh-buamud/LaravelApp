@extends('dashboard.layout')
@section('title', 'عرض المستخدمين')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">عرض المستخدمين</li>
@endsection
@section('content')
    <!-- على سبيل المثال، في ملف Blade لعرض قائمة المستخدمين -->

    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->is_super_admin)
                    <span class="badge badge-success">Super Admin</span>
                @else
                    <span class="badge badge-secondary">User</span>
                @endif
            </td>
            <td>
                <!-- أزرار لتغيير حالة السوبر أدمن -->
                @if (!$user->is_super_admin)
                    <form action="{{ route('make.superadmin', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Make Super Admin</button>
                    </form>
                @else
                    <form action="{{ route('remove.superadmin', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Remove Super Admin</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach

    <div class="alert alert-danger text-center">
        <h3>ليس لديك صلاحية للوصول إلى هذه الصفحة</h3>
    </div>
    @endif
@endsection
