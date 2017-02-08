<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <tr>
                <th class="col-lg-4">Title</th>
                <td>{{ isset($data->title)?ucfirst($data->title):''}}</td>
            </tr>
            <tr>

                <td colspan="2">
                    @if(isset($data->image) && !empty($data->image))
                        <img class="img-responsive" src="{{ $data->image }}"/>
                    @else
                        <img class="img-responsive" src="/{{ $no_image }}">
                    @endif
                </td>
            </tr>
            <tr>
                <th class="col-lg-4">Slug</th>
                <td>{{ isset($data->slug)? $data->slug:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Short Description</th>
                <td>{{ isset($data->short_description)? $data->short_description:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Long Description</th>
                <td>{{ isset($data->long_description)? $data->long_description:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">Status</th>
                <td>{{ isset($data->status)? $data->status:''}}</td>
            </tr>


        </table>
    </div>
</div>

<div class="modal-footer">
    <a href="{{route('admin.reconditioning')}}" class="btn btn-default" type="button" data-placement="top"
       data-content="click close button for close this entry form"> Close </a>
</div>


<script>
    $(".btn").popover({trigger: "manual", html: true, animation: false})
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
