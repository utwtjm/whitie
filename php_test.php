<?php
/**
 * Please note this file shouldn't be exposed on a live server,
 * there is no filtering of $_POST!!!!
 * 目前先把 session_destory 取消，原本看網路上是說 session 沒 destory，assert 會被 cache 但我測試並沒有耶
 */
error_reporting(-1);

// Determines if running in cli mode
if (isset($argv))
{
	$cli_mode = setup_cli($argv);
}

/**
 * Configure your paths here:
 */
define('MAIN_PATH', realpath(dirname(__FILE__)).'/');
define('SIMPLETEST', MAIN_PATH.'php_test/simpletest/'); // Directory of simpletest
define('ROOT', MAIN_PATH); // Directory of codeigniter index.php
define('TESTS_DIR', MAIN_PATH.'php_test/'); // Directory of your tests.
define('APP_DIR', MAIN_PATH.'application/'); // CodeIgniter Application directory
define('UNIT_TEST_MODE', TRUE); // 判斷現在是不是在 unit test 下

//do not use autorun as it output ugly report upon no test run
require_once SIMPLETEST.'unit_tester.php';
require_once SIMPLETEST.'mock_objects.php';
require_once SIMPLETEST.'collector.php';
require_once SIMPLETEST.'web_tester.php';
require_once SIMPLETEST.'extensions/my_reporter.php';
require_once SIMPLETEST.'extensions/cli_reporter.php';

$test_suite = new TestSuite();
$test_suite->_label = 'CodeIgniter Test Suite';

class CodeIgniterUnitTestCase extends UnitTestCase {
	protected $_ci;

	public function __construct($name = '')
	{
		parent::__construct($name);
		$this->_ci =& get_instance();
	}

	public function __get($var)
	{
		return $this->_ci->$var;
	}
}

class CodeIgniterWebTestCase extends WebTestCase {
	protected $_ci;

	public function __construct($name = '')
	{
		parent::__construct($name);
		$this->_ci =& get_instance();
	}

	public function __get($var)
	{
		return $this->_ci->$var;
	}
}

// Because get is removed in ci we pull it out here.
$run_all = FALSE;
if (isset($_GET['all']) || isset($_POST['all']))
{
	$run_all = TRUE;
}

//Capture CodeIgniter output, discard and load system into $CI variable
ob_start();
	include(ROOT.'index.php');
	$CI =& get_instance();
ob_end_clean();

$CI->load->library('session');
$CI->load->helper('directory');
$CI->load->helper('form');
// $CI->session->sess_destroy();

// Get all main tests
if ($run_all OR ( ! empty($_POST) && ! isset($_POST['test'])))
{
	$test_objs = array('controllers','models','views','libraries','bugs','helpers');

	foreach ($test_objs as $obj)
	{
		if (isset($_POST[$obj]) OR $run_all)
		{
			$dir = TESTS_DIR.$obj;
			$dir_files = directory_map($dir);
			foreach ($dir_files as $file)
			{

				if(is_test_file($file)) {
					$test_suite->addFile($dir.'/'.$file);
				}
				
			}
		}
	}
}
elseif (isset($_POST['test'])) //single test
{
	$file = $_POST['test'];

	if (file_exists(TESTS_DIR.$file))
	{
		$test_suite->addFile(TESTS_DIR.$file);
	}
}

// ------------------------------------------------------------------------

/**
 * Function to determine if in cli mode and if so set up variables to make it work
 *
 * @param Array of commandline args
 * @return Boolean true or false if commandline mode setup
 *
 */
function setup_cli($argv)
{
	if (php_sapi_name() == 'cli')
	{
		if (isset($argv[1]))
		{
			if (stripos($argv[1],'.php') !== false)
			{
				$_POST['test'] = $argv[1];
			}
			else
			{
				$_POST[$argv[1]] = $argv[1];
			}
		}
		else
		{
			$_POST['all'] = 'all';
		}
		$_SERVER['HTTP_HOST'] = '';
		$_SERVER['REQUEST_URI'] = '';
		return true;
	}
	return false;
}

/**
*
* 這個檔案是否是 test file 
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function is_test_file($file) {
	// 如果是 fake 開頭的也不做 test
	if(strpos($file, 'fake') !== false) {
		return false;
	}

	if ($file == 'index.html') {
		return false;
	}
	return true;
}

/**
*
* 顯示 test 的 data 
*
* @access	public
* @param	param (type) : param description
* @return 	return : return description
*
*/
function show_result($result, $type = null, $class = null, $function = null) {
	$backtrace = debug_backtrace();
	$function_name = is_null($function) ? $backtrace[1]['function'] : $function;
	$class_name = is_null($class) ? $backtrace[1]['class'] : $class;
	$id = uniqid();

	echo '<div class="test pass">';
	echo '<div class="result">PASSED</div>';
	echo '<h3>'.$function_name.' - <a href="#" style="color:green;" onclick=\'show_result("'.$id.'");return false;\'>顯示結果</a></h3>';
	echo '<div class="details" style="display:none;" id="'.$id.'">';
	if($type == 'image' || $type == 'link') {
		echo $result;
	} else {
		echo var_dump($result);				
	}
	echo '</div>';
	echo '</div>';
}

/**
 *
 * 顯示圖片
 *
 * @param type param
 *
 */
function show_image($result) {
	$backtrace = debug_backtrace();
	return show_result($result, 'image', $backtrace[1]['class'], $backtrace[1]['function']);
}

/**
 *
 * 顯示圖片
 *
 * @param type param
 *
 */
function show_link($result) {
	$backtrace = debug_backtrace();
	return show_result($result, 'link', $backtrace[1]['class'], $backtrace[1]['function']);
}

/**
 * Function to map tests and strip .html files.
 *
 *
 * @param	string
 * @return 	array
 */
function map_tests($location = '')
{
	if (empty($location))
	{
		return FALSE;
	}

	$files = directory_map($location);
	$return = array();

	foreach ($files as $file)
	{

		$is_test_file = is_test_file($file);
		if($is_test_file) {
			$return[] = $file;
		}
	}
	return $return;
}

//variables for report
$controllers = map_tests(TESTS_DIR.'controllers');
$models = map_tests(TESTS_DIR.'models');
$views = map_tests(TESTS_DIR.'views');
$libraries = map_tests(TESTS_DIR.'libraries');
$bugs = map_tests(TESTS_DIR.'bugs');
$helpers = map_tests(TESTS_DIR.'helpers');
$form_url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//display the form
if (isset($cli_mode))
{
	exit ($test_suite->run(new CliReporter()) ? 0 : 1);
}
else
{
	include(TESTS_DIR.'test_gui.php');
}

