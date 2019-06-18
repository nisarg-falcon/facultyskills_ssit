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
        $('.total').click(()=>{
            $("#ifrm").attr('src','faculty/total.php');
        });
        $('.today').click(()=>{
            $("#ifrm").attr('src','faculty/today.php');
        });
        $('.yesterday').click(()=>{
            $("#ifrm").attr('src','faculty/yesterday.php');
        });
        $('.average').click(()=>{
            $("#ifrm").attr('src','faculty/average.php');
        });
        $('.search').click(()=>{
            $("#ifrm").attr('src','faculty/search.php');
        });
        $('.profile').click(()=>{
            $("#ifrm").attr('src','faculty/profile.php');
        });
        $('.logout').click(()=>{
            window.location.href = 'php/logout.php';
        });
    }
    else{
        $('#ifrm').css('display','none');
        $('.fas').click(function(){
            $('.sidebar').css('width','100%');
             $('.sidebar').css('display','flex');
        });
        $('.total').click(()=>{
            $("#ifrm1").attr('src','faculty/chart/total_chart.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.today').click(()=>{
            $("#ifrm1").attr('src','faculty/chart/today_chart.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.yesterday').click(()=>{
            $("#ifrm1").attr('src','faculty/chart/yesterday_chart.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.average').click(()=>{
            $("#ifrm1").attr('src','faculty/chart/average_chart.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        // $('.average').click(()=>{
        //     $("#ifrm").attr('src','faculty/search.php');
        //     $('.sidebar').css('width','0%');
        //     $('.sidebar').css('display','none');
        // });
        $('.profile').click(()=>{
            $("#ifrm1").attr('src','faculty/profile.php');
            $('.sidebar').css('width','0%');
            $('.sidebar').css('display','none');
        });
        $('.logout').click(()=>{
            window.location.href = 'php/logout.php';
        });
        
    }
    
});