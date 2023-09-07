@extends('layouts.app')

@section('title', 'Crea nuovo progetto')

@section('content')
    {{-- back button --}}
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mt-4"><i class="fas fa-arrow-left"></i> Torna ai progetti</a>

    {{-- form --}}
    @include('includes.form')
@endsection

@section('scripts')

@vite('resources/js/image-preview.js')
@endsection