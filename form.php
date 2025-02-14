<?php
// Déclaration d'une classe appelée Form pour générer et valider un formulaire HTML
class Form
{
    // Propriétés publiques et privées utilisées pour gérer le formulaire
    public $action;       // URL où le formulaire sera envoyé
    public $method;       // Méthode d'envoi du formulaire (GET ou POST)
    private $formHtml;    // Contenu HTML du formulaire
    private $formValidate; // Message de validation après soumission du formulaire
    private $name;        // Nom de l'utilisateur, récupéré à partir du formulaire
    private $value = '';  // Valeur par défaut pour les champs du formulaire
    private $placeholder = ''; // Placeholder pour les champs du formulaire
    private $error;       // Tableau contenant les messages d'erreur
    private $type;
    private $arrayValue;

    // Constructeur : initialise le formulaire avec l'action et la méthode spécifiées
    public function __construct($action, $method)
    {
        $this->formHtml = "<form action='" . $action . "' method='" . $method . "' id='form'>";
        $this->formHtml .= "<fieldset>"; // Ajout d'un fieldset pour regrouper les champs
    }

    // Méthode pour ajouter un champ de texte au formulaire
    public function setText($name, $value, $placeholder)
    {
        // Génération du champ de texte avec les attributs fournis
        $this->formHtml .= "<input class='field' type='text' name='" . $name . "' value='" . $value . "' placeholder='" . $placeholder . "' />";

        $this->name = $name; // Stockage du nom du champ

        // Validation des données saisies
        $this->error = $this->validateData();

        // Affichage du message d'erreur associé, s'il existe
        if (isset($this->error[$name])) {
            $this->formHtml .= "<span class='error'>" . $this->error[$name] . "</span>";
        }
    }

    // Méthode privée pour valider les données du formulaire
    private function validateData()
    {
        $this->error = []; // Initialisation du tableau d'erreurs

        // Vérifie si des données ont été soumises via la méthode GET
        if (!empty($_GET)) {
            $firstname = $_GET["prenom"] ?? null;
            $name = $_GET["nom"] ?? null;
            $email = $_GET["email"] ?? null;

            // Validation du prénom : requis et minimum 3 caractères
            if (!$firstname) {
                $this->error["prenom"] = "Votre prénom est requis";
            } else {
                if (strlen(trim($firstname)) < 3) {
                    $this->error['prenom'] = "Minimum 3 caractères requis";
                }
            }

            // Validation du nom : requis et minimum 3 caractères
            if (!$name) {
                $this->error['nom'] = "Votre nom est requis";
            } else {
                if (strlen(trim($name)) < 3) {
                    $this->error['nom'] = "Minimum 3 caractères requis";
                }
            }

            // Validation de l'email : requis et doit être une adresse valide
            if (!$email) {
                $this->error["email"] = "Votre email est requis";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->error["email"] = "Votre email n'est pas valide";
                }
            }
        }

        return $this->error; // Retourne le tableau des erreurs
    }

    // Méthode pour ajouter un bloc bouton radio 
    public function setCheck($type, $arrayValue){

        for($i =0; $i <= count($arrayValue)-1; $i++ ){
            $this->formHtml .= "<div  class ='check'>";
            $this->formHtml .= "<input type='".$type."' id='".$arrayValue[$i]."' name='drone' value='".$arrayValue[$i]."' />";
            $this->formHtml .= "<label for='".$arrayValue[$i]."'>".$arrayValue[$i]."</label>";
            $this->formHtml .= "</div>";
        }
   

    }

    // Méthode pour ajouter un bouton de soumission au formulaire
    public function setSubmit($value)
    {
        $this->formHtml .= "<button type='submit'>" . $value . "</button>";
    }

    // Méthode pour obtenir le formulaire complet sous forme de chaîne HTML
    public function getForm()
    {
        // Fermeture des balises fieldset et form
        $this->formHtml .= '</fieldset>';
        $this->formHtml .= '</form>';

        // Si aucune donnée n'a été soumise ou s'il y a des erreurs, on retourne le formulaire
        if (empty($_GET) || !empty($this->error)) {
            return $this->formHtml;
        } else {
            // Récupération du nom soumis dans le formulaire
            $submittedName = $_GET['prenom'] ?? 'utilisateur';
            // Si les données sont valides, on affiche un message de validation
            $this->formValidate = "<h2>Bravo " . $submittedName . ", vous êtes prêt pour l'exercice suivant</h2>";
            return $this->formValidate;
        }
    }
}
