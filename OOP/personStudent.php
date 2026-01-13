<?php

class Persona
{
    public $name;
    public $surname;
    public $age;

    public function __construct($name, $surname, $age)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getSurname($surname)
    {
        return $this->surname;
    }
    public function getAge()
    {
        return $this->age;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }
}

class Teacher extends Persona
{
    public $module;
    public $salary;

    public function __construct($name, $surname, $age, $module, $salary)
    {
        parent::__construct($name, $surname, $age);
        $this->module = $module;
        $this->salary = $salary;
    }

    public function getNameAndSurname()
    {
        return $this->name + $this->surname;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function setModule($module)
    {
        $this->module = $module;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
}

class Student extends Persona
{
    public $finalMark;

    public function __construct($name, $surname, $age, $finalMark)
    {
        parent::__construct($name, $surname, $age);
        $this->finalMark = $finalMark;
    }

    public function getfinalMark()
    {
        return $this->finalMark;
    }

    public function setfinalMark($finalMark)
    {
        $this->finalMark = $finalMark;
    }
}


$teacher = new Teacher("Daniel", "Rebollo", 45, "DAW", 2300);

$student = new Student("Anxo", "Villamarin", 19, 8);

echo "<pre>";
print_r($teacher);
echo "</pre>";

echo "<pre>";
print_r($student);
echo "</pre>";

?>