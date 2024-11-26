@extends('dashboard.layout')

@section('content')
    <h1>جميع الماركات</h1>
    <a href="{{ route('dashboard.makes.create') }}" class="btn btn-primary mb-3">إضافة ماركة جديدة</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الماركة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($makes as $make)
                <tr>
                    <td>{{ $make->id }}</td>
                    <td>{{ $make->name }}</td>
                    <td>
                        <a href="{{ route('dashboard.makes.edit', $make) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('dashboard.makes.destroy', $make) }}" method="POST" style="display:inline;">
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
