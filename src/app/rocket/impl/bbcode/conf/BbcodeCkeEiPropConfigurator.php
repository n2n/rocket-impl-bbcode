<?php
namespace rocket\impl\bbcode\conf;

use n2n\util\type\attrs\DataSet;
use n2n\web\dispatch\mag\MagCollection;
use rocket\op\ei\util\Eiu;
use rocket\impl\ei\component\prop\adapter\config\ConfigAdaption;

class BbcodeCkeEiPropConfigurator extends ConfigAdaption {
	
	public function mag(Eiu $eiu, DataSet $dataSet, MagCollection $magCollection) {
		$magCollection->removeMagByPropertyName(self::PROP_TABLES_SUPPORTED_KEY);
	}

	public function save(Eiu $eiu, MagCollection $magCollection, DataSet $dataSet) {
	}

	public function setup(Eiu $eiu, DataSet $dataSet) {
	}

}