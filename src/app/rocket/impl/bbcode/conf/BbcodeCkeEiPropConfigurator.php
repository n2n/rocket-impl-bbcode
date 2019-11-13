<?php
namespace rocket\impl\bbcode\conf;

use rocket\impl\ei\component\prop\string\cke\conf\CkeEiPropConfigurator;
use n2n\core\container\N2nContext;
use n2n\web\dispatch\mag\MagDispatchable;

class BbcodeCkeEiPropConfigurator extends CkeEiPropConfigurator {
	
	public function mag(Eiu $eiu, DataSet $dataSet, MagCollection $magCollection) {
		$magDispatchable = parent::createMagDispatchable($n2nContext);
		$magCollection = $magDispatchable->getMagCollection();
		
		$magCollection->removeMagByPropertyName(self::PROP_TABLES_SUPPORTED_KEY);
		
		return $magDispatchable;
	}
}