<div class="row">

    <div class="col-lg-offset-0 col-md-12">
            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::label('id', 'Category:') !!}
                        {!! Form::Select('product_category_id',$productCategory,Input::old('product_category_id'),['id'=>'product_category_id', 'class'=>'form-control','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('product_category_id') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">   
                        {!! Form::label('product_sub_category_id','Sub Category: *') !!} 
                        {!! Form::Select('product_sub_category_id',$productSubCategory,Input::old('product_sub_category_id'),['id'=>'product_sub_category_id', 'class'=>'form-control','required']) !!}                     
                    </div>
                    <span class="text-danger">{!! $errors->first('product_sub_category_id') !!}</span>                   
                </div>                
            </div>
            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">                        
                        {!! Form::text('title', Input::old('title'), ['id'=>'title', 'class' => 'form-control']) !!}
                        {!! Form::label('title','Title') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('title') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::text('slug', Input::old('slug'), ['id'=>'slug', 'class' => 'form-control']) !!}
                        {!! Form::label('slug','Slug') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('slug') !!}</span>
                </div>
            </div>     
            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">                        
                        {!! Form::number('cost_price', Input::old('cost_price'), ['id'=>'cost_price', 'class' => 'form-control']) !!}
                        {!! Form::label('cost_price','Cost Price') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('cost_price') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::number('sell_price', Input::old('sell_price'), ['id'=>'sell_price', 'class' => 'form-control']) !!}
                        {!! Form::label('sell_price','Sell Price') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('sell_price') !!}</span>
                </div>
            </div>
            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">                        
                        {!! Form::number('quantity', Input::old('quantity'), ['id'=>'quantity', 'class' => 'form-control']) !!}
                        {!! Form::label('quantity','Quantity') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('quantity') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                         {!! Form::label('stock_type', 'Stock Type:') !!}
                        {!! Form::Select('stock_type',array('yes'=>'Yes','no'=>'No'),Input::old('stock_type'),['id'=>'stock_type', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('stock_type') !!}</span>
                </div>
            </div>
             <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">                        
                        {!! Form::label('unit_of_measurement', 'Unit of Measurement:') !!}
                        {!! Form::Select('  unit_of_measurement',array('yes'=>'Yes','no'=>'No'),Input::old('  unit_of_measurement'),['id'=>'unit_of_measurement', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('unit_of_measurement') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::label('product_type', 'Product Type:') !!}
                        {!! Form::Select('product_type',array('collection'=>'Collection','self'=>'Self'),Input::old('product_type'),['id'=>'product_type', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('product_type') !!}</span>
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
                {{--

                    <div class="col-lg-offset-0 col-md-6 frm-right-field">
                        <div class="form-group">
                            {!! Form::text('product_code', Input::old('product_code'), ['id'=>'product_code', 'class' => 'form-control']) !!}
                            {!! Form::label('product_code','Product Code') !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('product_code') !!}</span>
                    </div>    
                --}}               
            </div> 
            <p>&nbsp;</p>
            <div class="form-margin-btn pull-right">
                {!! Form::submit(isset($edit_cons)?'Update':'Save', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                <a href="{{route('admin.index.product')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->