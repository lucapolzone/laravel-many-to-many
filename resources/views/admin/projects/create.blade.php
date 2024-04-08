@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <h1>Inserisci un nuovo progetto</h1>
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                  <label class="form-label" for="title">Titolo progetto</label>
                  <input class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" type="text" id="title" name="title">
                  @error('title')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label" for="content">Descrizione progetto</label>
                  <input class="form-control @error('content') is-invalid @enderror" value="{{ old('content') }}" type="text" id="content" name="content">
                  @error('content')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror  
                </div>

                <div class="mb-3">
                    <label for="select" class="form-label">Categoria</label>                    
                    <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                        <option class="d-none" value="">Seleziona una categoria</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->label }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror  
                </div>

                <div class="mb-3">
                    <label class="form-label" for="link">Link al progetto</label>
                    <input class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}" type="url" id="link" name="link">
                    @error('link')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror  
                  </div>
                
                <button type="submit" class="btn btn-success">Salva</button>
              </form>

        </div>
    </section>
@endsection
