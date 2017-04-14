<?php

namespace IMooc;

use IMooc\UserStrategy;

class Female implements Userstrategy
{
	function showAd()
	{
		echo '新款女装广告<br>';
	}

	function showCategory()
	{
		echo '女装<br>';
	}
}