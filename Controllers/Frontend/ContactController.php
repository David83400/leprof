<?php

namespace LeProf\Controllers\Frontend;

use LeProf\Controllers\Controller;
use LeProf\Core\Form;
use LeProf\Models\Frontend\VisitorsModel;

class ContactController extends Controller
{
    /**
     * Display contact page
     *
     * @return void
     */
    public function index()
    {
        $form = new Form();

        $form->initForm()
            ->addLabelFor('lastName', 'Votre nom :')
            ->addInput('text', 'lastName', ['class' => 'form-control', 'id' => 'lastName'])
            ->addLabelFor('firstName', 'Votre prénom :')
            ->addInput('text', 'firstName', ['class' => 'form-control', 'id' => 'firstName'])
            ->addLabelFor('email', 'Votre email :')
            ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->addLabelFor('massage', 'Votre message :')
            ->addTextarea('message', '', ['class' => 'form-control', 'id' => 'message'])
            ->addButton('Envoyer', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->frontRender('Frontend/contact/index', ['contactForm' => $form->create()]);
    }
}