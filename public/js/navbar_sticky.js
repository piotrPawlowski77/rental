$(document).ready(function(){ //kiedy dokument jest gotowy, wykonaj instr. w klamrach
    //odczyt top .navbar
    var NavY = $('.navbar').offset().top;
    
    //funkcja stickyNav
    var stickyNav = function(){
        //odczyt top aktualnej wartości stopnia przewinięcia strony (scrolla)
        var ScrollY = $(window).scrollTop();
        
        if(ScrollY >= NavY){    //porównanie wartosci top scrolla i .navbar
            $('.navbar').addClass('sticky');
        }
        else{
            $('.navbar').removeClass('sticky');
        }
    };
    
    //1-sze wywołanie funkcji (kiedy zajdzie document.ready)
    stickyNav();
    
    // wywołanie funkcji (kiedy zajdzie scroll okna)
    $(window).scroll(function(){
        stickyNav();
    });
    
});