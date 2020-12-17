<?php

namespace LeProf\Controllers\Backend;

use LeProf\Controllers\Controller;
use LeProf\Models\Backend\ContactModel;
use LeProf\Models\Backend\AssistanceModel;

class AdminController extends Controller
{
    public function index()
    {
        // On vérifie si on est admin
        if($this->isAdmin()){
            $this->backRender('Backend/admin/index', [], 'Backend/adminTemplate');
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

            $this->backRender('Backend/admin/contactMessages', ['contactMessages' => $contactMessages], 'Backend/adminTemplate');
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

            $this->backRender('Backend/admin/assistanceMessages', ['assistanceMessages' => $assistanceMessages], 'Backend/adminTemplate');
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