<?php
class Stub {

    private $returns;

    private $arguments;

    public function with() {
        $this->arguments = func_get_args();
        return $this;
    }

    public function returns($value) {
        $this->returns = new StubReturns($value);
        return $this;
    }

    public function call($arguments) {
        //echo 'this->arguments', PHP_EOL;
        //var_dump($this->arguments);
        //echo 'arguments', PHP_EOL;
        //var_dump($arguments);
        //var_dump($this->arguments === $arguments);
        //exit;
        if(!isset($this->arguments) || (isset($this->arguments) && $this->arguments === $arguments)) {
            return $this->returns;
        }
        return null;
    }
}

class StubReturns {

    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }
}

class Expectation {

    private $returns;

    private $times;

    public function returns($value) {
        $this->returns = $value;
        return $this;
    }

    public function atLeast($times) {
        $this->times = $times;
    }

    public function call($arguments) {
        return $this->returns;
    }
}

class Mock {

    protected static $stubs = array();

    private $expectations = array();

    public function __call($method, $arguments) {
        if(isset($this->expectations[$method]) && $this->expectations[$method] instanceof Expectation) {
            return $this->expectations[$method]->call($arguments);
        }
        else if(method_exists($this, "__{$method}")) {
            return call_user_func_array(array($this, "__{$method}"), $arguments);
        }
        trigger_error(sprintf("Call to undefined method %s::%s()", get_class($this), $method), E_USER_ERROR);
    }

    public function expects($method) {
        if(empty($this->expectations[$method])) {
            $expectation = new Expectation($this, $method);
            $this->expectations[$method] = $expectation;
        }
        else {
            $expectation = $this->expectations[$method];
        }
        return $expectation;
    }

    public function stubs($method) {
        if(empty($this->expectations[$method])) {
            $expectation = new Expectation($this, $method);
            $expectation->atLeast(0);
            $this->expectations[$method] = $expectation;
        }
        else {
            $expectation = $this->expectations[$method];
        }
        return $expectation;
    }

    public static function stub($method) {
        self::$stubs[$method] = new Stub();
        return self::$stubs[$method];
    }

    public function generate() {
        $classes = func_get_args();
        foreach($classes as $className) {
            $rc = new ReflectionClass($className);
            $methods = $rc->getMethods();
            $staticMethods = array();
            foreach($methods as $method) {
                if($method->isStatic()) {
                    $parameters = $method->getParameters();
                    $params = array();
                    $paramNames = array();
                    foreach($parameters as $param) {
                        $paramName = "\${$param->getName()}";
                        $paramNames[] = $paramName;
                        $code = "{$paramName}";
                        if($param->isDefaultValueAvailable()) {
                            $defaultValue = $param->getDefaultValue();
                            if(is_array($defaultValue)) {
                                $defaultValue = var_export($defaultValue, true);
                            }
                            $code .= " = {$defaultValue}";
                        }
                        $params[] = $code;
                    }

                    $code = sprintf("public static function %s(%s) {\nif(self::hasStub('%s')) {\n\$return = self::callStub('%s', array(%s)); if(\$return instanceof StubReturns) { return \$return->getValue(); } }\nreturn %s::__%s(%s); }",
                        $method->getName(),
                        join(', ', $params),
                        $method->getName(),
                        $method->getName(),
                        join(', ', $paramNames),
                        $className,
                        $method->getName(),
                        join(', ', $paramNames)
                    );

                    //echo $code;
                    //exit;

                    $staticMethods[] = $code;
                }
                runkit_method_rename($className, $method->getName(), sprintf('__%s', $method->getName()));
            }

            $code = sprintf('class Mock%s extends Mock {
                %s
            }', $className, join(PHP_EOL, $staticMethods));
            eval($code);

            runkit_class_adopt($className, "Mock{$className}");
        }
    }

    protected static function hasStub($method) {
        return (isset(self::$stubs[$method]) && self::$stubs[$method] instanceof Stub);
    }

    protected static function callStub($method, array $arguments) {
        if(self::hasStub($method)) {
            return self::$stubs[$method]->call($arguments);
        }
        return null;
    }
}

class Model_Base {

    public function teste() {
        return "teste";
    }
}

require 'User.php';
class Role extends Model_Base {

    public function name() {
        return 'Desenvolvedor';
    }
}

Mock::generate('User', 'Role');

$user = new User();
$user->id = 1234;
$user->name = 'rafael';

echo $user->teste();

$role = new Role();
echo $role->name(), PHP_EOL;
$role->stubs('name')->returns('Programador');
echo $role->name(), PHP_EOL;

User::stub('first')->returns($user);
User::stub('all')->with(array('where' => '1 = 2'))->returns(array());
$user->stubs('roles')->returns(array(new Role(), $role));

// vai retornar um array vazio
$all = User::all(array('where' => '1 = 2'));
print_r($all);

// vai chamar o metodo original
$all = User::all(array('where' => '1 = 1'));
print_r($all);

// vai chmar o metodo original
$all = User::all();
print_r($all);

// vai chamar o metodo mockado
$user = User::first();
print_r($user);

$roles = $user->roles();
print_r($roles);

echo $roles[0]->name();
?>