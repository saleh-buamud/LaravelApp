@extends('dashboard.layout')
@section('title', 'Starter Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>
@endsection
@section('content')
    <h1>لوحة التحكم</h1>
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
        /* الخلفية الضبابية */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* اللون الأسود مع الشفافية */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            /* لضمان أن المودال يظهر فوق باقي المحتوى */
            opacity: 0;
            /* بداية مع إخفاء المودال */
            visibility: hidden;
            /* إخفاء المودال */
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        /* تصميم محتوى المودال */
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        /* تصميم زر الإغلاق */
        .btn-close {
            background: transparent;
            border: none;
            font-size: 30px;
            color: #333;
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

    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Create Category</a>
    <hr>
    <br>

    {{-- جدول السُب كاتجوري --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">الاسم</th>
                <th scope="col">الوصف</th>
                <th scope="col">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subCategories as $s)
                <tr>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->description }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="{{ route('subcategories.edit', $s->id) }}" class="btn btn-dark btn-sm mr-1">Edit</a>
                            <form action="{{ route('subcategories.destroy', $s->id) }}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="alert alert-primary text-center mt-3 p-2">
                            <h3 class="display-3">لا توجد سُب كاتجوري</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
