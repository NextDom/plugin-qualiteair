<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class qualiteair extends eqLogic {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */

	public static function ListVille() {
		$status1 = $status2 = $status3 = array();
		$data = @simplexml_load_file("http://www.lcsqa.org/indices-qualite-air/xml/".date('Y-m-d', time()));
		if ( $data !== false )
		{
			$xpathModele = '//agglomeration';
			$status2 = $data->xpath($xpathModele);
		}
		$data = @simplexml_load_file("http://www.lcsqa.org/indices-qualite-air/xml/".date('Y-m-d', time() - 24 * 60 * 60));
		if ( $data !== false )
		{
			$xpathModele = '//agglomeration';
			$status1 = $data->xpath($xpathModele);
		}
		$data = @simplexml_load_file("http://www.lcsqa.org/indices-qualite-air/xml/".date('Y-m-d', time() - 24 * 60 * 60 * 2));
		if ( $data !== false )
		{
			$xpathModele = '//agglomeration';
			$status3 = $data->xpath($xpathModele);
		}
		$status =  array_merge ($status1, $status2, $status3);
		if ( count($status) != 0 )
		{
			sort($status, SORT_STRING);
			return array_unique ($status);
		}
		else
		{
			return array();
		}
	}

	public static function cronHourly() {
		foreach (self::byType('qualiteair') as $eqLogic) {
			$eqLogic->pull();
		}
	}

	public function postUpdate()
	{
		$cmd = $this->getCmd(null, 'status');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('Etat');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('binary');
			$cmd->setLogicalId('status');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->save();
		}
		$cmd = $this->getCmd(null, 'valeurIndice');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('Aujourd\'hui');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('numeric');
			$cmd->setLogicalId('valeurIndice');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->setTemplate('dashboard', 'qualiteair');
			$cmd->setTemplate('mobile', 'qualiteair');
			$cmd->save();
		}
		$cmd = $this->getCmd(null, 'valeurIndiceDemain');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('Demain');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('numeric');
			$cmd->setLogicalId('valeurIndiceDemain');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->setTemplate('dashboard', 'qualiteair');
			$cmd->setTemplate('mobile', 'qualiteair');
			$cmd->save();
		}
		$cmd = $this->getCmd(null, 'SousIndiceO3');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('O3');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('numeric');
			$cmd->setLogicalId('SousIndiceO3');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->setTemplate('dashboard', 'qualiteair');
			$cmd->setTemplate('mobile', 'qualiteair');
			$cmd->save();
		}
		$cmd = $this->getCmd(null, 'SousIndiceNO2');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('NO2');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('numeric');
			$cmd->setLogicalId('SousIndiceNO2');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->setTemplate('dashboard', 'qualiteair');
			$cmd->setTemplate('mobile', 'qualiteair');
			$cmd->save();
		}
		$cmd = $this->getCmd(null, 'SousIndicePM10');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('PM10');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('numeric');
			$cmd->setLogicalId('SousIndicePM10');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->setTemplate('dashboard', 'qualiteair');
			$cmd->setTemplate('mobile', 'qualiteair');
			$cmd->save();
		}
		$cmd = $this->getCmd(null, 'SousIndiceSO2');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('S02');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('numeric');
			$cmd->setLogicalId('SousIndiceSO2');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->setTemplate('dashboard', 'qualiteair');
			$cmd->setTemplate('mobile', 'qualiteair');
			$cmd->save();
		}
		$cmd = $this->getCmd(null, 'Commentaire');
		if ( ! is_object($cmd) ) {
			$cmd = new qualiteairCmd();
			$cmd->setName('Commentaire');
			$cmd->setEqLogic_id($this->getId());
			$cmd->setType('info');
			$cmd->setSubType('string');
			$cmd->setLogicalId('Commentaire');
			$cmd->setIsVisible(1);
			$cmd->setEventOnly(1);
			$cmd->save();
		}
		$this->pull();
	}

	public function pull() {
		if ( $this->getIsEnable() ) {
			log::add('qualiteair','debug','pull '.$this->getName());
			log::add('qualiteair','debug','get http://www.lcsqa.org/indices-qualite-air/liste/jour');
			$statuscmd = $this->getCmd(null, 'status');
			$data = @simplexml_load_file("http://www.lcsqa.org/indices-qualite-air/liste/jour");
			log::add('qualiteair','debug',"Data : ".print_r($data, true));
			$count = 0;
			while ( $data === false && $count < 3 ) {
				$data = @simplexml_load_file("http://www.lcsqa.org/indices-qualite-air/liste/jour");
				$count++;
			}
			if ( $data === false ) {
				if ($statuscmd->execCmd() != 0) {
					$statuscmd->setCollectDate('');
					$statuscmd->event(0);
				}
				log::add('qualiteair','error',__('Impossible de se connecter à www.lcsqa.org.',__FILE__));
				return false;
			}
			$xpathModele = '//td[. ="'.strtoupper($this->getConfiguration('ville')).'"]/parent::*';
			$status = $data->xpath($xpathModele);
			if ( count($status) != 0 ) {
				foreach ($status as $col) {
					log::add('qualiteair','debug',"col ".print_r($col, false));
					#$eqLogic_cmd = $this->getCmd(null, $key);
					#if ( is_object($eqLogic_cmd) && $eqLogic_cmd->execCmd() != $eqLogic_cmd->formatValue($value)) {
					#	log::add('qualiteair','debug',"Change ".$eqLogic_cmd->getName());
					#	$eqLogic_cmd->setCollectDate('');
					#	$eqLogic_cmd->event($value);
					#}
				}				
				$statuscmd->setCollectDate('');
				$statuscmd->event(1);
			}
			else {
				log::add('qualiteair','debug','no data found for today');
				$statuscmd->setCollectDate('');
				$statuscmd->event(0);
			}
			$data = @simplexml_load_file("http://www.lcsqa.org/indices-qualite-air/xml/".date('Y-m-d', time() + 24 * 60 * 60));
			$count = 0;
			while ( $data === false && $count < 3 ) {
				$data = @simplexml_load_file("http://www.lcsqa.org/indices-qualite-air/xml/".date('Y-m-d', time() + 24 * 60 * 60));
				$count++;
			}
			$xpathModele = '//agglomeration[. ="'.strtoupper($this->getConfiguration('ville')).'"]/parent::*';
			$status = $data->xpath($xpathModele);
			if ( count($status) != 0 ) {
				foreach ($status[0] as $key => $value) {
					$eqLogic_cmd = $this->getCmd(null, $key);
					if ( is_object($eqLogic_cmd) && $eqLogic_cmd->execCmd() != $eqLogic_cmd->formatValue($value)) {
						log::add('qualiteair','debug',"Change ".$eqLogic_cmd->getName());
						$eqLogic_cmd->setCollectDate('');
						$eqLogic_cmd->event($value);
					}
				}
			} else {
				log::add('qualiteair','debug','no data found for tomorrow');
			}
			log::add('qualiteair','debug','pull end '.$this->getName());
		}
	}

    /*     * *********************Methode d'instance************************* */
}

class qualiteairCmd extends cmd {

    /*     * **********************Getteur Setteur*************************** */
}
?>
