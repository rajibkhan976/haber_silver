<div class="row">

    <div class="col-lg-offset-0 col-md-12">

            <div class="row">

                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::label('menu_type', 'Menu Type:') !!}
                        {!! Form::Select('menu_type',array(''=>'--Select Type--', 'MODU'=>'MODU','MENU'=>'MENU','SUBM'=>'SUBM'),Input::old('menu_type'),['id'=>'menu_type', 'class'=>'form-control ','required']) !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('menu_type') !!}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::text('menu_name', Input::old('menu_name'), [ 'id'=>'menu_name', 'class' => 'form-control', 'required' => 'required'  ]) !!}
                        {!! Form::label('menu_name','Menu Name : *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('menu_name') !!}</span>

                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">

                    <div class="form-group">
                        {!! Form::text('route', Input::old('route'), ['id'=>'route', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('route','Route: *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('route') !!}</span>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::label('parent_menu_id', 'Parent:') !!}

                            @if(isset($menu_lists))
                                <select name="parent_menu_id" class="form-control" required>
                                    <option value=""> ---Select Parent--- </option>
                                    <?php
                                    $data_type = '';
                                    foreach ($menu_lists as $values) {
                                        if ($data_type != $values->menu_type ) {
                                            if ($data_type != '') {
                                                echo '</optgroup>';
                                            }
                                            echo '<optgroup label="'.$values->menu_type .'">';
                                        }
                                        echo '<option value="'.$values->id .'">'.$values->menu_name .'</option>';
                                        $data_type = $values->menu_type;
                                    }

                                    if ($data_type != '')
                                    {
                                        echo '</optgroup>';
                                    }
                                    ?>
                                </select>
                            @endif
                    </div>
                    <span class="text-danger">{!! $errors->first('parent_menu_id') !!}</span>
                </div>
                <div class="col-lg-offset-0 col-md-6 frm-right-field">
                    <div class="form-group">
                        {!! Form::text('icon_code', Input::old('icon_code'), ['id'=>'icon_code', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('icon_code','Icon Code *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('icon_code') !!}</span>
                </div>
            </div>

            <div class="row">                
                <div class="col-lg-offset-0 col-md-6 frm-left-field">
                    <div class="form-group">
                        {!! Form::number('menu_order', Input::old('menu_order'), ['id'=>'menu_order', 'class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('menu_order','Menu Order *') !!}
                    </div>
                    <span class="text-danger">{!! $errors->first('menu_order') !!}</span>
                </div>

                <div class="col-lg-offset-0 col-md-6 frm-right-field">
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
                <a href="{{route('admin.menu.panel')}}" class=" btn btn-default " data-placement="top" data-content="click close button for close this entry form">Close</a>
            </div>


    </div><!--end .col -->
</div><!--end .row -->

