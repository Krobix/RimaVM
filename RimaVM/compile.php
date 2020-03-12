<?php

function remove_whitespace($str) {
	$lexed_str = str_split($str);
	while(($lexed_str[0] == " ") || ($lexeed_str[0] == "\n")) {
		unset($lexed_str[0]);
	}
	return implode($lexed_str);
}

function compile_single_ln($ln) {
	
}

?>