@extends('layouts.main')

@section('content')

<h1>Countries</h1>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3>Update Country</h3> 
                </div>
                <a href="{{ route('countries.index') }}" class="btn btn-info pull-right mr-4">Back</a> 
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('countries.update', $country->id) }}">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="country_code" class="col-md-4 col-form-label text-md-right">{{ __('Country Code') }}</label>

                    <div class="col-md-6">
                        <input id="country_code" type="text" class="form-control @error('country_code') is-invalid @enderror" name="country_code" value="{{ old('country_code', $country->country_code) }}" required autocomplete="country_code" autofocus>

                        @error('country_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $country->name) }}" required autocomplete="name" autofocus>

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
            <form action="{{ route('countries.destroy', $country->id) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Delete</button>
            </form>
            
        </div>
</div>
    
@endsection