<?php


namespace Akuren\Query;



class Query extends Dbpdo implements QueryBuilderInterface
{

    private $select;

    private $from;

    private $where = [];

    private $params;

    private  $group;

    private $order;

    private $limit;
    
    private $join;
    
    private $on;
    
    public static function table (string $table)
    {
       return (new Query())->from($table);
    }


    public  function from(string $table, ?string  $alias = null) : self
    {
        if ($alias){
            $this->from[$alias] = $table;
        }else{
            $this->from[] = $table;
        }

       return $this;
    }

    public function select (string ...$fields) : self
    {
       $this->select = $fields;
       return $this;
    }

    public function where (string $condition):self
    {
        $this->where[] = $condition;
        return $this;
    }


    public function count (): int
    {
     $this->select("COUNT(*)");
    return $this->execute()->fetchColumn();
    }


    public function params (array $params)
    {
       $this->params = $params;
       return $this;
    }

    public function __toString ()
    {
        $parts = ['SELECT'];
        if ($this->select){
            $parts[] = join(', ', $this->select);
        }else{
          $parts[] = '*';
        }

        $parts[] = 'FROM';
        $parts[] = $this->buildFrom();
        
        if ($this->join) {
            $parts[] = "LEFT JOIN";
            $parts[] = join(' ', $this->join);
        }
        if ($this->on) {
            $parts[] = "ON";
            $parts[] = join(' ', $this->on);
        }
        if (!empty($this->where)){
            $parts[] = "WHERE";
            $parts[] = "(".join(') AND (', $this->where). ")";
        }
        
       
        return join(' ', $parts);

    }




    public function insert(array $array){
        $tableau = [];
        $attributes = [];
        foreach ($array as $k => $v){
            $tableau[] = "$k = ?";
            $attributes[] = $v;
        }
        $table_part  = implode(' , ' , $tableau);

      return (new DBCreated())->query("INSERT INTO {$this->buildFrom()} SET $table_part " , $attributes ,true);

   }


    public function update($id, $fields)
    {
        $tableau = [];
        $attributes = [];
        foreach ($fields as $k => $v){
            $tableau[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $tabl_part  = implode(',' , $tableau);

        return  $this->query("UPDATE  {$this->buildFrom()} SET $tabl_part   WHERE id = ?" , $attributes ,true);

    }



    private function buildFrom () : string
    {
        $from = [];

        foreach ($this->from as $key => $value){
            if (is_string($key)){
                $from[] = "$value as $key";
            }
            else{
                $from[]  = $value;
            }
        }

        return join(', ', $from);
    }

    private function execute ()
    {
        $query = $this->__toString();
        if ($this->params){
          $statement = $this->getPDO()->prepare($query);
          $statement->execute($this->params);
          return $statement;
        }
        return $this->getPDO()->query($query);
    }


    public function get(bool $fecth = false)
    {
        $query = $this->__toString();
        if ($fecth) {
            return $this->getPDO()->query($query)->fetch();
        }
        return $this->getPDO()->query($query);
    }
    
    
    public function join(string ...$table)
    {
        $this->join = $table;
        return $this;
    }
    
    public function on(string $condition)
    {
        $this->on[] = $condition;
        return $this;
    }
    

}