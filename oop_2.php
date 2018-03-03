<!DOCTYPE html>
<html>
<head>
	<title>Полиморфизм и наследование</title>
</head>
<body>
	<h2>Полиморфизм и наследование</h2>
	<p><strong>Полиморфизм</strong> - принцип ООП, позволяющий переопределять свойства и методы, унаследованные от родительского класса. </p>
	
	<p><strong>Наследование</strong> - принцип ООП, позволяющий наследовать без копирования свойства и методы родительского класса, расширяя их собственными свойствами и методами. Наследование всегда осуществляется от одного родителя и позволяет избежать копирования кода от класса к классу.</p>

	<h2>Интерфейсы и абстрактные классы</h2>
	<p><strong>Интерфейс</strong> - это объект, содержащий в себе только методы (с аргументами) и константы. Он имплементируется в класс, и уже в классе реализуются методы и константы. Интерфейс, как и класс, тоже может наследовать другой интерфейс. Все методы, приведенные в интерфейсе, должны быть публичными.</p>

	<p><strong>Абстрактные классы</strong> - это классы, не участвующие в реализации, они предусмотрены для проектнирования и содержат в себе свойства и методы, которые через директиву abstract можно сделать обязательными для определения в дочерних классах. На базе абстрактных классов нельзя создать объект.</p>
	
	<p><strong>Общий вывод</strong>: мы можем создать <i>базовый класс</i>, в который включить все свойства и методы, общие для всех дочерних классов, и создавать прочие классы путем <i>наследования от базового</i> (через extends). Обязательные свойства или методы мы можем задать через <i>абстрактный класс</i>, можем <i>переопределять свойства или методы</i> в дочерних классах (полиморфизм), а также <i>реализовывать интерфейсы</i> с объявленными структурно константами и методами с аргументами. Такая методика позволяет делать наш код более структурным, без копирования, простым для изменения и масштабирования.</p>


<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

//суперкласс - базовый класс, у которого нет родителя. 

class SuperClass
{
	public $name; 		
}

//интерфейсы для всех классов

interface DescriptionInterface
{
	public function setDescription($name);
}


// Наследуемый класс машин

class Car extends SuperClass implements DescriptionInterface 
{ 
	public $transmission; // тип коробки передач
	public $region; // регион продаж
	public $package; // комплектация
	public $currency; //валюта продаж
	public $exchangerate; //курс обмена валют к доллару
	public $price; // цена
	
	public function __construct($name, $transmission, $region, $package)
	{
		$this->name=$name;
		$this->transmission=$transmission;
		$this->region=$region;
		$this->package=$package;
		echo "<pre>";
		print_r("На склад " . $this->region . " поступил новый автомобиль - " . $this->name . "!");
		print_r(" Заявленная комплектация: " . $this->package . ".");
		print_r(" Коробка передач: " . $this->transmission . ".");
		echo "</pre>";
	}

	public function setDescription($name)
	{
		echo "<pre>";
		print_r("Описание " . $this->name . ":");
		print_r(" автомобиль комплектации  " . $this->package . " обладает высокой конкурентоспособностью среди прочих автомобилей рынка " . $this->region . ".");
		print_r(" Базовый состав комплектации четко соответствует основным запросам целевой аудитории.");
		echo "</pre>";
	}		
}
?>

<h2>Машины</h2>

<?php

$Toyota=new Car("Toyona Avenses", "ручная", "Россия", "Sol");
$BMW=new Car("BMW X5", "авто", "Россия", "VIP");


// Наследуюемый класс телевизоров

class TV extends SuperClass implements DescriptionInterface
{
	public $lighting; // подсветка
	public $diagonal; //диагональ экрана
	public $dataformat;
	public $price; 
	
	public function __construct($name, $diagonal, $dataformat, $lighting)
	{
		$this->name=$name;
		$this->diagonal=$diagonal;
		$this->dataformat=$dataformat;
		$this->lighting=$lighting;
		echo "<pre>";
		print_r ("На склад доставлены модели телевизоров " . $this->name . " диагональю " . $this->diagonal . ". Формат: "  . $this->dataformat);
		echo "</pre>";	
	}

	public function setDescription($name)
	{
		echo "<pre>";
		print_r ("Описание телевизонов " . $this->name . ": полностью соответствуют ожиданиям целевой аудитории в рамках заявленной ценовой категории.");
		echo "</pre>";		
	}

	public function getSurPrise($price, $lighting)
	{
		$this->price=$price;
		$this->lighting=$lighting;
		if ($this->lighting==true) 
		{
			echo "<pre>";
			return "Это " . $this->name . " стоит " . $this->price . ". Реализуем по спекулятивной цене!";
			echo "</pre>";
		}
		
		if ($this->lighting==false) 
		{
			echo "<pre>";
			return "Это " . $this->name . " стоит " . $this->price . ". Подарите это барахло клиентам! Разгрузите склад!";
			echo "</pre>";
		}
	}
}
?>

<h2>Телевизоры</h2>

<?php

$tvDigital=new TV("iDaTV", "200", "4K", true);
echo $tvDigital->getSurPrise("120K RUR", true);
$tvAnalog=new TV("NeDoTV", "100", "ЭраДоHD", false);
echo $tvAnalog->getSurPrise("10 RUR", false);


// Наследуемый класс ручек

class Pen extends SuperClass implements DescriptionInterface
 {
 	public $color;
 	public $audience;
 	public $amount;
 	
 	public function __construct($name, $color, $audience, $amount)
 	{
 		$this->name=$name; 
 		$this->amount=$amount;
 		$this->color=$color;
 		$this->audience=$audience;
 		echo "<pre>";
 		print_r("Новые позиции ручек " . $this->name . ", " . $this->color . ", в количестве " . $this->amount . " штук.");
 		echo "<pre>";
 		echo "</pre>";
 		print_r($this->audience . " ждут новые " . $this->color . " ручки как можно скорее.");
 		echo "</pre>";	
 	}

	public function setDescription($name)
	{
		echo "<pre>";
 		print_r("Описание ручек " . $this->name . ": ручки высокого качества, корпуса ручек изготовлены из ударопрочного пищевого пластика, их можно грызть в порыве эмоций без ущерба для здоровья. Ручки рекомендованы для использования в стрессовых ситуациях.");
 		echo "</pre>";
 	}
 }
 ?>

<h2>Ручки</h2>

<?php

$penSchool=new Pen("3D-ручки","синие", "Школьники", 100);
$penBusiness=new Pen("Паркер", "черные", "Менеджеры", 200);


// Наследуемый класс уток


class Duck extends SuperClass implements DescriptionInterface
{
	public $food;
	public $sex;

	public function __construct($name, $food, $sex)
	{
		$this->name=$name;
		$this->food=$food;
		$this->sex=$sex;
		echo "<pre>";
		print_r("На наш пруд прилетели редчайшие утки-" . $this->name  . "! Нужно накормить их!");
		echo "</pre>";
	}

	public function setDescription($name)
	{
		echo "<pre>";
		print_r("Описание уток " . $this->name  . ": утки редчайшего окраса, занесенные в зеленую книгу, пользуются исключительной популярностью у заводчиков редких пернатых! Рекомендуются в качестве уникального подарка для близких друзей и соратников, поскольку извлекают забавные звуки, несовсем уместные в приличном обществе, но вполне уморительные для неснобов среднего класса!");
		echo "</pre>";
	}

	public function methodFeed()
	{
		if ($this->sex=="девочки") 
		{
			echo "<pre>";
			echo "Утки-" . $this->sex . " любят  " . $this->food  . ".";
			echo "</pre>";
		}
		elseif ($this->sex=="селезни") 
		{
			echo "<pre>";
			echo "Утки-" . $this->sex . " любят  " . $this->food  . ".";
			echo "</pre>";
		}
	}
}
?>

<h2>Утки</h2>

<?php

$duckHome=new Duck("домоседки", "хлеб", "девочки");
echo $duckHome->methodFeed();
$duckWild=new Duck("разгуляи", "зерно", "селезни");
echo $duckWild->methodFeed();


// Наследуемый класс товаров

class Product extends SuperClass implements DescriptionInterface
{
	public $id;
	public $type;
	public $price;
	public $category;

	public function __construct($id, $type, $name, $category, $price)
	{
		$this->id=$id;
		$this->type=$type;
		$this->name=$name;
		$this->category=$category;
		echo "<pre>";
		print_r("Поступил новый товар: " . $this->name . ".");
		echo "</pre>";
	}

	public function setDescription($name)
	{
		echo "<pre>";
		print_r("Описание товара " . $this->name . ": уникальный экземпляр. полностью соответствующий ожиданиям целевой аудитории, как по форме, так и по содержанию.");
		echo "</pre>";
	}
	
	public function methodSort()
	{
		if ($this->type=="еда") 
		{
			echo "<pre>";
			return "Положите товар " . $this->name . " в холодильник!";
			echo "</pre>";
		}
		elseif ($this->type=="ПО") 
		{
			echo "<pre>";
			return "Разместите товар " . $this->name . " на складе в категории " . $this->category . "!";
			echo "</pre>";
		}
	}
}
?>

<h2>Товары</h2>

<?php

$productFood=new Product(1, "еда", "капуста", "бахчевые", 65);
echo $productFood->methodSort();
$productSoft=new Product(2, "ПО", "АРМ", "ПО для товароведения", 1600);
echo $productSoft->methodSort();
$productFood1=new Product(3, "еда", "кабачки", "бахчевые", 85);
echo $productFood1->methodSort();
?>

</body>
</html>