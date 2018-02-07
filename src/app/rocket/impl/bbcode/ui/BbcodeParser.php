<?php
namespace rocket\impl\bbcode\ui;

use Genert\BBCode\BBCode;
use n2n\impl\web\ui\view\html\HtmlView;

class BbcodeParser {
	private $bbcode;
	private $view;
	
	public function __construct(HtmlView $view) {
		$this->bbcode = new BBCode();
		$this->view = $view;
	}
	
	public function toHtml(string $bbcode) {
		if (empty($bbcode)) return $bbcode;
		
		return $this->bbcode->convertToHtml($this->view->getHtmlBuilder()->getEsc($bbcode));
	}
}