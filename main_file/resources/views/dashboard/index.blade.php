@extends('layouts.app')
@section('page-title')
    {{__('Dashboard')}}
@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>

    </ul>
@endsection

@php
$settings=\App\Models\Custom::settings();
@endphp
@section('content')
    <div class="row">
        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total User')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['totalUser']}}</span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Contact')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                        <span class="count">{{$data['totalContact']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Total Support')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                    <span class="count">{{$data['totalSupport']}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6 cdx-xxl-50">
            <div class="card sale-revenue">
                <div class="card-header">
                    <h4>{{__('Today Expense')}}</h4>
                </div>
                <div class="card-body progressCounter">
                    <h2>
                    <span class="count">{{$data['todaySupport']}}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{__('Latest Supports')}}</h4>
            </div>
            <div class="card-body">
                <table class="display dataTable cell-border">
                    <thead>
                    <tr>
                        <th>{{__('Subject')}}</th>
                        <th>{{__('Attachment')}}</th>
                        <th>{{__('Created Date')}}</th>
                        <th>{{__('Created By')}}</th>
                        <th>{{__('Assign User')}}</th>
                        <th>{{__('Priority')}}</th>
                        <th>{{__('Status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['supports'] as $support)
                        <tr role="row">
                            <td>
                                <a href="{{ route('support.show',\Crypt::encrypt($support->id)) }}"
                                   class="text-body">{{$support->subject}}</a>
                            </td>
                            <td>
                                @if(!empty($support->attachment))
                                    <a href="{{asset('/storage/upload/support/'.$support->attachment)}}"
                                       download=""><i
                                            data-feather="download"></i></a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{\Auth::user()->dateFormat($support->created_at)}}
                            </td>
                            <td>
                                {{ !empty($support->createdUser)?$support->createdUser->name:'-' }}
                            </td>
                            <td>
                                {{ !empty($support->assignUser)?$support->assignUser->name:__('All') }}
                            </td>
                            <td>
                                @if($support->priority=='low')
                                    <span
                                        class="badge badge-primary">{{\App\Models\Support::$priority[$support->priority]}}</span>
                                @elseif($support->priority=='medium')
                                    <span
                                        class="badge badge-info">{{\App\Models\Support::$priority[$support->priority]}}</span>
                                @elseif($support->priority=='high')
                                    <span
                                        class="badge badge-warning">{{\App\Models\Support::$priority[$support->priority]}}</span>
                                @elseif($support->priority=='critical')
                                    <span
                                        class="badge badge-danger">{{\App\Models\Support::$priority[$support->priority]}}</span>
                                @endif
                            </td>
                            <td>
                                @if($support->status=='pending')
                                    <span
                                        class="badge badge-primary">{{\App\Models\Support::$status[$support->status]}}</span>
                                @elseif($support->status=='open')
                                    <span
                                        class="badge badge-info">{{\App\Models\Support::$status[$support->status]}}</span>
                                @elseif($support->status=='close')
                                    <span
                                        class="badge badge-danger">{{\App\Models\Support::$status[$support->status]}}</span>
                                @elseif($support->status=='on_hold')
                                    <span
                                        class="badge badge-warning">{{\App\Models\Support::$status[$support->status]}}</span>
                                @endif
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
