@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit company</div>

                <div class="card-body">
                  {!! Form::model($companyForEditing,['method'=>'PATCH', 'action'=>['CompanyController@update',$companyForEditing->id],'files'=>'true']) !!}
                    @csrf
                    <input type="hidden" name="oldPhoto" value="{{$companyForEditing->logo}}">
                    <div class="form-group">
                      {!! Form::label('name', 'Name') !!}
                      {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'eg.Apple','required'=>'required']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('email', 'Email') !!}
                      {!! Form::text('email',null, ['class'=>'form-control','placeholder'=>'eg.email@admin.com']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('website', 'Website') !!}
                      {!! Form::text('website',null, ['class'=>'form-control','placeholder'=>'eg.www.google.com']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('logo', 'Logo') !!}
                      {!! Form::file('logo') !!}
                      <img src="/storage/{{$companyForEditing->logo}}" width="120px" alt="{{$companyForEditing->name}}">
                    </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  {!! Form::close() !!}
                  @include('errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
