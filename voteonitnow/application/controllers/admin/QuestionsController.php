<?php

class QuestionsController extends Framework
{
	public $question;
	public function __construct()
	{
		$this->question = $this->model("Question");
	}
}
?>