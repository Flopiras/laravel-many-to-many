@if(session('message'))
    
<div class="alert alert-{{ session('type') ?? 'info' }} alert-dismissible fade show mt-4" role="alert">
    {{session('message')}}
</div>

@endif