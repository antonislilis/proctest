<?php
namespace Dust;
require_once ('DustException.php');
require_once 'Filter/Filter.php';
require_once 'Ast/Ast.php';
require_once 'Ast/Parameter.php';
require_once 'Ast/Part.php';
require_once 'Ast/InlinePart.php';
foreach (glob("public/dust-php-master/src/Dust/Parse/*.php") as $filename) {
  require_once $filename;
}
foreach (glob("public/dust-php-master/src/Dust/Ast/*.php") as $filename) {
  require_once $filename;
}
foreach (glob("public/dust-php-master/src/Dust/Filter/*.php") as $filename) {
  require_once $filename;
}
foreach (glob("public/dust-php-master/src/Dust/Evaluate/*.php") as $filename) {
  require_once $filename;
}
foreach (glob("public/dust-php-master/src/Dust/Helper/*.php") as $filename) {
  require_once $filename;
}



class Dust implements \Serializable {
    public $parser;
    
    public $evaluator;
    
    public $templates;
    
    public $filters;
    
    public $helpers;
    
    public $automaticFilters;
    
    public $includedDirectories = [];
    
    public $autoloaderOverride;
    
    public function __construct($parser = null, $evaluator = null) {
        if ($parser === null) $parser = new Parse\Parser();
        if ($evaluator === null) $evaluator = new Evaluate\Evaluator($this);
        $this->parser = $parser;
        $this->evaluator = $evaluator;
        $this->templates = [];
        $this->filters = [
            "s" => new Filter\SuppressEscape(),
            "h" => new Filter\HtmlEscape(),
            "j" => new Filter\JavaScriptEscape(),
            "u" => new Filter\EncodeUri(),
            "uc" => new Filter\EncodeUriComponent(),
            "js" => new Filter\JsonEncode(),
            "jp" => new Filter\JsonDecode()
        ];
        $this->helpers = [
            "select" => new Helper\Select(),
            "math" => new Helper\Math(),
            "eq" => new Helper\Eq(),
            "lt" => new Helper\Lt(),
            "lte" => new Helper\Lte(),
            "gt" => new Helper\Gt(),
            "gte" => new Helper\Gte(),
            "default" => new Helper\DefaultHelper(),
            "sep" => new Helper\Sep(),
            "size" => new Helper\Size(),
            "contextDump" => new Helper\ContextDump()
        ];
        $this->automaticFilters = [$this->filters['h']];
    }
    
    public function compile($source, $name = null) {
        $parsed = $this->parser->parse($source);
        if ($name != null) $this->register($name, $parsed);
        return $parsed;
    }
    
    public function compileFn($source, $name = null) {
        $parsed = $this->compile($source, $name);
        return function ($context) use ($parsed) { return $this->renderTemplate($parsed, $context); };
    }
    
    public function resolveAbsoluteDustFilePath($path, $basePath = null) {
        //add extension if necessary
        if (substr_compare($path, '.dust', -5, 5) !== 0) $path .= '.dust';
        if ($basePath != null) {
            $possible = realpath($basePath . '/' . $path);
            if ($possible !== false) return $possible;
        }
        //try the current path
        $possible = realpath($path);
        if ($possible !== false) return $possible;
        //now try each of the included directories
        for ($i = 0; $i < count($this->includedDirectories); $i++) {
            $possible = realpath($this->includedDirectories[$i] . '/' . $path);
            if ($possible !== false) return $possible;
        }
        return null;
    }
    
    public function compileFile($path, $basePath = null) {
        //resolve absolute path
        $absolutePath = $this->resolveAbsoluteDustFilePath($path, $basePath);
        if ($absolutePath == null) return null;
        //just compile w/ the path as the name
        $compiled = $this->compile(file_get_contents($absolutePath), $absolutePath);
        $compiled->filePath = $absolutePath;
        return $compiled;
    }
    
    public function register($name, Ast\Body $template) {
        $this->templates[$name] = $template;
    }
    
    public function loadTemplate($name, $basePath = null) {
        //if there is an override, use it instead
        if ($this->autoloaderOverride != null) return $this->autoloaderOverride->__invoke($name);
        //is it there w/ the normal name?
        if (!isset($this->templates[$name])) {
            //what if I used the resolve file version of the name
            $name = $this->resolveAbsoluteDustFilePath($name, $basePath);
            //if name is null, then it's not around
            if ($name == null) return null;
            //if name is null and not in the templates array, put it there automatically
            if (!isset($this->templates[$name])) $this->compileFile($name, $basePath);
        }
        return $this->templates[$name];
    }
    
    public function render($name, $context) {
        return $this->renderTemplate($this->loadTemplate($name), $context);
    }
    
    public function renderTemplate(Ast\Body $template, $context) {
        return $this->evaluator->evaluate($template, $context);
    }
    
    public function serialize() { return serialize($this->templates); }
    
    public function unserialize($data) { $this->templates = unserialize($data); }
    
}