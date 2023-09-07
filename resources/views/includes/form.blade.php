@if($project->exists)
{{-- edit --}}
<form method="POST" action="{{ route('admin.projects.update', $project) }}" class="mt-4" enctype="multipart/form-data">
    {{-- metod --}}
    @method('PUT')

@else
{{-- create --}}
<form method="POST" action="{{ route('admin.projects.store') }}" class="mt-4" enctype="multipart/form-data">
@endif

    {{-- token --}}
    @csrf

    <div class="row">

        {{-- title --}}
        <div class="col-7">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Titolo</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" maxlength="50" placeholder="Inserisci un titolo" value="{{ old('title', $project->title) }}" required>

                {{-- error message --}}
                @error('title')
                    <div id="titleFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            
        </div>

        {{-- type --}}
        <div class="col-4">
            <div class="mb-3">
                <label for="type" class="form-label fw-bold">Categoria</label>
                <select class="form-select @error('type_id') is-invalid @enderror" id="type" name="type_id">
                    <option>--</option>
                    @foreach($types as $type)
                    <option @if(old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">{{ $type->label }}</option>
                    @endforeach
                </select>
            </div>
     </div>
        
        {{-- content --}}
        <div class="col-12">
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">Testo del progetto</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="10">{{ old('content', $project->content) }}</textarea>

                {{-- error message --}}
                @error('content')
                    <div id="contentFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
        </div>

        {{-- technologies --}}
        <div class="col-12">
            <div class="mb-3">
                @foreach($technologies as $technology)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" @if(in_array($technology->id, old('technologies', $project_technology_ids ?? []))) checked @endif id="tech-{{$technology->id}}" value="{{$technology->id}}" name="technologies[]">
                        <label class="form-check-label" for="tech-{{$technology->id}}">{{ $technology->label }}</label>
                    </div>

                    {{-- error message --}}
                    @error('technologies')
                        <div class="text-danger">
                        {{ $message }}
                      </div>
                    @enderror
                @endforeach

                
            </div>
        </div>

        {{-- link --}}
        <div class="col-12">
            <div class="mb-3">
                <label for="link" class="form-label fw-bold">Link al progetto</label>
                <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Inserisci un link al progetto" value="{{ old('link', $project->link) }}">

                {{-- error message --}}
                @error('link')
                    <div id="linkFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
        </div>

        {{-- image --}}
        <div class="col-7">
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                {{-- error message --}}
                @error('image')
                <div id="imageFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        {{-- preview --}}
        <div class="col-2">
            <img src="{{ $project->image ? $project->getImagePath() : 'https://marcolanci.it/utils/placeholder.jpg' }}" class="img-fluid" id="image-preview" alt="preview">
        </div>
    </div>

    {{-- submit button --}}
    <div class="d-flex justify-content-end">
        <button class="btn btn-success">Salva</button>
    </div>
</form>