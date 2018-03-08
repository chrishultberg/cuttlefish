<?php



use VanDragt\Carbon;

if (!defined('BASE_FILEPATH')) {
    exit('No direct script access allowed');
}

class ControllerFeeds extends Carbon\Controller
{

    // single feed

    function records()
    {
        $limit = \Configuration::POSTS_HOMEPAGE;
        $records = new Carbon\Files(array('url' => '/content/posts'), $this->ext);
        $this->Records = $records->limit($limit + 5);
    }

    function model()
    {
        $model = new ModelPost($this->Records->getCollection());
        $this->Model = $model->limit(10);
    }

    function view()
    {
        parent::view();
        $this->View = new Carbon\Feed($this->Model->contents);
    }
}