<?php
    session_start();

    //echo $_SESSION['sessaoId'];
    //$login_cookie = $_COOKIE['Cpf'];

    $ferrariID = 1;
    $lamboID = 2;
    $mustangID = 3;

    $connect = mysqli_connect('localhost','root','', 'vigono');
    if ($connect->connect_error) {
        die("Connection failed: " 
            . $connect->connect_error);
    }
    if(isset($_SESSION['sessaoId'])){
        $logado = true;
        $loginId = $_SESSION['sessaoId'];
    }else{
        $logado = false;
    }

    function redirect(){
        echo "<script language='javascript' type='text/javascript'>
            alert('$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" != "index.php')</script>";
        //if("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" != "index.php"){}
        //header('Location: ' . "index.php", true);
        //die();
    }


    function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');
        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

    function endCycle($d1, $months)
    {
        $date = new DateTime($d1);
        $newDate = $date->add(add_months($months, $date));
        $newDate->sub(new DateInterval('P1D'));
        $dateReturned = $newDate->format('Y-m-d'); 
        return $dateReturned;
    }


    function alugarCarro($numeroCarro){
        global $loginId, $connect;
        $data = date("Y/m/d");
        
        $startDate = $data;
        $datafinal = endCycle($startDate, 1);

        $sqlquery = "INSERT INTO `locacao`(`DataInicio`, `DataFim`, `cliente_idCliente`, `carro_idCarro`) VALUES 
            ('$data', '$datafinal', '$loginId', '$numeroCarro')";
        echo "<script language='javascript' type='text/javascript'>
            alert('você poderá alugar o carro em um período de 1 mês a partir de hoje($datafinal)')</script>";
        if (!$connect->query($sqlquery) == true) {
            echo "Error: " . $sqlquery . "<br>" . $connect->error;
        }
    }

    if (isset($_GET['lamborghini'])) {
        alugarCarro($lamboID);
    }elseif(isset($_GET['ferrari'])) {
        alugarCarro($ferrariID);
    }elseif(isset($_GET['mustang'])) {
        alugarCarro($mustangID);
    }
?>


<html lang="pt">
<head>
    <title>Vigono Macchine</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/75e8e357fd.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" type="imagex/png" href="imgs/Logos/Logo1.ico">
</head>
<body>
    
    <header id="header" class="img">
        <div style="display: flex;">
            <a class="logo img" href="index.html"></a>
            <ul class="menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="quemSomos.html"><i class="fas fa-users"></i>Quem Somos</a></li>
                <li><a href="carros.html"><i class="fas fa-car"></i>Carros</a></li>
                <li><a href="planos.html"><i class="fas fa-map"></i>Planos</a></li>
                <li><?php
                    if($logado)echo '<a href="logout.php?token='.session_id().'">Sair</a>';
                    else{echo "<button onclick='AparecerModalL()' class='botao-login'> <i class='fas fa-sign-in-alt'></i>Login</button>";}
                ?></li>
            </ul>
            <ul class="social-medias">
                <li><a target="_blank" href="https://instagram.com"><i class="fab fa-instagram-square"></i></a></li>
                <li><a target="_blank" href="https://facebook.com"><i class="fab fa-facebook-square"></i></a></li>
            </ul>
        </div>
    </header>

    <div class="border-bGold">
        <div class="container secao-aproveite">
            <div class="half img-aproveite img float-left"></div>
            <div class="half float-right">
                <p>Ache sempre a melhor qualidade de atendimento, melhores carros e os melhores serviços do mercado com a <span>VIGONO.</span>
                    <br><br>A sua melhor escolha.</p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<!--    <p class="text-center v-border"><span>V</span></p>-->

    <div class="como-funciona border-bGold">
        <div class="comof-1">
            <div class="px-30">
                <p class="dourado"><strong>SIMPLES E SEGURO</strong></p>
                <p><strong>Passo 1:</strong> Informe o local, a data e horário de retirada e devolução do veículo.<br>
                    <strong>Passo 2:</strong> Escolha o seu carro<br>
                    <strong>Passo 3:</strong> Forneça seus dados pessoais e finalize a reserva.<br>
                    <strong>Passo 4:</strong> Apresente o código de reserva na agência e retire seu veículo.
                </p>
                <a href="#" class="botao-alugue">Alugue um Carro</a>
            </div>
        </div>
        <div class="comof-2 img"></div>
    </div>

    <div class="container text-center carros-semanais">
        <h1>Carros mais alugados da semana</h1>
        <div class="cards">
            <div class="third">
                <div class="card">
                    <div class="img car-img" style="background-image: url('imgs/cars/lambo-car.jpg');"></div>
                    <h3 style="margin-bottom: 30px">Lamborghini</h3>
                    <?php
                    
                    if($logado == true){
                        //echo '<button onclick="alugarCarroBotao(1)" class="alugue-carro">Eu quero! (1 mês de hoje)</button>';
                        echo "<a href='index.php?lamborghini=true'>Eu quero!</a>";
                        
                    }else{
                        echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero! (2 mês de hoje)</button>';
                    }
                    
                    ?>
                    
                </div>
            </div>
            <div class="third">
                <div class="card">
                    <div class="img car-img" style="background-image: url('imgs/cars/ferrari-car.jpeg');"></div>
                    <h3 style="margin-bottom: 30px">Ferrari</h3>
                    <button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>
                </div>
            </div>
            <div class="third">
                <div class="card">
                    <div class="img car-img" style="background-image: url('imgs/cars/mustang-car.jpg');"></div>
                    <h3 style="margin-bottom: 30px">Mustang</h3>
                    <button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>
                </div>
            </div>
        </div>
        <a href="carros.html" class="veja-carro">Veja todos os carros</a>
    </div>

    <div class="container text-center planos">
        <h1>Conheça nossos planos</h1>
        <div class="cards">
            <div class="half plano1">
                <div class="card">
                    <div class="planos-padding">
                        <p class="titulo-v">VIGONO.</p>
                        <p class="titulo-plano">CURTO PRAZO</p>
                        <h3>R$<span>599</span>,00<br>
                        por semana</h3>
                        <p class="normas">Permanência mínima de 4 semanas ou cobrança de multa contratual (R$800)<br>
                            Sem cobrança por kms adicionais<br>
                            Sistema de monitoramento mais seguro do mercado<br>
                            Assistência 24 horas<br>
                            Pacote proteção pelo menor preço do mercado<br>
                            Renovação semanal automática, sem troca do veículo</p>
                        <button onclick="AparecerModalL()" class="assine">Assine</button>
                    </div>
                </div>
            </div>
            <div class="half plano2">
                <div class="card">
                    <div class="planos-padding">
                        <p class="titulo-v">VIGONO.</p>
                        <p class="titulo-plano">LONGO PRAZO</p>
                        <h3>R$<span>599</span>,00<br>
                        por semana</h3>
                        <p class="normas">Permanência mínima de 6 meses ou cobrança de multa contratual (R$1.600)<br>
                            Sem cobrança por kms adicionais<br>
                            Sistema de monitoramento mais seguro do mercado<br>
                            Assistência 24 horas<br>
                            Pacote proteção pelo menor preço do mercado<br>
                            Renovação semestral não automática, com troca do veículo</p>
                        <button onclick="AparecerModalL()" class="assine">Assine</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h1 class="text-center">Perguntas frequentes</h1>
        <details>
            <summary> Como Alugar? </summary>
            <p>Para alugar é simples, através do nosso site, o cliente busca pelo veículo de sua preferência,
                após escolhe-lo basta preencher o formulário com seus dados, assim, ele irá receber uma senha,
                e então basta mostrar a senha gerada em uma de nossas sedes</p>
        </details>
        <details>
            <summary> Onde é a sede? </summary>
            <p>Nossa principal sede é na província de Veneza, Vigonovo, mas temos outras sedes tanto na italia como no brasil</p>
        </details>
        <details>
            <summary> O que acontece se o cliente causar danos ao veículo? </summary>
            <p>Caso o cliente cause algum dano ao veículo, será cobrado uma taxa justa relativo à destruição
                do mesmo. Por se tratar de uma empresa séria de veículos de alto valor, contamos com o seu
                cuidado com nossos carros.</p>
        </details>
        <details>
            <summary> Vocês têm suporte 24h? </summary>
            <p>Contamos com um atendimento de 24horas em nosso site, além de um atendimento rápido em
                nossas redes sociais como Instagram e Facebook. Caso tenha alguma dúvida, conte conosco 😉</p>
        </details>
    </div>

    <!-- <div class="form-p">
        <h2 class="text-center">Faça uma pergunta: </h2>
        <form id="form-pergunta">
            <label for="seuNome">Nome:</label><br>
            <input type="text" id="seuNome" name="seuNome"><br>
            <label for="pergunta">Sobrenome:</label><br>
            <textarea id="pergunta" name="pergunta" rows="4"></textarea><br>
            <input type="submit" class="botao-pergunta" value="Enviar" style="margin-top: 1rem"><br>
        </form>
    </div> -->

    <div id="modal-login" class="modal">
        <div class="modal-content">
            <span onclick="SumirModalL()" class="close">&times;</span>
            <h2>Preencha o Login: </h2> <hr>
            <form id="form-login" method="POST" action="login.php">
                <label for="Cpf">Cpf:</label><br>
                <input type="text" id="login-Cpf" name="Cpf"><br>
                <label for="Senha">Senha:</label><br>
                <input type="password" id="senha-login" name="Senha" minlength="8" required><br>

                <input type="submit" id="logar" value="Logar" name="logar" style="margin-top: 1rem">

                <input type="button" onclick="SumirModalL(); AparecerModalC()" value="Cadastrar" class="botao-cadastro">
            </form>
        </div>
    </div>

    <div id="modal-cadastro" class="modal">
        <div class="modal-content">
            <span onclick="SumirModalC()" class="close">&times;</span>
            <h2>Preencha o formulário de Cadastro: </h2> <hr>
            <form id="form-cadastro" name="cadCliente" method="POST" action="cadastro.php">
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome"><br>
                <label for="Cpf">CPF:</label><br>
                <input type="text" name="Cpf"><br>
                <label for="Email">Email:</label><br>
                <input type="text" name="Email"><br>
                <label for="Senha">Senha:</label><br>
                <input type="password" name="Senha" minlength="8" required><br>


                <input type="submit" name="botao-enviar-cadastro">
            </form>
        </div>
    </div>

    <footer>
        <div id="footer">
            <ul class="footer">
                <li>2020 © Vigono Macchine</li>
                <li><a target="_blank" href="https://instagram.com"><i class="fab fa-instagram-square"></i>Instagram</a></li>
                <li><a target="_blank" href="https://facebook.com"><i class="fab fa-facebook-square"></i>Facebook</a></li>
                <li><a href="mailto:vigonomacchine@sample.com?subject=Contato"><i class="fas fa-envelope"></i>Email</a></li>
            </ul>
        </div>
    </footer>

    <script type="text/javascript">
        function alugarCarroBotao(numero){
            $.ajax({url:"alugue.php", success:function(numero){console.log(numero)}
            })
        }
    </script>

    <script src="script.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</body>
</html>