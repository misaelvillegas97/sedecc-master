<?php
    header('Content-Type: application/json');
    // extract($_GET);
    include("../conexion.php");
    mysqli_set_charset( $mysqli, 'utf8');

    $eess_rut = $_GET['eess_rut'];
    $car_id = $_GET['car_id'];
    // if ($eess != 'admin') {
    //     $where = "WHERE e.eess_rut = '$eess'";
    // }else{
    //     $where = "";
    // }
    
    // if ($empresa != '') {
    //     $where2 = "WHERE e.eess_rut = '$empresa'";
    // }else{
    //     $where2 = '';
    // }
    $color = "";
    
    $query2 = " SELECT 
                    eva.eess_rut,
                    TRUNCATE(AVG(eva_cache_porcentaje), 2) AS eva_nota
                FROM min_evaluacion AS eva
                JOIN min_trabajador AS tra
                    ON eva.tra_rut = tra.tra_rut
                WHERE tra.car_id = $car_id AND 
                eva.eess_rut = $eess_rut
                ";

    $resultado = $mysqli->query($query2);

    $row = $resultado ->fetch_assoc();

    if ( $row['eva_nota'] >= 96 ) {
        $color = '#4FBD5B';
    }

    if ( $row['eva_nota'] < 96  && $row['eva_nota'] >= 86 ) {
        $color = '#F7E523';
    }

    if ( $row['eva_nota'] < 86  && $row['eva_nota'] >= 0 ) {
        $color = '#E14D57';
    }

    echo '
    [
        {
            "titulo": "% de cumplimiento",
            "eva_nota": '.$row['eva_nota'].',
            "color": "'.$color.'"
        },
        {
            "titulo": "nombre :v",
            "eva_nota": '.(100-$row['eva_nota']).',
            "color": "#dddddd"
        }
    ]';
        

?>