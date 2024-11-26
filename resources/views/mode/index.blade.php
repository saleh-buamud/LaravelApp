@extends('dashboard.layout')

@section('content')
    <h1>جميع الأنماط</h1>
    <a href="{{ route('dashboard.modes.create') }}" class="btn btn-primary mb-3">إضافة نمط جديد</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم النمط</th>
                <th>الماركة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modes as $mode)
                <tr>
                    <td>{{ $mode->id }}</td>
                    <td>{{ $mode->name }}</td>
                    <td>{{ $mode->make->name }}</td>
                    <td>
                        <a href="{{ route('dashboard.modes.edit', $mode) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('dashboard.modes.destroy', $mode) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
