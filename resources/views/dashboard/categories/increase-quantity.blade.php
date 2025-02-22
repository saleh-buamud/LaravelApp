@extends('dashboard.layout')

@section('title', 'مخزون قطع')
@section('breadcrumb')
    @parent
@endsection

@section('content')
    {{-- عرض رسائل التنبيه --}}
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

    {{-- عرض رسالة SweetAlert بعد زيادة الكمية --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'نجاح',
                text: "{{ session('success') }}",
                confirmButtonText: 'موافق'
            });
        </script>
    @endif


    {{-- جدول المنتجات --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">اسم المنتج</th>
                <th scope="col">الكمية</th>
                <th scope="col">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            {{-- زر زيادة الكمية --}}
                            <form action="{{ route('increase.quantity', $product->id) }}" method="POST" class="mr-1">
                                @csrf
                                <div class="input-group">
                                    <input type="number" name="quantity" class="form-control" min="1" required
                                        style="width: 80px;">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i> زيادة
                                    </button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-primary text-center mt-3 p-2">
                            <h3 class="display-3">لا توجد منتجات</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
