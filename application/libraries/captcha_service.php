<?php
class Captcha_service extends Base_service {

	var $securimage;
	var $image_type;
	var $image_width = 316;
	var $image_height = 80;

	public function __construct($config = array()) {
		parent::__construct();

		// third_party
		third_party_load('securimage/securimage');

		// init
		$this->image_type = Securimage::SI_IMAGE_PNG;

		if (count($config) > 0) {
			$this->initialize($config);
		}

		// securimage
		$this->securimage = new Securimage(
				array(
					'image_type' => $this->image_type,
					'image_width' => $this->image_width,
					'image_height' => $this->image_height
				)
			);
	}

	public function initialize($config = array()) {
		foreach ($config as $key => $val) {
			if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
	}

	/**
	*
	* 使用者輸入的 code 與產生的 code 是否相同
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function is_vaild($code) {
		return $this->securimage->check($code);
	}

	/**
	*
	* 顯示圖片
	*
	* @access	public
	* @param	param (type) : param description
	* @return 	return : return description
	*
	*/
	public function show() {
		$this->securimage->show();
	}

}

?>