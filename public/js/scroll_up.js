jQuery(function($){
    
    //zresetuj scroll-a
    $.scrollTo(0);
    
    //jeśli nastąpiło kliknięcie na scrollup-a to wykonaj funkcję
    $('.scrollup').click(function(){
        $.scrollTo($('body'), 1000);    //scrollTo(miejsce docelowe przewinięcia, czas w ms);
        return false;                  
    });
    
    //pokaz podczas przewijania
    $(window).scroll(function(){
       if($(this).scrollTop() > 100){
           $('.scrollup').fadeIn();
       } 
       else{
           $('.scrollup').fadeOut();
       }
        
    });
    
});