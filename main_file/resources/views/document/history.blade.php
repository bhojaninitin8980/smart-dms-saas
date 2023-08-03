@extends('layouts.app')
@section('page-title')
    {{__('History')}}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('History')}}</a>
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
                            <th>{{__('Date')}}</th>
                            <th>{{__('Document')}}</th>
                            <th>{{__('Action')}}</th>
                            <th>{{__('User')}}</th>
                            <th>{{__('Description')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories as $history)
                            <tr role="row">
                                <td>{{\Auth::user()->dateFormat($history->date)}} {{\Auth::user()->timeFormat($history->time)}}</td>
                                <td> {{ !empty($history->documents)?$history->documents->name:'-' }} </td>
                                <td> {{$history->action }} </td>
                                <td> {{ !empty($history->actionUser)?$history->actionUser->name:'-' }} </td>
                                <td> {{$history->description }} </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

