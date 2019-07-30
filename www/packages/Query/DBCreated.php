<?php


namespace Akuren\Query;


class DBCreated extends Dbpdo
{

    public function query($statement, $attributes= null, $one = false)
    {
        if ($attributes) {
            return  $this->prepare(
                $statement,
                $attributes,
                str_replace("Table", 'Entity', get_class($this)),
                $one);

        } else {
            return $this->Myquery(
                $statement,
                str_replace('Table', 'Entity', get_class($this))
            );
        }
    }

}