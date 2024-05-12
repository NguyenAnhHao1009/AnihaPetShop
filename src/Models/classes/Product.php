<?php

namespace App;

use PDO;

class Product
{
    private ?PDO $db;

    private int $product_id;
    private string $product_name;
    private string $description;
    private int $stock_quantity;
    private int $category_id;
    private int $unit_price;
    private string $product_avatar;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getId(): int
    {
        return $this->product_id;
    }
    public function getName(): string
    {
        return $this->product_name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getStockQuantity(): int
    {
        return $this->stock_quantity;
    }
    public function getCategoryId(): int
    {
        return $this->category_id;
    }
    public function getUnitPrice(): int
    {
        return $this->unit_price;
    }
    public function getProductAvatar(): string
    {
        return $this->product_avatar;
    }

    public function getCategoryName()
    {
        switch ($this->category_id) {
            case 1:
                return 'dog';
                break;
            case 2:
                return 'cat';
                break;
            case 3:
                return 'mouse';
                break;
            case 4:
                return 'food';
                break;
            case 5:
                return 'accessory';
                break;
            case 6:
                return 'rabbit';
                break;
            default:
                return '';
                break;
        }
    }


    public function getCategory()
    {
        switch ($this->category_id) {
            case 1:
                return 'Chó';
                break;
            case 2:
                return 'Mèo';
                break;
            case 3:
                return 'Chuột';
                break;
            case 4:
                return 'Thức ăn';
                break;
            case 5:
                return 'Phụ kiện';
                break;
            case 6:
                return 'Thỏ';
                break;
            default:
                return 'Khác';
                break;
        }
    }

    function getCategoryIdByName($type): int
    {
        switch ($type) {
            case 'dog':
                return  1;
                break;
            case 'cat':
                return  2;
                break;
            case 'mouse':
                return  3;
                break;
            case 'food':
                return  4;
                break;
            case 'accessory':
                return  5;
                break;
            case 'rabbit':
                return  6;
                break;
            default:
                return -1;
                break;
        }
    }

    function getListProductsByType($type): array
    {
        $type = $this->getCategoryIdByName($type);
        if ($type >= 0) {
            $sql = "SELECT * FROM products WHERE category_id = ?";
            $statement = $this->db->prepare($sql);
            $statement->execute([$type]);
        } else {
            $sql = "SELECT * FROM products";
            $statement = $this->db->prepare($sql);
            $statement->execute();
        }

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function productsDetailInfoForAdmin($name = null): array
    {
        $products = [];
        $name = trim($name);
        if ($name === null) {

            $statement = $this->db->prepare('select p.*, c.category_name from products p, categories c
                                            where p.category_id = c.category_id
                                            order by p.product_id;');
            $statement->execute();
        } else {
            $statement = $this->db->prepare('select p.*, c.category_name from products p, categories c
                                            where p.category_id = c.category_id and p.product_name like ?
                                            order by p.product_id;');
            $statement->execute(['%' . $name . '%']);
        }
        $products = $statement->fetchAll();
        return $products;
    }

    public function getListProductsBySearchKey($searchKey): array
    {
        $statement = $this->db->prepare('select * from products where product_name like ?');
        $statement->execute(["%{$searchKey}%"]);
        $products = $statement->fetchAll();
        return $products;
    }

    function getListProductsRandomByNumber($number)
    {
        $sql = "SELECT * FROM products order by rand() limit ?";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(1, $number, PDO::PARAM_INT);
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    function getListProductsRelated($product_id, int $number): array
    {
        $sql = "SELECT * FROM products WHERE
        product_id != :id1 AND category_id IN 
        (SELECT category_id FROM products WHERE product_id = :id)
        ORDER BY RAND() 
        LIMIT :limit_number";
        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id1', $product_id, PDO::PARAM_INT);
        $statement->bindParam(':id', $product_id, PDO::PARAM_INT);
        $statement->bindParam(':limit_number', $number, PDO::PARAM_INT);
        $statement->execute();
        $products = $statement->fetchAll();
        return $products;
    }

    public function countNumberOfProducts(): int
    {
        $sql = 'select count(*) num_products from products';
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $num_products = $statement->fetch();
        return $num_products['num_products'];
    }

    public function  countNumberOfProductsByType($category_id): int
    {
        if ($category_id == -1) {
            $sql = 'SELECT count(*) num_products from products';
            $statement = $this->db->prepare($sql);
        } else {
            $sql = 'select count(*) num_products from products where category_id = :category_id';
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        }
        $statement->execute();
        $num_products = $statement->fetch();
        return $num_products['num_products'];
    }

    public function countNumberOfProductsBySearchKey($searchKey): int
    {
        $sql = 'select count(*) num_products from products where product_name like :searchKey';
        $statement = $this->db->prepare($sql);
        $statement->execute([':searchKey' => "%$searchKey%"]);
        $num_products = $statement->fetch();
        return $num_products['num_products'];
    }

    public function fill(array $data): Product
    {
        $this->product_id = $data['product_id'] ?? 0;
        $this->product_name = $data['product_name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->stock_quantity = $data['stock_quantity'] ?? 0;
        $this->category_id = $data['category_id'] ?? 0;
        $this->unit_price = $data['unit_price'] ?? 0;
        $this->product_avatar = $data['product_avatar'] ?? '';
        return $this;
    }


    public function find($id): ?Product
    {
        $statement = $this->db->prepare('select * from products where product_id = ?');
        $statement->execute([$id]);
        if ($row =  $statement->fetch()) {
            $this->fill($row);
            return $this;
        }
        return null;
    }

    public function save(): bool
    {
        try {
            $statement = $this->db->prepare('insert into products (product_name, description, stock_quantity, category_id, unit_price, product_avatar) values (:product_name, :description, :stock_quantity, :category_id, :unit_price, :product_avatar)');
            $statement->execute([
                'product_name' => $this->product_name,
                'description' => $this->description,
                'stock_quantity' => $this->stock_quantity,
                'category_id' => $this->category_id,
                'unit_price' => $this->unit_price,
                'product_avatar' => $this->product_avatar
            ]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function delete($id): bool
    {
        try {
            $stmt = $this->db->prepare("select product_avatar from products where product_id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            $avatar = $row['product_avatar'];
            removeImgFromUploadsFolder($avatar);

            $statement = $this->db->prepare('delete from products where product_id = ?');
            $statement->execute([$id]);

            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getProductInfoById($id)
    {
        $statement = $this->db->prepare('select * from products where product_id = ?');
        $statement->execute([$id]);
        if ($row =  $statement->fetch()) {
            return $row;
        }
        return null;
    }

    public function edit(): bool
    {
        try {
            $statement = $this->db->prepare('update products set product_name = :product_name, description = :description, stock_quantity = :stock_quantity, category_id = :category_id, unit_price = :unit_price, product_avatar = :product_avatar where product_id = :product_id');
            $statement->execute([
                'product_id' => $this->product_id,
                'product_name' => $this->product_name,
                'description' => $this->description,
                'stock_quantity' => $this->stock_quantity,
                'category_id' => $this->category_id,
                'unit_price' => $this->unit_price,
                'product_avatar' => $this->product_avatar
            ]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function addNumberOfProduct($product_id, $add_number)
    {
        try {
            $statement = $this->db->prepare('update products set stock_quantity = stock_quantity + :add_number where product_id = :product_id');
            $statement->execute([
                'product_id' => $product_id,
                'add_number' => $add_number
            ]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function removeNumberOfProduct($product_id, $rm_number)
    {
        try {
            $statement = $this->db->prepare('update products set stock_quantity = stock_quantity - :rm_number where product_id = :product_id');
            $statement->execute([
                'product_id' => $product_id,
                'rm_number' => $rm_number
            ]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function fillFromDB(array $row)
    {
        [
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'description' => $this->description,
            'stock_quantity' => $this->stock_quantity,
            'category_id' => $this->category_id,
            'unit_price' => $this->unit_price,
            'product_avatar' => $this->product_avatar
        ] = $row;
        return $this;
    }


    public function paginate(
        int $offset = 0,
        int $limit = 10,
        $type =  null,
        $searchKey = null,
    ): array {
        $products = [];
        if (($type == null && $searchKey == null) || ($type == -1)) {
            $statement = $this->db->prepare('select * from products order by product_id desc limit :offset,:limit');
            $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
            $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        } else if ($searchKey !== null) {
            $searchKey = "%" . $searchKey . "%";
            $statement = $this->db->prepare('select * from products where product_name like :searchKey order by product_id desc limit :offset,:limit');
            $statement->bindParam(':searchKey', $searchKey, PDO::PARAM_STR);
            $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
            $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        } else if ($type != null) {
            $statement = $this->db->prepare('select * from products where category_id = :type order by product_id desc limit :offset,:limit');
            $statement->bindParam(':type', $type, PDO::PARAM_INT);
            $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
            $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
            $statement->execute();
        }

        $statement->execute();
        while ($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }
        return $products;
    }
}
