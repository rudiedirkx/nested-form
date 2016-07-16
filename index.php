<?php

use rdx\nestedform\Form;
use rdx\nestedform\fields\FormField;
use rdx\nestedform\fields\InputField;

require 'autoload.php';

class AddressForm extends Form {
	public function build() {
		$this->add('street', new InputField());
		$this->add('zipcode', new InputField());
		$this->add('city', new InputField());
	}
}

class UserForm extends Form {
	public function build() {
		$this->add('user_firstname', new InputField());
		$this->add('user_lastname', new InputField());
		$this->add('user_address', new FormField([
			'form' => new AddressForm(),
		]));
	}
}

class OrganizationForm extends Form {
	public function build() {
		$this->add('org_name', new InputField());
		$this->add('org_address', new FormField([
			'form' => new AddressForm(),
		]));
		$this->add('org_manager', new FormField([
			'form' => new UserForm(),
		]));
	}
}

$org_form = new OrganizationForm(['submit' => 'Save organization']);
$user_form = new UserForm(['submit' => 'Save user']);

if ( isset($_POST['org_name']) ) {
	header('Content-type: text/plain');

	$data = $org_form->values($_POST);
	print_r($data);
}
elseif ( isset($_POST['user_firstname']) ) {
	header('Content-type: text/plain');

	$data = $user_form->values($_POST);
	print_r($data);
}
else {
	echo $org_form->render() . "\n\n";
	// print_r($form);

	echo '<hr />';

	echo $user_form->render() . "\n\n";
}
