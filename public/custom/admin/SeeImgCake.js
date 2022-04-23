
function seeimg(e){
    var modal = document.querySelector(".show-img");
    var original = document.querySelector(".full");
    modal.classList.add("open");
    original.classList.add("open");
    const originalsrc = e.getAttribute("data-original");
    original.src =`${originalsrc}`;
}
       


 $( ".show-img" ).click(function(e) {
     console.log('1');
if(e.target.classList.contains("show-img")){
    var modal = document.querySelector(".show-img");
    var original = document.querySelector(".full");
    modal.classList.remove('open');
    original.classList.remove("open");
}
});

