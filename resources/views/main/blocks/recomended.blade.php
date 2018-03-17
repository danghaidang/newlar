<!-- 2 img -->
<div class="t-s-i{{ count($items['img-wrap'])>0?' top':'' }}">
    <a target="_blank" rel="nofollow" href="{{ $items['mylinkStore'] }}">
        <div class="wrap">
            @foreach($items['img-wrap'] as $src)
                <div class="img{{ $src[1]?' pst':'' }}">
                    <div class="img-wrap">
                        <img src="{{ strpos($src[0], 'http')!==false?'':'https://www.couponsatcheckout.net' }}{{ $src[0] }}">
                    </div>
                </div>
            @endforeach
        </div>
    </a>
</div>