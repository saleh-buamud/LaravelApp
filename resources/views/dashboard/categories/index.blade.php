@extends('dashboard.layout')
@section('title', 'Starter Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>
@endsection
@section('content')
    <h1>لوحة التحكم</h1>

 @if ($lowStockProducts->count() > 0)
    <div class="alert alert-warning text-center alert-dismissible fade show" role="alert">
        <h4>تنبيه!</h4>
        هناك منتجات عددها أقل من 5. يرجى مراجعتها:
        @foreach ($lowStockProducts as $product)
            {{ $product->name }}: {{ $product->quantity }}@if (!$loop->last), @endif
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


    <x-alert />
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
                    <td>{{ $s['name'] }}</td>
                    <td>{{ $s['description'] }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="{{ route('subcategories.edit', $s['id']) }}" class="btn btn-dark btn-sm mr-1">Edit</a>
                            <form action="{{ route('subcategories.destroy', $s['id']) }}" method="post" class="mr-1">
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
