<?php

    session_start();

    require_once 'assets/scripts/DBConnect.php';

    $sql_filter = $_SESSION['filter_sql_temp'];

?>

<!DOCTYPE html>
<html lang="en" class="no-js">

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

    <title>Smart eChoice | Ergebnisse</title>

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

    <!-- DataTables Styes -->
    <link rel="stylesheet" type="text/css" href="assets/plugins/DataTables/datatables.min.css"/>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(assets/img/preloader.gif) center no-repeat #fff;
    }
    </style>

  </head>

  <body>

    <div class="se-pre-con"></div>

    <header>

        <nav class="navbar navbar-expand-lg white navbar-dark fixed-top scrolling-navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php" rel="nofollow">
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
    </header>

    <main>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="card-header border-0 custom-primary-color-bg white-text">Ergebnisse</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center mt-3 mb-3">
                        <a href="filter.php" class="btn custom-primary-color-bg btn-ptc" rel="nofollow"><i class="fa fa-arrow-left left"></i> Zurück zum Filter</a>
                        <a id="btnTable" class="btn custom-primary-color-bg btn-ptc" rel="nofollow" ><i class="fa fa-list left"></i> Tabellenansicht</a>
                        <a id="btnGrid" style="display:none;" class="btn custom-primary-color-bg btn-ptc" rel="nofollow"><i class="fa fa-th-large left"></i> Kartenansicht</a>
                    </div>
                </div>
            </div>
            <div id="tableView" class="row" style="display:none;">
                <div class="col-md-12">
                    <div class="border-custom">
                        <table id="carTable" class="table table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Marke</th>
                                <th>Modell</th>
                                <th>minimaler Preis</th>
                                <th>Reichweite</th>
                                <th>Leistung</th>
                                <th>Ladestecker</th>
                                <th>maximale Geschwindigkeit</th>
                                <th>Sitzplätze</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th>Marke</th>
                                <th>Modell</th>
                                <th>minimaler Preis</th>
                                <th>Reichweite</th>
                                <th>Leistung</th>
                                <th>Ladestecker</th>
                                <th>maximale Geschwindigkeit</th>
                                <th>Sitzplätze</th>
                              </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $filter_results = $pdo->query($sql_filter);

                                foreach ($filter_results as $row) {
                                      echo '<tr>';

                                      $sql_automarke_temp = "SELECT `Automarke` FROM `Automarke` WHERE `Automarke_ID`=$row[1]";
                                      $automarke_temp=$pdo->query($sql_automarke_temp);
                                      if ($row[1]==0) {
                                          echo "<td></td>";
                                      } else {
                                          foreach ($automarke_temp as $automarke_row) {
                                              echo "<td>$automarke_row[Automarke]</td>";
                                          }
                                      }

                                      echo '<td>'.$row['Modell'].'</td>';
                                      echo '<td>'.$row['Preis_min'].' €'.'</td>';
                                      echo '<td>'.$row['Reichweite'].' km'.'</td>';
                                      echo '<td>'.$row['Leistung'].' PS'.'</td>';
                                      echo '<td>'.$row['Ladestecker'].'</td>';
                                      echo '<td>'.$row['Geschwindigkeit_max'].' km/h'.'</td>';
                                      echo '<td>'.$row['Sitzplaetze'].'</td>';
                                }
                                echo "</tbody>";
                                echo "</table>";
                            ?>
                            </tbody>
                        </table>   
                    </div>
                </div>
                <div id="height-helper"></div>
            </div>
            <div id="gridView" class="row">
                    <?php
                        $filter_results = $pdo->query($sql_filter);

                        if($filter_results->rowCount() == 0) {
                            echo '<div class="col-md-12" id="noResults"><div class="card info-color text-center z-depth-2"><div class="card-body"><p class="white-text mb-0">Keine Ergebnisse gefunden. Bitte gehen Sie zurück zum Filter.</p></div></div></div>';
                        }
                        else {
                            foreach ($filter_results as $row) {
                                    echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">';
                                        echo '<div class="card mb-4">';

                                        $sql_automarke_temp = "SELECT `Automarke` FROM `Automarke` WHERE `Automarke_ID`=$row[1]";
                                        $automarke_temp=$pdo->query($sql_automarke_temp);
                                        
                                        if ($row[1]==0) {
                                            echo "";
                                        } else {
                                            foreach ($automarke_temp as $automarke_row) {
                                                if ($row['image_stecker']== "") {
                                                    echo '<h4 class="card-header text-left"><span class="autoname">'.$automarke_row[Automarke]. ' ' .$row['Modell'].'</span><span class="badge badge-info float-right">'.$row['Ladestecker'].'</span></h4>';
                                                } else {
                                                    echo '<h4 class="card-header text-left"><span class="autoname">'.$automarke_row[Automarke]. ' ' .$row['Modell'].'</span><img src="'.$row['image_stecker'].'" class="float-right img-stecker"></h4>';
                                                }
                                            }
                                        }
                                        echo '<img class="img-fluid" src="'.$row['image_path'].'">';
                                        echo '<div class="card-body">';
                                            echo '<ul class="list-group list-group-flush">';

                                                echo '<li class="list-group-item"><i class="fa fa-eur left"></i> min. Preis <span class="float-right">'.$row['Preis_min'].' EUR</i></span></li>';

                                                echo '<li class="list-group-item"><i class="fa fa-road left"></i> max. Reichweite <span class="float-right">'.$row['Reichweite'].' km</span></li>';
                                                
                                                echo '<li class="list-group-item"><i class="fa fa-gears left"></i> Leistung <span class="float-right">'.$row['Leistung'].' PS</span></li>';
                                                
                                                echo '<li class="list-group-item"><i class="fa fa-flag-checkered left"></i> max. Geschw. <span class="float-right">'.$row['Geschwindigkeit_max'].' km/h</span></li>';

                                            echo '</ul>';
                                        echo '</div>';

                                        echo '<div class="card-footer p-0">';
                                            
                                            echo '<div class="text-center"><br/><a class="card-link black-text" href="https://www.google.com/search?tbm=isch&q='.$automarke_row['Automarke'].'+'.$row['Modell'].'" target="_blank">Bildersuche</a><a class="card-link black-text" href="https://www.google.de/maps/search/'.$automarke_row['Automarke'].'+Händler" target="_blank">Händlersuche</a><br/><br/></div>';
                                            
                                            echo '<button type="button" class="btn custom-primary-color-bg btn-block" data-toggle="modal" data-target="#modalComments-'.$row['Automarke_ID']. '-' .$row['Car_ID'].'">Kommentare</button>';

                                            echo '<div class="modal fade" id="modalComments-'.$row['Automarke_ID']. '-' .$row['Car_ID'].'" tabindex="-1" role="dialog" aria-labelledby="modalComments-'.$row['Automarke_ID'].'" aria-hidden="true">
                                                    <div class="modal-dialog modal-notify modal-info modal-fluid mt-0" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalComments'.$row['Automarke_ID']. '-' .$row['Car_ID'].'Label"><strong>Kommentare</strong> '.$automarke_row['Automarke']. ' ' .$row['Modell'].'</h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">'; ?>

                                                                <div class="row">

                                                                     <div class="col-12">
                                                                        <h5 class="mb-3"><strong>Kommentare</strong></h5>

                                                                        <div class="mb-3">

                                                                            <?php
                                                                                $SQL_comments = "SELECT * FROM Comments WHERE Car_ID=".$row['Car_ID'];

                                                                                $filter_results_comments = $pdo->query($SQL_comments);

                                                                                if($filter_results_comments->rowCount() == 0) {
                                                                                    echo '<p>Bis jetzt gibt es noch keine Kommentare zu diesem Fahrzeug. Seien Sie der/die Erste...</p>';
                                                                                } else {
                                                                                    echo '<ul id="comments">';
                                                                                    foreach ($filter_results_comments as $rowComment) {
                                                                                        echo '<li class="cmmnt">
                                                                                                <div class="avatar"><img src="assets/img/avatar.png" width="55" height="55" alt="avatar"></div>
                                                                                                <div class="cmmnt-content">
                                                                                                    <header>'.$rowComment['Name'].' <span class="pubdate">'.$rowComment['Datum'].'</span></header>
                                                                                                    <p>'.$rowComment['Kommentar'].'</p>
                                                                                                </div>
                                                                                            </li>';
                                                                                    }
                                                                                    echo '</ul>';
                                                                                }
                                                                            ?>

                                                                        </div>

                                                                        <hr/>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <h5 class="mb-3"><strong>Hinterlassen Sie einen Kommentar zum Fahrzeug.</strong></h5>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="md-form">
                                                                                    <input type="text" name="formName-<?php echo $row['Car_ID']; ?>" id="formName-<?php echo $row['Car_ID']; ?>" class="form-control-sm" required>
                                                                                    <label for="formName-<?php echo $row['Car_ID']; ?>">Name (erforderlich)</label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col">
                                                                                <div class="md-form">
                                                                                    <input type="email" name="formEmail-<?php echo $row['Car_ID']; ?>" id="formEmail-<?php echo $row['Car_ID']; ?>" class="form-control-sm" required>
                                                                                    <label for="formEmail-<?php echo $row['Car_ID']; ?>">Email (erforderlich)</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="md-form">
                                                                                    <textarea type="text" name="formComment-<?php echo $row['Car_ID']; ?>" id="formComment-<?php echo $row['Car_ID']; ?>" class="form-control md-textarea" rows="3" required></textarea>
                                                                                    <label for="formComment-<?php echo $row['Car_ID']; ?>">Kommentar (erforderlich)</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="text-center mt-4">
                                                                                    <button id="formBtn-<?php echo $row['Car_ID']; ?>" name="formBtn" class="btn custom-primary-color-bg" type="submit" value="submit" onclick="checkFormAndSubmit(<?php echo $row['Car_ID']; ?>)">Abschicken<i class="fa fa-paper-plane-o ml-2"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                <?php echo '</div>
                                                            <div class="modal-footer p-0">
                                                                <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';                                                                            
                                        echo '</div>';

                                    echo '</div>';
                                echo '</div>';
                            }
                        }
                    ?>
            </div>
        </div>

    </main>

    <footer class="page-footer center-on-small-only">

        <div class="container-fluid d-none-custom">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="http://www.codifey.de/" target="_blank" rel="nofollow"><img src="assets/img/logo-codifey.png" class="mb-5 pb-3 px-2" height="100" alt="CODIFeY"></a>
                
                    <a href="https://www.bmbf.de/" target="_blank" rel="nofollow"><img src="assets/img/logo-BMBF.png" class="mb-4 mt-3 pb-3 px-2" height="200" alt="Bundesministerium für Bildung und Forschung"></a>
               
                    <a href="https://www.ptka.kit.edu/" target="_blank" rel="nofollow"><img src="assets/img/logo-ptka.png" class="mb-5 pb-3 px-2" height="150" alt="Projektträger Karlsruhe"></a>
                </div>
            </div>
        </div>
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

    </footer>

    <button onclick="topFunction()" id="btnBackToTop" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>

    <a id="btnLegende" class="btn custom-primary-color-bg btn-ptc" rel="nofollow" data-toggle="modal" data-target="#modalLegende">Steckertypen anzeigen</a>

    <div class="modal fade" id="modalLegende" tabindex="-1" role="dialog" aria-labelledby="modalLegende" aria-hidden="true">
        <div class="modal-dialog modal-md modal-notify modal-info" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="heading lead">Steckertypen</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CHAdeMO
                            <img src="assets/img/stecker/icon-chademo-stecker.png" class="float-right img-stecker" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            SchuKo (Haushaltssteckdose)
                            <img src="assets/img/stecker/icon-schuko.png" class="float-right img-stecker" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Typ 1
                            <img src="assets/img/stecker/icon-typ-1-stecker.png" class="float-right img-stecker" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Typ 2
                            <img src="assets/img/stecker/icon-typ-2-stecker.png" class="float-right img-stecker" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Typ 2 Combined Charging System (CCS) Combo
                            <img src="assets/img/stecker/icon-typ-2-css-combo-stecker.png" class="float-right img-stecker" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CEE Typ B
                            <img src="assets/img/stecker/icon-cee-b.png" class="float-right img-stecker" />
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            VTOG 30kW AC
                            <img src="assets/img/stecker/icon-generic.png" class="float-right img-stecker" />
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Impressum Modal -->
    <div class="modal fade top" id="modalImpressum" tabindex="-1" role="dialog" aria-labelledby="modalImpressum" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="heading lead">Impressum</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

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
                <div class="modal-footer">
                    <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Datenschutz Modal -->
    <div class="modal fade top" id="modalDatenschutz" tabindex="-1" role="dialog" aria-labelledby="modalDatenschutz" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="heading lead">Datenschutz</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

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
                <div class="modal-footer">
                    <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Modal -->
    <div class="modal fade top" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModal" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-top modal-notify modal-info" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="heading lead" id="infoModal">Info</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Smart eChoice ist im Rahmen einer Projektarbeit an der Technischen Universität Chemnitz entstanden.
                    <br/>Die Anwendung soll Nutzer bei der Suche nach für sie passenden Elektrofahrzeugen unterstützen. Dies wird durch eine einfache Filterfunktion umgesetzt.
                    <br/>Die Filterfunktion durchsucht einen Fahrzeugkatalog innerhalb der Anwendung nach Eckdaten, die vom Nutzer eingegeben werden können.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-primary-color-bg" data-dismiss="modal">Schließen</button>
                </div>
            </div>
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

    <!-- DataTables Plugin -->
    <script type="text/javascript" src="assets/plugins/DataTables/datatables.min.js"></script>

    <!-- Custom JS -->
    <script type="text/javascript" src="assets/js/custom.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

    <script type="text/javascript">

        $(window).on('load', function(){ 
            $(".se-pre-con").fadeOut("slow");
        });

        $(document).ready(function(){

            $("#btnTable").click(function(){
                $("#gridView").hide();
                $("#btnTable").hide();
                $("#btnLegende").hide();
                $("#tableView").show();
                $("#btnGrid").show();
            });

            $("#btnGrid").click(function(){
                $("#tableView").hide();
                $("#btnGrid").hide();
                $("#gridView").show();
                $("#btnTable").show();
                $("#btnLegende").show();
            });

            $('#carTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        download: 'open'
                    }
                ],
                "language": {
                    "decimal":        ",",
                    "emptyTable":     "Keine Daten vorhanden.",
                    "info":           "Zeige _START_ bis _END_ von _TOTAL_ Einträgen",
                    "infoEmpty":      "Zeige 0 bis 0 von 0 Einträgen",
                    "infoFiltered":   "(gefiltert von _MAX_ Gesamteinträgen)",
                    "infoPostFix":    "",
                    "thousands":      ".",
                    "lengthMenu":     "Zeige _MENU_ Einträge",
                    "loadingRecords": "Laden...",
                    "processing":     "Verarbeiten...",
                    "search":         "Suche:",
                    "zeroRecords":    "Keine Einträge gefunden.",
                    "paginate": {
                        "first":      "Erste",
                        "last":       "Letzte",
                        "next":       "Nächste",
                        "previous":   "Vorherige"
                    }
                }
            });

            // Tooltips Initialization
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            });
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

    <script type="text/javascript">

        function validateEmail($email) {
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return emailReg.test( $email );
        }

        function checkFormAndSubmit(carID) {

            var name = document.getElementById("formName-"+carID).value;
            var email = document.getElementById("formEmail-"+carID).value;
            var kommentar = document.getElementById("formComment-"+carID).value;

            if(name == "" || email == "" || kommentar == "") {
                alert('Bitte alle Felder ausfüllen.');
            } else if (!validateEmail(email)) {
                alert('Email nicht gültig.');
            } else {
                xmlhttp = new XMLHttpRequest();

                var params = "carID=" + carID + "&name=" + name + "&email=" + email + "&kommentar=" + kommentar;

                xmlhttp.onreadystatechange = function() {
                    if(this.readyState < 4) {
                        // processing
                    }
                    if (this.readyState == 4) {

                        if(this.status == 200) {
                            // success
                            alert('Kommentar gespeichert.');
                            location.reload();
                        }
                        else {
                            // error
                            alert('Ein Fehler ist aufgetreten, bitte Administrator kontaktieren.');
                        }
                    }
                };

                xmlhttp.open("POST", "assets/scripts/saveComment.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(params);
            }
        }
    </script>

  </body>

</html>