<?php

function gender($gender) {
    if($gender == 'f') {
        echo "Feminino";
    } else {
        echo "Masculino";
    }
}

function status($status) {
    if($status == 1) {
        echo "<span class='text-white p-1' style='background: green;'>Ativo</span>";
    } else {
        echo "<span class='text-white p-1' style='background: red;'>Inativo</span>";
    }
}

function statusCarne($status) {
    if($status == 1) {
        echo "<span class='text-white p-1' style='background: green;'>Pago</span>";
    } else {
        echo "<span class='text-white p-1' style='background: red;'>Por Pagar</span>";
    }
}

function statusAssinatura($status, $data) {

    $data_inicio = strtotime(date($data));
    $data_fim = strtotime(date("Y-m-d"));

    // Resgata diferença entre as datas
    $dateInterval = $data_inicio - $data_fim;
    $dias = ($dateInterval / 86400);
    $vcto = $dias;

    if($vcto >= 0 && $status == 1) {
        echo "<span class='text-white p-1' style='background: green;'>Ativo</span>";
    } else {
        echo "<span class='text-white p-1' style='background: red;'>Inativo</span>";
    }

}

function diasEmFalta($data)
{
    $data_inicio = strtotime(date($data));
    $data_fim = strtotime(date("Y-m-d"));

    // Resgata diferença entre as datas
    $dateInterval = $data_inicio - $data_fim;
    $dias = ($dateInterval / 86400);
    if($dias >= 0) {
        $dias = "<span class='text-success'>$dias dia(s)</span>";
    } else {
        $dias = "<span class='text-danger'>$dias dia(s)</span>";
    }
    return $dias;
}


function disponivel($status) {
    if($status == 1) {
        echo "<span class='text-white p-1' style='background: green;'>Sim</span>";
    } else {
        echo "<span class='text-white p-1' style='background: red;'>Não</span>";
    }
}

function garantia($valor) {
    if($valor == 1) {
        echo "<span class='text-white p-1' style='background: green;'>3 meses</span>";
    } else if($valor == 2) {
        echo "<span class='text-white p-1' style='background: green;'>6 meses</span>";
    } else if($valor == 3) {
        echo "<span class='text-white p-1' style='background: green;'>12 meses</span>";
    } else if($valor == 4) {
        echo "<span class='text-white p-1' style='background: green;'>18 meses</span>";
    } else if($valor == 5) {
        echo "<span class='text-white p-1' style='background: green;'>24 meses</span>";
    } else if($valor == 6) {
        echo "<span class='text-white p-1' style='background: green;'>30 meses</span>";
    } else if($valor == 7) {
        echo "<span class='text-white p-1' style='background: green;'>36 meses</span>";
    } 
}

function dateFormat($dt) {
    echo date("d/m/Y", strtotime($dt));
}

function userLevel($role) {
    if($role == 1) 
        echo "Admnistrador";
    if($role == 2) 
        echo "Funcionário";
    if($role == 3) 
        echo "Cliente";
}

function firstWord($sentece) {
    $arr = explode(' ',trim($sentece));
    echo $arr[0]; 
}

function firstLeterToUpper($sentece) {
    echo ucwords($sentece); 
}

function slug($string) {
    $string = preg_replace('/[\t\n]/', ' ', $string);
    $string = preg_replace('/\s{2,}/', ' ', $string);
    $list = array(
        'Š' => 'S',
        'š' => 's',
        'Đ' => 'Dj',
        'đ' => 'dj',
        'Ž' => 'Z',
        'ž' => 'z',
        'Č' => 'C',
        'č' => 'c',
        'Ć' => 'C',
        'ć' => 'c',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'A',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ý' => 'Y',
        'Þ' => 'B',
        'ß' => 'Ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'a',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'o',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ø' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'ý' => 'y',
        'þ' => 'b',
        'ÿ' => 'y',
        'Ŕ' => 'R',
        'ŕ' => 'r',
        '/' => '-',
        ' ' => '-',
        '.' => '-',
    );

    $string = strtr($string, $list);
    $string = preg_replace('/-{2,}/', '-', $string);
    $string = strtolower($string);

    return $string;
}

function currencyFormat($value) {
    $value = (int)$value;
    if($value > 0 && !empty($value))
        return number_format($value, 2, ',','.')." Akz";
    else 
        return number_format(0, 2, ',','.')." Akz";
}