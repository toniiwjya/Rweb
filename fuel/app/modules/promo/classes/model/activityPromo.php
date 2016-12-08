<?php

namespace Promo;

class Model_ActivityPromo extends \Orm\Model{
	protected static $_table_name = "activity_promo";

	protected static $_properties = array(
		'id',
		'user_id',
		'promo_id'
	);
}