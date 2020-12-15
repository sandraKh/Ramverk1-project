<?php

namespace Anax\Homepage;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\UserLoginForm;
use Anax\User\HTMLForm\CreateUserForm;
use Anax\User\HTMLForm\EditUserForm;
use Anax\Answer\Answer;
use Anax\Tag\Tag;
use Anax\User\User;
use Anax\Comment\Comment;
use Anax\Question\Question;
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* A sample controller to show how a controller class can be implemented.
*/
class HomeController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function indexActionGet() : object
    {
        $page = $this->di->get("page");


        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $questions = $question->findLatest();

        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));

        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));

        $page->add("home/home-top-questions", [
            "questions" => $questions,
        ]);

        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $toptags = $tag->findAllOrderByGroupBy("count DESC", "tag", 3, "tag, count(tag) as count, questionId");

        $page->add("home/home-top-tags", [
            "toptags" => $toptags,
        ]);

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $userInfo = $user->findAllOrderBy("active DESC",  3);

        $page->add("home/home-top-users", [
            "userInfo" => $userInfo,
        ]);

        return $page->render([
            "title" => "Startsida",
        ]);
    }

}
