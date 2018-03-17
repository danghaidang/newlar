(function () {
    $(".l-b-lis").eq(0).show();
    var num = 0;
    var nav = function (num) {
        $(".logo-img").removeClass("logo-active").eq(num).addClass("logo-active");
    };
    /!*---btn right---*!/
    $(".btn-right").click(function () {
        num++;
        if(num > 5){
            num = 0
        }
        $(".l-b-lis").eq(num-1).fadeOut();
        $(".l-b-lis").eq(num).fadeIn(500);
        nav(num);
    });
    /!*---btn left---*!/
    $(".btn-left").click(function () {
        num--;
        $(".l-b-lis").eq(num+1).fadeOut();
        if(num <= -1){
            num = 5;
        }
        $(".l-b-lis").eq(num).fadeIn(500);
        nav(num);
    });

    $(".logo-img").click(function(){
        var $index = $(this).index();
        nav($index);
        num = $index;
        $(".l-b-lis").fadeOut();
        $(".l-b-lis").eq($index).fadeIn(500);

    });
    var addTimer = null;
    function timer () {
        addTimer = setInterval(function(){
            num++;
            if(num >5){
                num = 0;
            }
            $(".l-b-lis").eq(num-1).fadeOut();
            $(".l-b-lis").eq(num).fadeIn(500);
            nav(num);
        },10000);
    }
    timer();

    $(".l-b-t").hover(function() {
        clearInterval(addTimer);
        flag = false;
    }, function() {
        flag = true;
      timer();
    });
})();



