{{Form::open(array('url'=>'document','method'=>'post', 'enctype' => "multipart/form-data"))}}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-12">
            {{Form::label('name',__('Name'),array('class'=>'form-label'))}}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter document name')))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('category_id',__('Category'),array('class'=>'form-label'))}}
            {{Form::select('category_id',$category,null,array('class'=>'form-control hidesearch','id'=>'category'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('sub_category_id',__('Sub Category'),array('class'=>'form-label'))}}
            <div class="sc_div">
                <select class="form-control hidesearch sub_category_id" id="sub_category_id" name="sub_category_id">
                    <option value="">{{__('Select Sub Category')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('document',__('Document'),array('class'=>'form-label'))}}
            {{Form::file('document',array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('tages',__('Tages'),array('class'=>'form-label'))}}
            {{Form::select('tages[]',$tages,null,array('class'=>'form-control hidesearch','multiple'))}}
        </div>
        <div class="form-group  col-md-12">
            {{Form::label('description',__('Description'),array('class'=>'form-label'))}}
            {{Form::textarea('description',null,array('class'=>'form-control','rows'=>3))}}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('Close')}}</button>
    {{Form::submit(__('Create'),array('class'=>'btn btn-primary btn-rounded'))}}
</div>
{{ Form::close() }}

<script>
    $('#category').on('change', function () {
        "use strict";
        var category_id=$(this).val();
        var url = '{{ route("category.sub-category", ":id") }}';
        url = url.replace(':id', category_id);
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                category_id:category_id,
            },
            contentType: false,
            processData: false,
            type: 'GET',
            success: function (data) {
                $('.sub_category_id').empty();
                var unit = `<select class="form-control hidesearch sub_category_id" id="sub_category_id" name="sub_category_id"></select>`;
                $('.sc_div').html(unit);

                $.each(data, function(key, value) {
                    $('.sub_category_id').append('<option value="' + key + '">' + value +'</option>');
                });
                $('.hidesearch').select2({
                    minimumResultsForSearch: -1
                });
            },

        });
    });
</script>
