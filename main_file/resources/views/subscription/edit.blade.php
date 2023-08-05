{{ Form::model($subscription, array('route' => array('subscriptions.update', $subscription->id), 'method' => 'PUT')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter subscription name'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('price',__('Price'),array('class'=>'form-label'))}}
            {{Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter subscription price'),'step'=>'0.01'))}}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('duration', __('Duration'),array('class'=>'form-label')) }}
            {!! Form::select('duration', $durations, null,array('class' => 'form-control hidesearch','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('total_user',__('User Limit'),array('class'=>'form-label'))}}
            {{Form::number('total_user',null,array('class'=>'form-control','placeholder'=>__('Enter total user'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('total_document',__('Document Limit'),array('class'=>'form-label'))}}
            {{Form::number('total_document',null,array('class'=>'form-control','placeholder'=>__('Enter total contact'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('enabled_document_history',__('Show Document History'),array('class'=>'form-label'))}}
            <div>
                <label class="switch with-icon switch-primary">
                    <input type="checkbox" name="enabled_document_history" id="enabled_document_history" {{$subscription->enabled_document_history==1?'checked':''}}><span class="switch-btn"></span>
                </label>
            </div>
        </div>
        <div class="form-group col-md-6">
            {{Form::label('enabled_logged_history',__('Show User Logged History'),array('class'=>'form-label'))}}
            <div>
                <label class="switch with-icon switch-primary">
                    <input type="checkbox" name="enabled_logged_history" id="enabled_logged_history" {{$subscription->enabled_logged_history==1?'checked':''}}><span class="switch-btn"></span>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Update'),array('class'=>'btn btn-primary btn-rounded'))}}
</div>
{{ Form::close() }}


