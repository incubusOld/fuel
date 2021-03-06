<?php
namespace News;
use Orm\Model;

class Model_Article extends Model
{
	protected static $_properties = array(
		'id',
		'title',
		'body',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'\Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'\Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
        '\News\Observer_Article' => array(
            'events' => array('before_insert', 'before_save'),
        ),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('body', 'Body', 'required');

		return $val;
	}

}
