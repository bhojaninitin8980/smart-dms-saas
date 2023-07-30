@php
    $admin_logo=\App\Models\Custom::getValByName('company_logo');

@endphp
<aside class="codex-sidebar sidebar-{{$settings['sidebar_mode']}}">
    <div class="logo-gridwrap">
        <a class="codexbrand-logo" href="{{route('home')}}">
            <img class="img-fluid"
                 src="{{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                 alt="theeme-logo">
        </a>
        <a class="codex-darklogo" href="{{route('home')}}">
            <img class="img-fluid"
                 src="{{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                 alt="theeme-logo"></a>
        <div class="sidebar-action"><i data-feather="menu"></i></div>
    </div>
    <div class="icon-logo">
        <a href="{{route('home')}}">
            <img class="img-fluid"
                 src="{{asset(Storage::url('upload/logo/')).'/'.(isset($admin_logo) && !empty($admin_logo)?$admin_logo:'logo.png')}}"
                 alt="theeme-logo">
        </a>
    </div>
    <div class="codex-menuwrapper">
        @if(\Auth::user()->type=='super admin')
            <ul class="codex-menu custom-scroll" data-simplebar>
                <li class="cdxmenu-title">
                    <h5>{{__('Home')}}</h5>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'dashboard' || Request::route()->getName() == '')?'active':''}}">
                    <a href="{{route('dashboard')}}">
                        <div class="icon-item"><i data-feather="home"></i></div>
                        <span>{{__('Dashboard')}}</span>
                    </a>
                </li>

                <li class="cdxmenu-title">
                    <h5>{{__('Organization')}}</h5>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'users.index')?'active':''}}">
                    <a href="{{route('users.index')}}">
                        <div class="icon-item"><i data-feather="users"></i></div>
                        <span>{{__('Owners')}}</span>
                    </a>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'contact.index')?'active':''}}">
                    <a href="{{route('contact.index')}}">
                        <div class="icon-item"><i data-feather="phone-call"></i></div>
                        <span>{{__('Contacts')}}</span>
                    </a>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'support.index' || Request::route()->getName() == 'support.show')?'active':''}}">
                    <a href="{{route('support.index')}}">
                        <div class="icon-item"><i data-feather="headphones"></i></div>
                        <span>{{__('Supports')}}</span>
                    </a>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'note.index')?'active':''}}">
                    <a href="{{route('note.index')}}">
                        <div class="icon-item"><i data-feather="file-text"></i></div>
                        <span>{{__('Notes')}}</span>
                    </a>
                </li>

                <li class="cdxmenu-title">
                    <h5>{{__('Pricing')}}</h5>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'subscriptions.index' || Request::route()->getName() == 'subscriptions.show')?'active':''}}">
                    <a href="{{route('subscriptions.index')}}">
                        <div class="icon-item"><i data-feather="gift"></i></div>
                        <span>{{__('Packages')}}</span>
                    </a>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'subscription.transaction')?'active':''}}">
                    <a href="{{route('subscription.transaction')}}">
                        <div class="icon-item"><i data-feather="layers"></i></div>
                        <span>{{__('Transactions')}}</span>
                    </a>
                </li>

                <li class="cdxmenu-title">
                    <h5>{{__('Settings')}}</h5>
                </li>
                <li class="menu-item {{ (Request::route()->getName() == 'setting.account')?'active':''}}">
                    <a href="{{route('setting.account')}}">
                        <div class="icon-item"><i data-feather="user"></i></div>
                        <span>{{__('Account')}}</span>
                    </a>
                </li>
                <li class="menu-item {{ (Request::route()->getName() == 'setting.password')?'active':''}}">
                    <a href="{{route('setting.password')}}">
                        <div class="icon-item"><i data-feather="key"></i></div>
                        <span>{{__('Password')}}</span>
                    </a>
                </li>
                <li class="menu-item {{ (Request::route()->getName() == 'setting.general')?'active':''}}">
                    <a href="{{route('setting.general')}}">
                        <div class="icon-item"><i data-feather="settings"></i></div>
                        <span>{{__('General')}}</span>
                    </a>
                </li>
                <li class="menu-item {{ (Request::route()->getName() == 'setting.smtp')?'active':''}}">
                    <a href="{{route('setting.smtp')}}">
                        <div class="icon-item"><i data-feather="mail"></i></div>
                        <span>{{__('Email')}}</span>
                    </a>
                </li>
                <li class="menu-item {{ (Request::route()->getName() == 'setting.payment')?'active':''}}">
                    <a href="{{route('setting.payment')}}">
                        <div class="icon-item"><i data-feather="wind"></i></div>
                        <span>{{__('Payment')}}</span>
                    </a>
                </li>
            </ul>
        @else
            <ul class="codex-menu custom-scroll" data-simplebar>
                <li class="cdxmenu-title">
                    <h5>{{__('Home')}}</h5>
                </li>
                <li class="menu-item {{(Request::route()->getName() == 'dashboard' || Request::route()->getName() == '')?'active':''}}">
                    <a href="{{route('dashboard')}}">
                        <div class="icon-item"><i data-feather="home"></i></div>
                        <span>{{__('Dashboard')}}</span>
                    </a>
                </li>
                @if(Gate::check('manage user'))
                    <li class="menu-item {{(Request::route()->getName() == 'users.index')?'active':''}}">
                        <a href="{{route('users.index')}}">
                            <div class="icon-item"><i data-feather="users"></i></div>
                            <span>{{__('Users')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage role'))
                    <li class="menu-item  {{(Request::route()->getName() == 'role.index' || Request::route()->getName() == 'role.create' || Request::route()->getName() == 'role.edit')?'active':''}}">
                        <a href="{{route('role.index')}}">
                            <div class="icon-item"><i data-feather="anchor"></i></div>
                            <span>{{__('Roles')}}</span>
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage document') )
                    <li class="cdxmenu-title">
                        <h5>{{__('Business Management')}}</h5>
                    </li>
                    @if(Gate::check('manage document'))
                        <li class="menu-item {{(Request::route()->getName() == 'document.index' || Request::route()->getName() == 'document.show')?'active':''}}">
                            <a href="{{route('document.index')}}">
                                <div class="icon-item"><i data-feather="file-text"></i></div>
                                <span>{{__('All Documents')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage my document'))
                        <li class="menu-item {{(Request::route()->getName() == 'document.my-document')?'active':''}}">
                            <a href="{{route('document.my-document')}}">
                                <div class="icon-item"><i data-feather="file"></i></div>
                                <span>{{__('My Documents')}}</span>
                            </a>
                        </li>
                    @endif
                    <li class="menu-item {{(Request::route()->getName() == 'property.index')?'active':''}}">
                        <a href="#">
                            <div class="icon-item"><i data-feather="cpu"></i></div>
                            <span>{{__('All Reminders')}}</span>
                        </a>
                    </li>
                    <li class="menu-item {{(Request::route()->getName() == 'property.index')?'active':''}}">
                        <a href="#">
                            <div class="icon-item"><i data-feather="aperture"></i></div>
                            <span>{{__('My Reminders')}}</span>
                        </a>
                    </li>
                    <li class="menu-item {{(Request::route()->getName() == 'property.index')?'active':''}}">
                        <a href="#">
                            <div class="icon-item"><i data-feather="wind"></i></div>
                            <span>{{__('Document History')}}</span>
                        </a>
                    </li>
                    <li class="menu-item {{(Request::route()->getName() == 'property.index')?'active':''}}">
                        <a href="#">
                            <div class="icon-item"><i data-feather="check-square"></i></div>
                            <span>{{__('User Logged History')}}</span>
                        </a>
                    </li>

                @endif
                @if(Gate::check('manage contact') || Gate::check('manage support') || Gate::check('manage note'))
                    <li class="cdxmenu-title">
                        <h5>{{__('Additional')}}</h5>
                    </li>

                    @if(Gate::check('manage contact'))
                        <li class="menu-item {{(Request::route()->getName() == 'contact.index')?'active':''}}">
                            <a href="{{route('contact.index')}}">
                                <div class="icon-item"><i data-feather="phone-call"></i></div>
                                <span>{{__('Contacts')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage support'))
                        <li class="menu-item {{(Request::route()->getName() == 'support.index' || Request::route()->getName() == 'support.show')?'active':''}}">
                            <a href="{{route('support.index')}}">
                                <div class="icon-item"><i data-feather="headphones"></i></div>
                                <span>{{__('Supports')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage note'))
                        <li class="menu-item {{(Request::route()->getName() == 'note.index')?'active':''}}">
                            <a href="{{route('note.index')}}">
                                <div class="icon-item"><i data-feather="file-text"></i></div>
                                <span>{{__('Notes')}}</span>
                            </a>
                        </li>
                    @endif
                @endif
                @if(Gate::check('manage category') || Gate::check('manage sub category'))
                    <li class="cdxmenu-title">
                        <h5>{{__('Setup')}}</h5>
                    </li>
                    @if(Gate::check('manage category'))
                        <li class="menu-item {{(Request::route()->getName() == 'category.index')?'active':''}}">
                            <a href="{{route('category.index')}}">
                                <div class="icon-item"><i data-feather="list"></i></div>
                                <span>{{__('Category')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage sub category'))
                        <li class="menu-item {{(Request::route()->getName() == 'sub-category.index')?'active':''}}">
                            <a href="{{route('sub-category.index')}}">
                                <div class="icon-item"><i data-feather="sliders"></i></div>
                                <span>{{__('Sub Category')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage tag'))
                        <li class="menu-item {{(Request::route()->getName() == 'tag.index')?'active':''}}">
                            <a href="{{route('tag.index')}}">
                                <div class="icon-item"><i data-feather="layers"></i></div>
                                <span>{{__('Tags')}}</span>
                            </a>
                        </li>
                    @endif
                @endif
                @if(\Auth::user()->type=='admin')
                    <li class="cdxmenu-title">
                        <h5>{{__('Pricing')}}</h5>
                    </li>
                    <li class="menu-item {{(Request::route()->getName() == 'subscriptions.index' || Request::route()->getName() == 'subscriptions.show')?'active':''}}">
                        <a href="{{route('subscriptions.index')}}">
                            <div class="icon-item"><i data-feather="gift"></i></div>
                            <span>{{__('Packages')}}</span>
                        </a>
                    </li>
                    <li class="menu-item {{(Request::route()->getName() == 'subscription.transaction')?'active':''}}">
                        <a href="{{route('subscription.transaction')}}">
                            <div class="icon-item"><i data-feather="layers"></i></div>
                            <span>{{__('Transactions')}}</span>
                        </a>
                    </li>
                @endif

                @if(Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage company settings'))
                    <li class="cdxmenu-title">
                        <h5>{{__('Settings')}}</h5>
                    </li>
                    @if(Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage company settings'))
                        <li class="menu-item {{ (Request::route()->getName() == 'setting.account')?'active':''}}">
                            <a href="{{route('setting.account')}}">
                                <div class="icon-item"><i data-feather="user"></i></div>
                                <span>{{__('Account')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage company settings'))
                        <li class="menu-item {{ (Request::route()->getName() == 'setting.password')?'active':''}}">
                            <a href="{{route('setting.password')}}">
                                <div class="icon-item"><i data-feather="key"></i></div>
                                <span>{{__('Password')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage company settings'))
                        <li class="menu-item {{ (Request::route()->getName() == 'setting.general')?'active':''}}">
                            <a href="{{route('setting.general')}}">
                                <div class="icon-item"><i data-feather="settings"></i></div>
                                <span>{{__('General')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Gate::check('manage account settings') || Gate::check('manage password settings') || Gate::check('manage general settings') || Gate::check('manage company settings'))
                        <li class="menu-item {{ (Request::route()->getName() == 'setting.company')?'active':''}}">
                            <a href="{{route('setting.company')}}">
                                <div class="icon-item"><i data-feather="tool"></i></div>
                                <span>{{__('Company')}}</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        @endif
    </div>
</aside>
<!-- sidebar end-->
