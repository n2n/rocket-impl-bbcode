<?php
namespace rocket\impl\bbcode;

use rocket\impl\ei\component\prop\string\cke\CkeEiProp;
use rocket\ei\component\prop\indepenent\EiPropConfigurator;
use rocket\impl\bbcode\conf\BbcodeCkeEiPropConfigurator;
use rocket\impl\ei\component\prop\string\cke\model\CkeMag;
use rocket\ei\util\Eiu;
use rocket\ei\EiPropPath;
use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
use rocket\impl\bbcode\ui\BbcodeParser;
use rocket\si\content\SiField;

class BbcodeCkeEiProp extends CkeEiProp {
	
	public function createEiPropConfigurator(): EiPropConfigurator {
		return new BbcodeCkeEiPropConfigurator($this);
	}
	
	public function isTableSupported() {
		return false;
	}
	
	public function createOutSiField(Eiu $eiu): SiField {
		$value = $eiu->field()->getValue(EiPropPath::from($this));
		
		$ckeCss = null;
		if (($ckeCssConfigLookupId = $this->getCkeCssConfigLookupId()) !== null) {
			$ckeCss = $view->lookup($ckeCssConfigLookupId);
		}
		
		$linkProviders = array();
		foreach ($this->getCkeLinkProviderLookupIds() as $linkProviderLookupId) {
			$linkProviders[] = $view->lookup($linkProviderLookupId);
		}
		
		$ckeHtmlBuidler = new CkeHtmlBuilder($view);
		$contentsHtml = (new BbcodeParser($view))->toHtml((string) $value);
		
		return $ckeHtmlBuidler->getIframe($contentsHtml, $ckeCss, $linkProviders);
	}
	
	public function createInSiField(Eiu $eiu): SiField {
// 		$eiEntry = $eiu->entry()->getEiEntry();
		return new CkeMag($this->getLabelLstr(), null, $this->isMandatory($eiu),
				null, $this->getMaxlength(), $this->getMode(), true,
				false, $this->getCkeLinkProviderLookupIds(), $this->getCkeCssConfigLookupId());
	}
}