<?php

namespace Anax\Tag;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Question\HTMLForm\CreateQuestion;
use Anax\Question\Question;
use Anax\User\User;
use Anax\Tag\Tag;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $tags = new Tag();
        $tags->setDb($this->di->get("dbqb"));
        $allTags = $tags->findAll();
        $res = array();
        foreach($allTags as $tag) {
            if (!in_array($tag->tag, $res)) {
                $res[] = $tag->tag;
            }
        }

        $page->add("tags/view-all-tags", [
            "tags" => $res,
        ]);

        return $page->render([
            "title" => "Taggar",
        ]);
    }

    public function viewActionGet($tag) : object
    {
        $page = $this->di->get("page");

        $tags = new Tag();
        $tags->setDb($this->di->get("dbqb"));

        $allTags =  $tags->findTag("Tag.tag", $tag);

        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $page->add("tags/view-one-tag", [
            "tags" => $allTags,
            "question" => $question
        ]);

        return $page->render([
            "title" => "Taggar",
        ]);
    }
}
