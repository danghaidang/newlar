@extends('coupon.main')

@section('main_container')
<div class="row">
    <form method="post" id="form" action="{{asset('/coupon/addAjax')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="url" type="text">
        <input id="get" type="submit" value="GET">
    </form>

</div>

<div class="row"><div class="col-9" id="data-coupon"></div></div>
<script type="text/javascript">/*
    $(document).ready(function(){
        $('#form').bind('submit', function(e){
            var fdata = new FormData($(this)[0]);

            $.ajax({
                url: '{{asset('/coupon/addAjax')}}',
                type: 'POST',
                data: fdata,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    $('#data-coupon').html(data);
                }
            });

            return false;
        });
      });

</script>
@endsection