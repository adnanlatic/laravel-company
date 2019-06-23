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
                <div class="card-header">List of employees</div>

                <div class="card-body">
                  <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Company</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Edit</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($employees as $employee)
                    <tr>
                      <th scope="row">{{$employee->id}}</th>
                      <td>{{$employee->firstName}}</td>
                      <td>{{$employee->lastName}}</td>
                      <td>@if($employee->companies)
                        @if($employee->companies->logo)
                        <img src="storage/{{$employee->companies->logo}}" width="50px" alt="{{$employee->companies->name}}">
                        @else
                        {{$employee->companies->name}}
                        @endif
                        @else Not available @endif </td>
                      <td>{{$employee->email}}</td>
                      <td>{{$employee->phone}}</td>
                      <td>
                        <a href="/employee/{{$employee->id}}/edit" class="btn btn-outline-primary">Edit</a>
                      </td>
                      <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['EmployeeController@destroy',$employee->id]]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger']) !!}
                        {!! Form::close() !!}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                  <div class="d-flex justify-content-center">{{ $employees->links() }}</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
