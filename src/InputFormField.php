<?php

namespace rdx\nestedform;

use rdx\nestedform\FormField;

class InputFormField extends FormField {

	public function render(array $options = []) {
		$parents = $this->getParents();
		$name = $this->getRootForm()->parentsToName($parents);

		return '<p>' . $this->getName() . ': <input name="' . $name . '" /></p>' . "\n\n";
	}

}
