@php
    $user = json_decode($histories->details);
@endphp
<div class="modal-body">
    <div class="product-card">
        <div class="row">
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Status')}}</h6>
                    <p class="mb-20">{{$user->status}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Country')}}</h6>
                    <p class="mb-20">{{$user->country}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Country Code')}}</h6>
                    <p class="mb-20">{{$user->countryCode}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Region')}}</h6>
                    <p class="mb-20">{{$user->region}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Region Name')}}</h6>
                    <p class="mb-20">{{$user->regionName}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('City')}}</h6>
                    <p class="mb-20">{{$user->city}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Zip')}}</h6>
                    <p class="mb-20">{{$user->zip}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Latitude')}}</h6>
                    <p class="mb-20">{{$user->lat}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Longitude')}}</h6>
                    <p class="mb-20">{{$user->lon}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Timezone')}}</h6>
                    <p class="mb-20">{{$user->timezone}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Isp')}}</h6>
                    <p class="mb-20">{{$user->isp}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Org')}}</h6>
                    <p class="mb-20">{{$user->org}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('As')}}</h6>
                    <p class="mb-20">{{$user->as}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('IP')}}</h6>
                    <p class="mb-20">{{$user->query}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Browser Name')}}</h6>
                    <p class="mb-20">{{$user->browser_name}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Os Name')}}</h6>
                    <p class="mb-20">{{$user->os_name}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Browser Language')}}</h6>
                    <p class="mb-20">{{$user->browser_language}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Device Type')}}</h6>
                    <p class="mb-20">{{$user->device_type}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Referrer Host')}}</h6>
                    <p class="mb-20">{{$user->referrer_host}}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="detail-group">
                    <h6>{{__('Referrer Path')}}</h6>
                    <p class="mb-20">{{$user->referrer_path}}</p>
                </div>
            </div>
        </div>
    </div>
</div>



