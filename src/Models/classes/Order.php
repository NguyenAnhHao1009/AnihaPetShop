<?php

namespace App;

use PDO;

class Order
{
    private ?PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function countNumberOfOrders(): int
    {
        $sql = 'select count(*) as num_orders from orders where status <> -1';
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $num_orders = $statement->fetch();
        return $num_orders['num_orders'];
    }


    public function all($status = null): ?array
    {
        if($status===0 || $status===1 || $status===-2){
            $sql = 'SELECT od.order_id, us.user_name, prd.product_name, odd.quantity, od.order_date, od.status, prd.unit_price, od.order_phone, od.order_address, (odd.quantity * prd.unit_price) AS detail_total 
            FROM orders od, order_details odd, products prd, users us
            WHERE od.order_id = odd.order_id 
            AND odd.product_id = prd.product_id 
            AND od.user_id = us.user_id
            AND od.status = ?
            ORDER BY od.order_id;';
            $statement = $this->db->prepare($sql);
            $statement->execute([$status]);
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return $rows;
            }
            return null;
        }else if($status === null){ 
            $sql = 'SELECT od.order_id, us.user_name, prd.product_name, odd.quantity, od.order_date, od.status, prd.unit_price, od.order_phone, od.order_address, (odd.quantity * prd.unit_price) AS detail_total 
            FROM orders od, order_details odd, products prd, users us
            WHERE od.order_id = odd.order_id 
            AND odd.product_id = prd.product_id 
            AND od.user_id = us.user_id
            AND od.status <> -1
            ORDER BY od.status, od.order_id;';
            $statement = $this->db->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return $rows;
            }
            return null;
        }
        
        
    }

    public function acceptOrderById($order_id)
    {
        $sql = 'update orders set status = :status where order_id = :order_id';
        $statement = $this->db->prepare($sql);
        if ($statement->execute([':status' => '1', ':order_id' => $order_id])) {

            return true;
        } else {

            return false;
        };
    }

    public function getOwnerIdByOrderId($order_id) : int{
        try{
            $sql = 'select user_id from orders where order_id = :order_id';
            $statement = $this->db->prepare($sql);
            $statement->execute([':order_id' =>  $order_id]);
            if ($row =  $statement->fetch()) {
                return $row['user_id'];
            }
        }catch(\PDOException $e){
            return -1;
        }
    }

    public function searchOrderById($order_id)
    {
        $sql = 'SELECT od.order_id, us.user_name, prd.product_name, odd.quantity, od.order_date, od.status, od.order_phone, od.order_address, prd.unit_price, (odd.quantity * prd.unit_price) AS detail_total 
        FROM orders od, order_details odd, products prd, users us
        WHERE od.order_id = odd.order_id 
        AND odd.product_id = prd.product_id 
        AND od.user_id = us.user_id 
        AND od.order_id LIKE :order_id
        AND od.status <> -1
        ORDER BY od.status, od.order_id;';
        $statement = $this->db->prepare($sql);
        $statement->execute([':order_id' => '%' . $order_id . '%']);
        if ($rows =  $statement->fetchAll()) {
            return $rows;
        }
        return null;
    }

    public function getRevenue()
    {
        $sql = 'select sum(odd.quantity * prd.unit_price) as total_revenue from orders od, order_details odd, products prd
        where od.order_id = odd.order_id and odd.product_id = prd.product_id and od.status = 1';
        $statement = $this->db->prepare($sql);
        $statement->execute();
        if ($row =  $statement->fetchAll()) {
            return $row[0]['total_revenue'];
        }
        return null;
    }

    public function getCartInfoByUserId($user_id): ?array
    {
        try {
            $sql = 'select odd.product_id, od.order_id, p.product_avatar, p.product_name, odd.quantity, p.unit_price, (odd.quantity*p.unit_price) as total_detail, od.status   from users u, products p, orders od, order_details odd
            where u.user_id = od.user_id and p.product_id = odd.product_id and od.status = -1 and od.order_id = odd.order_id and od.user_id = ?;';
            $statement = $this->db->prepare($sql);
            $statement->execute([$user_id]);
            $rows = $statement->fetchAll();
            return $rows;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function changeStatusFrom_1To0($order_id): bool
    {
        try {
            $sql = 'update orders set status = 0 where order_id = ?';
            $statement = $this->db->prepare($sql);
            $statement->execute([$order_id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function changeStatusTo_2($order_id): bool
    {
        try {
            $sql = 'update orders set status = -2 where order_id = ?';
            $statement = $this->db->prepare($sql);
            $statement->execute([$order_id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function findExistsOrderWithStatusEqualTo_1($user_id)
    {
        try {
            $sql = 'SELECT order_id FROM orders WHERE user_id = ? and status = -1';
            $statement = $this->db->prepare($sql);
            $statement->execute([$user_id]);
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return $rows[0]['order_id'];
            }
            return null;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function checkProductExistsInOrder($order_id, $product_id): bool
    {
        $sql  = 'SELECT odd.product_id FROM order_details odd, orders od 
                 WHERE odd.order_id = od.order_id AND od.order_id = ? AND odd.product_id = ?';
        $statement = $this->db->prepare($sql);
        $statement->execute([$order_id, $product_id]);
        $rows = $statement->fetchAll();
        return !empty($rows);
    }

    public function addProductToCart($user_id, $product_id, $quantity)
    {
        $order_id = $this->findExistsOrderWithStatusEqualTo_1($user_id);
        if ($order_id === null) {
            $sql = 'INSERT INTO orders (user_id, status) VALUES (?, -1)';
            $statement = $this->db->prepare($sql);
            $statement->execute([$user_id]);
            $order_id = $this->findExistsOrderWithStatusEqualTo_1($user_id);
        }

        if ($this->checkProductExistsInOrder($order_id, $product_id)) {
            try {
                $sql = 'UPDATE order_details SET quantity = quantity + :quantity WHERE order_id = :order_id AND product_id = :product_id';
                $statement = $this->db->prepare($sql);
                return $statement->execute([':order_id' => $order_id, ':product_id' => $product_id, ':quantity' => $quantity]);
            } catch (\PDOException $e) {
                return false;
            }
        } else {
            try {
                $sql = 'INSERT INTO order_details (order_id, product_id, quantity) VALUES (?,?,?)';
                $statement = $this->db->prepare($sql);
                return $statement->execute([$order_id, $product_id, $quantity]);
            } catch (\PDOException $e) {
                return false;
            }
        }
    }

    public function getQuantityOfProductInOrder($order_id, $product_id)
    {
        $sql  = 'SELECT quantity FROM order_details WHERE order_id = :order_id AND product_id = :product_id';
        $statement = $this->db->prepare($sql);
        $statement->execute([':order_id' => $order_id, ':product_id' => $product_id]);
        $rows = $statement->fetchAll();
        if (!empty($rows)) {
            return $rows[0]['quantity'];
        }
        return null;
    }



    public function removeProductFromCart($order_id, $product_id): bool
    {
        try {
            $sql = 'DELETE FROM order_details WHERE order_id = :order_id AND product_id = :product_id';
            $statement = $this->db->prepare($sql);
            return $statement->execute([':order_id' => $order_id, ':product_id' => $product_id]);
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function orderSubmittedFromUser($user_id): ?array
    {
        try {
            $sql = 'select * from orders od, order_details odd, products prd
            where od.order_id = odd.order_id and prd.product_id = odd.product_id and od.user_id = ? order by od.status;';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$user_id]);
            $rows = $stmt->fetchAll();
            if (!empty($rows)) {
                return $rows;
            } else {
                return null;
            }
        } catch (\PDOException $e) {
            return null;
        }
    }

    

    function checkOrderHaveStatus0($order_id)
    {
        try {
            $sql = 'select * from orders where order_id = ? and status = 0';
            $statement = $this->db->prepare($sql);
            $statement->execute([$order_id]);
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return true;
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    function checkOrderHaveStatus_1($order_id)
    {
        try {
            $sql = 'select * from orders where order_id = ? and status = -1';
            $statement = $this->db->prepare($sql);
            $statement->execute([$order_id]);
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return true;
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    function checkOrderHaveStatus_2($order_id)
    {
        try {
            $sql = 'select * from orders where order_id = ? and status = -2';
            $statement = $this->db->prepare($sql);
            $statement->execute([$order_id]);
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return true;
            }
            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    function orderIdAndQuantityOfOrder($order_id): ?array
    {
        try {
            $sql = 'SELECT product_id, quantity FROM order_details WHERE order_id = :order_id';
            $statement = $this->db->prepare($sql);
            $statement->execute([':order_id' => $order_id]);
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return $rows;
            }
            return null;
        } catch (\PDOException $e) {
            return null;
        }
    }

    function removeOrderDetailsHasOrderId($order_id)
    {
        try {
            $sql = 'delete from order_details where order_id = :order_id';
            $statement = $this->db->prepare($sql);
            return $statement->execute([':order_id' => $order_id]);
        } catch (\PDOException $e) {
            return false;
        }
    }

    function removeOrderHasOrderId($order_id)
    {
        try {
            $sql = 'delete from orders where order_id = :order_id';
            $statement = $this->db->prepare($sql);
            return $statement->execute([':order_id' => $order_id]);
        } catch (\PDOException $e) {
            return false;
        }
    }


    public function updateQuantityInOrderDetails($order_id, $product_id, $quantity){
        try {
            $sql = 'UPDATE order_details SET quantity = :quantity WHERE order_id = :order_id AND product_id = :product_id';
            $statement = $this->db->prepare($sql);
            return $statement->execute([':order_id' => $order_id, ':product_id' => $product_id, ':quantity' => $quantity]);
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getInfoOrderToPrint($order_id) :?array{
        try {
            $sql = 'SELECT usr.user_id, usr.phone_number, usr.email, usr.user_name, od.order_id, prd.product_id, prd.product_name, prd.product_avatar, odd.quantity, od.order_date, od.order_phone, od.order_address, od.status, prd.unit_price 
            FROM orders od, order_details odd, products prd, users usr
            WHERE od.order_id = odd.order_id 
            AND od.user_id = usr.user_id 
            AND odd.product_id = prd.product_id 
            AND od.status <> -1
            AND od.order_id = :order_id
            ORDER BY od.status, od.order_id;';
            $statement = $this->db->prepare($sql);
            $statement->execute([':order_id' => $order_id]);
            $rows = $statement->fetchAll();
            if (!empty($rows)) {
                return $rows;
            }
            return null;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function updatePhoneOrderAndAddressOrderOfOrder($order_id, $order_phone, $order_address){
        try {
            $sql = 'UPDATE orders SET order_phone = :order_phone, order_address = :order_address WHERE order_id = :order_id';
            $statement = $this->db->prepare($sql);
            return $statement->execute([':order_id' => $order_id, ':order_phone' => $order_phone, ':order_address' => $order_address]);
        } catch (\PDOException $e) {
            return false;
        }
    }

}
