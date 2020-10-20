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
        obiektTresc = /^.{10,}$/;

        ok = true;

        //sprawdz pozostale warunki

        if(!$('#email').checkField(obiektEmail)){
            $('#email_error').text('Podaj poprawny adres e-mail: użytkownik@serwer.domena');
            ok = false;
        }
        else{
            $('#email_error').text('');
        }

        if( !$('#message_content').checkField(obiektTresc) ){
            $('#message_content_error').text('Podaj treść wiadomości (conajmniej 10 znaków)');
            ok = false;
        }
        else{
            $('#message_content_error').text('');
        }

        if(ok){
            //wyślij formularz
            $("#form1").submit();
            alert('Przyjęto zgłoszenie!');
            // dodajZgloszenie();
            return true;
        }
        else{
            alert('Musisz uzupełnić wszystkie pola formularza!');
            return false;
        }

    });
});
