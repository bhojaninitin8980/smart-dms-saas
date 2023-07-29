{{ Form::open(array('url' => 'subscriptions')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{Form::label('name',__('Name'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter subscription name'),'required'=>'required'))}}
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
            {{Form::label('total_contact',__('Contact Limit'),array('class'=>'form-label'))}}
            {{Form::number('total_contact',null,array('class'=>'form-control','placeholder'=>__('Enter total contact'),'required'=>'required'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('total_support',__('Support Limit'),array('class'=>'form-label'))}}
            {{Form::number('total_support',null,array('class'=>'form-control','placeholder'=>__('Enter total support'),'required'=>'required'))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary btn-rounded'))}}
</div>
{{ Form::close() }}

