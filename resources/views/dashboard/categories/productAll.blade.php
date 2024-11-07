@extends('dashboard.layout')
@section('title', 'Starter Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>
@endsection
@section('content')
    {{-- <x-alert /> --}}

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
    <style>
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            /* زيادة الشفافية لجعل الخلفية أغمق */
            backdrop-filter: blur(10px);
            /* إضافة تأثير الضبابية على الخلفية */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        /* تصميم محتوى المودال */
        .modal-content {
            background-color: #000000;
            /* تغيير الخلفية إلى لون داكن */
            color: #0c00ed;
            /* تغيير النص إلى اللون الأبيض */
            padding: 30px;
            border-radius: 12px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.6);
            /* إضافة تأثير ظل أكثر كثافة */
            text-align: center;
        }

        /* تصميم زر الإغلاق */
        .btn-close {
            background: transparent;
            border: none;
            font-size: 35px;
            color: #fff;
            /* جعل لون زر الإغلاق أبيض */
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .modal-backdrop.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <script>
        // إظهار المودال بعد تحميل الصفحة
        window.onload = function() {
            var modal = document.getElementById("lowStockModal");
            modal.classList.add('show');
        };

        // إغلاق المودال عند الضغط على زر الإغلاق
        function closeModal() {
            var modal = document.getElementById("lowStockModal");
            modal.classList.remove('show');
        }

        // إغلاق المودال عند النقر على الخلفية الضبابية
        document.getElementById("lowStockModal").addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });
    </script>


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
                    <td colspan="6">
                        <div class="alert alert-primary text-center mt-3 p-2">
                            <h3 class="display-3">لا توجد منتجات</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
