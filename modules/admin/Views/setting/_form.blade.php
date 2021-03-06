<div class="row">
    @if(isset($edit_value))
        {!! Form::hidden('type',Input::old('type')) !!}
        {!! Form::hidden('code',Input::old('code')) !!}
    @else
        <div class="col-lg-offset-0 col-md-6 frm-left-field">
            <div class="form-group">
                {!! Form::label('type', 'Type: *') !!}
                {!! Form::Select('type',array('product-code'=>'Product-code','quote-number'=>'Quote-number'),Input::old('type'),['id'=>'type', 'class'=>'form-control ','required'=> 'required',]) !!}
            </div>
            <span class="text-danger">{!! $errors->first('status') !!}</span>
        </div>
        <div class="col-lg-offset-0 col-md-6 frm-right-field">
            <div class="form-group">
                {!! Form::text('code',Input::old('code'),['id'=>'code', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"4",]) !!}
                {!! Form::label('code','Code: *') !!}
            </div>
            <span class="text-danger">{!! $errors->first('code') !!}</span>
        </div>
    @endif


</div>
<div class="row">
    <div class="col-lg-offset-0 col-md-6 frm-left-field">
        <div class="form-group">
            {!! Form::number('last_number',Input::old('last_number'),['id'=>'last_number','class' => 'form-control','required'=> 'required','data-rule-minlength'=>'1', 'title'=>'Enter last number']) !!}


            {!! Form::label('last_number', 'Last number: *', ['class' => 'control-label']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('file') !!}</span>
    </div>

    <div class="col-lg-offset-0 col-md-6 frm-right-field">
        <div class="form-group">
            {!! Form::number('increment',Input::old('increment'),['id'=>'increment','class' => 'form-control','required'=> 'required','data-rule-minlength'=>'1', 'title'=>'Enter increment']) !!}


            {!! Form::label('increment', 'Increment: *', ['class' => 'control-label']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('file') !!}</span>
    </div>
</div>

<div class="row">
    <div class="col-lg-offset-0 col-md-6 frm-left-field">
        <div class="form-group">
            {!! Form::label('status', 'Status: *') !!}

            {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required'=> 'required']) !!}
        </div>
        <span class="text-danger">{!! $errors->first('status') !!}</span>
    </div>
</div>

<div class="row">
    <div class="col-lg-offset-0 col-md-12">
        <p>&nbsp;</p>
        <div class="form-margin-btn pull-right">
            {!! Form::submit(isset($edit_cons)?'Update':'Save', ['class' => 'btn btn-primary pull-right','data-placement'=>'top','data-content'=>'click save changes button for save settings information']) !!}
            &nbsp;
            <a href="{{route('admin.setting')}}" class=" btn btn-default" data-placement="top"
               data-content="click close button for close this entry form">Close</a>
        </div>
    </div>
</div><?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

