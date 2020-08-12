<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
         $idForm = $_GET["form"];

         if(isset($idForm) && $idForm != ""){
            echo $select =  "SELECT * FROM formularios WHERE id=" . $idForm;
            $fechaInicio = '2020-07-20'; 
            $fechaFinal = '2020-07-25';
            echo $hoy = date("Y-m-d");
            if($fechaFinal===$hoy){
        ?>
        
            <iframe src="https://us02web.zoom.us/j/87174563324?pwd=eTdxTWtuNW1HdkRmV1kzb25BWVZoQT09" width="1200" height="600">
            </iframe>
        <?php
            } else {
                
                echo "Periodo invalido";
            }
        }else{
            echo "liga no valida";
        }
        ?>

    </body>
</html>