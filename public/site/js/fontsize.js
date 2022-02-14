var COOKIE_NAME="aaaaaaaa";
var COOKIE_H1 = "H1";
var COOKIE_H2 = "H2";
var COOKIE_H3 = "H3";
var COOKIE_P = "P";
var COOKIE_li = "li";
var DEFAULT_FONT_SIZE = 18;
var MAXIMUM_FONT_SIZE = 22;
var MINIMUM_FONT_SIZE = 16;
var DEFAULT_H1=18;
var DEFAULT_H2=16;
var DEFAULT_H3=15;
var DEFAULT_P=13;
var DEFAULT_li=13;
$(document).ready(function(){

  $("#small").click(function(event){
    var valcookie= read_cookie(COOKIE_H1);
 
    if(valcookie==0)
    {
    create_cookie ( COOKIE_NAME, DEFAULT_FONT_SIZE, 1 );
    create_cookie ( COOKIE_H1, DEFAULT_H1, 1 );
    create_cookie ( COOKIE_H2, DEFAULT_H2, 1 );
    create_cookie ( COOKIE_H3, DEFAULT_H3, 1 );
    create_cookie ( COOKIE_P, DEFAULT_P, 1 );
    create_cookie ( COOKIE_li, DEFAULT_li, 1 );
     var h1=read_cookie(COOKIE_H1);
     var h2=read_cookie(COOKIE_H2);
     var h3=read_cookie(COOKIE_H3);
     var p=read_cookie(COOKIE_P);
     var li=read_cookie(COOKIE_li);

  
    }
    else
    {
      if(MINIMUM_FONT_SIZE<=valcookie)
      {
        
    var newcookie=parseInt(valcookie)-parseInt(2);
    var h1=read_cookie(COOKIE_H1)-parseInt(2);
    var h2=read_cookie(COOKIE_H2)-parseInt(2);
    var h3=read_cookie(COOKIE_H3)-parseInt(2);
    var p=read_cookie(COOKIE_P)-parseInt(2);
    var li=read_cookie(COOKIE_li)-parseInt(2);
    
    create_cookie ( COOKIE_H1, h1, 1 );
    create_cookie ( COOKIE_H2, h2, 1 );
    create_cookie ( COOKIE_H3, h3, 1 );
    create_cookie ( COOKIE_P, p, 1 );
    create_cookie ( COOKIE_li, li, 1 );
     

 
      }
      //create_cookie ( COOKIE_NAME, 0, 1 );
    }
    var newcookie1=read_cookie(COOKIE_NAME);
    event.preventDefault();
   

    $(".variable_font h1").css({"fontSize":h1+"px"});
    $(".variable_font h2").css({"fontSize":h2+"px"});
    $(".variable_font h3").css({"fontSize":h3+"px"});
    $(".variable_font p").css({"fontSize":p+"px"});
    $(".variable_font li").css({"fontSize":li+"px"});

    $(".content-text h1").css({"fontSize":h1+"px"});
    $(".content-text h2").css({"fontSize":h2+"px"});
    $(".content-text h3").css({"fontSize":h3+"px"});
    $(".content-text p").css({"fontSize":p+"px"});
    $(".content-text li").css({"fontSize":li+"px"});
    
  });
  
  $("#medium").click(function(event){

    create_cookie ( COOKIE_H1, DEFAULT_H1, 1 );
    create_cookie ( COOKIE_H2, DEFAULT_H2, 1 );
    create_cookie ( COOKIE_H3, DEFAULT_H3, 1 );
    create_cookie ( COOKIE_P, DEFAULT_P, 1 );
    create_cookie ( COOKIE_li, DEFAULT_li, 1 );
     var h1=read_cookie(COOKIE_H1);
     var h2=read_cookie(COOKIE_H2);
     var h3=read_cookie(COOKIE_H3);
     var p=read_cookie(COOKIE_P);
     var li=read_cookie(COOKIE_li);

 
    event.preventDefault();
    $(".variable_font h1").css({"fontSize":DEFAULT_H1+"px"});
    $(".variable_font h2").css({"fontSize":DEFAULT_H2+"px"});
    $(".variable_font h3").css({"fontSize":DEFAULT_H3+"px"});
    $(".variable_font p").css({"fontSize":DEFAULT_P+"px"});
    $(".variable_font li").css({"fontSize":DEFAULT_li+"px"});

    $(".content-text h1").css({"fontSize":DEFAULT_H1+"px"});
    $(".content-text h2").css({"fontSize":DEFAULT_H2+"px"});
    $(".content-text h3").css({"fontSize":DEFAULT_H3+"px"});
    $(".content-text p").css({"fontSize":DEFAULT_P+"px"});
    $(".content-text li").css({"fontSize":DEFAULT_li+"px"});
    
    
  });
  
  $("#large").click(function(event){
    
   
   //alert(DEFAULT_FONT_SIZE);
  var valcookie= read_cookie(COOKIE_H1);

    if(valcookie==0)
    {
    create_cookie ( COOKIE_NAME, DEFAULT_FONT_SIZE, 1 );
    create_cookie ( COOKIE_H1, DEFAULT_H1, 1 );
    create_cookie ( COOKIE_H2, DEFAULT_H2, 1 );
    create_cookie ( COOKIE_H3, DEFAULT_H3, 1 );
    create_cookie ( COOKIE_P, DEFAULT_P, 1 );
    create_cookie ( COOKIE_li, DEFAULT_li, 1 );
     var h1=read_cookie(COOKIE_H1);
     var h2=read_cookie(COOKIE_H2);
     var h3=read_cookie(COOKIE_H3);
     var p=read_cookie(COOKIE_P);
     var li=read_cookie(COOKIE_li);
    }
    else
    {
      // alert("valcookie hhhhhhhhhhhh"+valcookie+"maximum"+MAXIMUM_FONT_SIZE);
      if(valcookie<=MAXIMUM_FONT_SIZE)
      {
       
        var newcookie=parseInt(valcookie)+parseInt(2);
        create_cookie ( COOKIE_NAME, newcookie, 1 );

        var newcookie=parseInt(valcookie)-parseInt(2);
        var h1=parseInt(read_cookie(COOKIE_H1))+parseInt(2);
        var h2=parseInt(read_cookie(COOKIE_H2))+parseInt(2);
        var h3=parseInt(read_cookie(COOKIE_H3))+parseInt(2);
        var p=parseInt(read_cookie(COOKIE_P))+parseInt(2);
        var li=parseInt(read_cookie(COOKIE_li))+parseInt(2);
        
        create_cookie ( COOKIE_H1, h1, 1 );
        create_cookie ( COOKIE_H2, h2, 1 );
        create_cookie ( COOKIE_H3, h3, 1 );
        create_cookie ( COOKIE_P, p, 1 );
        create_cookie ( COOKIE_li, li, 1 );

      }
      //create_cookie ( COOKIE_NAME, 0, 1 );
    }
    var newcookie1=read_cookie(COOKIE_NAME);
 
    //alert(MAXIMUM_FONT_SIZE);
    event.preventDefault();
    //create_cookie ( COOKIE_NAME, 0, 1 );
    $(".variable_font h1").css({"fontSize":h1+"px"});
    $(".variable_font h2").css({"fontSize":h2+"px"});
    $(".variable_font h3").css({"fontSize":h3+"px"});
    $(".variable_font p").css({"fontSize":p+"px"});
    $(".variable_font li").css({"fontSize":li+"px"});

    $(".content-text h1").css({"fontSize":h1+"px"});
    $(".content-text h2").css({"fontSize":h2+"px"});
    $(".content-text h3").css({"fontSize":h3+"px"});
    $(".content-text p").css({"fontSize":p+"px"});
    $(".content-text li").css({"fontSize":li+"px"});
   
    
  });
  
  $( "a" ).click(function() {
   $("a").removeClass("selected");
  $(this).addClass("selected");
  
 });

});

function create_cookie ( name, value, days ) 
  {
    
  var expires = "";

  if ( days ) 
    {
    var date = new Date ( );

    date.setTime ( date.getTime ( ) + 
                 ( days * 24 * 60 * 60 * 1000 ) );
    expires = "; expires=" + date.toGMTString ( );
    }

  document.cookie = name + "=" + value + expires + "; path=/";
  }

  function read_cookie ( name ) 
  {
  var cookie = null;
  
  if ( document.cookie.length > 0 )
    {
    var cookies = document.cookie.split ( ';' );
    var name_with_equal = name + "=";

    for ( var i = 0; ( i < cookies.length ); i++ ) 
      {
      var a_cookie = cookies [ i ];

      a_cookie = a_cookie.replace ( /^\s*/, "" );
      if ( a_cookie.indexOf ( name_with_equal ) === 0 )
        {
        cookie = a_cookie.substring ( name_with_equal.length, 
                                      a_cookie.length );
        break;
        }
      }
    }

  return ( cookie );
  }
  function control_fontsize()
  {
    //$( ".variable_font h1" ).css( "fontSize", "100px" );
    var valCookie=read_cookie(COOKIE_NAME);
     var h1=read_cookie(COOKIE_H1);
     var h2=read_cookie(COOKIE_H2);
     var h3=read_cookie(COOKIE_H3);
     var p=read_cookie(COOKIE_P);
     var li=read_cookie(COOKIE_li);
     $(".variable_font h1").css({"fontSize":h1+"px"});
    $(".variable_font h2").css({"fontSize":h2+"px"});
    $(".variable_font h3").css({"fontSize":h3+"px"});
    $(".variable_font p").css({"fontSize":p+"px"});
    $(".variable_font li").css({"fontSize":li+"px"});

    $(".content-text h1").css({"fontSize":h1+"px"});
    $(".content-text h2").css({"fontSize":h2+"px"});
    $(".content-text h3").css({"fontSize":h3+"px"});
    $(".content-text p").css({"fontSize":p+"px"});
    $(".content-text li").css({"fontSize":li+"px"});
    /*$(".variable_font h1").css("fontSize",valCookie+'px');
    $(".variable_font h2").css("fontSize",valCookie+'px');
    $(".variable_font p").css("fontSize",valCookie+'px');
    $(".variable_font li").css("fontSize",valCookie+'px');*/

  }