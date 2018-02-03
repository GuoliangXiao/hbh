var phoneUrl = "http://tcc.taobao.com/cc/json/mobile_tel_segment.htm";
function init() {
    resize();
    bindFunctions();
}

function bindFunctions() {
    $(".seal_select").click(function(){
         var v=$(".seal_select:checked").val();
         $(".div_seal").css("display","none");
         $(".div_seal_diy").css("display","none");
         if(v=="0"){
             $(".div_seal").css("display","block");
         }else {
             $(".div_seal_diy").css("display","block");
         }
    });
    $(".button_submit").click(function() {
        postInfo();
    });
    $(window).resize(function() {
        resize();
    });
    $(".div_seal").keypress(function() {
        if (event.keyCode == 13) {
            postInfo();
        }
    });
     $(".div_seal_diy").keypress(function() {
        if (event.keyCode == 13) {
            postDiy();
        }
    });
    $(".submit_diy").click(function() {
        postDiy();
     });
}
function postDiy(){
    var name=$(".name_diy").val();
    if(name==""){
        alert("输入为空！");
        return;
    }else if(!chinestTest(name)){
        alert("请输入汉字！");
        return;
    }
    var font=$(".font_kind").val();
    var size=$(".seal_size:checked").val();
    var line=$(".line_diy:checked").val();
    var kind=$(".kind_diy:checked").val();
    var style=$(".font_direct:checked").val();
    //alert(name+"-"+font+"-"+size+"-"+line+"-"+kind);
    var url="php/get_img_diy.php?name="+name+"&font="+font+"&size="+size+"&line="+line+"&kind="+kind+"&style="+style;
    //alert(url);
    $(".img_diy").attr("src",url);
}
function postInfo() {
    var name = $(".input_name").val();
    if (name != "") {
        if (chinestTest(name)) {
            if(name.length<2||name.length>4){
                alert("请输入2-4个汉字！");
            }else{
                 $(".img").each(function(index) {
                 var kind = getKind();
                 var url = "php/get_img.php?font=" + index + "&kind=" + kind + "&name=" + name;
                 $(this).attr("src", url);
            });
            }
        }else{
            alert("请输入汉字!");
        }
    }else{
        alert("输入为空！");
    }

}

function getKind() {
    var k = $(".seal_kind:checked").val();
    if (k == 1 || k == 0) {
        return k;
    } else {
        var r = Math.random();
        if (r < 0.5) {
            return 0;
        } else {
            return 1;
        }
    }
}

function chinestTest(s) {
    for (var i = 0; i < s.length; i++)
        if (s.charCodeAt(i) < 0x4E00 || s.charCodeAt(i) > 0x9FA5) {
            return false;
        }
    return true;
}

function resize() {
    var clientWidth = document.body.clientWidth;
    var width = 800;
    if (clientWidth - width < 20) {
        $(".div_body").css("margin-left", "10px");
    } else {
        $(".div_body").css("margin-left", parseInt((clientWidth - width) / 2) + "px");
    }
}

