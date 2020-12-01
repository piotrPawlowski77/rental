function DatesRangeFromTo(rentalDayIn, rentalDayOut)
{
    //deklaracja tablicy pomocniczej
    var tmpTab = [];
    //datepicker wymaga dat w postaci obiektu wiec
    var dayIn = new Date(rentalDayIn);
    var dayOut = new Date(rentalDayOut);

    //doklejanie dat do tablicy tmpTab
    //trzeba uzyc metod datepicker-a
    while(dayIn <= dayOut)
    {
        tmpTab.push( $.datepicker.formatDate('yy-mm-dd', new Date(dayIn)) );
        //zwiekszenie daty poczatkowej o 1 (na obiekce Date wykonuje metode setDate)
        dayIn.setDate(dayIn.getDate()+1);
    }

    //mam tablice z datami
    return tmpTab;
}


var AjaxObj = {

    get: function (url, success, data = null, beforeSend = null) {

        $.ajax({

            cache: false,
            url: b_url + '/' + url,
            type: "GET",
            data: data,
            success: function (response) {

                Application[success](response);

            },
            beforeSend: function () {

                if(beforeSend)
                    Application[beforeSend]();

            }

        });

    },

    set: function (data = {}, url, success = null) {

        $.ajax({

            cache: false,
            url: b_url + '/' + url,
            type: "GET",
            dataType: "json",
            data: data,
            success: function (response) {

                if(success)
                    Application[success](response);
            }

        });

    }

}

var Application = {

    GetReservationDataFromDB: function(id, calendar_id ,date){

        Application.calendar_id = calendar_id;

        AjaxObj.get('getReservationDataFromDbByAjax', 'AfterGetReservationDataFromDB', {car_id: id, date: date}, 'BeforeGetReservationDataFromDB');

    },

    BeforeGetReservationDataFromDB: function(){

        $('.reservationData' + Application.calendar_id).show();

    },

    AfterGetReservationDataFromDB: function (response) {

        //tu wczytywanie danych rezerwacji do komorek w tabeli
        /*spacja musi byc przed .reservation...*/

        $('.reservationData' + Application.calendar_id + " .reservationData_car_id").html(response.car_id);
        $('.reservationData' + Application.calendar_id + " .reservationData_car_name").html(response.car_name);
        $('.reservationData' + Application.calendar_id + " .reservationData_day_in").html(response.rental_day_in);
        $('.reservationData' + Application.calendar_id + " .reservationData_day_out").html(response.rental_day_out);
        $('.reservationData' + Application.calendar_id + " .reservationData_person").html(response.FullName);

        /* spr czy rezerwacja potwierdzona */
        if(response.status)
        {
            $('.reservationData' + Application.calendar_id + " .reservationData_confirm_reservation").removeAttr('href'); /*usuniecie atrybutu href*/
            $('.reservationData' + Application.calendar_id + " .reservationData_confirm_reservation").attr('disabled', 'disabled');/*'atrybut', 'wartosc' wylaczenie aktywnosci linka*/
            $('.reservationData' + Application.calendar_id + " .reservationData_confirm_reservation").html('Potwierdzono rezerwację');
            $('.reservationData' + Application.calendar_id + " .reservationData_confirm_reservation").attr('class', ' btn btn-success ');

            $('.reservationData' + Application.calendar_id + " .reservatioData_delete_reservation").removeAttr('href'); /*usuniecie atrybutu href*/
            $('.reservationData' + Application.calendar_id + " .reservatioData_delete_reservation").attr('disabled', 'disabled');/*'atrybut', 'wartosc' wylaczenie aktywnosci linka*/

        }
        else
        {
            $('.reservationData' + Application.calendar_id + " .reservationData_confirm_reservation").attr('href', response.confirmResLink);

            $('.reservationData' + Application.calendar_id + " .reservationData_confirm_reservation").removeAttr('disabled');

            $('.reservationData' + Application.calendar_id + " .reservatioData_delete_reservation").attr('href', response.deleteResLink);
        }

    },

    NotificationIsRead: function (notifId) {

        AjaxObj.set({id:notifId}, 'setReadNotificationByAjax')

    }

};

$(document).on('click', '.unread_notification', function (event) {
    event.preventDefault();

    $(this).removeClass('unread_notification');

    var notifCount = parseInt( $('#notifCount').html() );

    if( notifCount > 0 )
    {
        $('#notifCount').html(notifCount - 1);

        if(notifCount == 1)
        {
            $('#notifCount').hide();
        }
    }

    var notifId = $(this).children().attr('href');

    $(this).children().removeAttr('href');

    Application.NotificationIsRead(notifId);

});


