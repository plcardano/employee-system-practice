@extends('layouts.main')

@section('content')

<h1>Cities</h1>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3>Create City</h3> 
                </div>
                <a href="{{ route('cities.index') }}" class="btn btn-info pull-right mr-4">Back</a> 
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cities.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                    <div class="col-md-6">
                        <select name="state_id" class="form-control @error('state_id') is-invalid @enderror" >
                            <option selected>Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                          </select>

                        @error('state_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection