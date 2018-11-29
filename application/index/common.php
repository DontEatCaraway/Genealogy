<?php
		/**
	 * 验证手机号码格式
	 * @param string $phone 手机号
	 * @return boolean
	 */
	function is_phone($phone) {
	    $chars = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/";
	    if (preg_match($chars, $phone)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	/**
	 * 验证固定电话格式
	 * @param string $tel 固定电话
	 * @return boolean
	 */
	function is_tel($tel) {
	    $chars = "/^([0-9]{3,4}-)?[0-9]{7,8}$/";
	    if (preg_match($chars, $tel)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	/**
	 * 验证邮箱格式
	 * @param string $email 邮箱
	 * @return boolean
	 */
	function is_email($email) {
	    $chars = "/^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i";
	    if (preg_match($chars, $email)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	/**
	 * 验证身份证号码格式
	 * @param string $id_card 身份证号码
	 * @return boolean
	 */
	function is_idcard($id_card) {
	    $chars = "/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/";
	    if (preg_match($chars, $id_card)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	/**
	 * 验证银行卡号码格式
	 * @param string $id_card 银行卡号码
	 * @return boolean
	 */
	function is_bank($bank) {
	    $chars = "/^(\d{16}|\d{19}|\d{17})$/";
	    if (preg_match($chars, $bank)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	//验证中文姓名
	function isChineseName($name){
	    if (preg_match('/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/', $name)) {
	        return true;
	    } else {
	        return false;
	    }
	}

?>