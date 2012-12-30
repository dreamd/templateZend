<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;
use Zend\Session\Container;

class Combination extends AbstractPlugin {
	private $combination;
	const xorKey = 0x999;
    public function __invoke($item) {
		$this->initCombination();
		if (is_string($item) === true) {
			return $this->getCombinationByName($item);
		} else if (is_array($item) === true) {
			if (($link = $this->checkItemExists($item)) !== false) {
				return $link;
			} else {
				return $this->addItemToLists($item);
			}
		}
		return false;
    }
	private function checkItemExists($item) {
		for ($i = 0; $i < count($this->combination->itemLists); $i++) {
			if (isset($this->combination->itemLists[$i]->item) === true && $this->combination->itemLists[$i]->item === $item) {
				return $this->combination->itemLists[$i]->name;
			}
		}	
		return false;
	}
	private function addItemToLists($item) {
		$count = count($this->combination->itemLists);
		$name = $this->getNameByIndex($count);
		$item = $this->combination->itemLists;
		$item[$count] = (object)array(
			'name' => $name,
			'item' => $item,
		);
		$this->combination->itemLists = $item;
		return $name;
	}
	private function initCombination() {
		$this->combination = new Container('Combination');
		 if (isset($this->combination->itemLists) === false) {
			$this->combination->itemLists = array(); 
		 }
	}
	private function getNameByIndex($index) {
		return base64_encode($index^ self::xorKey);	
	}
	private function getIndexByName($name) {
		return (int)base64_decode($name) ^ self::xorKey;
	}
}
