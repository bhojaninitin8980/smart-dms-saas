@extends('layouts.app')
@section('page-title')
    {{__('Logged History')}}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Logged History')}}</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Role') }}</th>
                            <th>{{ __('Last Login') }}</th>
                            <th>{{ __('Ip') }}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('Device') }}</th>
                            <th>{{ __('OS') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($histories as $history)
                            @php
                                $historydetail = json_decode($history->details);
                            @endphp
                            <tr>
                                <td>{{ !empty($history->user)?$history->user->name:'-' }}</td>
                                <td>{{ !empty($history->user)?$history->user->email:'-' }}</td>
                                <td> {{ucfirst($history->type)}} </td>
                                <td>{{ !empty($history->date) ? \Auth::user()->dateformat($history->date) : '-' }}</td>
                                <td>{{ $history->ip }}</td>
                                <td>{{ !empty($historydetail->country)?$historydetail->country:'-' }}</td>
                                <td>{{ $historydetail->device_type }}</td>
                                <td>{{ $historydetail->os_name }}</td>
                                <td class="text-right">
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['logged.history.destroy', $history->id]]) !!}
                                        <a class="text-warning customModal" data-size="lg" data-bs-toggle="tooltip"
                                           data-bs-original-title="{{__('Show')}}" href="#"
                                           data-url="{{ route('logged.history.show',$history->id) }}"
                                           data-title="{{__('Details')}}"> <i data-feather="eye"></i></a>

                                        <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                           data-bs-original-title="{{__('Detete')}}" href="#"> <i
                                                data-feather="trash-2"></i></a>
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

