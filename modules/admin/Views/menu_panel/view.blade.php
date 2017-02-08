<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <tr>
                <th class="col-lg-4">Menu Type</th>
                <td>{{ isset($data->menu_type)?ucfirst($data->menu_type):''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Menu Name</th>
                <td>{{ isset($data->menu_name)?ucfirst($data->menu_name):''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Parent </th>
                <td>{{ isset($parent->menu_name)?$parent->menu_name:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Route </th>
                <td>{{ isset($data->route)?$data->route:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Icon Code </th>
                <td>{{ isset($data->icon_code)?$data->icon_code:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Menu Order </th>
                <td>{{ isset($data->menu_order)?$data->menu_order:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Status </th>
                <td>{{ isset($data->status)?$data->status:''}}</td>
            </tr>
        </table>
    </div>
</div>

<div class="modal-footer">
    <a href="{{route('admin.index.company')}}" class="btn btn-default" type="button" data-placement="top" data-content="click close button for close this entry form"> Close </a>
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
