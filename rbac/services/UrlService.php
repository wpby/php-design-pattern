<?php

namespace app\services;

use yii\helpers\Url;

/**
 * 作用：统一管理链接，并规范书写
 */
class UrlService
{	
	/**
	 * 返回一个内部链接
	 * @param  [type] $uri    [description]
	 * @param  array  $params [description]
	 * @return [type]         [description]
	 */
	public static function buildUrl($uri, $params = [])
	{
		return Url::toRoute( array_merge( [ $uri ] ,$params) );
	}

	/**
	 * 返回一个空链接
	 * @return [type] [description]
	 */
	public static function bindNullUrl()
	{
		return "javascript:void(0);";
	}
}

