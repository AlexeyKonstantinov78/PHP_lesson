<?php
//..объекты ООП домашка

abstract class Product
{
    public $title;
    public $price;
    public $weight;
    public static $companyName = "ЩКомапния";
    const YEAR_SRART = 2012;

    public function __construct(string $title, int $price, int $weight)
    {
        $this->title = $title;
        $this->price = $price;
        $this->weight = $weight;
    }

    public function printProduct() {
        echo "Название: $this->title, цена: $this->price руб. (без ндс:" . $this->price * 0.80 . "), вес: $this->weight кг.<br>";
    }

    abstract public function showImage();

    public static function showCompanyInfo()
    {
        echo "имя компании " . self::$companyName . " начало деятельности " . self::YEAR_SRART . '<br>';
    }
}

class Chocolate extends Product
{
    private $numСolories;
    public function __construct(string $title, int $price, int $weight, int $numСolories)
    {
        $this->numСolories = $numСolories;
        parent::__construct($title, $price, $weight);
    }

    public function showImage()
    {
        echo "<div>
                <img src='https://klike.net/uploads/posts/2019-06/1560839420_20.jpg' alt='картинка' width='{$this->weight}'/>
                {$this->numСolories}
                </div>";
    }

    public function __get($name)
    {
        echo "нельзя  не существующей переменной $name <br>";
    }

    public function __set($name, $value)
    {
        echo "нельзя присвоить значение $value не существующей переменной $name <br>";
    }
}

class Candy extends Product
{
    public function showImage()
    {
        echo "<div>
                <img src='https://gotvach.bg/files/lib/500x350/brownies_pudra.jpg' alt='картинка' width='{$this->weight}'/>
                
                </div>";
    }

    public function __get($name)
    {
        echo "нельзя  не существующей переменной $name <br>";
    }

    public function __set($name, $value)
    {
        echo "нельзя присвоить значение $value не существующей переменной $name <br>";
    }
}

$chocol = new Chocolate('шоколад', 200, 200,1500);
$candy = new Candy('конфета', 200, 100);

$chocol->showImage();
$chocol->showCompanyInfo();
echo $chocol->nam;
//$chocol->nam = 123;


$candy->showImage();
$candy->showCompanyInfo();
$candy->max;
$candy->max = 321;
Product::showCompanyInfo();
//$prod1 = new Product("картафан", 800, 1500);
//$prod2 = new Product('карт', 200, 800);
//$prod3 = new Product('морковь', 100, 500);
//$prod4 = new Product('морковь', 150, 1000);
//
//$prod1->printProduct();
//$prod2->printProduct();
//$prod3->printProduct();
//$prod4->printProduct();