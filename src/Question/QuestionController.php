<?php

namespace Anax\Question;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Question\HTMLForm\CreateQuestion;
use Anax\Question\HTMLForm\CreateAnswer;
use Anax\Question\Question;
use Anax\User\User;
use Anax\Tag\Tag;
use Anax\Answer\Answer;
use Anax\Comment\Comment;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $questions = $question->findAll();

        $page->add("question/crud/overview", []);

        foreach($questions as $item) {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $userInfo = $user->find('id', $item->userId);

        $page->add("question/crud/view-all", [
            "item" => $item,
            "userInfo" => $userInfo,
            ]);
        }

        return $page->render([
            "title" => "Alla Frågor",
        ]);
    }

    public function createAction() : object
    {
        if (!$this->di->get("session")->has("UserLogged")) {
            $this->di->get("response")->redirect("user/login");
        }

        $page = $this->di->get("page");

        $question = new CreateQuestion($this->di);
        $question->check();

        $page->add("question/crud/create", [
            "form" => $question->getHTML(),
        ]);

        return $page->render([
            "title" => "Create a post",
        ]);
    }

    public function viewAction(int $id) : object
         {
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

            $comments = new Comment();
            $comments->setDb($this->di->get("dbqb"));
            $comments = $comments->findAllCommentsWhere("questionId", $id);

             $page->add("question/crud/view-question", [
                 "question" => $question,
                 "comments" => $comments,
                 "userId" => $this->di->get("session")->get("UserLogged"),
                 "user" => $user,
                 "tags" => $tags,
                 "get" => $_GET,
                 "answers" => $answers,
             ]);

             return $page->render([
                 "title" => "Fråga",
             ]);
         }


}
