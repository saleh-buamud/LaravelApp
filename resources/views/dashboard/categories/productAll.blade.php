@extends('dashboard.layout')

@section('title', 'Starter Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>
@endsection

@section('content')
    {{-- <x-alert /> --}}

    @if (Session::has('messages'))
        <script>
        swal("Messages","{{ Session::get('messages') }}",'success',{
            button:true,
            button:"OK",
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

    <script>
        // إخفاء الرسالة بعد 5 ثوانٍ
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>

    @if ($lowStockProducts->count() > 0)
        <!-- Modal -->
        <div class="modal-backdrop" id="lowStockModal">
            <div class="modal-content">
                <h4>تنبيه!</h4>
                <p>هناك منتجات عددها أقل من 5. يرجى مراجعتها:</p>
                <ul>
                    @foreach ($lowStockProducts as $product)
                        <li>{{ $product->name }}: {{ $product->quantity }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" onclick="closeModal()">×</button>
            </div>
        </div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    <hr>
    <br>

    {{-- جدول المنتجات --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">صورة المنتج</th> <!-- إضافة عمود للصورة -->
                <th scope="col">اسم المنتج</th>
                <th scope="col">وصف المنتج</th>
                <th scope="col">السعر</th>
                <th scope="col">الكمية</th>
                <th scope="col">الموديلات</th> <!-- إضافة عمود للموديلات -->
                <th scope="col">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <!-- عرض صورة المنتج -->
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج"
                                style="width: 50px; height: auto;">
                        @else
                            <span>لا توجد صورة</span> <!-- في حال عدم وجود صورة -->
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>

                    <!-- عرض الموديلات المرتبطة -->
                    <td>
                        @foreach ($product->modes as $mode)
                            <span class="badge bg-secondary">{{ $mode->name }}</span> <!-- عرض كل موديل مرتبط -->
                        @endforeach
                    </td>

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark btn-sm mr-1">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="alert alert-primary text-center mt-3 p-2">
                            <h3 class="display-3">لا توجد منتجات</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
