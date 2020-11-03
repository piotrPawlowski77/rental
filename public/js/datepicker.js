$.datepicker.regional.pl = {
    closeText: "Zamknij",
    prevText: "&#x3C;Poprzedni",
    nextText: "Następny&#x3E;",
    currentText: "Dziś",
    monthNames: [ "Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec",
        "Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień" ],
    monthNamesShort: [ "Sty","Lu","Mar","Kw","Maj","Cze",
        "Lip","Sie","Wrz","Pa","Lis","Gru" ],
    dayNames: [ "Niedziela","Poniedziałek","Wtorek","Środa","Czwartek","Piątek","Sobota" ],
    dayNamesShort: [ "Nie","Pn","Wt","Śr","Czw","Pt","So" ],
    dayNamesMin: [ "N","Pn","Wt","Śr","Cz","Pt","So" ],
    weekHeader: "Tydz",
    dateFormat: "yy-mm-dd",
    minDate: 0,
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ""
};

$.datepicker.setDefaults( $.datepicker.regional.pl );

$(function () {
    $(".autocomplete").autocomplete({
        source: b_url + "/searchCities",
        minLength: 2,
    });
});

$(function() {
    $( ".datepicker" ).datepicker({

    });
});
