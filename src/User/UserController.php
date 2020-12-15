<?php

namespace Anax\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\UserLoginForm;
use Anax\User\HTMLForm\CreateUserForm;
use Anax\User\HTMLForm\EditUserForm;
use Anax\Answer\Answer;
use Anax\Comment\Comment;
use Anax\Question\Question;
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
* A sample controller to show how a controller class can be implemented.
*/
class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
    * @var $data description
    */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



    /**
    * Description.
    *
    * @param datatype $variable Description
    *
    * @throws Exception
    *
    * @return object as a response object
    */
    public function indexActionGet() : object
    {
        $current = $this->di->session->get("UserLogged");
        if (!$current) {
            return $this->di->response->redirect("user/login");
        }

        return $this->di->response->redirect("user/profile/{$current}");
    }



    /**
    * Description.
    *
    * @param datatype $variable Description
    *
    * @throws Exception
    *
    * @return object as a response object
    */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new UserLoginForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A login page",
        ]);
    }

    public function profileAction(int $id) : object
    {
        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find('id', $id);

        $page->add("user/profile", [
            "user" => $user,
        ]);

        $questions = new Question();
        $questions->setDb($this->di->get("dbqb"));
        $questions = $questions->findAllWhere("userId = ?", $id);
        foreach($questions as $question) {
            $page->add("user/questions", [
                "question" => $question,
                "user" => $user,
            ]);
        }

        $page->add("user/answerTitle");

        $answers = new Answer();
        $answers->setDb($this->di->get("dbqb"));
        $answers = $answers->findAllWhere("userId = ?", $id);

        foreach($answers as $answer) {
            $question = new Question();
            $question->setDb($this->di->get("dbqb"));
            $question->find("questionId", $answer->questionid);

            $page->add("user/answers", [
                "answer" => $answer,
                "question" => $question,
            ]);
        }

        $page->add("user/commentTitle");

        $comments = new Comment();
        $comments->setDb($this->di->get("dbqb"));
        $comments = $comments->findAllWhere("userId = ?", $id);

        foreach($comments as $comment) {
            $question = new Question();
            $question->setDb($this->di->get("dbqb"));
            $question->find("questionId", $comment->questionId);

            $page->add("user/comments", [
                "comment" => $comment,
                "question" => $question,
            ]);
        }

        return $page->render([
            "title" => $user->acronym,
        ]);
    }

    /**
    * Description.
    *
    * @param datatype $variable Description
    *
    * @throws Exception
    *
    * @return object as a response object
    */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create user page",
        ]);
    }

    public function editAction() : object
    {
        if (!$this->di->session->get('UserLogged')) {
            return $this->di->response->redirect("user/login");
        }

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $current = $this->di->session->get('UserLogged');
        $info = $user->find('id', $current);

        $edit = new EditUserForm($this->di, $info);
        $edit->check();

        $page = $this->di->get("page");
        $page->add("anax/v2/article/default", [
            "content" => $edit->getHTML(),
        ]);

        return $page->render([
            "title" => "Redigera användare",
        ]);
    }

    public function logoutAction() : object
    {
        if (!$this->di->session->get('UserLogged')) {
            return $this->di->response->redirect("user");
        }

        $this->di->session->delete("UserLogged");

        return $this->di->response->redirect("user/login");
    }
}
