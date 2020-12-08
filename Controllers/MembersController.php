<?php

namespace LeProf\Controllers;

use LeProf\Core\Form;

class MembersController extends Controller
{
    public function login()
    {
        $form = new Form();

        $form->initForm()
            ->addLabelFor('lastName', 'Votre nom :')
            ->addInput('text', 'lastName', ['class' => 'form-control', 'id' => 'lastName'])
            ->addTextarea('sign', 'Votre signature', ['class' => 'form-control'])
            ->addSelect('pays', ['francais' => 'Français', 'anglais' => 'Anglais'], ['id' => 'puce'])
            ->addButton('Valider', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->render('members/login', ['loginForm' => $form->create()]);
    }
}