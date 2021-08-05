@extends('layouts.main')

@section('content')

<h1>Departments</h1>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3>Create Departments</h3> 
                </div>
                <a href="{{ route('departments.index') }}" class="btn btn-info pull-right mr-4">Back</a> 
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('departments.store') }}">
                @csrf


                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

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