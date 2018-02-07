<?php
namespace app\rocket\impl\bbcode\ui;

use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
use n2n\impl\web\ui\view\html\HtmlView;
use rocket\impl\bbcode\ui\BbcodeParser;
use n2n\l10n\N2nLocale;

class BBcodeCkeHtmlBuilder extends CkeHtmlBuilder {
	private $bbcodeParser;
	
	public function __construct(HtmlView $view) {
		parent::__construct($view);
		$this->bbcodeParser = new BbcodeParser($view);
	}
	
	public function getOut(string $contentsBbcode, N2nLocale $n2nLocale = null) {
		return parent::getOut($this->bbcodeParser->toHtml($contentsBbcode), $n2nLocale);
	}
}