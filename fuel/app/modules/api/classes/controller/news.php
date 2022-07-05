<?php

namespace Api;

use Fuel\Core\Module;

Class Controller_News extends \Controller_Rest {


    public function get_news()
    {

        $page = \Input::get('page', 1);
        $response = \Request::forge('news/'.$page)->execute();
        return $this->response( $response->response->body );

    }

    public function post_create()
    {

        Module::load('news');
        $model = \News\Model_Article::validate('create');

        if ($model->run())
        {
            $article = \News\Model_Article::forge(array(
                'title' => \Input::post('title'),
                'body' => \Input::post('body'),
            ));

            if ($article && $article->save())
            {
                return $this->response( array('success' => 1, 'id' => $article->id) );
            }
            else
            {
                return $this->response( array('error' => 'Could not save article.') );
            }
        }
        else
        {
            return $this->response( array('error' => $model->error()) );
        }
    }

}