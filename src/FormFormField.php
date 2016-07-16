<?php

namespace rdx\nestedform;

use rdx\nestedform\Form;
use rdx\nestedform\FormField;

class FormFormField extends FormField {

	public $subform;

	public function __construct(array $options = []) {
		$this->subform = $options['form'];
		unset($options['form']);

		parent::__construct($options);
	}

	public function setParent(Form $form) {
		parent::setParent($form);
		$this->subform->parent = $form;
	}

	public function render(array $options = []) {
		$html = '';
		$html .= '<fieldset>' . "\n\n";
		$html .= '<legend>' . $this->getName() . '</legend>' . "\n\n";
		$html .= $this->subform->render(['withForm' => false]);
		$html .= '</fieldset>' . "\n\n";

		return $html;
	}

}
