<?php
namespace App\Modules\Cli\Tasks;

use App\Models\Attributes;
use App\Models\Brands;
use App\Models\Images;
use App\Models\Pages;
use App\Models\ProductsAttributes;
use Behat\Transliterator\Transliterator;
use Phalcon\Security\Random;
use App\Models\Categories;
use App\Models\Products;

class MainTask extends \Phalcon\Cli\Task
{
    private $site = 'http://tclime.ru';

    public function mainAction()
    {
        echo Transliterator::transliterate('Саморегулирующийся греющий кабель');
    }

    public function productsAction()
    {
        $site = 'http://tclime.ru/category/multi-split-sistemy/';
        $category = 22;



        $categoryPage = file_get_html($site);
        $countPages = count($categoryPage->find('.pagination ul li.page'));
        echo $this->convert('Количество страниц: ') . $countPages . PHP_EOL . PHP_EOL;
        $categoryPage->clear();

        for($i = 0; $i <= $countPages; $i++) {
            echo $this->convert('Страница №') . ($i + 1) . PHP_EOL;

            $offset = $i * 100;
            $categoryPage = file_get_html($site . 'offset' . $offset . '/');
            foreach ($categoryPage->find('.cat-item-box-small .h3') as $product) {
                /*echo $this->convert('Продукт ' . $product->plaintext . ' ');
                $productPage = file_get_html($this->site . $product->href);
                $product_db = new Products();
                $product_db->title = trim($productPage->find('h1', 0)->plaintext);
                $product_db->price = (int)trim(explode(' ', $productPage->find('.item-action-info .text-ar-26', 0)->plaintext)[0]);
                $product_db->description = $productPage->find('.box-500 > div', 0)->innertext ?? "";
                $product_db->category_id = $category;
                $product_db->uri = Transliterator::transliterate($productPage->find('h1', 0)->plaintext);

                $title = $productPage->find('h1', 0)->plaintext;
                preg_match('/[A-z]{1,}/', $title, $matches);;
                $brand = $matches[0] ?? 'undefined';
                if (!$brand_db = Brands::findFirst(['brand = :brand:', 'bind' => ['brand' => $brand]])) {
                    $brand_db = new Brands();
                    $brand_db->brand = $brand;
                    $brand_db->save();
                }
                $product_db->brand_id = $brand_db->id;
                if (!$product_db->save()) {
                    foreach ($product_db->getMessages() as $message) {
                        echo $message->getMessage() . PHP_EOL;
                    }
                    exit;
                }

                foreach ($productPage->find('.fixoptions tr') as $attribute) {
                    if (!$attribute_db = Attributes::findFirst(['attribute = :attribute:', 'bind' => ['attribute' => substr(trim($attribute->children(0)->plaintext), 0, -1)]])) {
                        $attribute_db = new Attributes();
                        $attribute_db->attribute = substr(trim($attribute->children(0)->plaintext), 0, -1);
                        $attribute_db->save();
                    }

                    $product_attribute = new ProductsAttributes();
                    $product_attribute->product_id = $product_db->id;
                    $product_attribute->attribute_id = $attribute_db->id;
                    $product_attribute->value = trim(preg_replace("/  +/", " ", $attribute->children(1)->plaintext));
                    $product_attribute->save();
                }
                */
                $image_url = $this->site . $productPage->find('.img_toshow_0', 0)->href;
                $image_name = (new Random())->uuid() . '.jpg';
                $path = BASE_PATH . '/public/files/products/' . $image_name;
                file_put_contents($path, file_get_contents($image_url));

                $image = new Images();

                $image->image = $image_name;
                $image->product_id = $product_db->id;
                $image->save();

                echo $this->convert('Готово') . PHP_EOL;
            }
        }
    }

    public function otherAction()
    {
        $site = 'http://buranrussia.ru';

        for($i = 0; $i <= 1; $i++) {
            $categoryPage = file_get_html($site . '/samoregulirujushiesja-nagrevatelnye-kabeli//offset' . $i*24);

            foreach($categoryPage->find('.title-product') as $productLink) {
                echo $this->convert($productLink->plaintext . ' ');
                $productPage = file_get_html($site . $productLink->href);

                $product = new Products();
                $product->title = trim($productPage->find('h1', 0)->plaintext);
                $product->price = (int)$productPage->find('.fa-rub', 0)->parent()->plaintext;
                $product->description = $productPage->find('.description-product', 0)->innertext ?? "";
                $product->category_id = 54;
                $product->uri = Transliterator::transliterate(trim($productPage->find('h1', 0)->plaintext));
                $product->brand_id = 26;
                $product->save();


                foreach ($productPage->find('.paramam tr') as $attribute) {
                    if (!$attribute_db = Attributes::findFirst(['attribute = :attribute:', 'bind' => ['attribute' => substr(trim($attribute->children(0)->plaintext), 0, -1)]])) {
                        $attribute_db = new Attributes();
                        $attribute_db->attribute = substr(trim($attribute->children(0)->plaintext), 0, -1);
                        $attribute_db->save();
                    }

                    $product_attribute = new ProductsAttributes();
                    $product_attribute->product_id = $product->id;
                    $product_attribute->attribute_id = $attribute_db->id;
                    $product_attribute->value = trim(preg_replace("/  +/", " ", $attribute->children(1)->plaintext));
                    $product_attribute->save();
                }

                $image_url = $site . $productPage->find('#img-current_picture', 0)->parent()->href;
                $image_name = (new Random())->uuid() . '.jpg';
                $path = BASE_PATH . '/public/files/products/' . $image_name;
                file_put_contents($path, file_get_contents($image_url));

                $image = new Images();

                $image->image = $image_name;
                $image->product_id = $product->id;
                $image->save();

                echo $this->convert('Готово') . PHP_EOL;
            }
        }
    }

    private function convert($string)
    {
        return mb_convert_encoding($string, 'CP866');
    }

}
