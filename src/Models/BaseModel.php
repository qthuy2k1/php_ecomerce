<?php

namespace App\Models;
use App\Core\Database;
use mysqli;

class BaseModel extends Database {
    protected $conn;

    public function __construct(){
        $this->conn = $this->connect();
    }
    // Lay ra tat ca du lieu trong bang
    public function all($table, $select = ['*'], $orderBy = ['name' => 'asc'], $limit = 10, $type = 0) {
        $columns = implode(', ', $select);
        $orderByString = implode(' ', $orderBy);
        if($type > 0) {
            if($orderByString) {
                $sql = "SELECT ${columns} FROM ${table} ORDER BY ${orderByString} LIMIT ${limit}";
            }
            else {
                $sql = "SELECT ${columns} FROM ${table} LIMIT ${limit}";
            }
        }

        // die($sql);
        
        $query = $this->_query($sql);

        $data = [];

        while($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function _query($sql) {
        return mysqli_query($this->conn, $sql);
    }

    // Lay ra 1 ban ghi trong bang
    public function find($table, $id) {
        $sql = "SELECT * FROM ${table} WHERE ma_san_pham = ${id} LIMIT 1";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function getByQuery($sql) {
        $query = $this->_query($sql);
        $data = [];

        while($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }

        return $data;
    }
}