<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;
use LeProf\Core\Form;
use LeProf\Models\VisitorsModel;
use LeProf\Models\VisitorsEmailModel;
use LeProf\Models\ContactModel;

class ContactController extends Controller
{
    /**
     * Display contact page
     *
     * @return void
     */
    public function index()
    {
        $errors = array();
        if($_POST){
            // Verify if contact form is complete
            if(Form::validate($_POST, ['lastName', 'firstName', 'email', 'titleMessage', 'message'])){
                if((preg_match('/^[a-zA-Z0-9éèê¨-]+$/', $_POST['lastName'])) && (preg_match('/^[a-zA-Z0-9éèê¨-]+$/', $_POST['firstName']))){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                    {   
                        // If form is complete we cleans $_POST
                        $lastName = strip_tags($_POST['lastName']);
                        $firstName = strip_tags($_POST['firstName']);
                        $email = strip_tags($_POST['email']);
                        $titleMessage = strip_tags($_POST['titleMessage']);
                        $message = strip_tags($_POST['message']);
                        
                        $visitorsModel = new VisitorsModel();
                        
                        $visitorArray = $visitorsModel->findOnManyTables(['visitors', 'visitorsEmail'], ['visitors.lastName' => $lastName, 'visitorsEmail.email' => $email], ['visitors.id' => 'visitorsEmail.visitorId']);
                        
                        $contactMessages = new ContactModel();
                        $visitorsEmail = new VisitorsEmailModel();
                        
                        if($visitorArray){
                            $visitorId = $visitorArray->id;
                            // var_dump($visitorArray); die;
                            $contactMessages->setTitleMessage($titleMessage)
                            ->setMessage($message)
                            ->setVisitorId($visitorId);
                            
                            // Email is create in database
                            $contactMessages->create();
                            header('Location: /');
                            $_SESSION['success'] = 'Votre message a bien été envoyé !';
                            exit;
                        }else{
                            // we hydrate visitor
                            $visitorsModel->setLastName($lastName)
                            ->setFirstName($firstName);
                            $visitorsModel->create();
                            
                            $visitor = $visitorsModel->findBy(['lastName' => $lastName,'firstName' => $firstName]);
                            $visitorId = $visitor->id;
                            
                            $visitorsEmail->setEmail($email)
                            ->setVisitorId($visitorId);
                            $contactMessages->setTitleMessage($titleMessage)
                            ->setMessage($message)
                            ->setVisitorId($visitorId);
                            $visitorsEmail->create();
                            $contactMessages->create();
                            header('Location: /');
                            $_SESSION['success'] = 'Votre message a bien été envoyé !';
                            exit;
                        }
                    }else{
                        $errors['message'] = "L'email enregistré n'est pas valide !";
                    }
                }else{
                    $errors['message'] = "Le nom ou le prénom enregistré n'est pas valide !";
                }
            }else{
                $errors['message'] = "Veuillez remplir tous les champs !";
            }
            Form::displayError($errors);
        }

        $form = new Form();
        
        $form->initForm()
            ->addLabelFor('lastName', 'Votre nom :', ['span' => '*'])
            ->addInput('text', 'lastName', ['class' => 'form-control', 'id' => 'lastName'])
            ->addLabelFor('firstName', 'Votre prénom :', ['span' => '*'])
            ->addInput('text', 'firstName', ['class' => 'form-control', 'id' => 'firstName'])
            ->addLabelFor('email', 'Votre email :', ['span' => '*'])
            ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->addLabelFor('titleMessage', 'Titre du message :', ['span' => '*'])
            ->addInput('text', 'titleMessage', ['class' => 'form-control', 'id' => 'titleMessage'])
            ->addLabelFor('message', 'Votre message :', ['span' => '*'])
            ->addTextarea('message', '', ['class' => 'form-control', 'id' => 'message'])
            ->addButton('Envoyer', ['class' => 'btn btn-primary', 'name' => 'contactForm'])
            ->endForm();
            // var_dump($form); die;
        $this->frontRender('Frontend/contact/index', ['contactForm' => $form->create(), 'errors' => $errors]);
    }
}