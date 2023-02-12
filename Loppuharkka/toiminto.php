<?php
    //Tällä headerilla ilmaistaa php lle koodin olevan jsonia
    header('Content-Type: application/json; charset=utf-8');
    //Haetaan json tiedosto rajapinnan puolelle
    $Taulukko = file_get_contents("./productdata.json");
    $Taulukko = json_decode($Taulukko);
    $Data = array();

    //Tehdään foreach ehto joka hakee taulukon ja määrittää objecteille avaimen jolla tietty objecti löydetään, sekä arvo
    foreach($Taulukko as $key => $value){
        ////Määritetään objectille ID arvo ja haetaan se json taulukosta
        if( isset($_GET['id'])){
            if ($_GET['id']== $value->id) {
                
                $Data[] = $value;
            }
        }
        //Määritetään objectille kategoria arvo ja haetaan se json taulukosta
        else if( isset ($_GET['kategoria'] )){
            if($_GET['kategoria'] == $value->kategoria) {
                $Data[] = $value;
            }
        }
        //Määritetään objectille hinta arvo ja koodataan hakemaan tuotteet jotka maksavat alle käyttäjän antavan hinnan
        else if( isset($_GET['hinta'])){
            if($_GET['hinta'] >= $value->hinta) {
                
                $Data[] = $value;
            }
        }
        //Jos ei anneta parametrejä (Jos GET on tyhjä), listataan kaikki tuotteet
        else if(empty($_GET)) {
            
            $Data[] = $value;
        }

    }
    echo json_encode($Data);
?>
