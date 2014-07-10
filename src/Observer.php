<?php

namespace Test;

class Observer {
	
	public function update(Subject $subject)
	{
		return get_class($subject).' updated!';
	}

}