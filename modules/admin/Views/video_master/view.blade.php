<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <tr>
                <th class="col-lg-4"> Title </th>
                <td>{{ isset($data->title)?ucfirst($data->title):''}} </td>
            </tr>
            <tr>
                <th class="col-lg-4"> Type </th>
                <td>{{ isset($data->type)? $data->type:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Caption</th>
                <td>{{ isset($data->caption)?$data->caption:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Order</th>
                <td>{{ isset($data->order)?$data->order:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Page Type</th>
                <td>{{ isset($data->page_type)?$data->page_type:''}}</td>
            </tr>            
            <tr>
                <th class="col-lg-4">Image </th>
                <td> @if(isset($data->caption_image))<img src="{{ asset($data->caption_image)}}" height="50" width="60"> @endif</td>
            </tr>
            <tr>
                <th class="col-lg-4">Thumb</th>
                <td>@if(isset($data->caption_thumb))<img src="{{ asset($data->caption_thumb)}}" height="50" width="60"> @endif</td>
            </tr>            
            <tr>
                <th class="col-lg-4">Status</th>
                <td>{{ isset($data->status)?$data->status:''}}</td>
            </tr>
           
        </table>
    </div>
</div>

<div class="modal-footer">
    <a href="{{route('admin.index.video.master')}}" class="btn btn-default" type="button" data-placement="top" data-content="click close button for close this"> Close </a>
</div>


<script>
    $(".btn").popover({ trigger: "manual" , html: true, animation:false})
            .on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 300);
    });
</script>
