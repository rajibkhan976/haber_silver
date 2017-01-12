<div class="row">

    <div class="col-lg-offset-0 col-md-12">

            <div class="row">
                <div class="col-lg-offset-0 col-md-6">
                    <div class="form-group">
                        {!! Form::text('title',Input::old('title'),['id'=>'title', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2"]) !!}
                        {!! Form::label('title','Title: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('title') !!}</span>
                </div>

                <div class="col-lg-offset-0 col-md-6">
                    <div class="form-group">
                        {!! Form::label('type', 'Type:') !!}
                        {!! Form::Select('type',array('collection'=>'Collection','self'=>'Self'),Input::old('type'),['id'=>'type', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-offset-0 col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-4">
                    <div class="form-group">
                        {{ Form::file('images[]', ['multiple'=>true,'files'=>true, 'class' => 'field form-control']) }}

                    </div>
                    <span class="text-danger">{!! $errors->first('file1') !!}</span>
                </div>
            </div>
            <div class="form-margin-btn pull-right">
                {!! Form::submit('Save Changes', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                <a href="{{route('admin.index.product.category')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->