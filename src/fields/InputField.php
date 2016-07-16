<?php

namespace rdx\nestedform\fields;

use rdx\nestedform\Field;

class InputField extends Field {

	public function render(array $options = []) {
		$parents = $this->getParents();
		$name = $this->getRootForm()->parentsToName($parents);

		return '<p>' . $this->getName() . ': <input name="' . $name . '" /></p>' . "\n\n";
	}

}
