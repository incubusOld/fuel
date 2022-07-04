<?php

namespace News;

Class Controller_News extends \Controller_Template {


    public function action_index()
    {

        $data['page'] = (int)$this->param('page', 1);

        $articles = Model_Article::query();
        $data['pages_num'] = ceil($articles->count() / 2);

        if(!$data['page'] || $data['page'] > $data['pages_num']){
            $data['page'] = 1;
        }

        $offset = ($data['page']-1)*2;
        $data['articles'] = $articles->offset($offset)->limit(2)->get();

        $this->template->menu = \Presenter::forge('menu');
        $this->template->title = "новости";
        $this->template->content = \View::forge('articles/index', $data);

    }

}