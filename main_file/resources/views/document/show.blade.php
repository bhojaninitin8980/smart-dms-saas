@extends('layouts.app')
@section('page-title')
    {{__('Support')}}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('document.index')}}">{{__('Document')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Details')}}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="cdxemail-contain">
                <div class="email-sidebar cdxapp-sidebar">
                    <div class="card">
                        <div class="card-header">
                            <h4 >{{__('Document Overview')}}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="sidebarmenu-list custom-sidebarmenu-list">
                                <li>
                                    <a class="menu-item" href="#">
                                        <div class="icons"><i data-feather="mail"></i></div>
                                        {{__('Basic Details')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-item" href="#">
                                        <div class="icons"><i data-feather="mail"></i></div>
                                        {{__('Comment')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-item" href="#">
                                        <div class="icons"><i data-feather="mail"></i></div>
                                        {{__('Reminder')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-item" href="#">
                                        <div class="icons"><i data-feather="mail"></i></div>
                                        {{__('Version History')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-item" href="#">
                                        <div class="icons"><i data-feather="mail"></i></div>
                                        {{__('Share')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-item" href="#">
                                        <div class="icons"><i data-feather="mail"></i></div>
                                        {{__('Send Email')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="email-body">
                    <div class="card">
                        <div class="card-header">
                            <ul class="mailreact-list">
                                <li>
                                    <a class="btn btn-primary" href="javascript:void(0)"><i data-feather="edit"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-primary" href="javascript:void(0)"><i data-feather="trash-2"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-primary" href="javascript:void(0)"><i data-feather="maximize"> </i></a>
                                </li>
                                <li>
                                    <a class="btn btn-primary" href="javascript:void(0)"><i data-feather="download"> </i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="Primary">
                                    <ul class="mail-list" data-simplebar>
                                        <li>
                                            <div class="mail-item">
                                                <i class="like-mail text-warning" data-feather="star"></i>
                                                <h6 class="parson-name">{{__('Document Name')}}</h6>
                                                <p>{{$document->name}}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mail-item">
                                                <i class="like-mail text-warning" data-feather="star"></i>
                                                <h6 class="parson-name">{{__('Category')}}</h6>
                                                <p>{{ !empty($document->category)?$document->category->title:'-' }}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mail-item">
                                                <i class="like-mail text-warning" data-feather="star"></i>
                                                <h6 class="parson-name">{{__('Sub Category')}}</h6>
                                                <p>{{ !empty($document->subCategory)?$document->subCategory->title:'-' }}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mail-item">
                                                <i class="like-mail text-warning" data-feather="star"></i>
                                                <h6 class="parson-name">{{__('Created By')}}</h6>
                                                <p>{{!empty($document->createdBy)?$document->createdBy->name:''}}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mail-item">
                                                <i class="like-mail text-warning" data-feather="star"></i>
                                                <h6 class="parson-name">{{__('Created At')}}</h6>
                                                <p>{{\Auth::user()->dateFormat($document->created_at)}}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mail-item">
                                                <i class="like-mail text-warning" data-feather="star"></i>
                                                <h6 class="parson-name">{{__('Tags')}}</h6>
                                                <p>
                                                    @foreach($document->tags() as $tag)
                                                        {{$tag->title}},
                                                    @endforeach
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mail-item">
                                                <i class="like-mail text-warning" data-feather="star"></i>
                                                <h6 class="parson-name">{{__('Description')}}</h6>
                                                <p>{{$document->description}} </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

