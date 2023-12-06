<?php

include("includes/bddlog.php");
include("includes/header.php");
include("includes/nav.php");

?>

<form method="post">
    <select name="classes" class="classes-select">
        <option value="default"> - Sélectionner une classe - </option>

        <?php

        $sql = "SELECT * FROM Classe";
        $result = $conn->query($sql);
        $classes = $result->fetchAll();
        foreach ($classes as $classe) {
            $nom_classe = $classe[1];
            $id_classe = $classe[0];

            echo "<option value=" . $id_classe . ">" . $nom_classe . "</option>";
        }

        ?>

    </select>
    <input name="submit" type="submit">
</form>

<?php

if (isset($_POST['submit'])) {
    if ($_POST['classes'] == "default") {
        echo '<p>Veuillez choisir une classe !</p>';
    } else {
        if (!empty($_POST['classes'])) {
            $value = $_POST['classes'];
            $_SESSION["value"] = $value;
            header("Location: vue/classe.php");
        }
    }
}

include('includes/footer.php');
?>