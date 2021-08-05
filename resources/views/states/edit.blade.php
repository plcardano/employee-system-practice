@extends('layouts.main')

@section('content')

<h1>Countries</h1>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3>Update State</h3> 
                </div>
                <a href="{{ route('states.index') }}" class="btn btn-info pull-right mr-4">Back</a> 
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('states.update', $state->id) }}">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                    <div class="col-md-6">
                        <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" >
                            <option selected>Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" 
                                    {{ $country->id == $state->country_id ? 'selected' : '' }}>
                                    {{ $country->name }}</option>
                            @endforeach
                          </select>

                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $state->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>

                    </div>

                    
                </div>
            </form>
        </div>
    </div>
        <div class="mt-2 mr-4  float-right">
            <form action="{{ route('states.destroy', $state->id) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Delete</button>
            </form>
            
        </div>
</div>
    
@endsection