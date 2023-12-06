<?php
include("../includes/bddlog.php");
include("../includes/header.php");
include("../includes/nav.php");
session_start();


$sqlclasse = "SELECT nomClasse FROM Classe WHERE idClasse=" . $_SESSION['value'];
$result = $conn->query($sqlclasse);
$classe = $result->fetch();
$nomClasse = $classe[0];

?>

<div class="classe-panel">

    <div class="class-tab">
        <table class="liste">
            <tr class="titleclasse">
                <th>
                    <?php echo $nomClasse ?>
                </th>
            </tr>
            <?php

            $tab_id = array();
            $tab_id_abs = array();

            $sqlnom = "SELECT * FROM Eleve WHERE idClasse=" . $_SESSION['value'] . " AND statusEleve=0";
            $resultnom = $conn->query($sqlnom);
            $noms = $resultnom->fetchAll();
            foreach ($noms as $nom) {
                $idEleve = $nom[0];
                $nomEleve = $nom[1];
                $prenomEleve = $nom[2];

                echo "<tr><td>$nomEleve $prenomEleve</td></tr>";

                array_push($tab_id, $idEleve);
            }
            $sqlnomabs = "SELECT * FROM Eleve WHERE idClasse=" . $_SESSION['value'] . " AND statusEleve=2";
            $resultnomabs = $conn->query($sqlnomabs);
            $nomsabs = $resultnomabs->fetchAll();
            foreach ($nomsabs as $nomabs) {
                $idEleveabs = $nomabs[0];

                array_push($tab_id_abs, $idEleveabs);
            }
            ?>

        </table>

    </div>

    <div class="class-add">

        <div class="tirage">
            <form method="post">
                <input name="random" type="submit" value="Tirage">
                <input name="randomabs" type="submit" value="Tirage Absent">
                <input class="reset" name="reset" type="submit" value="reset">
                <input name="A" type="submit" value="A">
                <input name="1" type="submit" value="1">
                <input name="3" type="submit" value="3">
            </form>
            <?php
            if (isset($_SESSION["msg"])) {
                echo $_SESSION["msg"];
            }
            if (isset($_POST['random'])) {
                shuffle($tab_id);

                if (!empty($tab_id)) {
                    $nombre_tire = array_shift($tab_id);
                    $_SESSION['tire'] = $nombre_tire;

                    $sqltirage = "SELECT * FROM Eleve WHERE idEleve=" . $nombre_tire;
                    $resulttirage = $conn->query($sqltirage);
                    $names = $resulttirage->fetchAll();
                    foreach ($names as $name) {
                        $idEleveR = $name[0];
                        $_SESSION['tire'] = $idEleveR;
                        $nomEleveR = $name[1];
                        $prenomEleveR = $name[2];
                    }

                    // $sqlstatus = "UPDATE Eleve SET statusEleve=1 WHERE idEleve=$nombre_tire";
                    //  $conn->query($sqlstatus);

                    $nom_stock = "L'élève " . $nomEleveR . " " . $prenomEleveR . " est tiré !";
                    $_SESSION["stock"] = $nomEleveR . " " . $prenomEleveR;

                    if (!empty($nom_stock)) {
                        $_SESSION["msg"] = "<p>$nom_stock</p>";
                        header("Refresh:0");
                    }
                } else {

                    $_SESSION["msg"] = "<p>Tous les élèves sont passés</p>";
                    header("Refresh:0");
                }
            }
            if (isset($_POST['randomabs'])) {
                shuffle($tab_id_abs);

                if (!empty($tab_id_abs)) {
                    $nombre_tire = array_shift($tab_id_abs);
                    $_SESSION['tire'] = $nombre_tire;

                    $sqltirage = "SELECT * FROM Eleve WHERE idEleve=" . $nombre_tire;
                    $resulttirage = $conn->query($sqltirage);
                    $names = $resulttirage->fetchAll();
                    foreach ($names as $name) {
                        $idEleveR = $name[0];
                        $_SESSION['tire'] = $idEleveR;
                        $nomEleveR = $name[1];
                        $prenomEleveR = $name[2];
                    }

                    // $sqlstatus = "UPDATE Eleve SET statusEleve=1 WHERE idEleve=$nombre_tire";
                    //  $conn->query($sqlstatus);

                    $nom_stock = "L'élève " . $nomEleveR . " " . $prenomEleveR . " est tiré !";
                    $_SESSION["stock"] = $nomEleveR . " " . $prenomEleveR;

                    if (!empty($nom_stock)) {
                        $_SESSION["msg"] = "<p>$nom_stock</p>";
                        header("Refresh:0");
                    }
                } else {

                    $_SESSION["msg"] = "<p>Tous les élèves sont passés</p>";
                    header("Refresh:0");
                }
            }
            ?>
            <table class="absent">
                <th class="titleabsent">
                    Absent(s) au(x) dernier(s) tirage(s):
                </th>

                <?php


                $sqlabs = "SELECT * FROM Eleve WHERE idClasse=" . $_SESSION['value'] . " AND statusEleve=2";
                $resultabs = $conn->query($sqlabs);
                $abss = $resultabs->fetchAll();
                foreach ($abss as $abs) {
                    $idabs = $abs[0];
                    $nomabs = $abs[1];
                    $prenomabs = $abs[2];

                    echo "<tr><td>$nomabs $prenomabs</td></tr>";
                } ?>
            </table>
            <table class="note">
                <th class="titleeleve">
                    Eleve(s) noté(s):
                </th>

                <?php


                $sqlnote = "SELECT * FROM Eleve WHERE idClasse=" . $_SESSION['value'] . " AND statusEleve=1";
                $resultnote = $conn->query($sqlnote);
                $notes = $resultnote->fetchAll();
                foreach ($notes as $note) {
                    $idNote = $note[0];
                    $nomNote = $note[1];
                    $prenomNote = $note[2];
                    $noteEleve = $note[3];

                    echo "<tr><td>$nomNote $prenomNote $noteEleve point(s)</td></tr>";
                }
                if (isset($_POST['A'])) {
                    $sqla = "UPDATE Eleve SET statusEleve=2 WHERE idEleve=" . $_SESSION['tire'];
                    $conn->query($sqla);
                    $nombre_tire = 0;
                    $_SESSION["msg"] = "<p>" . $_SESSION["stock"] . " est noté absent !</p>";
                    header("Refresh:0");
                }
                if (isset($_POST['1'])) {
                    $sqlnote1 = "UPDATE Eleve SET statusEleve=1, pointEleve=1 WHERE idEleve=" . $_SESSION['tire'];
                    $conn->query($sqlnote1);
                    $nombre_tire = 0;
                    $_SESSION["msg"] = "<p>" . $_SESSION["stock"] . " a obtenu 1 point !</p>";
                    header("Refresh:0");
                }
                if (isset($_POST['3'])) {
                    $sqlnote3 = "UPDATE Eleve SET statusEleve=1, pointEleve=3 WHERE idEleve=" . $_SESSION['tire'];
                    $conn->query($sqlnote3);
                    $nombre_tire = 0;
                    $_SESSION["msg"] = "<p>" . $_SESSION["stock"] . " a obtenu 3 points !</p>";
                    header("Refresh:0");
                }


                if (isset($_POST['reset'])) {
                    $sqlreset = "UPDATE Eleve SET statusEleve=0, pointEleve=0";
                    $conn->query($sqlreset);
                    $_SESSION["msg"] = "<p>La roulette a été réinitialisé !</p>";
                    header("Refresh:0");
                }

                if (empty($_SESSION["msg"])) {
                    $_SESSION["msg"] = "<p>Appuyez sur le tirage pour commencez la roulette !</p>";
                }
                ?>
            </table>
        </div>

    </div>
</div>

<?php echo '<script>history.replaceState(null,null,"?' . time() . '");</script>'; ?>