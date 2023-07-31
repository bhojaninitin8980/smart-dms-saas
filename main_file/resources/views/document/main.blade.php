<div class="email-sidebar cdxapp-sidebar">
    <div class="card">
        <div class="card-header">
            <h4 >{{__('Document Overview')}}</h4>
        </div>
        <div class="card-body">
            <ul class="sidebarmenu-list custom-sidebarmenu-list">
                <li>
                    <a class="menu-item" href="{{route('document.show',\Illuminate\Support\Facades\Crypt::encrypt($document->id))}}">
                        <div class="icons"><i data-feather="list"></i></div>
                        {{__('Basic Details')}}
                    </a>
                </li>
                <li>
                    <a class="menu-item" href="{{route('document.comment',\Illuminate\Support\Facades\Crypt::encrypt($document->id))}}">
                        <div class="icons"><i data-feather="message-circle"></i></div>
                        {{__('Comment')}}
                    </a>
                </li>
                <li>
                    <a class="menu-item" href="{{route('document.reminder',\Illuminate\Support\Facades\Crypt::encrypt($document->id))}}">
                        <div class="icons"><i data-feather="user-check"></i></div>
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
