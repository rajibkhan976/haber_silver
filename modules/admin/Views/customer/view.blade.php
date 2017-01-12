<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <tr>
                <th class="col-lg-4"> Customer Name</th>
                <td>{{ isset($data->first_name)?ucfirst($data->first_name):''}} {{ isset($data->last_name)?ucfirst($data->last_name):''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Company Name</th>
                <td>{{ isset($data->name)? $data->name:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Address1</th>
                <td>{{ isset($data->address_one)?$data->address_one:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Address2</th>
                <td>{{ isset($data->address_two)?$data->address_two:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Address3</th>
                <td>{{ isset($data->address_three)?$data->address_three:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">City</th>
                <td>{{ isset($data->city)?$data->city:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">State </th>
                <td>{{ isset($data->state)?$data->state:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Zip</th>
                <td>{{ isset($data->zip)?$data->zip:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Country</th>
                <td>{{ isset($data->country)?$data->country:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Phone Number</th>
                <td>{{ isset($data->phone_number)?$data->phone_number:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Fax Number</th>
                <td>{{ isset($data->fax_number)?$data->fax_number:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Email1</th>
                <td>{{ isset($data->email_one)?$data->email_one:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Email2</th>
                <td>{{ isset($data->email_two)?$data->email_two:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Email3</th>
                <td>{{ isset($data->email_three)?$data->email_three:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Email4</th>
                <td>{{ isset($data->email_four)?$data->email_four:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Notes</th>
                <td>{{ isset($data->notes)?$data->notes:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Status</th>
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
