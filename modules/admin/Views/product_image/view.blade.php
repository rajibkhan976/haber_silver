<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;">
        <table id="" class="table table-bordered table-hover table-striped">
            <tr>
                <th class="col-lg-4"> Product Image </th>
                <td> Thumb Image </td>
            </tr>

            @if(isset($data))
                @foreach($data as $values)
              
                    <tr>
                        <td> @if(isset($values->image))<img src="{{ asset($values->image)}}" height="80" width="80"> @endif</td>
                        <td> @if(isset($values->image))<img src="{{ asset($values->thumb)}}"> @endif</td>
                    </tr>

                @endforeach
            @endif    
           
        </table>
    </div>
</div>

<div class="modal-footer">
    <a href="{{route('admin.index.product.image')}}" class="btn btn-default" type="button" data-placement="top" data-content="click close button for close this"> Close </a>
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
