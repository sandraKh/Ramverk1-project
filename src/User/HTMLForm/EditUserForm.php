<?php

namespace Anax\User\HTMLForm;
use Anax\User\User;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class EditUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
     public function __construct(ContainerInterface $di, $user)
     {
         parent::__construct($di);
         $this->form->create(
             [
                 "id" => __CLASS__,
                 "legend" => "Redigera användare",
             ],
             [
                 "id" => [
                     "type"        => "hidden",
                     "value"       => $user->id,
                 ],
                 "acronym" => [
                     "type"        => "text",
                     "value"       => $user->acronym
                 ],
                 "email" => [
                     "type"        => "email",
                     "value"       => $user->email
                 ],
                 "submit" => [
                     "type" => "submit",
                     "value" => "Spara",
                     "callback" => [$this, "callbackSubmit"]
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
     /**
      * Callback for submit-button which should return true if it could
      * carry out its work and false if something failed.
      *
      * @return boolean true if okey, false if something went wrong.
      */
      /**
       * Callback for submit-button which should return true if it could
       * carry out its work and false if something failed.
       *
       * @return boolean true if okey, false if something went wrong.
       */
      public function callbackSubmit()
      {
          // Get values from the submitted form
            $acronym       = $this->form->value("acronym");
            $email = $this->form->value("email");
            $updated  = date("Y/m/d G:i:s", time());
            $id = $this->form->value("id");

            $user = new User();
            $user->setDb($this->di->get("dbqb"));
            $user->find("id", $this->form->value("id"));

            $user->acronym = $acronym;
            $user->email = $email;
            $user->updated = $updated;

            $user->save();
            $this->di->get("session")->set("UserLogged", $user);

          //$this->form->addOutput("User was created.");

          return true;
      }

      public function callbackSuccess()
        {
            $id = $this->form->value("id");

             $this->di->get("response")->redirect("user/profile/{$id}")->send();
        }
}
