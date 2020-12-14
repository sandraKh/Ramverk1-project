<?php

namespace Anax\Answer;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Answer\HTMLForm\CreateAnswer;
use Anax\Question\Question;
use Anax\User\User;
use Anax\Tag\Tag;
use \Michelf\MarkdownExtra;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class AnswerController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var $data description
     */

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
     public function createAction(int $id) : object
     {
        $userId = $this->di->get("session")->get("UserLogged");
        if (!$userId) {
            $this->di->get("response")->redirect("user/login");
        }

        $page = $this->di->get("page");

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question = $question->find("questionId", $id);

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find('id', $question->userId);

        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $tags = $tag->findTag("Question.questionId", $id);

        $answers = new Answer();
        $answers->setDb($this->di->get("dbqb"));
        $answers = $answers->findAllAnswerWhere("questionId", $id);

        $form = new CreateAnswer($this->di, $id);
        $form->check();

        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));

        $page->add("question/crud/view-question", [
            "answer" => $answer->findAllAnswerWhere("questionId", $id),
            "question" => $question,
            "userId" => $this->di->get("session")->get("UserLogged"),
            "user" => $user,
            "tags" => $tags,
            "answers" => $answers,
        ]);

        $page->add("question/crud/create", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Fråga",
        ]);
    }
}
