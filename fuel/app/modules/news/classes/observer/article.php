<?php

namespace News;


class Observer_Article extends \Orm\Observer {

    private function cleaning($text) {

        return \Security::xss_clean($text);

    }

    public function before_insert(Model_Article $model) {

        $model->body = $this->cleaning($model->body);

    }

    public function before_save(Model_Article $model) {

        $model->body = $this->cleaning($model->body);

    }

}

?>