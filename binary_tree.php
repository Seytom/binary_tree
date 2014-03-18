<?php

function sort_array($any_array){

	class nodeElement {
		public
			$data,
			$prev=false,
			$next=false;

		public function __construct($data) {
			$this->data=$data;
		}

		public function add($data) {
			if ($this->data<$data) {
				if ($this->next) {
					$this->next->add($data);
				} else {
					$this->next=new nodeElement($data);
				}
			} else {
				if ($this->prev) {
					$this->prev->add($data);
				} else {
					$this->prev=new nodeElement($data);
				}
			}
		}

		public function show() {
			// echo "entering the show method for: ", $this->data, "<br>";
			if ($this->prev) $this->prev->show();
			echo $this->data, "<br>";  //print value
			if($this->prev) { //print value of previous node
				echo " Prev: ", $this->prev->data, "<br>" ;
			}
			else echo "Prev = false; <br>";
			if($this->next) {  //print value of next node
				echo " Next: ", $this->next->data, "<br><br>";
			}
			else echo "Next = false; <br><br>";
			if ($this->next) $this->next->show();
			// echo "leaving the show method for: ", $this->data, "<br>";
		}
	}

	class nodeTree {
		public
			$first=false;

		public function add($data) {
			if ($this->first) {
				$this->first->add($data);
			} else {
				$this->first=new nodeElement($data); //one time, adds root node
			}
		}

		public function show() {
			if ($this->first) {
				$this->first->show();
				echo "Tree root: ", $this->first->data, " <br> ";
			}
		}

	}

	$my_tree = new nodeTree();
	foreach ($any_array as $value){ //sort the array by adding each value to the tree
		$my_tree->add($value);
	}
	$my_tree->show();

}

$ran_array= array();
for ($i =0; $i<100000; $i++){
	$ran_array[]=rand(-5000,50000);
}

$my_array= array(45,2,35,42,88,17,17,221,3,46,455,23,13,6,77,89,604,17,46,17,175);//
$x = microtime(true);

sort_array($my_array);
$y= microtime(true);
echo "x= ", $x."<br>";
echo "y= " .$y."<br>";
echo "The process took ". ($y-$x) . " seconds.";


?>