function SumirMenu(){
    document.getElementById('header').style.display = "none";
}

function AparecerMenu(){
    document.getElementById('header').style.display = "block";
}

var lastScrollTop = 0;

window.addEventListener("scroll", function(){
    var st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop){
        SumirMenu()
    } else {
        AparecerMenu()
    }
    lastScrollTop = st <= 0 ? 0 : st;
}, false);