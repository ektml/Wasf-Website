var preload = document.getElementById("preloading");
window.addEventListener('load', function () {
  
 
  $("#preloading").fadeOut();
  
  
})

$(document).ready(function () {

  // $("#nav-login").click(function () {
  //   $("#login-dialog").show();
  //    $("#signup-dialog").hide();
  // });
  
  //  $("#signup-dialog").hide();
  // $("#tologin").click(function () {
  //    $("#login-dialog").show();
  //    $("#signup-dialog").hide();
      
  // });
  //   $("#tosignup").click(function () {
  //       $("#login-dialog").hide();
  //      $("#signup-dialog").show();
  //   });
  
// $('.scrollable').slick({
//   infinite: true,
//   slidesToShow: 3,
//   slidesToScroll: 3
// });
  
  const productContainers = [...document.querySelectorAll('.scrollable')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
      item.scrollLeft += containerWidth;
     
      console.log("after"+item.scrollLeft);
    })

    preBtn[i].addEventListener('click', () => {
      item.scrollLeft -= containerWidth;
    
      console.log("pre"+item.scrollLeft);

    })
    console.log("all width"+containerWidth);
})


$(".hart").click(function(){

  $(this).toggleClass("active");
  

});

});


const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);
