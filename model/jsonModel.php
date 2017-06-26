<?php

class JSON {

	public $json_array = [
		"status" => true,
	];

	public function write($key, $str) {
		$this->json_array[$key] = $str;
		$this->json_array['status'] = false;
	}

	public function pop($print = false) {
		if($print)
			echo json_encode($this->json_array, JSON_UNESCAPED_UNICODE);
		else
			return json_encode($this->json_array, JSON_UNESCAPED_UNICODE);
	}

	public function ok() {
		return $this->json_array['status'];
	}

	public function warning($key, $str) {
		$this->json_array[$key] = $str;
	}

}
