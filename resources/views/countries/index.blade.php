@extends('layouts.main')

@section('content')

<h1>Countries</h1>

<div class="col-md-8">
  <div class="card">
      <div>
          @if (session()->has('message'))
              <div class="alert alert-success">
                  {{ session('message') }}
              </div>
          @endif

          @if (session()->has('errmessage'))
              <div class="alert alert-danger">
                  {{ session('errmessage') }}
              </div>
          @endif
      </div>
      <div class="card-header">
          <div class="row">
              <div class="col">
                  <form method="GET" action="{{ route('countries.index') }}">
                      <div class="form-row align-items-center">
                        <div class="col-auto">
                          <input type="search" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="Search">
                        </div>
                        
                        <div class="col-auto">
                          <button type="submit" class="btn btn-primary mb-2">Search</button>
                        </div>
                      </div>
                    </form>
              </div>
              <div class="col">
                  <a href="{{ route('countries.create') }}" class="btn btn-primary float-right">Create</a>
              </div>
          </div>        
          
      </div>
      <div class="card-body">
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Country Code</th>
                  <th scope="col">Country</th>
                  <th scope="col">Manage</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($countries as $country)
              <tr>
              <th scope="row">{{ $country->id }}</th>
              <td>{{ $country->country_code }}</td>
              <td>{{ $country->name }}</td>
              <td>                
                  <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-secondary"><i class="fas fa-fw fa-edit"></i></a>             
                  
              </td>
            </tr>
              @endforeach
              </tbody>
            </table>
      </div>
  </div>
</div>  
    
@endsection