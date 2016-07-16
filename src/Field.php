<?php

namespace rdx\nestedform;

use rdx\nestedform\Form;

abstract class Field {

	public $options = [];
	public $parent;

	public function __construct(array $options = []) {
		$this->options = $options;
	}

	public function setParent(Form $form) {
		$this->parent = $form;
	}

	abstract public function render(array $options = []);

	public function getName() {
		$children = $this->parent->children;
		foreach ($children as $name => $field) {
			if ($this === $field) {
				return $name;
			}
		}
	}

	public function getLabel() {
		return isset($this->options['label']) ? $this->options['label'] : $this->getName();
	}

	public function getParents() {
		$form = $this->getForm();

		$parents = [
			$this->getName(),
		];

		while ($parent = $form->getParentForm()) {
			$parents[] = $form->getName();
			$form = $parent;
		}

		return array_reverse($parents);
	}

	public function getForm() {
		return $this->parent;
	}

	public function getRootForm() {
		return $this->getForm()->getRootForm();
	}

}
