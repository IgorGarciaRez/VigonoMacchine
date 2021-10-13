
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
var btn1 = document.getElementById("botao-plano1");
var btn2 = document.getElementById("botao-plano2");
var span1 = document.getElementsByClassName("close")[0];

btn1.onclick = function() {
    modalP.style.display = "block";
}

btn2.onclick = function() {
    modalP.style.display = "block";
}

span1.onclick = function() {
    modalP.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modalP) {
        modalP.style.display = "none";
    }
}

/*-----------*/

var modalC = document.getElementById("modal-carros");
var btnC1 = document.getElementsByClassName("alugue-carro")[0];
var btnC2 = document.getElementsByClassName("alugue-carro")[1];
var btnC3 = document.getElementsByClassName("alugue-carro")[2];
var span2 = document.getElementsByClassName("close")[1];

function GerarSenha(){
    var senha = ""
    var hex = "0123456789ABCDEF"
    for (var i = 0; i < 6; i++ ){
        senha += hex[Math.floor(Math.random() * hex.length)]
    }
    document.getElementById("senha-carro").value = senha
}

btnC1.onclick = function() {
    modalC.style.display = "block";
}

btnC2.onclick = function() {
    modalC.style.display = "block";
}

btnC3.onclick = function() {
    modalC.style.display = "block";
}

span2.onclick = function() {
    modalC.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modalC) {
        modalC.style.display = "none";
    }
}

