<?php
/**
 * Yireo Template Helper for Joomla!
 *
 * @author Yireo (info@yireo.com)
 * @package Yth
 * @copyright Copyright 2012
 * @license GNU Public License
 * @link http://www.yireo.com
 * @version 0.10.1
 *
 * Usage: 
 *      Place this file "js.php" in your template JS-folder (templates/TEMPLATE/js/js.php)
 *      Optionally modify $defaults and $options
 *      Call this file from within "index.php" instead of calling your scripts
 *          <?php echo Yth::addJsPhp(); ?>
 *
 * Array $defaults:
 *      List of all your template scripts
 *
 * Array $options:
 *      zlib: Enable zlib compresssion when outputting data
 *  
 */

// Basic PHP-settings
ini_set('display_errors', 1);

$ff = $_GET['ff'];
$fab = $_GET['fab'];
$fac = $_GET['fac'];
$fal = $_GET['fal'];
$fc = $_GET['fc'];
$fd = $_GET['fd'];
$fe = $_GET['fe'];
$fi = $_GET['fi'];
$fj = $_GET['fj'];
$fm = $_GET['fm'];
$foc = $_GET['foc'];
$fob = $_GET['fob'];
$fr = $_GET['fr'];
$fta = $_GET['fta'];
$fto = $_GET['fto'];
$ftb = $_GET['ftb'];

$scripts = array();
array_push($scripts, 'vendor/jquery.js');
if ($ff==1) array_push($scripts, 'foundation/foundation.min.js');
if ($fab==1) array_push($scripts, 'foundation/foundation.abide.min.js');
if ($fac==1) array_push($scripts, 'foundation/foundation.accordion.min.js');
if ($fal==1) array_push($scripts, 'foundation/foundation.alert.min.js');
if ($fc==1) array_push($scripts, 'foundation/foundation.clearing.min.js');
if ($fd==1) array_push($scripts, 'foundation/foundation.dropdown.min.js');
if ($fe==1) array_push($scripts, 'foundation/foundation.equalizer.min.js');
if ($fi==1) array_push($scripts, 'foundation/foundation.interchange.min.js');
if ($fj==1) array_push($scripts, 'foundation/foundation.joyride.min.js');
if ($fm==1) array_push($scripts, 'foundation/foundation.magellan.min.js');
if ($foc==1) array_push($scripts, 'foundation/foundation.offcanvas.min.js');
if ($fob==1) array_push($scripts, 'foundation/foundation.orbit.min.js');
if ($fr==1) array_push($scripts, 'foundation/foundation.reveal.min.js');
if ($fta==1) array_push($scripts, 'foundation/foundation.tab.min.js');
if ($fto==1) array_push($scripts, 'foundation/foundation.toolkit.min.js');
if ($ftb==1) array_push($scripts, 'foundation/foundation.topbar.min.js');

// Modify options
$options = array(
    'zlib' => 1,
);

/*************** DO NOT EDIT BELOW THIS LINE *********************/

// Initialize the class
$renderer = new JSRenderer($options);
$renderer->setScripts($scripts);
$renderer->output();

/*
 * JS Renderer class
 *
 * Usage:
 *      $renderer = new JSRenderer(); // Get a new blanc object
 *      $renderer = new JSRenderer($options); // Get a new object with default options
 *      $renderer->setOptions($options); // Set the options if they were not set yet
 *      $renderer->setScripts($scripts); // Set the options if they were not set yet
 */
class JSRenderer
{
    /*
     * Flag to enable zlib compression
     */
    private $zlib = 0;

    /*
     * Constructor
     *
     * @access public
     * @param array $options
     * @return null
     */
    public function __construct($options)
    {
        if(!empty($options)) {
            foreach($options as $name => $value) {
                $this->$name = $value;
            }
        }
    }

    /*
     * Method to set the default JS-scripts
     *
     * @access public
     * @param array $defaults
     * @return null
     */
    public function setScripts($js)
    {
        $this->js = $js;
    }

    /*
     * Method to output all the parsed JS
     *
     * @access public
     * @param null
     * @return null
     */
    public function output()
    {
        // Start output buffering
        if($this->zlib == 1 && extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
            @ob_start('ob_gzhandler');
        }

        // Output the JS header
        header('Content-type: text/javascript; charset: UTF-8');

        // Get the scripts
        $js = $this->getScripts();

        // Gather the content
        $content = null;
        foreach($js as $file) {
            if(is_file($file)) {
                $content .= "/* File: $file */\n";
                $content .= file_get_contents($file);
            } else {
                $content .= "/* Error loading file $file */\n";
            }
        }

        // Output the content
        print $content;

        // End output buffering
        if($this->zlib == 1 && extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
            ob_end_flush();
        }
    }

    /*
     * Method to get a list of the scripts that need to be loaded
     *
     * @access private
     * @param null
     * @return array
     */
    private function getScripts()
    {
        // Initialize the JS array
        $js = array();

        // Add output depending on extra GET-parameter
        if(isset($_GET['s']) && !empty($_GET['s'])) {
            $sheets = explode(',', $_GET['s']);
            foreach($sheets as $sheet) {

                // Make sure to append ".js" and remove whitespaces (NULL-bytes)
                if(preg_match('/\.js$/', $sheet) == false) $sheet = $sheet.'.js';
                $sheet = str_replace("\0", '', $sheet);
                $sheet = trim($sheet);

                // Determine the absolute file-path
                if(is_file($sheet) && is_readable($sheet)) {
                    $sheet = realpath($sheet);
                } else {
                    $sheet = realpath(JPATH_BASE.$sheet);
                }

                // If this absolute filepath lies outside of Joomla!, skip it
                if(is_file($sheet) && is_readable($sheet) && strpos($sheet, JPATH_BASE) === 0) {
                    $js[] = $sheet;
                }
            }
        }

        // Add the defaults to the JS-array
        if(!empty($this->js)) {
            foreach($this->js as $sheet) {
                if(is_file($sheet)) {
                    $js[] = $sheet;
                }
            }
        }

        return $js;
    }
}

