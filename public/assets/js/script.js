var preload = document.getElementById("preloading");
window.addEventListener('load', function () {


  $("#preloading").fadeOut();


})

$(document).ready(function () {

 const productContainers = [...document.querySelectorAll('.scrollable')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
   let containerDimensions = item.getBoundingClientRect();
   let containerWidth = containerDimensions.width;

   nxtBtn[i].addEventListener('click', () => {
     item.scrollLeft += containerWidth;

   })

   preBtn[i].addEventListener('click', () => {
     item.scrollLeft -= containerWidth;


   })

})


// close chat when close requests 
$('.modal').on('hide.bs.modal',function(){
    $('.chat').offcanvas('hide');
});


// $(".hart").click(function(e){

//   // var id=$(".hart").data('id');
//   // $(this).toggleClass("active");
// var id =$(".hart").attr('data-id');
// // var  type =$(".hart").attr('data-type');

// $.ajax({
//     url: "{{ URL('user/addorremovelikes') }}/" + id,
//     type: "GET",
//     // data:{'type':type},
//     dataType: "json",
//     success: function(data) {
//       if(data){
//         console.log(data);
//         $(this).toggleClass("active");
//       }else{


//       }
//     }

//     });


// });


// chat
// $('.chat').on('show.bs.offcanvas',function(){

//       var id= $(this).attr('data-id');
//       var type= $(this).attr('data-type');
//       var mesageto= $(this).attr('data-to');
//       type=type.trim();
//       mesageto=mesageto.trim();
//  console.log(type);
//  console.log(mesageto);

//  setInterval(getmessage,1000);
//  function getmessage() {
//   $.ajax({
//     url: "{{URL::to('user/chat')}}/"+ id,
// type: "GET",
// data:{'type':type,'messageto':mesageto},
// dataType: "json",
// success: function(data) {
//  if(data){
//        console.log(data);
//  }else{


//  }
// }

// });
//   }



//      });
  // console.log( $('.chat'));
  //    var myOffcanvas = document.querySelector('.chat');
  //    console.log(myOffcanvas);
  // myOffcanvas.foreach(addEventListener('show.bs.offcanvas', function () {
  // console.log(adfas);
  // }));




$(".visaicon").addClass("active");
$(".apayicon").removeClass("active");
$(".walleticon").removeClass("active");
$(".visa").show();
$(".apay").hide();
$(".wallet").hide();

$(".visaicon").click(function (){

  $(this).addClass("active");
  $(".apayicon").removeClass("active");
  $(".walleticon").removeClass("active");
  $(".visa").show();
  $(".apay").hide();
  $(".wallet").hide();

});
$(".apayicon").click(function (){

  $(this).addClass("active");
  $(".visaicon").removeClass("active");
  $(".walleticon").removeClass("active");
  $(".visa").hide();
  $(".apay").show();
  $(".wallet").hide();
});
$(".walleticon").click(function (){
  $(this).addClass("active");
  $(".apayicon").removeClass("active");
  $(".visaicon").removeClass("active");
  $(".visa").hide();
  $(".apay").hide();
  $(".wallet").show();
});



// code of choose private request or reservation

// $('#form-chooserequest').on('submit',function(e){
//     e.preventDefault();
//     var value=$("input[name=requesttype]:checked").val();

//     console.log(value);
//     switch(value){
//     case "private":  location.href='requestprivate'; break;
//     case "reservation":  location.href='reservation'; break;
//     }
// });

});



  function OTPInput() {
const inputs = document.querySelectorAll('#otpinupts  *[id]');
for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } }
OTPInput();




//const imgs = document.querySelectorAll('.img-select a');
//const imgBtns = [...imgs];
//let imgId = 1;
//
//imgBtns.forEach((imgItem) => {
//    imgItem.addEventListener('click', (event) => {
//        event.preventDefault();
//        imgId = imgItem.dataset.id;
//        slideImage();
//    });
//});
//
//function slideImage(){
//    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;
//
//    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
//}
//
//window.addEventListener('resize', slideImage);


$(function()
{
    function c(){p();var e=h();var r=0;var u=false;l.empty();
        while(!u){if(s[r]==e[0].weekday){
            u=true
        }else{
            l.append('<div class="blank"></div>');
            r++}}
        for(var c=0;c<42-r;c++){
            if(c>=e.length){
                l.append('<div class="blank"></div>')
            }else{
                var v=e[c].day;
                var m=g(new Date(t,n-1,v))?'<div class="today">':"<div>";
                l.append(m+""+v+"</div>")}}var y=o[n-1];
                a.css("background-color",y).find("h1").text(i[n-1]+" "+t);
                f.find("div").css("color",y);
                l.find(".today").css("background-color",y);
                d()}function h(){var e=[];
                    for(var r=1;r<v(t,n)+1;r++){
                        e.push({day:r,weekday:s[m(t,n,r)]})}
                        return e
                    }
                        function p(){
                            f.empty();
                            for(var e=0;e<7;e++){
                                f.append("<div>"+s[e].substring(0,3)+"</div>")}
                            }
                                function d(){
                                    var t;
                                    var n=$("#calendar").css("width",e+"px");
                                    n.find(t="#calendar_weekdays, #calendar_content").css("width",e+"px").find("div").css({width:e/7+"px",height:e/7+"px","line-height":e/7+"px"});
                                    n.find("#calendar_header").css({height:e*(1/7)+"px"}).find('i[class^="icon-chevron"]').css("line-height",e*(1/7)+"px")}
                                    function v(e,t){
                                        return(new Date(e,t,0)).getDate()
                                    }
                                        function m(e,t,n){
                                            return(new Date(e,t-1,n)).getDay()
                                        }
                                        function g(e){
                                            return y(new Date)==y(e)
                                        }
                                        function y(e){return e.getFullYear()+"/"+(e.getMonth()+1)+"/"+e.getDate()
                                    }
                                    function b(){
                                        var e=new Date;t=e.getFullYear();
                                        n=e.getMonth()+1
                                    }
                                    var e=480;
                                    var t=2013;var n=9;

                                    var r=[];var i=["JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"];
                                    var s=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
                                    var o=["#16a085","#1abc9c","#F26B1D","#27ae60","#FF6860","#f39c12","#f1c40f","#e67e22","#2ecc71","#e74c3c","#d35400","#2c3e50"];
                                    var u=$("#calendar");
                                    var a=u.find("#calendar_header");
                                    var f=u.find("#calendar_weekdays");
                                    var l=u.find("#calendar_content");
                                    b();
                                    c();
                                    a.find('i[class^="icon-chevron"]').on("click",function(){
                                        var e=$(this);
                                        var r=function(e){
                                            n=e=="next"?n+1:n-1;
                                            if(n<1){n=12;t--}else if(n>12){n=1;t++}c()};

                                            if(e.attr("class").indexOf("left")!=-1){r("previous")}else{r("next")}})})
