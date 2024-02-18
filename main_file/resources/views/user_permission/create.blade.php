{{ Form::open(array('url' => 'user_permission')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group ">
            {{Form::label('title',__('Title'))}}
            {{Form::text('title',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group">
            @foreach ($userRoles as $userRole)
                <div class="custom-control">
                    {{Form::checkbox('user_roles[]',$userRole->id,null, ['class'=>'custom-control-input'])}}
                    {{Form::label('user_role'.$userRole->id,$userRole->name,['class'=>'form-control-label '])}}
                </div>
            @endforeach
        </div>
        <div class="col-md-12">
            {{Form::submit(__('Create'),array('class'=>'btn btn-primary btn-rounded'))}}
        </div>
    </div>
</div>
{{ Form::close() }}


