<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>

<div class="modal-body">
    <div style="padding: 30px;margin-left: 80px">
        <table id="" class="table table-bordered table-hover table-striped">           
            <tr>
                <td align="center"> 
                    
                    @if($data->video_file != 'not_found') 
                        @php 
                          $file_name = explode( '.',$data->video_file); 
                        @endphp
                     
                        <video width="550" height="360" controls poster="{{asset($data->caption_image)}}">
                           <source src="{{asset($data->video_file)}}" type="video/{{end($file_name)}}">
                        </video>
                    @else
                        <video width="550" height="360" poster="{{asset($video_not_found)}}">
                        </video>                         
                    @endif  
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
