<?php

namespace rdx\nestedform;

// @todo Templates (form, fields, field, x_field)
// @todo Validate
// @todo Extract
// @todo Simple nesting with dot notation
// @todo Translate

use rdx\nestedform\Field;
use rdx\nestedform\fields\FormField;

abstract class Form {

	public $options = [];
	public $parent;
	public $children = [];

	public function __construct(array $options = []) {
		$this->options = $options;

		$this->build();
	}

	abstract public function build();

	public function add($name, Field $field) {
		$this->children[$name] = $field;
		$field->setParent($this);
	}

	public function render(array $options = []) {
		$withForm = @$options['withForm'] !== false;

		$html = '';

		$withForm and $html .= '<form method="post">' . "\n\n";

		foreach ($this->children as $field) {
			$html .= $field->render();
		}

		$withForm and $html .= $this->renderActions();

		$withForm and $html .= '</form>' . "\n\n";

		return $html;
	}

	public function renderActions() {
		return '<p><button>' . $this->options['submit'] . '</button></p>' . "\n\n";
	}

	public function getParentForm() {
		return $this->parent;
	}

	public function getRootForm() {
		$form = $this;
		while ($parent = $form->getParentForm()) {
			$form = $parent;
		}
		return $form;
	}

	public function getName() {
		if ($parent = $this->getParentForm()) {
			foreach ($parent->children as $name => $field) {
				if ($field instanceof FormField && $field->subform === $this) {
					return $name;
				}
			}
		}
	}

	public function parentsToName(array $parents) {
		return preg_replace('#^(\w+)\]#', '$1', implode('][', $parents) . ']');
	}

	public function values(array $source) {
		// @todo
		return $source;
	}

}
