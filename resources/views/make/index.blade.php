@extends('dashboard.layout')

@section('content')
    <h1>جميع الماركات</h1>
    <a href="{{ route('dashboard.makes.create') }}" class="btn btn-primary mb-3">إضافة ماركة جديدة</a>
    @if (Session::has('message'))
        <script>
            swal("Messages", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "OK",
            });
        </script>
    @endif
    @if (Session::has('Update'))
        <script>
            swal("Update", "{{ Session::get('Update') }}", 'success', {
                button: true,
                button: "OK",
            });
        </script>
    @endif
    @if (Session::has('Delete'))
        <script>
            swal("Delete", "{{ Session::get('Delete') }}", 'success', {
                button: "OK",
            }).then(function() {
                // تخصيص الأيقونة لتكون حمراء بشكل كامل
                const swalIcon = document.querySelector('.swal2-icon.swal2-error');
                swalIcon.style.borderColor = '#D32F2F'; // اللون الأحمر
                swalIcon.style.color = '#D32F2F'; // اللون الأحمر
            });
        </script>
    @endif

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
    <div class="d-flex justify-content-center">
        {{ $makes->links('pagination::bootstrap-5') }}
    </div>
@endsection
