@extends('layouts.app')
@section('page-title')
    {{__('Role')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('role.index')}}">{{__('Roles')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Create')}}</a>
        </li>
    </ul>
@endsection
@section('content')

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Create Role And Permissions')}}</h4>
                </div>
                <div class="card-body">
                    {{ Form::open(array('url' => 'role')) }}
                    <div class="form-group">
                        <div class="small-group">
                            <div>
                                {{Form::label('title',__('Role Title'),['class'=>'form-label'])}}
                                {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter role title')))}}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($permissionList as $permission)
                                <div class="form-check custom-chek form-check-inline col-md-3">
                                    {{Form::checkbox('user_permission[]',$permission->id,null, ['class'=>'form-check-input','id' =>'user_permission'.$permission->id])}}
                                    {{Form::label('user_permission'.$permission->id,ucfirst($permission->name),['class'=>'form-check-label'])}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group mt-20 text-end">
                        {{Form::submit(__('Create'),array('class'=>'btn btn-primary btn-rounded'))}}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

