<?php

namespace Anax\User\HTMLForm;

use Anax\User\User;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
* Example of FormModel implementation.
*/
class UserLoginForm extends FormModel
{
    /**
    * Constructor injects with DI container.
    *
    * @param Psr\Container\ContainerInterface $di a service container
    */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Logga in användare"
            ],
            [
                "user" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Logga in",
                    "callback" => [$this, "callbackSubmit"]
                ],
                "create" => [
                    "type"     => "submit",
                    "value"    => "Registrera",
                    "callback" => [$this, "register"],
                ],
            ]
        );
    }



    /**
    * Callback for submit-button which should return true if it could
    * carry out its work and false if something failed.
    *
    * @return boolean true if okey, false if something went wrong.
    */
    public function callbackSubmit()
    {
        $acronym       = $this->form->value("user");
        $password      = $this->form->value("password");

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($acronym, $password);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.");
            return false;
        }

        $currUser = $user->find('acronym', $acronym);
        $this->di->session->set('UserLogged', $currUser->id);
        $this->form->addOutput("User " . $user->acronym . " logged in.");
        return true;
    }

    public function register()
    {
        $this->di->response->redirect("user/create");
    }

    public function callbackSuccess()
    {
        $id = $this->di->get("session")->get("UserLogged");
        $this->di->get("response")->redirect("user/profile/{$id}")->send();
    }
}
