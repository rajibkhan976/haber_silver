<div class="row">

    <div class="col-lg-offset-0 col-md-12">
           
            <div class="row">                
               
                <div class="col-lg-offset-4 col-md-12">
                    <div class="form-group">
                        {{ Form::file('image', ['files'=>true, 'class' => 'field form-control']) }}

                    </div>
                    <span class="text-danger">{!! $errors->first('file1') !!}</span>
                </div>
            </div> 
            <div class="row">  
                <div class="col-lg-offset-4 col-md-12">
                    <div class="form-margin-btn">
                        {!! Form::submit(isset($edit_cons)?'Update':'Save', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                        <a href="{{route('admin.index.product.image')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
                    </div>
                </div>    
            </div>
    </div><!--end .col -->
</div><!--end .row -->