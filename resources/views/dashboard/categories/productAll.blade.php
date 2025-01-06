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

    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    <hr>
    <br>
    <form action="{{ route('products.search') }}">
        <div class="mb-3">
            <label for="name" class="form-label">اسم المنتج</label>
            <div class="input-group">
                <input type="text" name="name" class="form-control" id="name" value="{{ request('name') }}"
                    placeholder="أدخل اسم المنتج">
                <button type="submit" class="btn btn-primary">ابحث</button>
            </div>
        </div>
    </form>
    {{-- جدول المنتجات --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">صورة المنتج</th>
                <th scope="col">اسم المنتج</th>
                <th scope="col">وصف المنتج</th>
                <th scope="col">السعر</th>
                <th scope="col">الكمية</th>
                <th scope="col">الموديلات</th>
                <th scope="col">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="صورة المنتج"
                                style="width: 50px; height: auto;">
                        @else
                            <span>لا توجد صورة</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        @foreach ($product->modes as $mode)
                            <span class="badge bg-secondary">{{ $mode->name }}</span>
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
    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

@endsection
