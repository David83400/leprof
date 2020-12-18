<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;
use LeProf\Core\Form;
use LeProf\Models\Frontend\MembersModel;

class MembersController extends Controller
{
    /**
     * Users connection verifications and form creation
     * @return void
     */
    public function login()
    {
        // Verify if connection form is complete
        if(Form::validate($_POST, ['lastName', 'pass'])){
            // We search the user in the database
            $membersModel = new MembersModel();
            $memberArray = $membersModel->findOneByLastName(strip_tags($_POST['lastName']));
            if(!$memberArray){
                // If there's no correspondance we send a session message
                $_SESSION['error'] = 'Il y\'a une erreur !';
                header('Location: /members/login');
                exit;
            }

            // If user exists
            $member = $membersModel->hydrate($memberArray);

            // Password verification
            if(password_verify($_POST['pass'], $member->getPass())){
                // If pasword is good, we create the session
                $member->setSession();
                if(isset($_SESSION['member']) && in_array('ROLE_ADMIN', $_SESSION['member']['roles'])){
                    header('Location: /admin');
                    exit;
                }else{
                    header('Location: /');
                    exit;
                }
            }else{
                // If password is false
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
     * Users registration verifications and form creation
     * @return void
     */
    public function register()
    {
        // Verify if registration form is complete
        if(Form::validate($_POST, ['lastName', 'pass'])){
            // If form is complete we cleans $_POST
            $lastName = strip_tags($_POST['lastName']); // htmlspecialchars garde les entités qu'il y'a dedans, strip tags enlève toutes les balises html, il nettoie tout

            // we hash the password
            $pass = password_hash($_POST['pass'], PASSWORD_ARGON2I);

            // we hydrate member
            $member = new MembersModel();
            
            $member->setLastName($lastName)
            ->setPass($pass);
            
            // Member is create in database
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
     * Logout of the user
     *
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['member']);
        header('Location: /');
        exit;
    }
}