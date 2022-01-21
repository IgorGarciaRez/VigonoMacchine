<?php

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

    alugarCarro($numeroCarro);

?>