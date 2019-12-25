<?php
function connect()
{
    include "../config/.dbconfig";
    $con = new mysqli($host, $user, $password, $db);
    if ($con->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $con;
}

class Table
{
    public $sql;
    public $result;
    public function selectAll()
    {
        $this->sql = "select * from " . get_class($this);
        return $this;

    }
    public function select(...$param)
    {
        $this->sql = "select ";
        foreach ($param as $col) {
            $this->sql .= $col . ", ";
        }

        $this->sql = substr($this->sql, 0, strlen($this->sql) - 2);
        $this->sql .= " from " . get_class($this);
        return $this;
    }
    public function where($col, $val)
    {

        if (!strstr($this->sql, 'where')) {
            $this->sql .= " where ";
        } else {
            $this->sql .= " and ";
        }

        $this->sql .= $col . "= '" . $val . "' ";

        return $this;
    }
    public function order($col, $type = 'asc')
    {
        if (!strstr($this->sql, 'order by')) {
            $this->sql .= " order by " . $col . " " . $type;
        }

        return $this;
    }
    public function group($col)
    {

        $this->sql .= " group by " . $col . " ";
        return $this;
    }
    public function limit($int)
    {
        $this->sql .= " limit $int ";
        return $this;
    }
    public function join($tabel, $left, $right)
    {
        $this->sql .= " join " . $tabel . " on ";
        $this->sql .= get_class($this) . ".$left = " . $tabel . ".$right";
        return $this;
    }
    public function left($tabel, $left, $right)
    {
        $this->sql .= " left join " . get_class($tabel) . " on ";
        $this->sql .= get_class($this) . ".$left = " . get_class($tabel) . ".$right";
        return $this;
    }
    public function right($tabel, $left, $right)
    {
        $this->sql .= " right join " . get_class($tabel) . " on ";
        $this->sql .= get_class($this) . ".$left = " . get_class($tabel) . ".$right";
        return $this;
    }
    public function insert()
    {
        $this->sql = "insert into " . get_class($this);
        return $this;
    }
    public function update()
    {
        $this->sql = "update " . get_class($this) . " set ";
        return $this;
    }
    public function delete()
    {
        $this->sql = "delete from " . get_class($this) . " ";
        return $this;
    }
    public function set($col, $val)
    {
        if (strstr($this->sql, "set") && strstr($this->sql, "=")) {
            $this->sql .= ", ";
        }

        $this->sql .= "$col='$val' ";
        return $this;
    }
    public function col(...$col)
    {
        $this->sql .= "(";
        foreach ($col as $t) {
            $this->sql .= "$t, ";
        }

        $this->sql = substr($this->sql, 0, strlen($this->sql) - 2);
        $this->sql .= ")";
        return $this;
    }
    public function val(...$param)
    {
        $this->sql .= " values(";
        foreach ($param as $val) {
            $this->sql .= "'$val', ";
        }

        $this->sql = substr($this->sql, 0, strlen($this->sql) - 2);
        $this->sql .= ")";
        return $this;
    }
    public function exec()
    {
        $con = connect();
        if (strstr($this->sql, "select")) {
            $this->result = $con->query($this->sql);
        } else if (strstr($this->sql, "insert") || strstr($this->sql, "update") || strstr($this->sql, "delete")) {
            if ($con->query($this->sql) === true) {
                $this->result = "ok";
            } else {
                $this->result = $con->error;
            }
        }
        $con->close();
        return $this;
    }
    public function fetch()
    {
        $tmp = [];
        while ($row = $this->result->fetch_assoc()) {
            array_push($tmp, $row);
        }
        return $tmp;
    }
}
