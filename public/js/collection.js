(function(){
    var is_google=window.location.search.indexOf("is_google=1")>-1;
    if(is_google) return;
    var pro_content=$(".p-content"),h_l=$("*[data-type='loaded-hide']");
    if(pro_content.length||is_google) pro_content.addClass("active");
    if(h_l.length||is_google) h_l.remove();
    $(".top-product").addClass("top-layout");
})();
