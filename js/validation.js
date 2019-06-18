$(document).ready(function(){

    var chk1,chk2,chk3,chk4,chk5,chk6;
    
    /* Selecting Fields */ 
    $(".name").focusout(function(){
        var slt = $(this);
        var data = $(this).val();
        var len = $(this).val().length;
        chk6 = Name_check(data,len,slt);
        
    });

    $(".user").focusout(function(){
        var slt = $(this);
        var data = $(this).val();
        var len = $(this).val().length;
        chk1 = Usr_check(data,len,slt);
        
    });
    $(".pass").focusout(function(){
        var data = $(this).val();
        var len = $(this).val().length;
        var slt = $(this);
        chk2 = Pass_check(data,len,slt);
    });
    $(".conpass").focusout(function(){
        var data = $(this).val();
        var pass = $(".pass").val();
        var slt = $(this);
        chk3= Pass_verify(data,pass,slt);

    });
    $(".select").focusout(function () {
        var data = $(this).val();
        Branch_check(data);

      });
    $(".log_usname").focusout(function(){
        var data = $(this).val();
        var len = $(this).val().length;
        var slt = $(this);
        chk4 = log_check(data,len,slt);
        console.log(chk4);
    });
    $(".log_pass").focusout(function(){
        var data = $(this).val();
        var len = $(this).val().length;
        var slt = $(this);
        chk5 = pass_check(data,len,slt);
        console.log(chk5);
    });

    /* Functions For Validation  */ 
    function Name_check(data,len,slt) {
        
        if(len < 5 || len > 100){
            
            $(".name_error").html(" 5 to 100 characters are allowed");
            $(slt).css("border-color","red");
            return 0;
        }
        else{
            $(".name_error").empty();
            $(slt).css("border-color","#39FF14");
            console.log(len);
            return 1;
        } 
    }
    function Usr_check(data,len,slt) {

        $.post("http://127.0.0.1/Code/php/chk_user.php", {
                name : data
            },
            function (res) {
              if(res == 0){ 
                $(".username_error").empty();
                $(slt).css("border-color","#39FF14");
                return 1;
              }   
              else{
                $(".username_error").html(" Username already exist");
                $(slt).css("border-color","red");
                return 0;
              }
            }
        );
        
        if(len < 5 || len > 12){
            
            $(".username_error").html(" 5 to 12 characters are allowed");
            $(slt).css("border-color","red");
            return 0;
        }
        else{
            $(".username_error").empty();
            $(slt).css("border-color","#39FF14");
            return 1;
        } 
    }
    function Pass_check(data,len,slt){
        var upperCaseLetters = /[A-Z]/g;
        var numbers = /[0-9]/g;
        var lowerCaseLetters = /[a-z]/g;

        if(len < 8 || len > 12){
            $(".password_error").html(" 8 to 12 characters are allowed");
            $(slt).css("border-color","red");
            return 0;
        }
        else if(data.match(upperCaseLetters) == null){
            $(".password_error").html("UpperCase letter required");
            $(slt).css("border-color","red");
            return 0;
        }
        else if(data.match(lowerCaseLetters == null)){
            $(".password_error").html("LowerCase letter required");
            $(slt).css("border-color","red");
            return 0;
        }
        else if(data.match(numbers) == null){
            $(".password_error").html("Number required");
            $(slt).css("border-color","red");
            return 0;
        }
        else{
            $(".password_error").empty();
            $(slt).css("border-color","#39FF14");
            return 1;
        }
    }
    function Pass_verify(data,pass,slt){
        if(data == pass){
            $(".confpass_error").empty();
            $(slt).css("border-color","#39FF14");
            return 1;
        }
        else{
            $(".confpass_error").html("Password don't match");
            $(slt).css("border-color","red");
            return 0;
        }
    } 
    function Branch_check(data) {
        if(data == null){
            $(".branch_error").html("Please Select Option");
        }
        else{
            $(".branch_error").empty();

      }
    }
    function log_check(data,len,slt) {
        
        if(len < 5 || len > 12){
            
            $(".log_username_error").html(" 5 to 12 characters are allowed");
            $(slt).css("border-color","red");
            return 0;
        }
        else{
            $(".log_username_error").empty();
            $(slt).css("border-color","#39FF14");
            return 1;
        } 
    }
    function pass_check(data,len,slt) {
        
        if(len < 5 || len > 12){
            
            $(".log_pass_error").html(" 5 to 12 characters are allowed");
            $(slt).css("border-color","red");
            return 0;
        }
        else{
            $(".log_pass_error").empty();
            $(slt).css("border-color","#39FF14");
            return 1;
        } 
    }




    $("form[name='form1']").submit(function(){
       if(chk1 == 0 || chk2 == 0 || chk3 == 0 || chk6 == 0){
           return false;
       }
       else if(chk1 == null || chk2 == null || chk3 == null){
            return false;

       } 
       else{
           return true;
       }
    });

    $("form[name='form2']").submit(function(){


        if(chk4 == 0 || chk5 == 0){
            
            return false;
        }
        else if(chk4 == null || chk5 == null){
            return false;
        }
        else{
            return true;
        }
       
      
       
    });
    
    

});