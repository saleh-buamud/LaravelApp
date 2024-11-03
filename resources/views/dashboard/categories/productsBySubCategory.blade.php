@extends('dashboard.layout')

@section('title', 'Products by SubCategory')

@section('content')
    <h2>Products for SubCategory: {{ $subCategory->name }}</h2>

    {{-- جدول المنتجات --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">اسم المنتج</th>
                <th scope="col">وصف المنتج</th>
                <th scope="col">السعر</th>
                <th scope="col">الكمية</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="alert alert-primary text-center mt-3 p-2">
                            <h3 class="display-3">لا توجد منتجات</h3>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
