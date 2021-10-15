
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
var modalP = document.getElementById("modal-planos");

function AparecerModalP() {
    modalP.style.display = "block";
}

function SumirModalP() {
    modalP.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modalP) {
        modalP.style.display = "none";
    }
}

/*-----------*/

var modalC = document.getElementById("modal-carros");

function GerarSenha(){
    var senha = ""
    var hex = "0123456789ABCDEF"
    for (var i = 0; i < 6; i++ ){
        senha += hex[Math.floor(Math.random() * hex.length)]
    }
    document.getElementById("senha-carro").value = senha
}

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