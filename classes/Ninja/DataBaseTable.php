<?php
namespace Ninja;

class DataBaseTable{
  private $pdo;
  private $table;
  private $primaryKey;

  public function __construct(\PDO $pdo,String $table,String $primaryKey){
    $this->pdo=$pdo;
    $this->table= $table;
    $this->primaryKey = $primaryKey;
  }

  public function insert($fields){
    $query = 'INSERT INTO `'.$this->table.'`(';
    foreach ($fields as $key => $value) {
      $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    foreach ($fields as $key => $value) {
      $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';
    $fields = $this->processDates($fields);
    $this->query($query, $fields);
  }

//any date in another format is converted to Y-M-s
  private function processDates($fields) {
    foreach ($fields as $key => $value) {
      if ($value instanceof \DateTime) {
        $fields[$key] = $value->format('Y-m-d');
      }
    }
    return $fields;
  }

  public function update($fields) {
    $query = ' UPDATE `' . $this->table .'` SET ';
    foreach ($fields as $key => $value) {
      $query .= '`' . $key . '` = :' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ' WHERE `' . $this->primaryKey . '` = :primaryKey';
    // Set the :primaryKey variable
    $fields['primaryKey'] = $fields['id'];
    $fields = $this->processDates($fields);
    $this->query($query, $fields);
  }


  private function query($sql, $parameters = []) {
    $query = $this->pdo->prepare($sql);
    $query->execute($parameters);//need not to bind values seperately
    return $query;
  }

  public function delete($id) {
    $parameters = [':id' => $id];
    $this->query('DELETE FROM `'.$this->table.'`WHERE `'.$this->primaryKey.'` = :id', $parameters);
  }

  public function findAll(){
    return $this->query('SELECT * FROM `'.$this->table.'`')->fetchAll();
  }

  public function findById($value) {
    $query = 'SELECT * FROM `' . $this->table . '`WHERE `' . $this->primaryKey . '` = :value';
    $parameters = ['value' => $value];
    $query = $this->query($query, $parameters);
    return $query->fetch();
  }

  public function find($column, $value) {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE ' .$column . ' = :value';
    $parameters = ['value' => $value];
    $query = $this->query($query, $parameters);
    return $query->fetchAll();
}


  public function total() {
    $query = $this->query('SELECT COUNT(*)FROM `' . $this->table . '`');
    $row = $query->fetch();
    return $row[0];
  }

  //if we try inserting a existing id, it will give us a 'duplicate id' error
  public function save($record) {
    try {
      if ($record[$this->primaryKey] == '') {//when the primary key is set to null, the auto increment feature in mysql will generate an id automatically
        $record[$this->primaryKey] = null;
      }
      $this->insert($record);
      echo 'pritnted';
      }
    catch (\PDOException $e) {
      $this->update($record);
    }
  }
}
