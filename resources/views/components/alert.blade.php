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
   @if (session('updated'))
       <div class="alert alert-primary alert-dismissible fade show" id="successAlert" role="alert">
           {{ session('updated') }}
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
   @endif
   <script>
       setTimeout(function() {
           $('#successAlert').fadeOut('slow');
       }, 3000);
   </script>
