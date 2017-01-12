<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <tr>
                <th class="col-lg-4">Company Name</th>
                <td>{{ isset($data->name)?ucfirst($data->name):''}}</td>
            </tr>
           <tr>
                
                <td colspan="2">@if(isset($data->letter_head_image)) <img src="{{ $data->letter_head_image }}"/> @endif</td>
            </tr>        
            <tr>
                <th class="col-lg-4">Approved Produtc</th>
                <td>{{ isset($data->approved_produtc)? $data->approved_produtc:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Description</th>
                <td>{{ isset($data->description)?$data->description:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">PriceLevel1</th>
                <td>{{ isset($data->price_level_one)?$data->price_level_one:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">PriceLevel2</th>
                <td>{{ isset($data->price_level_two)?$data->price_level_one:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">Discount A (%)</th>
                <td>{{ isset($data->discount_a)?$data->discount_a:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">Discount B (%)</th>
                <td>{{ isset($data->discount_b)?$data->discount_b:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">Discount C (%)</th>
                <td>{{ isset($data->discount_c)?$data->discount_c:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">MarkupLevel1</th>
                <td>{{ isset($data->mark_up_level_one)?$data->mark_up_level_one:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">MarkupLevel2</th>
                <td>{{ isset($data->mark_up_level_two)?$data->mark_up_level_two:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">Markup A (%)</th>
                <td>{{ isset($data->mark_up_a)?$data->mark_up_a:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">Markup B (%)</th>
                <td>{{ isset($data->mark_up_b)?$data->mark_up_b:''}}</td>
            </tr>

            <tr>
                <th class="col-lg-4">Markup C (%)</th>
                <td>{{ isset($data->mark_up_c)?$data->mark_up_c:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4"> Distributor's letterhead text #1</th>
                <td>{{ isset($data->letter_head_text)?$data->letter_head_text:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Distributor's letterhead footer</th>
                <td>{{ isset($data->letter_head_footer)?$data->letter_head_footer:''}}</td>
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
