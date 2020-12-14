<?php

namespace Anax\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\Question\Question;
use Anax\Tag\Tag;

/**
 * Form to create an item.
 */
class CreateQuestion extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $user = $this->di->get("session")->get("UserLogged");
        $this->form->create(
            [
                "postId" => __CLASS__
            ],
            [
                "userid" => [
                    "type" => "hidden",
                    "value" => $user
                ],

                "title" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "text" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],
                "tags" => [
                    "type"  => "textarea",
                    "placeholder" => "T.ex Fantasy, Drakar, Klassiker",
                ],
                "submit" => [
                    "type" => "submit",
                    "value" => "Create Post",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    public function callbackSubmit() : bool
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->userId  = $this->form->value("userid");
        $question->title = $this->form->value("title");
        $question->text = $this->form->value("text");
        $question->save();

        $questionId = $question->id;

        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $tags = $this->form->value("tags");
        $alltag = explode(",", $tags);

        foreach ($alltag as $individualTag) {
            $tag = new Tag();
            $tag->setDb($this->di->get("dbqb"));
            $tag->questionId = $questionId;
            $tag->tag = str_replace(' ', '', $individualTag);
            $tag->save();
            }
        return true;
    }

    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("question")->send();
    }

}
