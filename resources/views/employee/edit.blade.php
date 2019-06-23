@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit employee</div>

                <div class="card-body">
                  {!! Form::model($employee,['method'=>'PATCH', 'action'=>['EmployeeController@update',$employee->id]]) !!}
                    @csrf
                    <div class="form-group">
                      {!! Form::label('firstName', 'First Name') !!}
                      {!! Form::text('firstName',null, ['class'=>'form-control','placeholder'=>'eg.John']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('lastName', 'Last Name') !!}
                      {!! Form::text('lastName',null, ['class'=>'form-control','placeholder'=>'eg.Doe']) !!}
                    </div>
                    <div class="form-group">
                  		{!! Form::label('company_id', 'Company:') !!}
                  		{!! Form::select('company_id', [''=>'Choose option']+$companies ,null,['class'=>'form-control']) !!}
                  	</div>
                    <div class="form-group">
                      {!! Form::label('email', 'Email') !!}
                      {!! Form::text('email',null, ['class'=>'form-control','placeholder'=>'eg.email@admin.com']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('phone', 'Phone') !!}
                      {!! Form::text('phone',null, ['class'=>'form-control','placeholder'=>'eg.+43 111 2222']) !!}
                    </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  {!! Form::close() !!}
                  <br>
                  @include('errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
