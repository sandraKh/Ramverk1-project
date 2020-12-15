<?php

namespace Anax\Comment\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Question\Question;
use Anax\Answer\Answer;
use Anax\User\User;
use Anax\Comment\Comment;
use Anax\Filter\Filter;

/**
 * Form to create an item.
 */
class CreateComment extends FormModel
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
        $this->commentId = $this->di->get("request")->getGet("commentId");

        $this->form->create(
            [
                "commentId" => __CLASS__
            ],
            [
                "Kommentera" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Skicka Kommentar",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }

    public function callbackSubmit() : bool
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->questionId = $this->questionId;
        $comment->commentId = $this->commentId;
        $comment->answerId = 0;
        $comment->userId = $this->di->get("session")->get("UserLogged");
        $mdFilter= new Filter();
        $comment->text = $mdFilter->markdown($this->form->value("Kommentera"));
        $comment->save();

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
