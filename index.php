<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>POO-Greta</title>
</head>

<body>

    <section>
        <h1>
            EXERCICE PHP POO (Programation objet)
        </h1>

        <?php
        include("nav.php");

        $myNav = new navigation("menu");
        $myNav->addItem("index.php", "Exercice 1");
        $myNav->addItem("#", "Exercice 2");
        $myNav->addItem("#", "Exercice 3");
        $myNav->addItem("#", "Exercice 4");

        echo $myNav->getNav();

        ?>

        <h2>
            Le Formulaire dynamique - <a href="https://github.com/GRETA-Kercode9/PHP-POO/tree/main">Solution -> Thierry</a>
        </h2>

        <?php
        include("form.php");


            $form = new Form("index.php", "get");
            $form->setText("prenom",$_GET["prenom"] ?? '', "Entrer votre prenom:");
            $form->setText("nom",$_GET["nom"] ?? '', "Entrer votre nom: ");
            $form->setText("email",$_GET["email"] ?? '', "Entrer votre email: ");
            $form->setCheck("radio",["non précisé","masculin","feminin"]);
            $form->setSubmit("Envoyer");
            echo $form->getForm();
            


        ?>

    </section>


</body>

</html>