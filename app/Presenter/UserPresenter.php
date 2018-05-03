<?php

namespace App\Presenter;

	class UserPresenter
	{
		public function getFull(): string
		   {
		       return $this->id . ' ' . $this->name;
		   }
	}
