<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;
use LeProf\Core\Form;
use LeProf\Models\Frontend\MembersModel;

class MembersController extends Controller
{
    /**
     * Connexion des utilisateurs
     * @return void
     */
    public function login()
    {
        // On vérifie si le formulaire est complet
        if(Form::validate($_POST, ['lastName', 'pass'])){
            // Le formulaire est valide
            // On cherche dans la base de données l'utilisateur avec le nom entré
            $membersModel = new MembersModel();
            $memberArray = $membersModel->findOneByLastName(strip_tags($_POST['lastName']));
            if(!$memberArray){
                // On envoie un message de session
                $_SESSION['error'] = 'Il y\'a une erreur !';
                header('Location: /members/login');
                exit;
            }

            // Le membre existe
            $member = $membersModel->hydrate($memberArray);

            // On vérifie si le mot de passe est correct
            if(password_verify($_POST['pass'], $member->getPass())){
            //if($_POST['pass'] === $member->getPass()){
                // Le mot de passe est bon
                // On crée la session
                $member->setSession();
                header('Location: /');
                exit;
            }else{
                // Mauvais mot de passe
                $_SESSION['error'] = 'Il y\'a une erreur !';
                header('Location: /members/login');
                exit;
            }
        }

        $form = new Form();

        $form->initForm()
            ->addLabelFor('lastName', 'Votre nom :')
            ->addInput('text', 'lastName', ['class' => 'form-control', 'id' => 'lastName'])
            ->addLabelFor('firstName', 'Votre prénom :')
            ->addInput('text', 'firstName', ['class' => 'form-control', 'id' => 'firstName'])
            ->addLabelFor('pass', 'Votre mot de passe :')
            ->addInput('password', 'pass', ['class' => 'form-control', 'id' => 'pass'])
            ->addButton('Me connecter', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->frontRender('Frontend/members/login', ['loginForm' => $form->create()]);
    }

    /**
     * Inscription des utilisateurs
     * @return void
     */
    public function register()
    {
        //On vérifie si le formulaire est valide
        if(Form::validate($_POST, ['lastName', 'pass'])){
            // Le formulaire est valide
            // On nettoie l'adresse mail
            $lastName = strip_tags($_POST['lastName']); // htmlspecialchars garde les entités qu'il y'a dedans, strip tags enlève toutes les balises html, il nettoie tout

            // On chiffre le mot de passe
            $pass = password_hash($_POST['pass'], PASSWORD_ARGON2I);

            // On hydrate le membre
            $member = new MembersModel();
            
            $member->setLastName($lastName)
            ->setPass($pass);
            
            // On stocke le membre en base de données
            $member->create();
        }

        $form = new Form();

        $form->initForm()
            ->addLabelFor('lastName', 'Votre nom :')
            ->addInput('text', 'lastName', ['class' => 'form-control', 'id' => 'lastName'])
            ->addLabelFor('firstName', 'Votre prénom :')
            ->addInput('text', 'firstName', ['class' => 'form-control', 'id' => 'firstName'])
            ->addLabelFor('nationality', 'Votre nationalité :')
            ->addSelect('pays', ['francais' => 'Français', 'anglais' => 'Anglais'], ['id' => 'nationality'])
            ->addLabelFor('pass', 'Votre mot de passe :')
            ->addInput('password', 'pass', ['class' => 'form-control', 'id' => 'pass'])
            ->addButton('M\'inscrire', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->frontRender('Frontend/members/register', ['registerForm' => $form->create()]);
    }

    /**
     * Déconnexion de l'utilisateur
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['member']);
        header('Location: '. $_SERVER['HTTP_REFERER']);
        exit;
    }
}