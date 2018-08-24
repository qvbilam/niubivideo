<?php

namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Article extends Model
{
	use SoftDelete;
	protected $deleteTime = 'deleteTime';

}