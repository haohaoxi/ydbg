jQuery(function($){
	$(".top-menu #date").getDate();
	var innerHeight = document.documentElement.clientHeight;
	var innerWidth = document.documentElement.clientWidth;
	$(".left-menu").css("height",innerHeight - 142 + "px");
	$(".boxer").css("width",innerWidth - 237 + "px").css("height",innerHeight - 157 + "px");
	$("#boxer-news").css("width",innerWidth - 220 + "px").css("height",innerHeight - 157 + "px");
	$("#boxer-zh").css("width",innerWidth - 220 + "px").css("height",innerHeight - 157 + "px");
	$(".message-box").css("width",innerWidth - 40 + "px").css("height",innerHeight - 157 + "px");
	if (innerWidth < 1410) {
  		$("#box-body").css("width","1410px");
		$(".boxer").css("width","1173px").css("height",innerHeight - 157 + "px");
		$("#boxer-zh").css("width","1190px").css("height",innerHeight - 157 + "px");
	}

	$(".left-menu .item").children("a").on("click",function(){
		if ($(this).parent().find("ul").attr("class")) {
			$(this).removeClass("active");
			$(this).parent().find("ul").hide().removeClass();
		} else {
			$(this).addClass("active");
			$(this).parent().find("ul").show().addClass("show");
		}
	});


    $('.inactive').click(function(){
        if($(this).hasClass('inactives')){
            $(this).removeClass('inactives');
            $(this).next('ul').hide();
        }else{
            $(this).parent('li').siblings('li').find('a').removeClass('inactives');
            $(this).parent('li').siblings('li').find('ul').hide();
            $(this).addClass('inactives');
            $(this).next('ul').show();
        }
        var nav_position= new Array();
        $('.yiji').find('a').each(function(i){
            if($(this).hasClass('inactives')){
                nav_position.push(i);
            }
        });
        setCookie('nav_position',nav_position);
        // console.clear();
       // console.log(nav_position)

    });

    if(getCookie('nav_position')){
        var get_nav_position = getCookie('nav_position');
        $('.yiji').find('a').each(function(i){
            if(get_nav_position.indexOf(i)!=-1){
                $(this).trigger("click")
            }
        });
    }


    function setCookie(a,b){
        var d=new Date();
        var v=arguments;
        var c=arguments.length;
        var e=(c>2)?v[2]:null;
        var p=(c>3)?v[3]:null;
        var m=(c>4)?v[4]:window.location.host;
        var r=(c>5)?v[5]:false;
        if(e!=null){
            var T=parseFloat(e);
            var U=e.replace(T,"");
            T=(isNaN(T)||T<=0)?1:T;
            U=("snhdwmqy".indexOf(U)==-1||U=="")?'s':U.toLowerCase();
            switch(U){
                case 's':d.setSeconds(d.getSeconds()+T);break;
                case 'n':d.setMinutes(d.getMinutes()+T);break;
                case 'h':d.setHours(d.getHours()+T);break;
                case 'd':d.setDate(d.getDate()+T);break;
                case 'w':d.setDate(d.getDate()+7*T);break;
                case 'm':d.setMonth(d.getMonth()+1+T);break;
                case 'q':d.setMonth(d.getMonth()+1 +3*T);break;
                case 'y':d.setFullYear(d.getFullYear()+ T);break
            }
        }
        document.cookie=a+"="+escape(b)+((e==null)?"":("; expires="+d.toGMTString()))+((p==null)?("; path=/"):("; path="+p))+("; domain="+m)+((r==true)?"; secure":"")
    }

    function getCookieVal(a){
        var b=document.cookie.indexOf(";",a);
        if(b==-1)b=document.cookie.length;
        return unescape(document.cookie.substring(a,b))
    }

    function getCookie(a){
        var v=a+"=";
        var i=0;
        while(i<document.cookie.length){
            var j=i+v.length;
            if(document.cookie.substring(i,j)==v)return getCookieVal(j);
            i=document.cookie.indexOf(" ",i)+1;
            if(i==0)break
        }
        return null
    }
    function delCookie(a){
        var e=new Date();
        e.setTime(e.getTime()-1);
        var b=getCookie(a);
        document.cookie=a+"="+a+";path=/; domain="+window.location.host+"; expires="+e.toGMTString()
    }
});