<div class="row">

    <div class="col-lg-offset-0 col-md-12">

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">

                    <div class="form-group">
                        {!! Form::text('name',Input::old('name'),['id'=>'name', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2"]) !!}
                        {!! Form::label('name','Company Name: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('name') !!}</span>                   
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::text('description', Input::old('description'), ['id'=>'description', 'class' => 'form-control', 'required' => 'required', 'data-rule-minlength'=>"2"]) !!}
                        {!! Form::label('description','Description: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('description') !!}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::text('approved_product', Input::old('approved_product'), [ 'id'=>'approved_product', 'class' => 'form-control', 'required' => 'required'  ]) !!}
                        {!! Form::label('approved_product','Approve Product : *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('approved_product') !!}</span>

                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">

                    <div class="form-group">
                        {!! Form::number('price_level_one', Input::old('price_level_one'), ['id'=>'price_level_one', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('price_level_one','PriceLevel1: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('price_level_one') !!}</span>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">

                    <div class="form-group">
                        {!! Form::number('price_level_two', Input::old('price_level_two'), ['id'=>'price_level_two', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('price_level_two','PriceLevel2: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('price_level_two') !!}</span>

                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">

                    <div class="form-group">
                        {!! Form::number('discount_a', Input::old('discount_a'), ['id'=>'discount_a', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('discount_a','Discount A (%) *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('discount_a') !!}</span>

                </div>
            </div>

            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('discount_b', Input::old('discount_b'), ['id'=>'discount_b', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('discount_b','Discount B (%) *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('discount_b') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::number('discount_c', Input::old('discount_c'), ['id'=>'discount_c', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('discount_c','Discount C (%) *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('discount_c') !!}</span>
                </div>
            </div>

            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('mark_up_level_one', Input::old('mark_up_level_one'), ['id'=>'mark_up_level_one', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('mark_up_level_one','MarkupLevel1 *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('mark_up_level_one') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::number('mark_up_level_two', Input::old('mark_up_level_two'), ['id'=>'mark_up_level_two', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('mark_up_level_two','MarkupLevel2 *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('mark_up_level_two') !!}</span>
                </div>
            </div>

            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('mark_up_a', Input::old('mark_up_a'), ['id'=>'mark_up_a', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('mark_up_a','Markup A (%) *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('mark_up_a') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::number('mark_up_b', Input::old('mark_up_b'), ['id'=>'mark_up_b', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('mark_up_b','Markup B (%) *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('mark_up_b') !!}</span>
                </div>
            </div>


            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('mark_up_c', Input::old('mark_up_c'), ['id'=>'mark_up_c', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('mark_up_c','Markup C (%) *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('mark_up_c') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {{ Form::file('letter_head_image', ['class' => 'field']) }}

                        {!! Form::label('letter_head_image',"Distributor's letterhead image") !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('letter_head_image') !!}</span>
                </div>
            </div>

            <div class="row" >
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                         {{ Form::textarea('letter_head_text', Input::old('letter_head_text'), ['class' => 'form-control','rows'=>'2']) }}
                        
                        {!! Form::label("letter_head_text","Distributor's letterhead text : *") !!}

                    </div>
                    <span class="text-danger">{!! $errors->first('letter_head_text') !!}</span>
                </div>

                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                         {{ Form::textarea('letter_head_footer', Input::old('letter_head_footer'), ['class' => 'form-control','rows'=>'2']) }}
                        
                        {!! Form::label("letter_head_footer","Distributor's letterhead footer : *") !!}

                    </div>
                    <span class="text-danger">{!! $errors->first('letter_head_footer') !!}</span>
                </div>
            </div>

            <div class="row">
                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                </div>
            </div>
        <p>&nbsp;</p>
            <div class="form-margin-btn pull-right">

                {!! Form::submit(isset($edit_cons)?'Update':'Save', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}

                <a href="{{route('admin.index.company')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->