<?php
namespace rocket\impl\bbcode\conf;

use rocket\ei\util\Eiu;
use n2n\util\type\attrs\DataSet;
use n2n\web\dispatch\mag\MagCollection;
use rocket\impl\ei\component\prop\adapter\config\ConfigAdaption;
use rocket\impl\ei\component\prop\string\cke\conf\CkeConfig;

class BbcodeCkeConfig extends ConfigAdaption {
	
	public function mag(Eiu $eiu, DataSet $dataSet, MagCollection $magCollection) {
		$magCollection->removeMagByPropertyName(CkeConfig::ATTR_TABLES_SUPPORTED_KEY);
	}
	
	public function save(Eiu $eiu, MagCollection $magCollection, DataSet $dataSet) {
	}

	public function setup(Eiu $eiu, DataSet $dataSet) {
	}

}