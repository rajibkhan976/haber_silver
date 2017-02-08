<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
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
                <th class="col-lg-4"> Category Name </th>
                <td>{{ isset($data->productCategory['title'])? $data->productCategory['title']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Sub Category Name</th>
                <td>{{ isset($data->productSubCategory['title'])?$data->productSubCategory['title']:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Product Code</th>
                <td>{{ isset($data->product_code)?$data->product_code:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Sell Price</th>
                <td>{{ isset($data->sell_price)?$data->sell_price:''}}</td>
            </tr>            
            <tr>
                <th class="col-lg-4">Cost Price </th>
                <td> {{ isset($data->cost_price)?$data->cost_price:''}}</td>
            </tr>
            <tr>
                 <th class="col-lg-4">Quantity </th>
                <td> {{ isset($data->quantity)?$data->quantity:''}}</td>
            </tr>            
            <tr>
                <th class="col-lg-4">Unit of Measurement</th>
                <td>{{ isset($data->unit_of_measurement)?$data->unit_of_measurement:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Product Type</th>
                <td>{{ isset($data->product_type)?$data->product_type:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Stock Type</th>
                <td>{{ isset($data->stock_type)?$data->stock_type:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Slug</th>
                <td>{{ isset($data->slug)?$data->slug:''}}</td>
            </tr>
            <tr>
                <th class="col-lg-4">Status</th>
                <td>{{ isset($data->status)?$data->status:''}}</td>
            </tr>
            
        </table>
    </div>
</div>

<div class="modal-footer">
    <a href="{{route('admin.index.product')}}" class="btn btn-default" type="button" data-placement="top" data-content="click close button for close this"> Close </a>
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
