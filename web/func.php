<?php
function print_r_($value) {
	echo "<pre>";
	print_r($value);
	echo "</pre>";
}

function c_log($value){
	echo "<script>console.log('$value')</script>";
}