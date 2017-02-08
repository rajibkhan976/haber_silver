<div class="row">

    <div class="col-lg-offset-0 col-md-12">
            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::label('id', 'Product:') !!}
                        {!! Form::Select('product_id',$products,Input::old('product_id'),['id'=>'country_id', 'class'=>'form-control','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('product_id') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">                       
                        {!! Form::text('title',Input::old('title'),['id'=>'title', 'class' => 'form-control', 'required']) !!} 

                        {!! Form::label('title','Title: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('title') !!}</span>                   
                </div>                
            </div>
            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">                        
                        {!! Form::text('alt', Input::old('alt'), ['id'=>'alt', 'class' => 'form-control']) !!}
                        {!! Form::label('alt','Alter Text') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('alt') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {{ Form::file('images[]', ['multiple'=>true,'files'=>true, 'class' => 'field form-control']) }}

                    </div>
                    <span class="text-danger">{!! $errors->first('file1') !!}</span>
                </div>
            </div>            
            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                </div>               
            </div> 
            <p>&nbsp;</p>
            <div class="form-margin-btn pull-right">
                {!! Form::submit(isset($edit_cons)?'Update':'Save', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save product image information']) !!}
                <a href="{{ URL::previous() }}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->