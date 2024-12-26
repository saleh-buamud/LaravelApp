@extends('dashboard.layout')

@section('content')
    <h1>جميع الأنماط</h1>
    <a href="{{ route('dashboard.modes.create') }}" class="btn btn-primary mb-3">إضافة نمط جديد</a>
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
    <div class="d-flex justify-content-center">
        {{ $modes->links('pagination::bootstrap-5') }}
    </div>
@endsection
