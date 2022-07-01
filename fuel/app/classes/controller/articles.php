<?php
class Controller_Articles extends Controller_Template
{

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

        $this->template->menu = Presenter::forge('menu');
		$this->template->title = "новости";
		$this->template->content = View::forge('articles/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('articles');

		if ( ! $data['article'] = Model_Article::find($id))
		{
			Session::set_flash('error', 'Could not find article #'.$id);
			Response::redirect('articles');
		}

		$this->template->title = "Article";
		$this->template->content = View::forge('articles/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Article::validate('create');

			if ($val->run())
			{
				$article = Model_Article::forge(array(
					'title' => Input::post('title'),
					'body' => Input::post('body'),
				));

				if ($article and $article->save())
				{
					Session::set_flash('success', 'Added article #'.$article->id.'.');

					Response::redirect('articles');
				}

				else
				{
					Session::set_flash('error', 'Could not save article.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Articles";
		$this->template->content = View::forge('articles/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('articles');

		if ( ! $article = Model_Article::find($id))
		{
			Session::set_flash('error', 'Could not find article #'.$id);
			Response::redirect('articles');
		}

		$val = Model_Article::validate('edit');

		if ($val->run())
		{
			$article->title = Input::post('title');
			$article->body = Input::post('body');

			if ($article->save())
			{
				Session::set_flash('success', 'Updated article #' . $id);

				Response::redirect('articles');
			}

			else
			{
				Session::set_flash('error', 'Could not update article #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$article->title = $val->validated('title');
				$article->body = $val->validated('body');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('article', $article, false);
		}

		$this->template->title = "Articles";
		$this->template->content = View::forge('articles/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('articles');

		if ($article = Model_Article::find($id))
		{
			$article->delete();

			Session::set_flash('success', 'Deleted article #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete article #'.$id);
		}

		Response::redirect('articles');

	}

}
