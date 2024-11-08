@extends('dashboard.layout')
@section('title', 'قطع غيار كهربائية')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">قطع غيار كهربائية</li>
@endsection
@section('content')
    <x-alert />
    <hr>
    <br>

    <h2>قطع غيار كهربائية</h2> <!-- عنوان القسم الجديد -->

    {{-- جدول المنتجات --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
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
                    <td colspan="5">
                        <div class="alert alert-primary text-center mt-3 p-2">
                            <h3 class="display-3">لا توجد منتجات</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
