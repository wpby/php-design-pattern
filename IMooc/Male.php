<?php

namespace IMooc;

use IMooc\UserStrategy;

class Male implements UserStrategy
{
	function showAd()
	{
		echo '新款男装广告<br>';
	}

	function showCategory()
	{
		echo '男装<br>';
	}
}