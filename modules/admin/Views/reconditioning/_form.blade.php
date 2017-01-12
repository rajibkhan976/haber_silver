<div class="row">

    <div class="col-lg-offset-0 col-md-12">

        <div class="row">
            <div class="col-lg-offset-0 col-md-6">

                <div class="form-group">
                    {!! Form::text('title',Input::old('title'),['id'=>'title', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2"]) !!}
                    {!! Form::label('title','Reconditioning Title: *') !!}
                </div>
                <span class="text-danger">{!! $errors->first('title') !!}</span>
            </div>
            <div class="col-lg-offset-0 col-md-6">
                <div class="form-group">
                    {{ Form::file('image', ['class' => 'field']) }}

                    {!! Form::label('image',"Reconditioning Image") !!}
                </div>
                <span class="text-danger">{!! $errors->first('image') !!}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-offset-6 col-md-6">
                <img class="img-responsive" style="max-height: 100px;" src="{{ $data['image'] }}">
            </div>

        </div>


        <div class="row">
            <div class="col-lg-offset-0 col-md-6">
                <div class="form-group">
                    {!! Form::textarea('short_description',Input::old('short_description'),['id'=>'short_description', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2", 'rows'=>'4']) !!}
                    {!! Form::label('short_description','Short description: *') !!}
                </div>
                <span class="text-danger">{!! $errors->first('short_description') !!}</span>
            </div>
            <div class="col-lg-offset-0 col-md-6">
                <div class="form-group">
                    {!! Form::textarea('long_description',Input::old('long_description'),['id'=>'long_description', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2", 'rows'=>'4']) !!}
                    {!! Form::label('long_description','Long description: *') !!}
                </div>
                <span class="text-danger">{!! $errors->first('long_description') !!}</span>
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
        </div>
        <div class="form-margin-btn pull-right">
            {!! Form::submit('Save Changes', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
            <a href="{{route('admin.reconditioning')}}" class=" btn btn-default " data-placement="top"
               data-content="click close button for close this entry form">Close</a>
        </div>


    </div><!--end .col -->
</div><!--end .row -->