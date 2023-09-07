@extends('layouts.app')

@section('title', $project->title)

@section('content')
{{-- back --}}
<a href="{{route('admin.projects.index')}}" class="btn btn-primary mt-4"><i class="fas fa-arrow-left"></i> Torna alla lista dei progetti</a>

<div class="card mt-4">
    <div class="row g-0">
      <div class="col-md-4">
        @if($project->image)
          <img src="{{ $project->getImagePath()}}" class="img-fluid rounded m-1" alt="{{ $project->title }}">
        @endif
      </div>
      <div class="col-md-8">
        <div class="card-body">
          {{-- category --}}
          <h6 class="text-end my-3"><small class="text-body-secondary"><strong>Categoria :</strong> @if($project->type_id) {{ $project->type->label }} @endif</small></h6>
          <h5 class="card-title">{{ $project->title }}</h5>
          <p class="card-text">{{ $project->content }}</p>
          <p class="card-text"><small class="text-body-secondary">Update : {{ $project->updated_at }}</small></p>
        </div>
      </div>
    </div>
    {{-- buttons --}}
    <div class="d-flex justify-content-end m-2">

        {{-- edit --}}
        <a href="{{route('admin.projects.edit', $project )}}" class="btn btn-warning mx-3 mt-4 text-end"><i class="fas fa-pencil"></i> Edit Project</a>

        {{-- delete --}}
        <form method="POST" action="{{route('admin.projects.destroy', $project)}}" class="delete-form mt-4">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Delete Project</button>
        </form>
    </div>
  </div>

@endsection

@section('scripts')
@vite(['resources/js/delete-confirmation.js'])
@endsection