
var lastScrollTop = 0;

function SumirMenu(){
    document.getElementById('header').style.top = "-100px";
}

function AparecerMenu(){
    document.getElementById('header').style.top = "0";
}


window.addEventListener("scroll", function(){
    var st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop){
        SumirMenu()
    } else {
        AparecerMenu()
    }
    lastScrollTop = st <= 0 ? 0 : st;
});

// ---- MODAL --------------
var modalL = document.getElementById("modal-login");

function AparecerModalL() {
    modalL.style.display = "block";
}

function SumirModalL() {
    modalL.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modalL) {
        modalL.style.display = "none";
    }
}

/*-----------*/

var modalC = document.getElementById("modal-cadastro");

function AparecerModalC() {
    modalC.style.display = "block";
}

function SumirModalC() {
    modalC.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modalC) {
        modalC.style.display = "none";
    }
}