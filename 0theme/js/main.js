$(document).ready(function(){
    $('#for-buy-btn').click(function(){
        $('.search-for-buy-row').removeClass('hide');
        $('.search-for-rent-row').addClass('hide');
        $('#property-search-buy-box').removeClass('hide');
        $('#property-search-rent-box').addClass('hide');
        $('#search-type').val("buy");
    });
    $('#for-rent-btn').click(function(){
        $('.search-for-buy-row').addClass('hide');
        $('.search-for-rent-row').removeClass('hide');
        $('#property-search-buy-box').addClass('hide');
        $('#property-search-rent-box').removeClass('hide');
        $('#search-type').val("rent");
    });

    $('#property-for-buy-btn').click(function(){
        $('.search-for-buy-row').removeClass('hide');
        $('.search-for-rent-row').addClass('hide');
        $('#property-search-buy-box').removeClass('hide');
        $('#property-search-rent-box').addClass('hide')
        $('#search-type').val("buy");
    });
    $('#property-for-rent-btn').click(function(){
        $('.search-for-buy-row').addClass('hide');
        $('.search-for-rent-row').removeClass('hide');
        $('#property-search-buy-box').addClass('hide');
        $('#property-search-rent-box').removeClass('hide');
        $('#search-type').val("rent");
    });

    $(".property-search-header").click(function(){
        $(this).find(".property-drop-down").toggleClass('rotate-180deg');
    });
    
    $(window).scroll(function(){
        var top = $(window).scrollTop();
        if(top >= 100){
            $('.second-nav').addClass('fixed-top');
            $('.second-nav').addClass('black-color');
        }else{
            if($('.second-nav').hasClass('fixed-top')){
                $('.second-nav').removeClass('fixed-top');
                $('.second-nav').removeClass('black-color');
            }
        }
    });

    // $(window).scroll(function(){
    //     var top = $(window).scrollTop();
    //     var offset = $('.page-nav').offset().top - $();
    //     if(top >= 400 && top <= offset){
    //         $('#property-search-box').addClass('fixed-70');
    //         $('#property-search-box').addClass('white-color');
    //     }else{
    //         if($('#property-search-box').hasClass('fixed-70')){
    //             $('#property-search-box').removeClass('fixed-70');
    //             $('#property-search-box').removeClass('white-color');
    //         }
    //     }
    // });
    
    $('#email-btn').click(function(){
        $('#real-estate-phone-detail').removeClass('hide');
        $('#real-estate-email-detail').addClass('hide');
    });

    $('#phone-btn').click(function(){
        $('#real-estate-email-detail').removeClass('hide');
        $('#real-estate-phone-detail').addClass('hide');
    });
    
    $("#agent-box").css({"display": "none"});
    $("#agent-checkbox").change(function() {
        if(this.checked) {
            $("#agent-box").css({"display": "block"});
            $("#agent-box select, #agent-address").prop("required", true);
        } else {
            $("#agent-box").css({"display": "none"});
            $("#agent-box select, #agent-address").prop("required", false);
        }
    });
    
});

function openOffcanvas() {
    document.getElementById("sidebar").style.display = "block";
    document.getElementById("sidebar").style.width = "250px";
}
function openNav() {
    document.getElementById("main-hover").style.display = "block";
    document.getElementById("main-hover").style.width = "100%";
    document.getElementById("main-hover").style.opacity = "0.8";  
}
function closeOffcanvas() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("sidebar").style.display = "none";
    document.getElementById("main-hover").style.width = "0";
    document.getElementById("main-hover").style.opacity = "0";
    document.getElementById("main-hover").style.display = "none";
}