<!-- START Header scripts -->
    @include('user::scripts._header')
<!-- END Header scripts -->

<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>


<div class="modal-body">
    @section('content_update')
        {!! Form::model($data, ['method' => 'PATCH', 'files'=> true, 'route'=> ['admin.update.catalog', $data->id]]) !!}
        @include('admin::catalog._form')
        {!! Form::close() !!}
</div>

<!-- START Footer scripts -->
    @include('user::scripts._footer')
<!-- END Header scripts -->