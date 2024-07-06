 @extends('dashboard.layout')
 @section('title', 'Starter Page')
 @section('breadcrumb')
     @parent
     <li class="breadcrumb-item active">Starter Page</li>
 @endsection
 @section('content')
     @if (session('success'))
         <div class="alert alert-success alert-dismissible fade show" id="successAlert" role="alert">
             {{ session('success') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
     @endif


     @if (session('Deleted'))
         <div class="alert alert-danger alert-dismissible fade show" id="successAlert" role="alert">
             {{ session('Deleteds') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
     @endif

     <script>
         setTimeout(function() {
             $('#successAlert').fadeOut('slow');
         }, 3000);
     </script>

     <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>

     <table class="table table-striped table-hover mt-4">
         <thead class="thead-dark">
             <tr>
                 <th scope="col">ID</th>
                 <th scope="col">Name</th>
                 <th scope="col">Parent</th>
                 <th scope="col">Image</th>
                 <th scope="col">Created At</th>
                 <th scope="col">Actions</th>
             </tr>
         </thead>
         <tbody>
             @forelse ($categories as $cat)
                 <tr>
                     <td>{{ $cat->id }}</td>
                     <td>{{ $cat->name }}</td>
                     <td>{{ $cat->parent_id }}</td>
                     <td>
                         @if ($cat->image)
                             <img src="{{ asset('storage/' . $cat->image) }}" height="50" width="50"
                                 alt="Category Image">
                         @else
                             <span class="text-muted">No Image</span>
                         @endif
                     </td>
                     <td>{{ $cat->created_at->format('Y-m-d') }}</td>
                     <td>
                         <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                             <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-dark btn-sm mr-1">Edit</a>
                             <form action="{{ route('categories.destroy', $cat->id) }}" method="post" class="mr-1">
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
                             <h3 class="display-3">No Categories</h3>
                         </div>
                     </td>
                 </tr>
             @endforelse
         </tbody>
     </table>


 @endsection
