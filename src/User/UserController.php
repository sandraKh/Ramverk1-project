<?php

namespace Anax\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\User\HTMLForm\UserLoginForm;
use Anax\User\HTMLForm\CreateUserForm;
use Anax\User\HTMLForm\EditUserForm;

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
