(function ($){
    //parametrem funkcji jest obiekt wyrażenia regularnego (reg):
    $.fn.checkField = function (reg){
      if(!reg.test(this.val())){
          return (false);
      }
      else{
          return (true);
      }

    };

})(jQuery);

$(function(){
    $('#wyslij').click(function(){

        obiektEmail = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/;
        var minLen = 10;
        var maxLen = 255;
        var messageContentLen = document.querySelector('#message_content').value.length;

        ok = true;

        //sprawdz pozostale warunki

        if(!$('#email').checkField(obiektEmail)){
            $('#email_error').text('Podaj poprawny adres e-mail: użytkownik@serwer.domena');
            ok = false;
        }
        else{
            $('#email_error').text('');
        }

        if( messageContentLen < minLen ){
            $('#message_content_error').text('Podaj treść wiadomości dłuższą niż 10 znaków');
            ok = false;
        }
        else if(messageContentLen > maxLen){
            $('#message_content_error').text('Podaj treść wiadomości nie dłuższą niż 255 znaków');
            ok = false;
        }
        else{
            $('#message_content_error').text('');
        }

        if(ok){
            //wyślij formularz
            $("#form1").submit();
            //alert('Przyjęto zgłoszenie!');
            return true;
        }
        else{
            alert('Musisz uzupełnić wszystkie pola formularza!');
            return false;
        }

    });
});
