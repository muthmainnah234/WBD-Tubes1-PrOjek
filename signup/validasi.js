
    function validasiForm() {
      if (!validate()) {
          return false;
      }
    }

    function validate() {
      if(document.getElementById("validname").value != 1){

          alert("username sudah ada");
        } else
          if(document.getElementById("validemail").value != 1){
                alert("email sudah ada atau belum sesuai format");
              } else      
        if (document.forms["signup"]["passwd2"].value != document.forms["signup"]["passwd1"].value){
          alert("password dan confirmed sspassword berbeda");
          return (false);
        } else {
          if (document.forms["signup"]["passwd1"].value == '' || document.forms["signup"]["passwd2"].value == '' || document.forms["signup"]["name"].value == '' || document.forms["signup"]["username"].value == '' || document.forms["signup"]["email"].value == '' || document.forms["signup"]["phoneNumber"].value == ''){
            alert("tidak ada field yang boleh kosong");
            return(false);
          } else{
            if ((document.forms["signup"]["name"].value).length > 20){
              alert("panjang nama tidak boleh lebih dari 20");
              return(false);
            }else{
              if ((document.forms["signup"]["phoneNumber"].value).length < 9 || (document.forms["signup"]["phoneNumber"].value).length > 12){
                alert("nomor telpon maksimal 12, minimal 9");
                return(false);
              } else {
                 var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                 if (re.test(document.forms["signup"]["email"].value)){
                    return(true);
                 } else {
                    alert("email tidak sesuai format");
                    return(false);
                 }
              }
            }
          }
        }
      }
    


      function usernameValidation(str){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         if (this.responseText == 1 ){
          document.getElementById("validname").value = 0;
          document.getElementById("checkmark1").style.height='20px';
          document.getElementById("checkmark1").style.width='20px';
          document.getElementById("checkmark1").src = "crossmark.png";
         } else {
          document.getElementById("validname").value = 1;
          document.getElementById("checkmark1").style.height='30px';
          document.getElementById("checkmark1").style.width='30px';
          document.getElementById("checkmark1").src = "checkmark.png";
         }
        }
      };
      url = "validateUsername.php?username=" + str;
      xhttp.open("GET", url, true);
      xhttp.send();
    };

    function emailValidation(str){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (this.readyState == 4 && this.status == 200) {
         if (this.responseText == 1 || !re.test(document.forms["signup"]["email"].value)){
          document.getElementById("validemail").value = 0;
          document.getElementById("checkmark2").style.width='20px';
          document.getElementById("checkmark2").style.height='20px'; 
          document.getElementById("checkmark2").src = "crossmark.png";
         } else {
          document.getElementById("validemail").value = 1;
          document.getElementById("checkmark2").style.width='30px';
          document.getElementById("checkmark2").style.height='30px'; 
          document.getElementById("checkmark2").src = "checkmark.png";
         }
        }
      };
      url = "validateEmail.php?email=" + str;
      xhttp.open("GET", url, true);
      xhttp.send();
    };
