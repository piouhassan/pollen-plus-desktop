<?php


namespace Akuren\Query;


interface QueryBuilderInterface
{


    public static function table(string $table);



    /**
     * @param string $table
     * @param string $alias
     * @return self
     */
    public  function  from(string $table, ?string  $alias = null);

    /**
     * @param string ...$fields
     * @return self
     */
    public function select (string ...$fields);

    /**
     * @param string $condition
     * @return self
     */
    public function where (string $condition) ;


    /**
     * @return integer
     */
    public function count ();


    /**
     * @param array $params
     * @return self
     */
    public  function params(array $params);

    /**
     * @return string
     */
    public function __toString ();
    
    
    /**
     * @param bool $fecth
     * @return mixed
     */
    public function  get(bool $fecth);


    /**
     * @param array $array
     * @return mixed
     */
    public function insert(array $array);
    
    
    public function join(string ...$table);


    /**
     * @param $id
     * @param $fields
     * @return mixed
     */
    public function update($id, $fields);

}