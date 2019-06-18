$(document).ready(function(){
    var w = window.innerWidth;
    if(w > 1280){
        $(".slider").click(function(){
            $(this).toggleClass("animate");
            var x = $(this).position();
            if(x.left < 600){
                $(".para2").html("Oops! Don't Have an Account");
                $(".para3").html("Let's First Register Then.");
                $(".para4").html("Click Here To Register"); 
             }
             else if(x.left > 600){
                $(".para2").html("Already Have Account ??");
                $(".para3").html("Let's Get Started Then.");
                $(".para4").html("Click Here To Login");
             }
        });
    }
    else if(w <= 1280){
        $(".slider").click(function(){
            $(this).toggleClass("animate");
            var x = $(this).position();
            if(x.left < 500){
                $(".para1").html("Register");
             }
             else if(x.left > 500){
                 $(".para1").html("Login");
             }
        });
    }
    else{
        console.log(nothing);
    }
    $(".btnlogin").click(function(){
        $(".second-container").fadeOut(1000);
        $(".first-container").fadeIn(1000);
    });
    $(".btnregister").click(function(){
        $(".second-container").fadeIn(1000);
        $(".first-container").fadeOut(1000);
    });

    
});