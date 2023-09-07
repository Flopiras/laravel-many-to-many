@extends('layouts.app')

@section('title', 'Cestino')

@section('content')
{{-- back --}}
<div class="mt-4 d-flex justify-content-end">
    <a href="{{ route('admin.projects.index')}}" class="btn btn-success">Torna alla lista</a>
</div>
    
{{-- projects --}}
<div class="mt-4">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome progetto</th>
          <th scope="col">Eliminato il</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($projects as $project)
        <tr>
            <th scope="row">{{ $project->id }}</th>
          <td>{{ $project->title }}</td>
          <td>{{ $project->deleted_at }}</td>
          <td>
            <div class="d-flex justify-content-end">
                {{-- restore --}}
                <form method="POST" action="{{ route('admin.projects.restore', $project)}}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-warning me-4">Ripristina</button>
                </form>
                {{-- delete --}}
                <form method="POST" action="{{ route('admin.projects.drop', $project) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Elimina definitivamente</button>
                </form>
            </div>
        </td>
        </tr>
          @empty
          <tr>
            <td class="text-center" colspan="4">
              <h3>Non ci sono progetti disponibili</h3>
            </td>
          </tr>
          @endforelse
          
      </tbody>
    </table>
  </div>
@endsection