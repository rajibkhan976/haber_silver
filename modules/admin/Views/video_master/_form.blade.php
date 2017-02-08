<div class="row">

    <div class="col-lg-offset-0 col-md-12">

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::label('type', 'Type: *') !!}
                        {!! Form::Select('type',array('url'=>'URL','local'=>'Local'),Input::old('type'),['id'=>'type', 'class'=>'form-control ','required'=> 'required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('type') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::text('title',Input::old('title'),['id'=>'title', 'class' => 'form-control', 'required'=> 'required', 'data-rule-minlength'=>"2"]) !!}
                        {!! Form::label('title','Title: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('first_name') !!}</span>                   
                </div>                
            </div>
            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::text('caption', Input::old('caption'), ['id'=>'caption', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('caption','Caption *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('caption') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {{ Form::file('caption_image', ['class' => 'field']) }}
                        {!! Form::label('caption_image',"Caption Image") !!} 
                    </div>
                    <span class="text-danger">{!! $errors->first('caption_image') !!}</span>
                </div>
            </div> 
            <div class="row"> 
                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('order', Input::old('order'), ['id'=>'order', 'class' => 'form-control', 'data-rule-minlength'=>"4",'required'=> 'required']) !!}
                        {!! Form::label('order','Order: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                </div>
                
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::label('page_type', 'Page Type:') !!}
                        {!! Form::Select('page_type',array('homepage'=>'Homepage','pages'=>'Pages'),Input::old('page_type'),['id'=>'page_type', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('page_type') !!}</span>
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
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {{ Form::file('video_file', ['class' => 'field']) }}
                        {!! Form::label('video_file',"Video File") !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('video_file') !!}</span>
                </div>
            </div> 
            <p>&nbsp;</p>
            <div class="form-margin-btn pull-right">
                {!! Form::submit(isset($edit_cons)?'Update':'Save', ['id'=>'btn-disabled','class' => 'btn btn-primary ','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                <a href="{{route('admin.index.video.master')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->