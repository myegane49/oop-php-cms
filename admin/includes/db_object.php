<?php
class DbObject {
  public static function find_all() {
    // global $database;
    // return $database->query("SELECT * FROM users");
    
    $table = static::$db_table;
    // return self::find_this_query("SELECT * FROM $table");
    return static::find_this_query("SELECT * FROM $table");
  }

  public static function find_by_id($user_id) {
    $table = static::$db_table;
    $result = static::find_this_query("SELECT * FROM $table WHERE id = $user_id");
    // $found_user = mysqli_fetch_assoc($result);
    // return $found_user;

    if (!empty($result)) {
      $first_item = array_shift($result);
      return $first_item;
    }
    return false;
  }

  static function find_this_query($sql) {
    global $database;
    $result = $database->query($sql);
    $the_object_array = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $the_object_array[] = static::instantiation($row);
    }
    return $the_object_array;
  }

  static function instantiation($found_user) {
    // $user = new self;
    $calling_class = get_called_class();
    $the_object = new $calling_class;

    // $user->id = $found_user['id'];
    // $user->username = $found_user['username'];
    // $user->password = $found_user['password'];
    // $user->first_name = $found_user['first_name'];
    // $user->last_name = $found_user['last_name'];

    foreach($found_user as $property => $value) {
      if ($the_object->has_the_property($property)) {
        $the_object->$property = $value;
      }
    }

    return $the_object;
  }

  private function has_the_property($property) {
    $object_properties = get_object_vars($this);
    return array_key_exists($property, $object_properties);
  }

  public function create() {
    global $database;
    $table = static::$db_table;
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
    $table = static::$db_table;
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
    $table = static::$db_table;

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
    foreach(static::$db_table_fields as $field) {
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