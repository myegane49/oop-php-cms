<?php 
class User {
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  public static function find_all_users() {
    // global $database;
    // return $database->query("SELECT * FROM users");

    return self::find_this_query("SELECT * FROM users");
  }

  public static function find_user_by_id($user_id) {
    $result = self::find_this_query("SELECT * FROM users WHERE id = $user_id");
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
      $the_object_array[] = self::instantiation($row);
    }
    return $the_object_array;
  }

  static function instantiation($found_user) {
    $user = new self;

    // $user->id = $found_user['id'];
    // $user->username = $found_user['username'];
    // $user->password = $found_user['password'];
    // $user->first_name = $found_user['first_name'];
    // $user->last_name = $found_user['last_name'];

    foreach($found_user as $property => $value) {
      if ($user->has_the_property($property)) {
        $user->$property = $value;
      }
    }

    return $user;
  }

  private function has_the_property($property) {
    $object_properties = get_object_vars($this);
    return array_key_exists($property, $object_properties);
  }
}

?>