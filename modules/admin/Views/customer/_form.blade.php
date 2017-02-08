<div class="row">

    <div class="col-lg-offset-0 col-md-12">

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">

                    <div class="form-group">
                        {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2"]) !!}
                        {!! Form::label('first_name','First Name: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('first_name') !!}</span>                   
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::text('last_name', Input::old('last_name'), ['id'=>'last_name', 'class' => 'form-control', 'required' => 'required', 'data-rule-minlength'=>"2"]) !!}
                        {!! Form::label('last_name','Lats Name: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::label('company_id', 'Company:') !!}
                        
                         @if(isset($company_data))
                                @foreach($company_data as $values)
                                    <select name="company_id" class="form-control">
                                        <option value="{{ $values->id }}"> {{$values->name }}</option>
                                    </select>
                                @endforeach
                          @else
                            <select name="company_id" class="form-control">
                                <option value="{{ @$data->co_id }}"> {{@$data->name }}</option>
                            </select>
                        @endif
                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                </div>

                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                </div>           
            </div>



            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::text('city', Input::old('city'), [ 'id'=>'city', 'class' => 'form-control', 'required' => 'required'  ]) !!}
                        {!! Form::label('city','City: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('city') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::text('state', Input::old('state'), [ 'id'=>'state', 'class' => 'form-control', 'required' => 'required'  ]) !!}
                        {!! Form::label('state','State: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('state') !!}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('zip', Input::old('zip'), ['id'=>'zip', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('zip','Zip: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('zip') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::text('country', Input::old('country'), [ 'id'=>'country', 'class' => 'form-control', 'required' => 'required'  ]) !!}
                        {!! Form::label('country','Country: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('country') !!}</span>
                </div>
            </div>

            <div class="row" >
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('phone_number', Input::old('phone_number'), ['id'=>'fax_number', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('phone_number','Phone Number: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('phone_number') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::number('fax_number', Input::old('fax_number'), ['id'=>'fax_number', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('fax_number','Fax Number: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('fax_number') !!}</span>
                </div>
            </div>

            <div class="row" >
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::email('email_one', Input::old('email_one'), ['id'=>'email_one', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('email_one','Email1: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('email_one') !!}</span>
                </div>

                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::email('email_two', Input::old('email_two'), ['id'=>'email_two', 'class' => 'form-control']) !!}
                        {!! Form::label('email_two','Email2: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('email_two') !!}</span>
                </div>
            </div>  
            <div class="row" >
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::email('email_three', Input::old('email_three'), ['id'=>'email_three', 'class' => 'form-control']) !!}
                        {!! Form::label('email_three','Email3: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('email_three') !!}</span>
                </div>

                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::email('email_four', Input::old('email_four'), ['id'=>'email_four', 'class' => 'form-control']) !!}
                        {!! Form::label('email_four','Email4: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('email_four') !!}</span>
                </div>
            </div>            

             <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                         {{ Form::textarea('address_one', Input::old('address_one'), ['class' => 'form-control','rows'=>'2']) }}
                         {!! Form::label("address_one","Address One: *") !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('address_one') !!}</span>
                </div>

                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                         {{ Form::textarea('address_two', Input::old('address_two'), ['class' => 'form-control','rows'=>'2']) }}
                         {!! Form::label("address_two","Address Two: *") !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('address_two') !!}</span>
                </div> 
                   
            </div>

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                         {{ Form::textarea('address_three', Input::old('address_three'), ['class' => 'form-control','rows'=>'2']) }}
                         {!! Form::label("address_three","Address Three: *") !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('address_three') !!}</span>
                </div> 
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                         {{ Form::textarea('notes', Input::old('notes'), ['class' => 'form-control','rows'=>'2']) }}
                        
                        {!! Form::label("notes","Notes: *") !!}

                    </div>
                    <span class="text-danger">{!! $errors->first('notes') !!}</span>
                </div>         
            </div>
            <p>&nbsp;</p>
            <div class="form-margin-btn pull-right">

                {!! Form::submit(isset($edit_cons)?'Update':'Save', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                <a href="{{route('admin.index.company')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->