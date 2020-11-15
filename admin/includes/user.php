<?php 
class User extends DbObject {
  protected static $db_table = 'users';
  protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name'];
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  static function verify_user($username, $password) {
    global $database;
    
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $result = self::find_this_query($sql);
    if (!empty($result)) {
      $first_item = array_shift($result);
      return $first_item;
    }
    return false;
  }

  public function create() {
    global $database;
    $table = self::$db_table;
    $properties = $this->clean_properties();
    $keys = implode(",", array_keys($properties));
    $values = implode("','", array_values($properties));

    // $username = $database->escape_string($this->username);
    // $password = $database->escape_string($this->password);
    // $first_name = $database->escape_string($this->first_name);
    // $last_name = $database->escape_string($this->last_name);

    // $sql = "INSERT INTO $table (username, password, first_name, last_name) VALUES ('$username', '$password', '$first_name', '$last_name')";
    $sql = "INSERT INTO $table ($keys) VALUES ('$values')";
    if ($database->query($sql)) {
      $this->id = $database->the_insert_id();
      return true;
    } else {
      return false;
    }
  }

  public function update() {
    global $database;
    $table = self::$db_table;
    $properties = $this->clean_properties();
    $property_pairs = [];
    foreach($properties as $key => $value) {
      $property_pairs[] = "$key = '$value'";
    }
    $key_value_set = implode(", ", $property_pairs);

    // $username = $database->escape_string($this->username);
    // $password = $database->escape_string($this->password);
    // $first_name = $database->escape_string($this->first_name);
    // $last_name = $database->escape_string($this->last_name);
    $id = $database->escape_string($this->id);

    // $sql = "UPDATE $table SET username = '$username', password = '$password', first_name = '$first_name', last_name = '$last_name' WHERE id = $id";
    $sql = "UPDATE $table SET $key_value_set WHERE id = $id";
    $database->query($sql);

    return mysqli_affected_rows($database->connection) == 1 ? true : false;  
  }

  public function delete() {
    global $database;
    $id = $database->escape_string($this->id);
    $table = self::$db_table;

    $sql = "DELETE FROM $table WHERE id = $id";
    $database->query($sql);

    return mysqli_affected_rows($database->connection) == 1 ? true : false; 
  }

  public function save() {
    return isset($this->id) ? $this->update() : $this->create();
  }

  protected function properties() {
    // return get_object_vars($this);

    $properties = [];
    foreach(self::$db_table_fields as $field) {
      if (property_exists($this, $field)) {
        $properties[$field] = $this->$field;
      }
    }

    return $properties;
  }

  protected function clean_properties() {
    global $database;

    $clean_properties = [];
    foreach($this->properties() as $key => $value) {
      $clean_properties[$key] = $database->escape_string($value);
    }

    return $clean_properties;
  }
}

?>