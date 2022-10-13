<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    class Persona {
        public $nombre;
        public $apellido;
        public $edad;

        function __construct($nombre, $apellido, $edad){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->edad = $edad;
        }

        function __toString(){
            return "Hola soy " . $this->nombre . " " . $this->apellido . " tengo " . $this->edad ." años";
        }
    }

    class Cliente extends Persona {
        public $saldo;
    
        function __construct($nombre, $apellido, $edad, $saldo){
            parent::__construct($nombre, $apellido, $edad);
            $this->saldo = $saldo;
        }

        function __toString(){
            return parent::__toString() . " y tengo " . $this->saldo . " euros";
        }
    }

    class Empleado extends Persona {
        public $sueldo;
        public $antiguedad;

        function __construct($nombre, $apellido, $edad, $sueldo, $antiguedad){
            parent::__construct($nombre, $apellido, $edad);
            $this->sueldo = $sueldo;
            $this->antiguedad = $antiguedad;
        }

        function __toString(){
            return parent::__toString() . " cobro " . $this->sueldo . " euros y tengo una antigüedad de " . $this->antiguedad . " días";
        }

        function __getAntiguedad(){
            return $this->antiguedad;
        }
    }

    class Empresa {
        private $nombre;
        private $empleados = array();
        private $clientes = array();

        function __construct($nombre, $empleados, $clientes){
            $this->nombre=$nombre;
            $this->empleados=$empleados;
            $this->clientes=$clientes;
        }

        function verClientes(){
            while(current($this->clientes)){
                echo current($this->clientes) . "<br>";
                next($this->clientes);
            }
        }

        function verEmpleados(){
            
            asort($this->empleados, SORT_STRING);
            while(current($this->empleados)){
                echo current($this->empleados) . "<br>";
                next($this->empleados);
            }
        }

        function añadirEmpleados($nif, $emp){
            $this->empleados[$nif] = $emp; 
        }

        function masAntiguo(){
            $antiguedades = array();
            foreach($this->empleados as $k => $v){
                $antiguedades[$k] = $v->__getAntiguedad();
            }
            asort($antiguedades);
            end($antiguedades);
            echo $this->empleados[key($antiguedades)];
        }

        function __toString(){
            return "Somos " . $this->nombre . " tenemos " . count($this->empleados) ." empleados y " . count($this->clientes) . " clientes";
        }
}
    // $p1 = new Persona("Mengcheng", "Han", 20);
    
    $misClientes = array(
        new Cliente("Mengcheng", "Han", 20, 150), 
        new Cliente("Raúl", "Castaño", 27, 645), 
        new Cliente("Kein", "Besil", 25, 123)
    );
    
    $misEmpleados = array(
        "1234A" => new Empleado("Kap", "Uyo o", 20, 1800, 120), 
        "1234B" => new Empleado("Alba", "Sánchez", 21, 1050, 650), 
        "1234C" => new Empleado("Filo", "DaPuta", 15, 2500, 455), 
        "1234D" => new Empleado("Roland", "Vallès", 33, 1520, 342)
    );
     
    $empresa = new Empresa("Retrete SL", $misEmpleados, $misClientes);
    $emp = new Empleado("Freya", "Vallès", 31, 1400, 20);
    $empresa->añadirEmpleados("1234G", $emp);
    echo $empresa . "<br>";
    echo "Estos son mis clientes" . "<br>";
    echo  $empresa->verClientes() . "<br>";
    echo  $empresa->verEmpleados() . "<br>" ;
    echo $empresa->masAntiguo();

    
    // echo $p1 . "<br>";
    // echo $c1 . "<br>";
?>
</body>

</html>