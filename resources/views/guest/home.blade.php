@extends('layouts.app')
@section('content')

<header>
    <div class=" my-4 container text-center">
        <h1>Projects :</h1>
    </div>
</header>
<div class="jumbotron p-5 mb-4 bg-light rounded-3"> 
</div>

<div class="content container">
    <div class="row row-cols-4 mt-4">
        @forelse($projects as $project)
            <div class="col">
                <div class="card mb-4" >
                    <img src="{{ $project->getImagePath() }}" class="card-img-top" alt="{{ $project->title }}">
                    <div class="card-body">
                      <h5 class="card-title">{{ $project->title }}</h5>
                      <p class="card-text">{{ $project->getAbstract() }}</p>
                      <a href="{{ route('admin.projects.show', $project)}}" class="btn btn-primary">Show this project</a>
                    </div>
                  </div>
            </div>
        @empty
            <h3 class="text-center mt-4">Non ci sono progetti</h3>
        @endforelse
    </div>
</div>
@endsection