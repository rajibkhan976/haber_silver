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
                        {!! Form::text('alt',Input::old('alt'),['id'=>'alt', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2"]) !!}
                        {!! Form::label('alt','Alt: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('title') !!}</span>
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
                                <div style="float: left; width: 80%;">
                                    {{ Form::file('images', ['files'=>true, 'class' => 'field']) }}
                                </div>
                            @if(isset($data))
                                <div style="float: left; width: 20%;">
                                     <img src="{{@$data->thumb}}" alt="{{@$data->alt}}">
                                </div>
                            @endif

                        </div>

                        <span class="text-danger">{!! $errors->first('file1') !!}</span>
                    </div>

            </div>

            <input name="product_cat_id" type="hidden" value="{{@$pc_data->id}}">





            <div class="form-margin-btn pull-right">
                {!! Form::submit('Save Changes', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                <a href="{{route('admin.index.product.category')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->