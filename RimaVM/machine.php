<?php
require "opcodes.php";
require "compile.php";
require "utils.php";

class Machine {
	private $memory = [];
	private $var_table = [];
	private $instruct_ptr = 0;
	private $code = [];
	private $retval = "NULL";
	
	function __construct($code) {
		$this->code = $code;
	}
	
	private function reval($expr) {
		const NUM_CHARS = "0123456789";
		$expr = remove_whitespace($expr);
		$split_expr = str_split($expr);
		if(startsWith($expr, "@PTR:")) {
			return $this->memory[intval(explode(":", $expr)[1])];
		}
		elseif(startsWith($expr, "'") || startsWith($expr, '"')) {
			while(!((strpos($expr, "'") == false)||(strpos($expr, '"') == false))) {
				$expr = str_replace("'", "", $expr);
				$expr = str_replace('"', "", $expr);
				return $expr;
			}
		}
		elseif(strpos(NUM_CHARS, $split_expr == 0) != false) {
			return intval($expr);
		}
		else {
			return $this->reval($this->memory[$this->var_table[$expr]]);
		}
	}
	
	protected function exec_opcode($op, $args) {
		switch($op) {
			case ops::DEF:
				array_push($this->memory, $this->reval($args[1]));
				$this->var_table[$args[0]] = count($this->memory) - 1;
				break;
			case ops::LOADRET:
				$this->exec_opcode(ops::DEF, [$args[0], $this->retval]);
				break;
			case ops::ADD:
				$this->retval = $this->reval($args[0]) + $this->reval($args[1]);
				break;
			case ops::SUB:
				$this->retval = $this->reval($args[0]) - $this->reval(args[1]);
				break;
			case ops::MUL:
				$this->retval = $this->reval($args[0]) * $this->reval(args[1]);
				break;
			case ops::DIV:
				$this->retval = $this->reval($args[0]) / $this->reval(args[1]);
				break;
			case ops::FUNCDEF:
				$new_func = RimaFunction::def($this, $this->code, $this->instruct_ptr - 1);
				array_push($this->memory, $new_func[0]);
				$addr = count($this->memory) - 1;
				$this->exec_opcode(ops::DEF, [args[0], "@PTR:" . "$addr"]);
				break;
		}
	}
}

class RimaFunction {
	private $code = [];
	private $parentm = null;
	
	public static function def($vm, $code, $starting_pos) {
		$end = array_search([ops::ENDFUNCDEF, [$code[$starting_pos][1][0]]], $code);
		$length = $end - $starting_pos;
		$func_code = []; 
		foreach(array_slice($code, $starting_pos, $length) as &$c) {
			array_push($func_code, $c);
		}
		return [new RimaFunction($code, $vm), $end - 1];
	}
	
	function __constructor($code, $parent) {
		$this->code = $code;
		$this->parentm = $parent;
	}
	
	protected function call() {
		foreach($this->code as &$c) {
			$this->parentm->exec_opcode(c[0], c[1]);
		}
	}
}

?>