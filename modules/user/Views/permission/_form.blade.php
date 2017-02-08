
<div class="col-lg-offset-0 col-md-12">
    <div class="form-group">          
      
        {!! Form::text('title',Input::old('title'), ['id'=>'title', 'class' => 'form-control','required'=>'required','data-rule-minlength'=>"3",'style'=>'text-transform:capitalize','title'=>'enter permission title, example :: Branch Permission']) !!}

        {!! Form::label('title', 'Title: *', ['class' => 'control-label']) !!}
    </div>
    <span class="text-danger">{!! $errors->first('title') !!}</span>
</div>


<div class="col-lg-offset-0 col-md-12">
    <div class="form-group">
       
        {!! Form::text('route_url', Input::old('route_url'), ['id'=>'route_url', 'class' => 'form-control','size' => '12x3','title'=>'enter route_url about permission']) !!}

        {!! Form::label('route_url', 'Route Url:', ['class' => 'control-label']) !!}
    </div>
    <span class="text-danger">{!! $errors->first('route_url') !!}</span>
</div>




<div class="row">
    <div class="col-lg-offset-0 col-md-12">
        <p>&nbsp;</p>
        <div class="form-margin-btn pull-right">
                {!! Form::submit(isset($edit_cons)?'Update':'Save', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save branch information']) !!}
                <a href="{{route('user.index.permission')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
        </div>
    </div>
</div>


