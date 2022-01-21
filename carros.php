<?php
    session_start();

    $ferrariID = 1;
    $lamboID = 2;
    $mustangID = 3;
    $mcLarenID = 4;
    $mercedesID = 5;
    $supraID = 6;
    $rollsRoyceID = 7;
    $bugattiID = 8;
    $bmwID = 9;

    $ferrariUrl = "?ferrari=true";
    $lamboUrl = "?lamborghini=true";
    $mustangUrl = "?mustang=true";
    $mcLarenUrl = "?mcLaren=true";
    $mercedesUrl = "?mercedes=true";
    $supraUrl = "?supra=true";
    $rollsRoyceUrl = "?rollsRoyce=true";
    $bugattiUrl = "?bugatti=true";
    $bmwUrl = "?bmw=true";

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
            alert('Você poderá alugar o carro em um período de 1 mês a partir de hoje(até $datafinal)')</script>";
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
    }elseif (isset($_GET['mcLaren'])) {
        alugarCarro($mcLarenID);
    }elseif(isset($_GET['mercedes'])) {
        alugarCarro($mercedesID);
    }elseif(isset($_GET['supra'])) {
        alugarCarro($supraID);
    }elseif (isset($_GET['rollsRoyce'])) {
        alugarCarro($rollsRoyceID);
    }elseif(isset($_GET['bugatti'])) {
        alugarCarro($bugattiID);
    }elseif(isset($_GET['bmw'])) {
        alugarCarro($bmwID);
    }
?>


<html lang="pt">
<head>
    <title>Carros</title>
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
            <a class="logo img" href="index.php"></a>
            <ul class="menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="quemSomos.html"><i class="fas fa-users"></i>Quem Somos</a></li>
                <li><a href="carros.php"><i class="fas fa-car"></i>Carros</a></li>
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

    <div class="container carros">
        <h1>Conheça nossos modelos!</h1>
        <div class="text-center">
            <div class="cards">
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/lambo-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">Lamborghini</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$lamboUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/ferrari-car.jpeg');"></div>
                        <h3 style="margin-bottom: 30px">Ferrari</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$ferrariUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/mustang-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">Mustang</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$mustangUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/mclaren-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">McLaren</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$mcLarenUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/mercedes-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">Mercedes</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$mercedesUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/supra-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">Toyota Supra</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$supraUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
            </div>
            <div class="cards">
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/rollsroyce-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">Rolls Royce</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$rollsRoyceUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/bugatti-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">Bugatti</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$bugattiUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
                <div class="third">
                    <div class="card">
                        <div class="img car-img" style="background-image: url('imgs/cars/bmw-car.jpg');"></div>
                        <h3 style="margin-bottom: 30px">BMW</h3>
                        <?php
                            if($logado == true){echo "<a id='alugue_carros' href='carros.php$bmwUrl'>Eu quero!</a>";}
                            else{echo '<button onclick="AparecerModalL()" class="alugue-carro">Eu quero!</button>';}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <div id="modal-carros" class="modal">
        <div class="modal-content">
            <span onclick="SumirModalC()" class="close">&times;</span>
            <h2>Preencha o formulário: </h2> <hr>
            <form id="form-carros">
                <label for="carro-pnome">Nome:</label><br>
                <input type="text" id="carro-pnome" name="carro-pnome"><br>
                <label for="carro-snome">Sobrenome:</label><br>
                <input type="text" id="carro-snome" name="carro-snome"><br>
                <label for="carro-cpfform">CPF:</label><br>
                <input type="text" id="carro-cpfform" name="carro-cpfform"><br>
                <label for="carro-telform">Telefone:</label><br>
                <input type="text" id="carro-telform" name="carro-telform"><br>
                <label for="carro-data">Data de retirada:</label><br>
                <input type="text" id="carro-data" name="carro-data"><br>
                <input type="button" id="carro-button" onclick="GerarSenha()" value="Gerar Senha" style="margin-top: 1rem"><br>
                <input type="text" id="senha-carro" name="senha-carro">
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
        var url = "http://localhost/VigonoMacchine/carros.php";
        if(window.location.href != url){
            window.location.replace("http://localhost/VigonoMacchine/carros.php");
        }
    </script>

    <script src="script.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</body>
</html>