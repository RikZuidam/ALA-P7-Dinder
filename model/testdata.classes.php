<?php

class Test{

	public $firstname;
	public $lastname;
	public $countDog;
	public $city;
	public $img;

	public function getFreeProfile() {
		$fnames = ["Pieter", "Gerrit", "Jan", "Kees", "Karel"];
		$lnames = ["Barendsen", "van Brugge", "Willemsen", "de Jong"];
		$dogs = [1,2,3,4,5,6,7,8,9];
		$cities = ['Gouda', 'Amsterdam', 'Leeuwarden', 'Breda'];

		$firstname = array_rand($fnames, 1);
		$lastname = array_rand($lnames, 1);
		$dog = array_rand($dogs, 1);
		$city = array_rand($cities, 1);

		$this->freeaccount["fname"] = $fnames[$firstname];
		$this->freeaccount["lname"] = $lnames[$lastname];
		$this->freeaccount["dog"] = $dogs[$dog];
		$this->freeaccount["city"] = $cities[$city];
	} 
}