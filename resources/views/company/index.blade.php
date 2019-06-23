@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

          <div class="row">
            <div class="col-md-6 offset-md-3">
              @if(Session::has('flash_message_success'))
              <div class="alert alert-success" role="alert">
                {!! session('flash_message_success') !!}
              </div>
              @endif
            </div>
          </div>

            <div class="card">
                <div class="card-header">List of companies</div>

                <div class="card-body">
                  <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Logo</th>
                      <th scope="col">Website</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($companies as $company)
                    <tr>
                      <th scope="row">{{$company->id}}</th>
                      <td>{{$company->name}}</td>
                      <td>{{$company->email}}</td>
                      <td>@if($company->logo) <img src="storage/{{$company->logo}}" width="70px" alt="{{$company->name}}">@else Not available @endif</td>
                      <td>{{$company->website}}</td>
                      <td>
                        <a href="/company/{{$company->id}}/edit" class="btn btn-outline-primary">Edit</a>
                      </td>
                      <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['CompanyController@destroy',$company->id]]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger']) !!}
                        {!! Form::close() !!}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                  <div class="d-flex justify-content-center">{{ $companies->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
