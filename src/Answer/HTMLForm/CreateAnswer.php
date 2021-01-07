<?php

namespace Anax\Answer\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Question\Question;
use Anax\User\User;
use Anax\Answer\Answer;
use Anax\Filter\Filter;

/**
 * Form to create an item.
 */
class CreateAnswer extends FormModel
{
    public $questionId;
    public $id;
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $questionId)
    {
        parent::__construct($di);
        $this->questionId = $questionId;
        $this->answerId = $this->di->get("request")->getGet("answerId");

        $this->form->create(
            [
                "answerId" => __CLASS__
            ],
            [
                "Svara" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Skicka Svar",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    public function callbackSubmit() : bool
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->questionId = $this->questionId;
        $answer->answerId = $this->answerId;
        $answer->userId = $this->di->get("session")->get("UserLogged");
        $mdFilter= new Filter();
        $answer->text = $mdFilter->markdown($this->form->value("Svara"));

        $answer->save();

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $this->di->get("session")->get("UserLogged"));
        $user->active = $user->active + 1;
        $user->save();

        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("question/view/" . $this->questionId)->send();
    }
}
