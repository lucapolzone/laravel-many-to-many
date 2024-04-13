@extends('layouts.app')

@section('content')
    <section class="my-3">
        <div class="container">
            <h1 class="mb-5">Inserisci un nuovo progetto</h1>
            <form action="{{ route('admin.projects.store') }}" method="POST" class="row mb-4">
                @csrf

                <div class="col-5">
                  <label class="form-label" for="title">Titolo progetto</label>
                  <input class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" type="text" id="title" name="title">
                  @error('title')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="col-7" style="max-width: 655px">
                  @foreach($technologies as $technology)
                      <input class="form-check-input" id="technologies-{{ $technology->id }}" name="technologies[]" type="checkbox" value="{{ $technology->id }}">
                      <label class="form-check-label me-2" for="technologies-{{ $technology->id }}">{{ $technology->label }}</label>
                  @endforeach
                </div>

                <div class="mb-3">
                  <label class="form-label" for="content">Descrizione progetto</label>
                  <textarea class="form-control @error('content') is-invalid @enderror" type="text" id="content" name="content" rows="5">
                    {{ old('content') }}
                  </textarea>  
                  @error('content')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror  
                </div>

                <div class="mb-3 col-6">
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
                <div>
                  <button type="submit" class="btn btn-success">Salva</button>
                </div>
              </form>
        </div>
    </section>
@endsection
