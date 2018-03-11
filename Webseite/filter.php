<?php
    session_start();
    require_once 'assets/scripts/DBConnect.php';

    if (isset($_POST['show_results'])) {
        $sql_hersteller = $_POST['marke'];

        if (isset($_POST['hybrid'])) {
            $sql_hybrid = 1;
        } else {
            $sql_hybrid = 0;
        }

        $sql_verbrauch = $_POST['verbrauch'];
        $sql_typ = $_POST['typ'];
        $sql_sitzplatz_a = $_POST['sitzplatz_a'];
        $sql_sitzplatz_b = $_POST['sitzplatz_b'];
        $sql_kofferraum = $_POST['kofferraum'];
        $sql_leistung_a = $_POST['leistung_a'];
        $sql_leistung_b = $_POST['leistung_b'];
        $sql_reichweite = $_POST['reichweite'];
        $sql_ladezeit = $_POST['ladezeit'];
        $sql_preis_a = $_POST['preis_a'];
        $sql_preis_b = $_POST['preis_b'];

        $sql_suche = "SELECT * FROM `Car` WHERE `Preis_min` != 0";
        $sql_suche_temp = "0";
        
        foreach ($sql_hersteller as $key => $value) {
            if ($value != 0) {
                $sql_suche_temp .= " ,".$value."";
            }
        }
        
        if ($sql_suche_temp != "0") {
            $sql_suche .= " AND `Automarke_ID` IN (".$sql_suche_temp.")";
        }
        if ($sql_hybrid == 1) {
            if ($sql_verbrauch != 0) {
                $sql_suche .= " AND `Verbrauch` <= ".$sql_verbrauch."";
            }
        } elseif ($sql_hybrid == 0) {
            $sql_suche .= " AND `Hybrid` =".$sql_hybrid."";
        }
        $sql_suche_temp = "0";
        foreach ($sql_typ as $key2 => $value2) {
            if ($value2 != 0) {
                $sql_suche_temp .= " ,".$value2."";
            }
        }
        if ($sql_suche_temp != "0") {
            $sql_suche .= " AND `Autoklasse_ID` IN (".$sql_suche_temp.")";
        }
        if ($sql_sitzplatz_a != 0 && $sql_sitzplatz_b != 0) {
            $sql_suche .= " AND `Sitzplaetze` BETWEEN ".$sql_sitzplatz_a." AND ".$sql_sitzplatz_b."";
        }
        if ($sql_sitzplatz_a != 0 && $sql_sitzplatz_b == 0) {
            $sql_suche .= " AND `Sitzplaetze` >= ".$sql_sitzplatz_a."";
        }
        if ($sql_sitzplatz_a == 0 && $sql_sitzplatz_b != 0) {
            $sql_suche .= " AND `Sitzplaetze` <= ".$sql_sitzplatz_b."";
        }
        if ($sql_kofferraum != 0) {
            $sql_suche .= " AND `Kofferraum_max` >= ".$sql_kofferraum."";
        }
        if ($sql_leistung_a != 0 && $sql_leistung_b != 0) {
            $sql_suche .= " AND `Leistung` BETWEEN ".$sql_leistung_a." AND ".$sql_leistung_b."";
        }
        if ($sql_leistung_a != 0 && $sql_leistung_b == 0) {
            $sql_suche .= " AND `Leistung` >= ".$sql_leistung_a."";
        }
        if ($sql_leistung_a == 0 && $sql_leistung_b != 0) {
            $sql_suche .= " AND `Leistung` <= ".$sql_leistung_b."";
        }
        if ($sql_reichweite != 0) {
            $sql_suche .= " AND `Reichweite` >= ".$sql_reichweite."";
        }
        if ($sql_ladezeit != 0) {
            $sql_suche .= " AND `Ladezeit_normal` <= ".$sql_ladezeit."";
        }
        if ($sql_preis_a != 0 && $sql_preis_b != 0) {
            $sql_suche .= " AND `Preis_min` BETWEEN ".$sql_preis_a." AND ".$sql_preis_b."";
        }
        if ($sql_preis_a != 0 && $sql_preis_b == 0) {
            $sql_suche .= " AND `Preis_min` >= ".$sql_preis_a."";
        }
        if ($sql_preis_a == 0 && $sql_preis_b != 0) {
            $sql_suche .= " AND `Preis_min` <= ".$sql_preis_b."";
        }

        unset($_SESSION['filter_sql_temp']);
        $_SESSION['filter_sql_temp'] = $sql_suche;
        header("location: results.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="title" content="Smart eChoice - Ihr e-Fahrzeug Filter">
    <meta name="description" content="Unsere Anwendung kann Sie bei der Suche nach Ihrem nächsten E-Fahrzeug unterstützen.">
    <meta name="author" content="eMobilisten">
    <link rel="canonical" href="http://smart-e-choice.de/">

    <meta property="og:locale" content="de_DE">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Smart eChoice - Ihr e-Fahrzeug Filter">
    <meta property="og:description" content="Unsere Anwendung kann Sie bei der Suche nach Ihrem nächsten E-Fahrzeug unterstützen.">
    <meta property="og:url" content="http://smart-e-choice.de">
    <meta property="og:site_name" content="Smart eChoice">
    <meta property="og:image" content="http://smart-e-choice.de/assets/img/logo-emobilisten.png">

    <title>Smart eChoice | Filter</title>

    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="assets/css/mdb.min.css">

    <!-- Modal Bootstrap Plugin -->
    <link rel="stylesheet" href="assets/plugins/enhanced-modals.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css">

  </head>

  <body>

    <header>

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg white navbar-dark fixed-top scrolling-navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                  <img src="assets/img/logo-emobilisten.png" height="50" alt="eMobilisten">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="index.php">Home</a>
                        <a class="nav-item nav-link active" href="filter.php">Filter <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link" data-toggle="modal" data-target="#infoModal">Info</a>
                    </div>
                </div>
            </div>
        </nav>
        <!--/.Navbar-->

    </header>

    <main>

        <!--Main layout-->
        <div class="container-fluid">
            <div class="row wow fadeIn" data-wow-delay="0.2s">
                <div class="col-md-12">
                	<div id="hinweis" class="alert alert-info alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    	<span aria-hidden="true">&times;</span>
						</button>
						<strong>Hinweis:</strong> Verwenden Sie den Filter am besten auf einem Laptop/Desktop.
					</div>
                    <div class="card">
                        <h3 class="card-header custom-primary-color-bg white-text">Filter</h3>
                        <div class="card-body">
                            <p>In diesem Bereich können Sie unsere stets aktuelle Datenbank nach E-Fahrzeugen durchsuchen. Wählen Sie dafür einfach unter den nachfolgenden Überschriften Ihre gewünschten Kriterien aus. Falls gewisse Eigenschaften für Sie irrelevant sind, belassen Sie die Felder einfach auf „beliebig“.</p>
                        </div>                        
                    </div>
                </div>
            </div>

            <div class="row mt-3 wow fadeIn" data-wow-delay="0.5s" id="filter">
                <div class="col-md-12">
                    <form action="" name="filterForm" id="filterForm" method="post">

                        <div class="row">

                            <div class="col-md-6">
                                
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Hersteller
                                        <div id="hersteller">
                                            <select multiple="multiple" id="herstellerSelect" name="marke[]" class="form-control">
                                               <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                    // generiert eine Liste mit allen Marken aus der Datenbank
                                                    $SQL = "SELECT * FROM Automarke";
                                                        foreach ($pdo->query($SQL) as $row) {
                                                            echo '<option value="'.$row['Automarke_ID'].'" data-tokens="'.$row['Automarke'].'">'.$row['Automarke'].'</option>';
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </li>
                                   
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            Hybrid oder rein elektrisch?
                                            <div id="hybrid-toggle">
                                                <input id="hybridInput" name="hybrid" type="checkbox" data-toggle="toggle" data-on="Hybrid & elektrisch" data-off="rein elektrisch" data-width="200" onstyle="info" class="form-control">
                                            </div>
                                        </div>
                                        <div id="verbrauch" style="display: none;">
                                            max. Verbrauch
                                            <div>
                                                <select id="verbrauchSelect" name="verbrauch" class="form-control">
                                                   <option value="0" selected="selected">beliebig</option>
                                                    <?php
                                                        $i = 1;
                                                        while ($i < 11) {
                                                            echo  '"<option value="'.$i.'">'.$i.' l/100km</option>';
                                                            $i++;
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Typ
                                        <div id="type">
                                            <select id="typSelect" name="typ[]" multiple="multiple" class="form-control">
                                               <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                    // generiert eine Liste mit allen Marken aus der Datenbank
                                                    $SQL = "SELECT * FROM Autoklasse";
                                                        foreach ($pdo->query($SQL) as $row) {
                                                            echo '<option value="'.$row['Autoklasse_ID'].'" data-tokens="'.$row['Autoklasse'].'">'.$row['Autoklasse'].'</option>';
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Sitzplätze (von/bis)
                                        <div id="type">
                                            <select name="sitzplatz_a" id="sitzplatzVonSeclet" class="form-control">
                                                <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                        $i = 1;
                                                        while ($i < 10) {
                                                            echo  '"<option value="'.$i.'">'.$i.'</option>';
                                                            $i++;
                                                        }
                                                ?>
                                            </select>
                                            <select name="sitzplatz_b" id="sitzplatzBisSeclet" class="form-control">
                                                <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                        $i = 2;
                                                        while ($i < 10) {
                                                            echo  '"<option value="'.$i.'">'.$i.'</option>';
                                                            $i++;
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </li>
                                    
                                </ul>

                            </div>

                            <div class="col-md-6">
                                <ul class="list-group">

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        mind. Kofferraumvolumen
                                        <select name="kofferraum" id="kofferraumSelect" class="form-control">
                                            <option value="0" selected="selected">beliebig</option>
                                            <?php
                                                    $i = 500;
                                                    while ($i < 3001) {
                                                        echo  '"<option value="'.$i.'">'.$i.' Liter</option>';
                                                        $i = $i + 500;
                                                    }
                                            ?>
                                        </select>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Leistung (von/bis)
                                        <div>
                                            <select name="leistung_a" id="leistungVonSelect" class="form-control">
                                                <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                        $i = 50;
                                                        while ($i < 401) {
                                                            echo  '"<option value="'.$i.'">'.$i.' PS</option>';
                                                            $i = $i + 50;
                                                        }
                                                ?>
                                            </select>
                                            <select name="leistung_b" id="leistungBisSelect" class="form-control">
                                                <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                        $i = 50;
                                                        while ($i < 401) {
                                                            echo  '"<option value="'.$i.'">'.$i.' PS</option>';
                                                            $i = $i + 50;
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        min. Reichweite
                                        <div class="float-right">
                                            <select name="reichweite" id="reichweiteSelect" class="form-control">
                                                <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                        $i = 50;
                                                        while ($i < 1001) {
                                                            echo  '"<option value="'.$i.'">'.$i.' km</option>';
                                                            if ($i < 351) {
                                                                $i = $i + 50;
                                                            } else {
                                                                $i = $i + 100;
                                                            }
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        max. Ladezeit
                                        <select name="ladezeit" id="ladezeitSelect" class="form-control">
                                            <option value="0" selected="selected">beliebig</option>
                                            <?php
                                                $i = 3;
                                                while ($i < 11) {
                                                    echo  '"<option value="'.$i.'">'.$i.' h</option>';
                                                    $i = $i + 1;
                                                }
                                            ?>
                                        </select>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Preis (von/bis)
                                        <div>
                                            <select name="preis_a" id="preisVonSelect" class="form-control">
                                                <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                    $i = 5000;
                                                    while ($i < 200001) {
                                                        echo  '"<option value="'.$i.'">'.$i.' €</option>';
                                                        if ($i < 100000) {
                                                            $i = $i + 5000;
                                                        } else {
                                                            $i = $i + 25000;
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <select name="preis_b" id="preisBisSelect" class="form-control">
                                                <option value="0" selected="selected">beliebig</option>
                                                <?php
                                                    $i = 5000;
                                                    while ($i < 200001) {
                                                        echo  '"<option value="'.$i.'">'.$i.' €</option>';
                                                        if ($i < 100000) {
                                                            $i = $i + 5000;
                                                        } else {
                                                            $i = $i + 25000;
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>

                        
                        
                        <div class="text-center mt-3 mb-2">
                            <button type="submit" id="show_results" name="show_results" class="btn btn-lg custom-primary-color-bg btn-ptc mt-3">Ergebnisse anzeigen <i class="fa fa-car right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.Main layout-->

    </main>

    <!--Footer-->
    <footer class="page-footer center-on-small-only">

        <!--Footer logos-->
        <div class="container-fluid d-none-custom">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="http://www.codifey.de/" target="_blank" rel="nofollow"><img src="assets/img/logo-codifey.png" class="mb-5 pb-3 px-2" height="100" alt="CODIFeY"></a>
                
                    <a href="https://www.bmbf.de/" target="_blank" rel="nofollow"><img src="assets/img/logo-BMBF.png" class="mb-4 mt-3 pb-3 px-2" height="200" alt="Bundesministerium für Bildung und Forschung"></a>
               
                    <a href="https://www.ptka.kit.edu/" target="_blank" rel="nofollow"><img src="assets/img/logo-ptka.png" class="mb-5 pb-3 px-2" height="150" alt="Projektträger Karlsruhe"></a>
                </div>
            </div>
        </div>
        <!--/.Footer logos-->
        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        © <?php echo date("Y"); ?> eMobilisten
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline">
                          <li class="list-inline-item"><a data-toggle="modal" data-target="#modalImpressum">Impressum</a></li>
                          <li class="list-inline-item"><a data-toggle="modal" data-target="#modalDatenschutz">Datenschutz</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->

    <button onclick="topFunction()" id="btnBackToTop" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>

    <!-- Impressum Modal -->
    <div class="modal fade top" id="modalImpressum" tabindex="-1" role="dialog" aria-labelledby="modalImpressum" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">Impressum</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <p>Die Anwendung wurde im Rahmen eines Studenten-Projektes von Studenten der TU Chemnitz enwtickelt.
                    <br/>Das Projekt gliedert sich in das <a href="http://www.codifey.de/" target="_blank" rel="nofollow">CODIFeY</a> Projekt ein. Dieses wird vom <a href="https://www.bmbf.de/" target="_blank" rel="nofollow">Bundesministerium für Bildung und Forschung</a> gefördert und vom <a href="https://www.ptka.kit.edu/" target="_blank" rel="nofollow">Projektträger Karlsruhe</a> betreut.</p>
                    <hr/>

                    <h4 class="h4-responsive">Angaben gemäß § 5 TMG</h4>
                    <p>TU Chemnitz
                    <br/>Christoph Kollwitz
                    <br/>Thüringer Weg 7, Raum 218
                    <br/>09126 Chemnitz
                    <br/>
                    <br/>Telefon: +49 (0) 371 531-36249
                    <br/>Email: christoph.kollwitz@wirtschaft.tu-chemnitz.de</p>

                    <hr/>

                    <h4 class="h4-responsive">Inhaltlich Verantwortlicher gemäß § 55 Abs. 2 RStV</h4>
                    <p>Christoph Kollwitz, siehe o.g. Anschrift</p>

                    <hr/>

                    <h4 class="h4-responsive">Technische Umsetzung &amp; Betreuung</h4>
                    <p>Max Scholz
                    <br/>Email: max.scholz@s2015.tu-chemnitz.de</p>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <!-- Datenschutz Modal -->
    <div class="modal fade top" id="modalDatenschutz" tabindex="-1" role="dialog" aria-labelledby="modalDatenschutz" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead">Datenschutz</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <p>Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend der gesetzlichen Datenschutzvorschriften sowie dieser Datenschutzerklärung.
                    <br/>Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten möglich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder E-Mail-Adressen) erhoben werden, erfolgt dies, soweit möglich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben.
                    <br/>Wir weisen darauf hin, dass die Datenübertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen kann. Ein lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich.</p>

                    <div id="datenschutzAccordion" data-children=".item">
                        <div class="item">
                            <a class="h4-responsive" data-toggle="collapse" data-parent="#datenschutzAccordion" href="#accordionHaftungInhalte" aria-expanded="false" aria-controls="accordionHaftungInhalte">Haftung für Inhalte</a>
                            <div id="accordionHaftungInhalte" class="collapse" role="tabpanel">
                                <p>Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.</p>
                            </div>
                        </div>
                        <div class="item">
                            <a class="h4-responsive" data-toggle="collapse" data-parent="#datenschutzAccordion" href="#accordionHaftungLinks" aria-expanded="false" aria-controls="accordionHaftungLinks">Haftung für Links</a>
                            <div id="accordionHaftungLinks" class="collapse" role="tabpanel">
                                <p>Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.</p>
                            </div>
                        </div>
                        <div class="item">
                            <a class="h4-responsive" data-toggle="collapse" data-parent="#datenschutzAccordion" href="#accordionUrheberrecht" aria-expanded="false" aria-controls="accordionUrheberrecht">Urheberrecht</a>
                            <div id="accordionUrheberrecht" class="collapse" role="tabpanel">
                                <p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.</p>
                            </div>
                        </div>
                        <div class="item">
                            <a class="h4-responsive" data-toggle="collapse" data-parent="#datenschutzAccordion" href="#accordionServer" aria-expanded="false" aria-controls="accordionServer">Server-Log-Files</a>
                            <div id="accordionServer" class="collapse" role="tabpanel">
                                <p>Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten Server-Log Files, die Ihr Browser automatisch an uns übermittelt. Dies sind:</p>
                                <ul>
                                    <li>Browsertyp und Browserversion</li>
                                    <li>verwendetes Betriebssystem</li>
                                    <li>Referrer URL</li>
                                    <li>Hostname des zugreifenden Rechners</li>
                                    <li>Uhrzeit der Serveranfrage</li>
                                </ul>
                                <p>Diese Daten sind nicht bestimmten Personen zuordenbar. Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen. Wir behalten uns vor, diese Daten nachträglich zu prüfen, wenn uns konkrete Anhaltspunkte für eine rechtswidrige Nutzung bekannt werden.</p>
                            </div>
                        </div>
                        <div class="item">
                            <a class="h4-responsive" data-toggle="collapse" data-parent="#datenschutzAccordion" href="#accordionALS" aria-expanded="false" aria-controls="accordionALS">Auskunft, Löschung, Sperrung</a>
                            <div id="accordionALS" class="collapse" role="tabpanel">
                                <p>Sie haben jederzeit das Recht auf unentgeltliche Auskunft über Ihre gespeicherten personenbezogenen Daten, deren Herkunft und Empfänger und den Zweck der Datenverarbeitung sowie ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten. Hierzu sowie zu weiteren Fragen zum Thema personenbezogene Daten können Sie sich jederzeit unter der im Impressum angegebenen Adresse an uns wenden.</p>
                            </div>
                        </div>
                        <div class="item">
                            <a class="h4-responsive" data-toggle="collapse" data-parent="#datenschutzAccordion" href="#accordionGA" aria-expanded="false" aria-controls="accordionGA">Google Analytics</a>
                            <div id="accordionGA" class="collapse" role="tabpanel">
                                <p>Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. („Google“). Google Analytics verwendet sog. „Cookies“, Textdateien, die auf Ihrem Computer gespeichert werden und die eine Analyse der Benutzung der Website durch Sie ermöglichen. Die durch das Cookie erzeugten Informationen über Ihre Benutzung dieser Website werden in der Regel an einen Server von Google in den USA übertragen und dort gespeichert. Im Falle der Aktivierung der IP-Anonymisierung auf dieser Website, wird Ihre IP-Adresse von Google jedoch innerhalb von Mitgliedstaaten der Europäischen Union oder in anderen Vertragsstaaten des Abkommens über den Europäischen Wirtschaftsraum zuvor gekürzt. Nur in Ausnahmefällen wird die volle IP-Adresse an einen Server von Google in den USA übertragen und dort gekürzt. Im Auftrag des Betreibers dieser Website wird Google diese Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports über die Websiteaktivitäten zusammenzustellen und um weitere mit der Websitenutzung und der Internetnutzung verbundene Dienstleistungen gegenüber dem Websitebetreiber zu erbringen. Die im Rahmen von Google Analytics von Ihrem Browser übermittelte IP-Adresse wird nicht mit anderen Daten von Google zusammengeführt. Sie können die Speicherung der Cookies durch eine entsprechende Einstellung Ihrer Browser-Software verhindern; wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen dieser Website vollumfänglich werden nutzen können. Sie können darüber hinaus die Erfassung der durch das Cookie erzeugten und auf Ihre Nutzung der Website bezogenen Daten (inkl. Ihrer IP-Adresse) an Google sowie die Verarbeitung dieser Daten durch Google verhindern, indem Sie das unter dem folgenden Link (http://tools.google.com/dlpage/gaoptout?hl=de) verfügbare Browser-Plugin herunterladen und installieren.<br/>Nähere Informationen zu Nutzungsbedingungen und Datenschutz finden Sie unter http://www.google.com/analytics/terms/de.html bzw. unter https://www.google.de/intl/de/policies/. Wir weisen Sie darauf hin, dass auf dieser Website Google Analytics um den Code „anonymizeIp“ erweitert wurde, um eine anonymisierte Erfassung von IP-Adressen (sog. IP-Masking) zu gewährleisten.</p>
                            </div>
                        </div>
                        <p class="mt-3"><em>Quellverweis: <a target="_blank" href="https://www.e-recht24.de/">eRecht24</a></em></p>
                        <hr/>
                        <div class="item">
                            <a class="h4-responsive" data-toggle="collapse" data-parent="#datenschutzAccordion" href="#accordionLizenzrecht" aria-expanded="false" aria-controls="accordionLizenzrecht">Lizenzrecht</a>
                            <div id="accordionLizenzrecht" class="collapse" role="tabpanel">
                                <p>Alle auf dieser Website verwendeten Bilder sind unter <a target="_blank" href="https://creativecommons.org/">Creative Commons</a> bzw. <a target="_blank" href="https://wiki.creativecommons.org/wiki/Public_domain">Public Domain</a> lizenziert.
                                <br/>Die Dateien wurden verändert.
                                <br/>Namen der Ersteller:
                                <br/>
                                <ul>
                                    <li>anthonares</li>
                                    <li>Jwh</li>
                                    <li>Karlis Dambrans</li>
                                    <li>M93</li>
                                    <li>Mariordo (Mario Roberto Duran Ortiz)</li>
                                    <li>Mitsubishi Motors</li>
                                    <li>MotorBlog</li>
                                    <li>Peteratkins</li>
                                    <li>Peter Stevens</li>
                                    <li>Thilo Parg</li>
                                    <li>Thomas Doerfer</li>
                                    <li>Thesupermat</li>
                                    <li>Tokumeigakarinoaoshima</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <!-- Info Modal -->
    <div class="modal fade top" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModal" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <p class="heading lead" id="infoModal">Info</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <p>Smart eChoice ist im Rahmen einer Projektarbeit an der Technischen Universität Chemnitz entstanden.
                    <br/>Die Anwendung soll Nutzer bei der Suche nach für sie passenden Elektrofahrzeugen unterstützen. Dies wird durch eine einfache Filterfunktion umgesetzt.
                    <br/>Die Filterfunktion durchsucht einen Fahrzeugkatalog innerhalb der Anwendung nach Eckdaten, die vom Nutzer eingegeben werden können.</p>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap dropdown -->
    <script type="text/javascript" src="assets/js/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>

    <!-- Modal Bootstrap Plugin -->
    <script type="text/javascript" src="assets/plugins/enhanced-modals.min.js"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="assets/js/custom.js"></script>
    
    <!-- Boostrap Select/Toggle Plugins Styles -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-multiselect.css" type="text/css"/>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Bootstrap Select/Toggle Plugins -->
    <script type="text/javascript" src="assets/plugins/bootstrap-multiselect.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

        	// init (multi) select inputs
            $('#herstellerSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg',
                maxHeight: 200
            });
            $('#typSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg',
                maxHeight: 200
            });
            $('#verbrauchSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg'
            });
            $('#sitzplatzVonSeclet').multiselect({
                buttonClass: 'btn custom-primary-color-bg'
            });
            $('#sitzplatzBisSeclet').multiselect({
                buttonClass: 'btn custom-primary-color-bg'
            });
            $('#kofferraumSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg'
            });
            $('#leistungVonSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg'
            });
            $('#leistungBisSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg'
            });
            $('#reichweiteSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg',
                maxHeight: 200
            });
            $('#ladezeitSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg'
            });
            $('#preisVonSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg',
                maxHeight: 200
            });
            $('#preisBisSelect').multiselect({
                buttonClass: 'btn custom-primary-color-bg',
                maxHeight: 200
            });

            // fix toggle
            $('.toggle-handle').removeClass("btn-default");
            $('.toggle-handle').addClass("btn-danger");
            $('.toggle-off').removeClass("btn-default");
            $('.toggle-off').addClass("custom-primary-color-bg");

            $(function() {
                $('#hybridInput').change(function() {
                    var x = document.getElementById('verbrauch');
                    if (x.style.display === 'none') {
                        x.style.display = 'block';
                    } else {
                        x.style.display = 'none';
                    }
                });
            });

            setTimeout(function() { // automatically close alert and remove it if the users doesnt close within 5 secs
	        	$("#hinweis").remove();
	        }, 5000);
        });
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-56500116-8', 'auto');
      ga('send', 'pageview');

    </script>

  </body>

</html>