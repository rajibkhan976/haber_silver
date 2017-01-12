<div class="row">

    <div class="col-lg-offset-0 col-md-12">

            <div class="row">                               
                <div class="col-lg-offset-0 col-md-6">
                    <div class="form-group">
                        {!! Form::label('country_id', 'Company:') !!}
                        {!! Form::Select('country_id',$companies,Input::old('company_id'),['id'=>'country_id', 'class'=>'form-control','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('country_id') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6">                   
                    <div class="form-group">
                        {!! Form::label('users_id', 'User:') !!}
                        {!! Form::Select('users_id',$users,Input::old('users_id'),['id'=>'users_id', 'class'=>'form-control','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('users_id') !!}</span>
                </div>  
            </div>
            
            <div class="row">                
                <div class="col-lg-offset-0 col-md-6">
                    <div class="form-group">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('status') !!}</span>
                </div>                
            </div> 

            <div class="form-margin-btn pull-right">
                {!! Form::submit('Save Changes', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                <a href="{{route('admin.index.video.master')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->