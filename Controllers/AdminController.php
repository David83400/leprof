<?php

namespace LeProf\Controllers;

use LeProf\Models\ContactModel;
use LeProf\Models\AssistanceModel;

class AdminController extends Controller
{
    public function index()
    {
        // On vérifie si on est admin
        if($this->isAdmin()){
            $this->render('admin/index', [], 'adminTemplate');
        }
    }

    /**
     * Affiche la liste des messages de contact sous forme de tableau
     *
     * @return void
     */
    public function contactMessages()
    {
        if($this->isAdmin()){
            $contactModel = new ContactModel();

            $contactMessages = $contactModel->findAll();

            $this->render('admin/contactMessages', ['contactMessages' => $contactMessages], 'adminTemplate');
        }
    }

    /**
     * Delete a contact message
     *
     * @param [int] $id
     * @return void
     */
    public function deleteContactMessage(int $id)
    {
        if($this->isAdmin()){
            $contact = new ContactModel();

            $contact->delete($id);

            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Affiche la liste des messages d'assistance sous forme de tableau
     *
     * @return void
     */
    public function assistanceMessages()
    {
        if($this->isAdmin()){
            $assistanceModel = new AssistanceModel();

            $assistanceMessages = $assistanceModel->findAll();

            $this->render('admin/assistanceMessages', ['assistanceMessages' => $assistanceMessages], 'adminTemplate');
        }
    }

    /**
     * Delete an assistance message
     *
     * @param [int] $id
     * @return void
     */
    public function deleteAssistanceMessage(int $id)
    {
        if($this->isAdmin()){
            $assistance = new AssistanceModel();

            $assistance->delete($id);

            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    private function isAdmin()
    {
        // On vérifie si on est connecté et si ROLE_ADMIN est dans nos roles
        if(isset($_SESSION['member']) && in_array('ROLE_ADMIN', $_SESSION['member']['roles'])){
            // On est admin
            return true;
        }else{
            // On n'est pas admin
            $_SESSION['error'] = 'Vous n\'avez pas accès à cette page !';
            header('Location: /');
            exit;
        }
    }
}