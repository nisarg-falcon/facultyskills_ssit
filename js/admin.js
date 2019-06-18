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
            $("#ifrm").attr('src','skill.php');
        });
        $('.grade').click(()=>{
            $("#ifrm").attr('src','inbox.php');
        });
        $('.logout').click(()=>{
            window.location.href = 'php/logout.php';
        });
        $('.score').click(()=>{
            $("#ifrm").attr('src','admin_score.php');
        });
        $('.designation').click(()=>{
            $("#ifrm").attr('src','insert.php');
        });
        $('.employee').click(()=>{
            $("#ifrm").attr('src','employee.php');
        });
        $('.manage_skill').click(() => {
            $("#ifrm").attr('src', 'manage_skill.php');
        });
    }
    else{
        $('.fas').click(function(){
            $('.sidebar').css('width','100%');
             $('.sidebar').css('display','flex');
        });
        $('.skills').click(()=>{
            $("#ifrm").attr('src','skill.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.grade').click(()=>{
            $("#ifrm").attr('src','inbox.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.score').click(()=>{
            $("#ifrm").attr('src','admin_score.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.logout').click(()=>{
            window.location.href = 'php/logout.php';
        });
        $('.designation').click(()=>{
            $("#ifrm").attr('src','insert.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.employee').click(()=>{
            $("#ifrm").attr('src','employee.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.manage_skill').click(() => {
            $("#ifrm").attr('src', 'manage_skill.php');
            $('.sidebar').css('width', '0%');
            $('.sidebar').css('display', 'none');
        });
    }
    

    

});