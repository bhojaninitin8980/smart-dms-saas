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
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Document Details')}}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>{{__('Document Name')}}</th>
                            <td>{{$document->name}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Category')}}</th>
                            <td>{{ !empty($document->category)?$document->category->title:'-' }}</td>
                        </tr>
                        <tr>
                            <th>{{__('Sub Category')}}</th>
                            <td>{{ !empty($document->subCategory)?$document->subCategory->title:'-' }}</td>
                        </tr>

                        <tr>
                            <th>{{__('Created By')}}</th>
                            <td>{{!empty($document->createdBy)?$document->createdBy->name:''}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Created At')}}</th>
                            <td>{{\Auth::user()->dateFormat($document->created_at)}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Tags')}}</th>
                            <td>
                                @foreach($document->tags() as $tag)
                                    {{$tag->title}},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('Description')}}</th>
                            <td>{{$document->description}} </td>
                        </tr>
                        <tr>
                            <th>{{__('Document')}}</th>
                            <td>
                                <a href="#"><i data-feather="maximize"></i></a>
                                <a href="#"><i data-feather="download"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa fa-commenting mr-10"></i>Comments</h4>
                        </div>
                        <div class="card-body">
                            <ul class="blgcomment-list">
                                <li class="reply-comment">
                                    <div class="comment-item">
                                        <div class="media">
                                            <img class="img-fluid"
                                                 src="http://demo.smartwebinfotech.site/smart-tenant-saas/storage/upload/profile/avatar.png"
                                                 alt="">
                                            <div class="media-body">
                                                <a href="#">
                                                    <h5> Owner <span class="comment-time">    <i
                                                                class="fa fa-calendar"></i>06-07-23</span>
                                                    </h5>
                                                </a>

                                                <p> In publishing and graphic design, Lorem ipsum is a placeholder text
                                                    commonly used to</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="reply-comment">
                                    <div class="comment-item">
                                        <div class="media">
                                            <img class="img-fluid"
                                                 src="http://demo.smartwebinfotech.site/smart-tenant-saas/storage/upload/profile/avatar.png"
                                                 alt="">
                                            <div class="media-body">
                                                <a href="#">
                                                    <h5> Owner <span class="comment-time">    <i
                                                                class="fa fa-calendar"></i>06-07-23</span>
                                                    </h5>
                                                </a>

                                                <p> , Lorem ipsum is a placeholder text commonly used to</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card addblg-comment">
                        <div class="card-header">
                            <h4> <i class="fa fa-plus-square mr-10"></i>Add comment</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <textarea class="form-control" rows="2" placeholder="write acomment"></textarea>
                                </div>
                                <div class="form-group mb-0"><a class="btn btn-primary">Add Comment</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

