<?php

namespace LeProf\Core;

class Form
{
    private $formCode = '';

    /**
     * Génère le formulaire html
     *
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    /**
     * Valide si tous les champs proposés sont remplis
     * @param array $form Tableau issu du fourmulaire ($_POST, $_GET)
     * @param array $ranges Tableau listant les champs obligatoires
     * @return bool
     */
    public static function validate(array $form, array $ranges)
    {
        // On parcours les champs (ranges)
        foreach($ranges as $range){
            // On vérifie si le champ est abbsent ou vide dans le formulaire
            if(!isset($form[$range]) || empty($form[$range])){
                // On sort en retournant false
                return false;
            }
        }
        return true;
    }

    /**
     * Ajoute les attributrs envoyés à la balise
     *
     * @param array $attributes Tableau associatif [ex : 'class' => 'form-control', 'required' => 'true']
     * @return string Chaine de caractères générée
     */
    private function addAttributes(array $attributes): string
    {
        // On initialise une chaine de caractères
        $str = '';

        // On liste les attributs courts
        $shorts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate', 'selected'];
        
        // On boucle sur le tableau d'attributs
        foreach($attributes as $attribute => $value){
            // Si l'attribut est dans la liste des attributs courts
            if(in_array($attribute, $shorts) && $value == true){
                // On ajoute un espace à notre attribut dans la chaine de caractères
                $str .= " $attribute";
            }else{
                // On ajoute attribute='value'
                $str .= " $attribute='$value'";
            }
        }
        return $str;
    }

    /**
     * Balise d'ouverture du formulaire
     * @param string $action Action du formulaire
     * @param string $method Méthode  du formulaire post ou get
     * @param array $attributes Attributs
     * @return self
     */
    public function initForm(string $action = '#', string $method = 'post', array $attributes = []): self
    {
        // On crée la balise form
        $this->formCode .= "<form action='$action' method='$method'";

        // On ajoute les attributs éventuels
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    /**
     * Balise de fermeture du formulaire
     *
     * @return Form
     */
    public function endForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    /**
     * Ajout d'un label
     * @param string $for
     * @param string $text
     * @param array $attributes
     * @return self
     */
    public function addLabelFor(string $for, string $text, array $attributes = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<label for='$for'";

        // On ajoute les attributs
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        // On ajoute le texte
        $this->formCode .= ">$text</label>";

        return $this;
    }

    public function addInput(string $type, string $name, array $attributes = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<input type='$type' name='$name'";

        // S'il y'a des attributs, on les ajoute
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    public function addTextarea(string $name, string $value = '', array $attributes = []): self
    {
        // On ouvre la balise
        $this->formCode .= "<textarea name='$name'";

        // On ajoute les attributs
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        // On ajoute le texte
        $this->formCode .= ">$value</textarea>";

        return $this;
    }

    public function addSelect(string $name, array $options, array $attributes = []): self
    {
        // On crée le select
        $this->formCode .= "<select name='$name'";

        // On ajoute les attributs
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        // On ajoute les options
        foreach($options as $value => $text){
            $this->formCode .= "<option value='$value'>$text</option>";
        }

        // On ferme le select
        $this->formCode .= "</select>";

        return $this;
    }

    public function addButton(string $text, array $attributes = []): self
    {
        // On ouvre le bouton
        $this->formCode .= '<button';

        //On ajoute les attributs
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        // On ajoute le texte et on ferme le bouton
        $this->formCode .= ">$text</button>";

        return $this;
    }
}