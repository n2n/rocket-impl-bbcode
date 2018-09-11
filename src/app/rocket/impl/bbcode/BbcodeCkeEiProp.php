<?php
namespace rocket\impl\bbcode;

use rocket\impl\ei\component\prop\string\cke\CkeEiProp;
use rocket\ei\component\prop\indepenent\EiPropConfigurator;
use rocket\impl\bbcode\conf\BbcodeCkeEiPropConfigurator;
use rocket\impl\ei\component\prop\string\cke\model\CkeMag;
use rocket\ei\util\Eiu;
use n2n\web\dispatch\mag\Mag;
use n2n\impl\web\ui\view\html\HtmlView;
use rocket\ei\EiPropPath;
use rocket\impl\ei\component\prop\string\cke\ui\CkeHtmlBuilder;
use rocket\impl\bbcode\ui\BbcodeParser;

class BbcodeCkeEiProp extends CkeEiProp {
	
	public function createEiPropConfigurator(): EiPropConfigurator {
		return new BbcodeCkeEiPropConfigurator($this);
	}
	
	public function isTableSupported() {
		return false;
	}
	
	public function createOutputUiComponent(HtmlView $view, Eiu $eiu) {
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
	
	public function createMag(Eiu $eiu): Mag {
		$eiEntry = $eiu->entry()->getEiEntry();
		return new CkeMag($this->getLabelLstr(), null, $this->isMandatory($eiu),
				null, $this->getMaxlength(), $this->getMode(), true,
				false, $this->getCkeLinkProviderLookupIds(), $this->getCkeCssConfigLookupId());
	}
}