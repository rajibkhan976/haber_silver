
    
            <div class="col-lg-offset-0 col-md-12">
                    <div class="form-group">
                         {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required','data-rule-minlength'=>'2', 'title'=>'Enter Role Name']) !!}


                        {!! Form::label('title', 'Title: *', ['class' => 'control-label']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('title') !!}</span>
            </div>

             <div class="col-lg-offset-0 col-md-12">
                    <div class="form-group">
                         {!! Form::label('status', 'Status: *') !!}
                       
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required'=> 'required']) !!}


                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
            </div>

    <div class="row">
        <div class="col-lg-offset-0 col-md-12">
            <div class="form-margin-btn pull-right">
                {!! Form::submit(isset($edit_cons)?'Update':'Save', ['class' => 'btn btn-primary pull-right','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
                <a href="{{route('user.role')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>
        </div>
    </div>



