<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;margin-left: 80px">
        <table id="" class="table table-bordered table-hover table-striped">           
            <tr>
                <td> 
                    <?php
                      if(isset($data->video_file)) {
                        $file_name = explode( '.',$data->video_file);                            
                    ?> 
                        <video width="600" controls>
                           <source src="{{asset($data->video_file)}}" type="video/{{end($file_name)}}">
                        </video>

                    <?php } ?>
                </td>
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
