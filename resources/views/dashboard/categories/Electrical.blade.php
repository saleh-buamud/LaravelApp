@extends('dashboard.layout')
@section('title', 'Starter Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Starter Page</li>
@endsection
@section('content')
    <x-alert />
    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Create SupCategory</a>
    <hr>
    <br>
    <h2>قطع غيار كهربائية</h2>
    {{-- 
    @if (count($subCategories) > 0)
        <a href="{{ route('subcategories.create') }}" class="btn btn-primary">Create SubCategory</a>
    @endif --}}

    {{-- جدول السُب كاتجوري --}}
    <table class="table table-striped table-hover mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">اسم السُب كاتجوري</th>
                <th scope="col">وصف السُب كاتجوري</th>
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
                            <form action="{{ route('subcategories.destroy', $s['id']) }}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                        <a href="{{ route('subcategories.products', $s->id) }}" class="btn btn-dark btn-sm mr-1">all
                            products</a>
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
