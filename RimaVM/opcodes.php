<?php

abstract class ops {
	const DEF = 0; //DEF varname, "value";
	const LOADRET = 1; //LOADRET varname;
	const ADD = 2; //ADD 1, 2;
	const SUB = 3; //SUB 2, 1;
	const MUL = 4; //MUL 1, 2;
	const DIV = 5; //DIV 10, 2;
	const FUNCDEF = 6; //FUNCDEF name, arg1, arg2;
	const READ = 7; //READ "filename";
	const WRITE = 8; //WRITE "filename", "contents";
	const CREAD = 9; //CREAD;
	const CWRITE = 10; //CWRITE content;
	const WEBOUT = 11; //WEBOUT "<p>content</p>";
	const INPUT = 12; //INPUT "<p>input prompt</p>";
	const ENDFUNCDEF = 13; //ENDFUNCDEF name;
	const WEBOUTF = 14; //WEBOUTF "string F[variable]";
	const CALL = 15; //CALL funcname;
	const DEFPTR = 16; //DEFPTR name, var;
	const LOADPTR = 17; // LOADPTR address;
	const PUSHRETURN = 18; //PUSHRETURN "value";
	const DEL = 19; //DEL varname;
}

function convert_stmt_op($stmt) {
	switch ($stmt) {
		case "DEF":
			return 0;
		case "LOADRET":
			return 1;
		case "ADD":
			return 2;
		case "SUB":
			return 3;
		case "MUL":
			return 4;
		case "DIV":
			return 5;
		case "FUNCDEF":
			return 6;
		case "READ":
			return 7;
		case "WRITE":
			return 8;
		case "CREAD":
			return 9;
		case "CWRITE":
			return 10;
		case "WEBOUT":
			return 11;
		case "INPUT":
			return 12;
		case "ENDFUNCDEF":
			return 13;
		case "WEBOUTF":
			return 14;
		case "CALL":
			return 15;
		case "DEFPTR":
			return 16;
		case "LOADPTR":
			return 17;
		case "PUSHRETURN":
			return 18;
		case "DEL":
			return 19;
	}
}

?>