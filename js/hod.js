$(document).ready(function(){
    var w = window.innerWidth;
    hide = true;
    $('body').on("click", function () {
        if (hide) $('.dropdown').removeClass('active');
        hide = true;
    });
    $('body').on('click', '.item', function () {
        var self = $(this);
        if (self.hasClass('active')) {
            $('.item').removeClass('active');
            return false;
        }
        $('.item').removeClass('active');
            self.toggleClass('active');
        hide = false;
    });
    if( w > 1000){
        $('.fas').click(function(){
            $('.main_container').toggleClass('ham');
        });
        $('.skills').click(()=>{
            $("#ifrm").attr('src','hod/hod_skill.php');
        });
        $('.logout').click(()=>{
            window.location.href = 'php/logout.php';
        });
        $('.score').click(()=>{
            $("#ifrm").attr('src','hod/hod_score.php');
        });
        $('.profile').click(()=>{
            $("#ifrm").attr('src','profile.php');
        });
    }
    else{
        $('.fas').click(function(){
            $('.sidebar').css('width','100%');
             $('.sidebar').css('display','flex');
        });
        $('.skills').click(()=>{
            $("#ifrm").attr('src','hod/hod_skill.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.profile').click(()=>{
            $("#ifrm").attr('src','profile.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.score').click(()=>{
            $("#ifrm").attr('src','chart.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.logout').click(()=>{
            window.location.href = 'php/logout.php';
        });
        
    }
    
});