$(document).ready(function(){  
  
    //When mouse rolls over  
    $("li#main_nav").mouseover(function(){  
        $(this).stop().animate({height:'150px'},{queue:false, duration:600, easing: 'easeOutBounce'})  
    });  
  
    //When mouse is removed  
    $("li#main_nav").mouseout(function(){  
        $(this).stop().animate({height:'50px'},{queue:false, duration:600, easing: 'easeOutBounce'})  
    });  
  
});// JavaScript Document