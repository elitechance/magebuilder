<?php
/**
 * User: Ethan Dave Gomez
 * Date: 9/18/13
 * Time: 4:29 PM
 */

class MageBuilder {
    const TEMPLATE_MODEL = <<<TEMPLATE_MODEL_HD
<?php

class {CLASS} extends {PARENT_CLASS} {

    public function _construct() {
        /**
         * @todo - init must go here
         */
    }

    public function hi() {
        Zend_Debug::dump("Inside {CLASS}::hi() method");
    }
}

?>
TEMPLATE_MODEL_HD;

    const TEMPLATE_BLOCK = <<<TEMPLATE_BLOCK_HD
<?php

class {CLASS} extends {PARENT_CLASS} {

    public function _construct() {
        /**
         * @todo - init must go here
         */
    }

    public function hi() {
        Zend_Debug::dump("Inside {CLASS}::hi() method");
    }
}

?>
TEMPLATE_BLOCK_HD;


    const TEMPLATE_HELPER = <<<TEMPLATE_HELPER_HD
<?php

class {CLASS} extends {PARENT_CLASS} {

    public function hi() {
        Zend_Debug::dump("Inside {CLASS}::hi() method");
    }

}

?>
TEMPLATE_HELPER_HD;

    const TEMPLATE_CONTROLLER = <<<TEMPLATE_CONTROLLER_HD
<?php

class {CLASS} extends Mage_Core_Controller_Front_Action {

    public function indexAction() {

        Zend_Debug::dump("{CLASS} Index Action");
{METHODS}
    }
}

?>
TEMPLATE_CONTROLLER_HD;

    const CACHE_TYPES_BLOCK_HTML = 'block_html';
    const CACHE_TYPES_COLLECTIONS = 'collections';
    const CACHE_TYPES_CONFIG = 'config';
    const CACHE_TYPES_CONFIG_API = 'config_api';
    const CACHE_TYPES_CONFIG_API2 = 'config_api2';
    const CACHE_TYPES_EAV = 'eav';
    const CACHE_TYPES_FULL_PAGE = 'full_page';
    const CACHE_TYPES_LAYOUT = 'layout';
    const CACHE_TYPES_TRANSLATE = 'translate';

    const CONFIG_DIR = '.magebuilder';
    const CONFIG_FILE = 'config.json';

    const CODEPOOL_COMMUNITY = 'community';
    const CODEPOOL_CORE = 'core';
    const CODEPOOL_LOCAL = 'local';

    const GROUP_TYPE_MODEL = 'Model';
    const GROUP_TYPE_BLOCK = 'Block';
    const GROUP_TYPE_HELPER = 'Helper';
    const GROUP_TYPE_CONTROLLER = 'Controller';
    const CLASS_DELIMITER = '_';

    /**
     * PIDX_CM_NAME - Create Module Name
     * PIDX_CM_ALIAS - Create Module Alias
     * ...
     *
     */
    const PIDX_CM_NAME = 2;
    const PIDX_CM_ALIAS = 3;
    const PIDX_CM_CODEPOOL = 4;


    /**
     * PIDX_CMD_MODULE - Create Model Module
     */
    const PIDX_CMD_MODULE = 2;
    const PIDX_CMD_NAME = 3;

    const PIDX_COMMAND = 1;
    const PIDX_EXTENDS = 3;
    const PVAL_EXTENDS = 'extends';
    const PIDX_PARENT_CLASS = 4;
    const PIDX_INIT = 1;
    const PIDX_ROOT_PATH = 2;
    /**
     * CO - Create Object
     */
    const PIDX_CO_CLASS_TYPE = 2;

    /**
     * Check path
     */
    const PIDX_CHECK_PATH_GROUP_TYPE = 2;
    const PIDX_CHECK_PATH_CLASS_TYPE = 3;

    /**
     * Check class path
     */
    const PIDX_CHECK_CLASS_PATH_GROUP_TYPE = 2;
    const PIDX_CHECK_CLASS_PATH_CLASS_TYPE = 3;

    /**
     * (CP) Create Project
     */
    const PIDX_CP_MODULE = 2;
    const PIDX_CP_ALIAS = 3;

    const ERRMSG_CREATE_FILE = "Unable to create file: '%s'\n";
    const ERRMSG_CREATE_DIR = "Unable to create dir: [%s]\n";

    const ERRMSG_INVALID_ROOTPATH = "Please specify a valid Magento root path: '%s'\n";
    const ERRMSG_UNKNOWN_COMMAND = "Unknown Command: [%s]\n";
    const ERRMSG_INVALID_CM_PARAMS = "Please specify name and alias.\n\n    $ magebuilder create-module <module name> <alias>\n";
    const ERRMSG_INVALID_CODEPOOL = "Invalid Code Pool: '%s'\n    $ magebuilder create-module <module name> <alias> [core|community|local]\n";
    const ERRMSG_INVALID_MODULE_NAME = "Module name does not exists [%s].\n\n    Hint:\n    $ magebuider create-module <module name> <alias>\n";
    const ERRMSG_INVALID_CLASS_TYPE = "Invalid class-type: [%s]\n";
    const ERRMSG_INVALID_GROUP_TYPE = "Invalid group-type: [%s]\n";
    const ERRMSG_INVALID_CLASS_FILE = "Invalid class file: [%s]\n";
    const ERRMSG_INVALID_CLASS_PATH = "Invalid class path: [%s]\n";

    const ERRMSG_EXTENDING_ITSELF  = "Error: The class is extending itself: [%s]\n";
    const ERRMSG_MAGE_ROOTPATH = "Please specify Magento root path\n\n    $ magebuider init <root path>\n";

    const MESSAGE_VERIFY_FILE = "Are you sure you want to overwrite '%s' [y|n]? (default 'n') \n";

    const MESSAGE_REFRESH_XML_CACHE = "Refreshing *.xml Cache...\n";
    const MESSAGE_REFRESH_XML_CACHE_DONE = "Refreshing *.xml Cache... Done\n";
    const MESSAGE_REFRESH_CONFIG_CACHE = "Refreshing Config Cache...\n";
    const MESSAGE_REFRESH_CONFIG_CACHE_DONE = "Refreshing Config Cache... Done\n";

    const COMMAND_CREATE_MODULE = 'create-module';
    const COMMAND_CREATE_MODEL = 'create-model';
    const COMMAND_CREATE_HELPER = 'create-helper';
    const COMMAND_CREATE_BLOCK = 'create-block';
    const COMMAND_CREATE_CONTROLLER = 'create-controller';
    const COMMAND_CREATE_PROJECT = 'create-project';
    const COMMAND_CHECK_PATH = 'check-path';
    const COMMAND_CHECK_CLASS_PATH = 'check-class';
    const COMMAND_INIT = 'init';

    /**
     * @var string
     */
    protected $_homeDir;

    /**
     * @var string
     */
    protected $_mageBuilderDir;

    /**
     * @var string
     */
    protected $_magentoRootPath;

    /**
     * @var array
     */
    protected $_argv;

    /**
     * @var int
     */
    protected $_argc;

    /**
     * @var array
     */
    protected $_config;

    /**
     * @var string
     */
    protected $_codePool;

    /**
     * @var string
     */
    protected $_mageBuilderFile;

    /**
     * @var Mage_Core_Model_Config
     */
    protected $_mageConfig;

    private function _error($message) {
        $args = func_get_args();
        switch(count($args)) {
            case 2: printf($message, $args[1]); break;
            case 3: printf($message, $args[1], $args[2]); break;
            case 4: printf($message, $args[1], $args[2], $args[3]); break;
            case 5: printf($message, $args[1], $args[2], $args[3], $args[4]); break;
            default: printf($message);
        }
        exit;
    }

    private function _removeEndSlash($path) {
        return preg_replace('/\/$/', '', $path);
    }

    private function _loadMagento() {
        require_once $this->_magentoRootPath . '/app/Mage.php';
        Mage::app('admin');
    }

    private function _testMagentoRootPath() {
        if ($this->_argc <= 2) {
            $this->_error(self::ERRMSG_MAGE_ROOTPATH);
        }
        $this->_magentoRootPath = $this->_removeEndSlash($this->_getArgParam(self::PIDX_ROOT_PATH));
        if (!file_exists($this->_magentoRootPath . '/app/Mage.php')) {
            $this->_error(self::ERRMSG_INVALID_ROOTPATH, $this->_magentoRootPath);
        }
    }

    private function _checkInitialMagentoRootPath() {
        $this->_testMagentoRootPath();
        $this->_loadMagento();
        $this->_magentoRootPath = Mage::getBaseDir();
        $this->_config = (object) array();
        $this->_config->magentoRootPath = $this->_magentoRootPath;
    }

    private function _loadConfig() {
        $fp = fopen($this->_mageBuilderFile, "r");
        $this->_config = json_decode( fread($fp, 1024) );
        fclose($fp);
        $this->_magentoRootPath = $this->_config->magentoRootPath;
    }

    private function _saveConfig() {
        $fp = fopen($this->_mageBuilderFile, "w");
        if (!$fp) {
            $this->_error(self::ERRMSG_CREATE_FILE, $this->_mageBuilderFile);
        }
        fwrite($fp, json_encode($this->_config));
        fclose($fp);
    }

    private function _createMageBuilderDir(){
        $ok = $this->_mkdir($this->_mageBuilderDir);
        if (!$ok) {
            $this->_error(self::ERRMSG_CREATE_DIR, $this->_homeDir);
        }
    }

    protected function _checkConfig() {
        if (!file_exists($this->_mageBuilderDir)) {
            if ($this->_argc <= 1 || $this->_getArgParam(self::PIDX_INIT) != 'init') {
                $this->_error(self::ERRMSG_MAGE_ROOTPATH);
            }
            $this->_checkInitialMagentoRootPath();
            $this->_createMageBuilderDir();

            $this->_saveConfig();
            exit;
        }
        else {
            $this->_loadConfig();
            $this->_loadMagento();
        }
    }

    private function _detectHomeDir() {
        $this->_homeDir = $this->_removeEndSlash( $_SERVER['HOME'] );
    }

    private function _toModuleName($name) {
        $namespace = explode(self::CLASS_DELIMITER, $name);
        return ucfirst($namespace[0]) . self::CLASS_DELIMITER . ucfirst($namespace[1]);
    }

    /**
     * @param SimpleXMLElement $xml
     * @param string $moduleName
     * @param string $moduleAlias
     */
    private function _addModuleBlocks($xml, $moduleName, $moduleAlias){
        $xml->global->addChild('blocks')->addChild($moduleAlias)->class = $moduleName .self::CLASS_DELIMITER. self::GROUP_TYPE_BLOCK;
    }

    /**
     * @param SimpleXMLElement $xml
     * @param string $moduleName
     * @param string $moduleAlias
     */
    private function _addModuleModels($xml, $moduleName, $moduleAlias){
        $xml->global->addChild('models')->addChild($moduleAlias)->class = $moduleName .self::CLASS_DELIMITER. self::GROUP_TYPE_MODEL;
    }

    /**
     * @param SimpleXMLElement $xml
     * @param string $moduleName
     * @param string $moduleAlias
     */
    private function _addModuleHelpers($xml, $moduleName, $moduleAlias){
        $xml->global->addChild('helpers')->addChild($moduleAlias)->class = $moduleName .self::CLASS_DELIMITER. self::GROUP_TYPE_HELPER;
    }

    /**
     * @param SimpleXMLElement $xml
     * @param string $moduleName
     * @param string $moduleAlias
     */
    private function _addModuleResources($xml, $moduleName, $moduleAlias){
        $xml->global->addChild('resources')->addChild($moduleAlias.'_setup')->addChild('setup')->module = $moduleName;
    }

    /**
     * @param SimpleXMLElement $xml
     * @param string $moduleName
     * @param string $moduleAlias
     */
    private function _addModuleFrontend($xml, $moduleName, $moduleAlias){
        $xml->addChild('frontend')->addChild('routers')->addChild($moduleAlias)->use = 'standard';
        $xml->frontend->routers->{$moduleAlias}->use = 'standard';
        $xml->frontend->routers->{$moduleAlias}->addChild('args')->module = $moduleName;
        $xml->frontend->routers->{$moduleAlias}->args->frontName = $moduleAlias;
    }

    /**
     * @param SimpleXMLElement $xml
     * @param string $moduleName
     * @param string $moduleAlias
     */
    private function _addModuleLayout($xml, $moduleName, $moduleAlias){
        $xml->frontend->addChild('layout')->addChild('updates')->addChild($moduleAlias)->file = $moduleAlias.'.xml';
        $xml->frontend->layout->updates->{$moduleAlias}->addAttribute('module', $moduleName);
    }

    private function _verify($message) {
        echo $message;
        $response = $this->_readLn();
        return $response;
    }

    private function _message($message) {
        echo $message;
    }

    private function _createFile($path, $content, $check = true){
        if ($check) {
            if (file_exists($path)) {
                $response = $this->_verify(sprintf(self::MESSAGE_VERIFY_FILE, $path));

                if (!$response) { $response = 'n'; }

                if ($response == 'n') {return;}
            }
        }

        $fp = fopen($path, "w");

        if (!$fp) {
            $this->_error(self::ERRMSG_CREATE_FILE, $path);
        }

        fwrite($fp, $content);
        fclose($fp);
    }

    private function _readLn() {
        $stdin = fopen("php://stdin", "r");
        $line = fgets($stdin);
        $line = preg_replace("/\n$/", '', $line);
        $line = preg_replace("/\r$/", '', $line);
        return $line;
    }

    private function _createEtcModule($moduleName, $moduleAlias){
        $moduleXml = new SimpleXMLElement('<config></config>');
        $moduleXml->addChild('modules')->addChild($moduleName)->active = 'true';

        $codePool = strtolower($this->_getArgParam(self::PIDX_CM_CODEPOOL));
        if ($codePool) {
            switch ($codePool) {
                case self::CODEPOOL_COMMUNITY:
                case self::CODEPOOL_CORE:
                case self::CODEPOOL_LOCAL: break;
                default: $this->_error(self::ERRMSG_INVALID_CODEPOOL, $codePool);
            }
        }
        else {
            $codePool = self::CODEPOOL_LOCAL;
        }

        $this->_codePool = $codePool;
        $moduleXml->modules->{$moduleName}->codePool = $codePool;
        $dom = dom_import_simplexml($moduleXml)->ownerDocument;
        $dom->formatOutput = true;
        $moduleFile = $this->_magentoRootPath . '/app/etc/modules/'.$moduleName.'.xml';
        $this->_createFile($moduleFile, $dom->saveXML());
    }

    private function _createModuleConfig($moduleName, $moduleAlias){
        $moduleConfigXml = new SimpleXMLElement('<config></config>');
        $moduleConfigXml->addChild('modules')->addChild($moduleName)->addChild('version');
        $moduleConfigXml->modules->{$moduleName}->version = '0.0.1';

        $global = $moduleConfigXml->children('global');
        if (!$global) { $moduleConfigXml->addChild('global'); }

        $this->_addModuleBlocks($moduleConfigXml, $moduleName, $moduleAlias);
        $this->_addModuleModels($moduleConfigXml, $moduleName, $moduleAlias);
        $this->_addModuleHelpers($moduleConfigXml, $moduleName, $moduleAlias);
        $this->_addModuleResources($moduleConfigXml, $moduleName, $moduleAlias);
        $this->_addModuleFrontend($moduleConfigXml, $moduleName, $moduleAlias);
        $this->_addModuleLayout($moduleConfigXml, $moduleName, $moduleAlias);

        $dom = dom_import_simplexml($moduleConfigXml)->ownerDocument;
        $dom->formatOutput = true;

        $moduleNameInfo = explode(self::CLASS_DELIMITER, $moduleName);
        $moduleDir = $this->_magentoRootPath.'/app/code/'.$this->_codePool.'/'.$moduleNameInfo[0].'/'.$moduleNameInfo[1];
        $this->_mkdir($moduleDir);
        $this->_mkdir($moduleDir.'/etc');
        $this->_mkdir($moduleDir.'/controllers');
        $this->_mkdir($moduleDir.'/Helper');
        $this->_mkdir($moduleDir.'/Model');
        $this->_mkdir($moduleDir.'/Block');
        $this->_mkdir($moduleDir.'/sql');
        $this->_mkdir($moduleDir.'/sql/'.$moduleAlias.'_setup');

        $moduleConfigFile = $moduleDir.'/etc/config.xml';
        $this->_createFile($moduleConfigFile, $dom->saveXML());
    }

    private function _mkdir($dir, $checkError = false) {
        if (file_exists($dir)) { return false; }
        $result = mkdir($dir, 0775, true);
        if (!$result && $checkError) {
            $this->_error(self::ERRMSG_CREATE_DIR, $dir);
        }
        return $result;
    }

    protected function _refreshCache($cacheType = null) {
        try {
            /**
             * @var array $allTypes
             */
            $allTypes = Mage::app()->useCache();
            foreach($allTypes as $type => $isActive) {
                if ($cacheType) {
                    if ($cacheType == $type) {
                        Mage::app()->getCacheInstance()->cleanType($type);
                        break;
                    }
                }
                else {
                    Mage::app()->getCacheInstance()->cleanType($type);
                }
            }
        } catch (Exception $e) {
            // do something
            error_log($e->getMessage());
        }
    }

    private function _processCreateModule() {
        $moduleName = $this->_toModuleName( $this->_getArgParam(self::PIDX_CM_NAME) );
        $moduleAlias = strtolower( $this->_getArgParam(self::PIDX_CM_ALIAS) );

        if (!$moduleAlias || !$moduleName) { $this->_error(self::ERRMSG_INVALID_CM_PARAMS); }

        $this->_createEtcModule($moduleName, $moduleAlias);
        $this->_createModuleConfig($moduleName, $moduleAlias);

        $this->_message(self::MESSAGE_REFRESH_XML_CACHE);
        $this->_refreshCache(self::CACHE_TYPES_CONFIG);
        $this->_message(self::MESSAGE_REFRESH_XML_CACHE_DONE);
    }

    private function _removeDir($dir){
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->_removeDir("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    private function _processInit() {
        $this->_testMagentoRootPath();
        /**
         * Set new Magento Root Path and save it
         */
        $this->_config->magentoRootPath = $this->_magentoRootPath;
        $this->_saveConfig();
    }

    private function _getModuleName($type){
        $config = Mage::getConfig();
        $className = $config->getModelClassName($type);
        $classInfo = explode(self::CLASS_DELIMITER, $className);
        $moduleName = $classInfo[0].self::CLASS_DELIMITER.$classInfo[1];
        return $moduleName;
    }

    private function _getObjectClassName(&$classType, $groupType){
        $config = Mage::getConfig();
        switch ($groupType) {
            case self::GROUP_TYPE_MODEL: return $config->getModelClassName($classType);
            case self::GROUP_TYPE_HELPER:
                /**
                 * Setting default helper class Data.php
                 */
                if (!preg_match('/\//', $classType)) {
                    $classType .= '/data';
                }
                return $config->getHelperClassName($classType);
            case self::GROUP_TYPE_BLOCK: return $config->getBlockClassName($classType);
            case self::GROUP_TYPE_CONTROLLER:
                $className = $config->getModelClassName($classType);
                $className = preg_replace('/'.self::CLASS_DELIMITER.self::GROUP_TYPE_MODEL.'/',  '', $className, 1);
                $className .= self::GROUP_TYPE_CONTROLLER;
                return $className;
            default: return false;
        }
    }

    private function _getClassNameDir($className) {
        $classInfo = explode(self::CLASS_DELIMITER, $className);
        $moduleDir = Mage::getModuleDir('', $classInfo[0].self::CLASS_DELIMITER.$classInfo[1]);

        /**
         * Hack for controller class
         */
        if (preg_match('/'.self::GROUP_TYPE_CONTROLLER.'$/', $className)) {
            $moduleDir .= '/controllers';
            if ( count($classInfo) > 3  ) {
                $moduleTypeDir = $moduleDir.'/'.$classInfo[2];
            }
            else {
                $moduleTypeDir = $moduleDir;
            }
        }
        else {
            $moduleTypeDir = $moduleDir.'/'.$classInfo[2];
        }

        for ($i = 0; $i < (count($classInfo)-1); $i++) {
            if ($i == 0 || $i == 1 || $i == 2) { continue; }
            $moduleTypeDir .= '/'.$classInfo[$i];
        }
        return $moduleTypeDir;
    }

    private function _getClassNameFile($className) {
        $classInfo = explode(self::CLASS_DELIMITER, $className);
        return $classInfo[count($classInfo) - 1 ].'.php';
    }

    private function _getParentClassType($childClassName){
        $hasExtend = $this->_getArgParam(self::PIDX_EXTENDS);
        $classType = '';
        $parentClassName = '';

        if ($hasExtend == self::PVAL_EXTENDS) {
            $classType = $this->_getArgParam(self::PIDX_PARENT_CLASS);
        }
        else {
            return $parentClassName;
        }

        if (!$classType) {
            $this->_error(self::ERRMSG_INVALID_CLASS_TYPE, $classType);
        }

        $command = $this->_getArgParam(self::PIDX_COMMAND);


        switch($command) {
            case self::COMMAND_CREATE_MODEL: $parentClassName = $this->_getObjectClassName($classType, self::GROUP_TYPE_MODEL); break;
            case self::COMMAND_CREATE_HELPER: $parentClassName = $this->_getObjectClassName($classType, self::GROUP_TYPE_HELPER); break;
            case self::COMMAND_CREATE_BLOCK: $parentClassName = $this->_getObjectClassName($classType, self::GROUP_TYPE_BLOCK); break;
            case self::COMMAND_CREATE_CONTROLLER:  $this->_error("@todo - support controller custom extend\n"); break;
        }
        $ok = class_exists($parentClassName);
        if (!$ok) {
            $this->_error(self::ERRMSG_INVALID_CLASS_TYPE, $classType);
        }

        if ($childClassName == $parentClassName) {
            $this->_error(self::ERRMSG_EXTENDING_ITSELF, $childClassName);
        }

        return $parentClassName;
    }

    /**
     * @param string $className
     * @return string
     */
    private function _getModelTemplate($className){
        $parent = 'Mage_Core_Model_Abstract';

        $customParent = $this->_getParentClassType($className);

        if ($customParent) {
            $parent = $customParent;
        }

        $template = self::TEMPLATE_MODEL;
        $template = preg_replace('/{CLASS}/', $className, $template);
        $template = preg_replace('/{PARENT_CLASS}/', $parent, $template);
        return $template;
    }

    /**
     * @param string $className
     * @return string
     */
    private function _getBlockTemplate($className) {
        $parent = 'Mage_Core_Block_Abstract';

        $customParent = $this->_getParentClassType($className);

        if ($customParent) {
            $parent = $customParent;
        }

        $template = self::TEMPLATE_BLOCK;
        $template = preg_replace('/{CLASS}/', $className, $template);
        $template = preg_replace('/{PARENT_CLASS}/', $parent, $template);
        return $template;
    }

    /**
     * @param string $className
     * @return mixed
     */
    private function _getHelperTemplate($className) {
        $parent = 'Mage_Core_Helper_Abstract';

        $customParent = $this->_getParentClassType($className);

        if ($customParent) {
            $parent = $customParent;
        }

        $template = self::TEMPLATE_HELPER;
        $template = preg_replace('/{CLASS}/', $className, $template);
        $template = preg_replace('/{PARENT_CLASS}/', $parent, $template);
        return $template;
    }

    /**
     * @param string $className
     * @return mixed
     */
    private function _getControllerTemplate($className = '') {
        $template = self::TEMPLATE_CONTROLLER;
        $template = preg_replace('/{CLASS}/', $className, $template);

        $testMethods = '';
        $alias = $this->_getArgParam(self::PIDX_CP_ALIAS);
        if ($this->_getArgParam(self::PIDX_COMMAND) == self::COMMAND_CREATE_PROJECT) {
            $testMethods = <<<TEST_METHODS
        \$helloModel = Mage::getModel('$alias/hello');
        \$helloModel->hi();
        \$helperModel = Mage::helper('$alias');
        \$helperModel->hi();

TEST_METHODS;
        }

        $template = preg_replace('/{METHODS}/', $testMethods, $template);
        return $template;
    }

    private function _getTemplate($classType, $className) {
        $template = '';
        switch($classType) {
            case self::GROUP_TYPE_MODEL: $template = $this->_getModelTemplate($className); break;
            case self::GROUP_TYPE_BLOCK: $template = $this->_getBlockTemplate($className); break;
            case self::GROUP_TYPE_HELPER: $template = $this->_getHelperTemplate($className); break;
            case self::GROUP_TYPE_CONTROLLER: $template = $this->_getControllerTemplate($className); break;
        }
        return $template;
    }

    private function _processCreateObject($classType, $groupType) {
        try {
            $className = $this->_getObjectClassName($classType, $groupType);
            $moduleName = $this->_getModuleName($classType);
            $moduleFile = $this->_magentoRootPath.'/app/etc/modules/'.$moduleName.'.xml';
            if (!file_exists($moduleFile)) {
                $this->_error(self::ERRMSG_INVALID_MODULE_NAME, $moduleFile);
            }
            $classNameDir = $this->_getClassNameDir($className);
            $this->_mkdir($classNameDir);

            $classNameFile = $classNameDir . '/'. $this->_getClassNameFile($className);
            $template = $this->_getTemplate($groupType, $className);

            /**
             * Debug
             *
             */
/*
            var_dump($classNameFile);
            var_dump($template);
            */
            $this->_createFile($classNameFile, $template);
        }
        catch (Exception $e) {
            $this->_error($e->getMessage());
        }
    }

    private function _getArgParam($index) {
        if ($index >= count($this->_argv)) return '';
        return $this->_argv[$index];
    }

    private function _processCreateProject(){
        $alias = $this->_getArgParam(self::PIDX_CP_ALIAS);
        $model = $alias.'/hello';
        $helper = $alias;
        $controller = $alias.'/index';
        $this->_processCreateModule();

        $this->_message(self::MESSAGE_REFRESH_CONFIG_CACHE);
        $this->_mageConfig->cleanCache();
        $this->_message(self::MESSAGE_REFRESH_CONFIG_CACHE_DONE);

        $this->_processCreateObject($model, self::GROUP_TYPE_MODEL);
        $this->_processCreateObject($helper, self::GROUP_TYPE_HELPER);
        $this->_processCreateObject($controller, self::GROUP_TYPE_CONTROLLER);
    }

    private function _usage(){
        $usage = <<<USAGE
Usage:
$ php magebuilder <command> <[options]>
    Commands:
        * create-project <module-name> <module-alias>
        * create-modules <module-name> <module-alias> [code-pool]
        * create-model <class-type> [extends <class-type>]
        * create-block <class-type> [extends <class-type>]
        * create-helper <class-type> [extends <class-type>]
        * create-controller <class-type> [extends <class-type>]

        * check-path <class-type>
        * check-class <class-type>

        Options:
           module-name
               * Test_MageBuilder --> app/etc/Test_MageBuilder.xml
               * test_mageBuilder --> app/etc/Test_MageBuilder.xml
               * test_magebuilder --> app/etc/Test_Magebuilder.xml

           module-alias - Unique identifier for your module
           class-type - What you normally pass to Magento's factory methods. i.e. Mage::getModel(<class-type>)
           extends - You want to specify a different parent class

Note: Check README.md for more info.

USAGE;
        $this->_error($usage);
    }

    /**
     * @param string $groupType
     * @return bool
     */
    private function _isValudGroupType($groupType) {
        $groupType = ucfirst($groupType);
        switch ($groupType) {
            case self::GROUP_TYPE_BLOCK:
            case self::GROUP_TYPE_MODEL:
            case self::GROUP_TYPE_HELPER:
            case self::GROUP_TYPE_CONTROLLER:  return true;
            default: return false;
        }
    }

    private function _getPathByGroupTypeAndClassType($classType, $groupType) {
        $groupType = ucfirst($groupType);
        $isValidGroupType = $this->_isValudGroupType($groupType);
        if (!$isValidGroupType) {
            $this->_error(self::ERRMSG_INVALID_GROUP_TYPE, strtolower($groupType));
        }

        if (!$classType) {
            $this->_error(self::ERRMSG_INVALID_CLASS_TYPE, $classType);
        }

        $className = $this->_getObjectClassName($classType, $groupType);
        $classDir = $this->_getClassNameDir($className);
        return $classDir;
    }

    private function _processCheckClassPath() {
        $groupType = $this->_getArgParam(self::PIDX_CHECK_CLASS_PATH_GROUP_TYPE);
        $classType = $this->_getArgParam(self::PIDX_CHECK_CLASS_PATH_CLASS_TYPE);
        $groupType = ucfirst($groupType);

        $classDir = $this->_getPathByGroupTypeAndClassType($classType, $groupType);
        $className = $this->_getObjectClassName($classType, $groupType);
        $classFile = $classDir.'/'.$this->_getClassNameFile($className);

        if (file_exists($classFile)) {
            $this->_message($classFile."\n");
        }
        else {
            $this->_error(self::ERRMSG_INVALID_CLASS_TYPE, $classType);
        }
    }

    private function _processCheckPath() {
        $groupType = $this->_getArgParam(self::PIDX_CHECK_PATH_GROUP_TYPE);
        $classType = $this->_getArgParam(self::PIDX_CHECK_PATH_CLASS_TYPE);

        $classDir = $this->_getPathByGroupTypeAndClassType($classType, $groupType);

        $result = file_exists($classDir);
        if (file_exists($classDir)) {
            $this->_message($classDir."\n");
        }
        else {
            $this->_error(self::ERRMSG_INVALID_CLASS_TYPE, $classType);
        }
    }

    private function _processCommand() {
        $command = $this->_getArgParam(self::PIDX_COMMAND);
        $classType = $this->_getArgParam(self::PIDX_CO_CLASS_TYPE);
        $this->_mageConfig = Mage::getConfig();
        switch ($command) {
            case self::COMMAND_CREATE_MODULE: $this->_processCreateModule(); break;
            case self::COMMAND_CREATE_MODEL: $this->_processCreateObject($classType, self::GROUP_TYPE_MODEL); break;
            case self::COMMAND_CREATE_HELPER: $this->_processCreateObject($classType, self::GROUP_TYPE_HELPER); break;
            case self::COMMAND_CREATE_BLOCK: $this->_processCreateObject($classType, self::GROUP_TYPE_BLOCK); break;
            case self::COMMAND_CREATE_CONTROLLER: $this->_processCreateObject($classType, self::GROUP_TYPE_CONTROLLER); break;
            case self::COMMAND_CREATE_PROJECT: $this->_processCreateProject(); break;
            case self::COMMAND_INIT: $this->_processInit(); break;
            case self::COMMAND_CHECK_PATH: $this->_processCheckPath(); break;
            case self::COMMAND_CHECK_CLASS_PATH: $this->_processCheckClassPath(); break;
            default:
                $message = sprintf(self::ERRMSG_UNKNOWN_COMMAND, $command);
                $this->_message($message);
                $this->_usage();
        }
    }

    private function _init() {
        $this->_detectHomeDir();
        $this->_mageBuilderDir = $this->_homeDir . '/' . self::CONFIG_DIR;
        $this->_mageBuilderFile = $this->_mageBuilderDir.'/'.self::CONFIG_FILE;
        $this->_argv = $_SERVER['argv'];
        $this->_argc = $_SERVER['argc'];
        $this->_checkConfig();
        $this->_processCommand();
    }

    public function run(){
        $this->_init();
    }

}

function main() {
    $builder = new MageBuilder();
    $builder->run();
}

main();