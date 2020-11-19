<?php 
class User extends DbObject {
  protected static $db_table = 'users';
  protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name', 'user_image'];
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;
  public $user_image;
  public $upload_directory = "images";
  public $image_placeholder = "images/def_avatar.webp";

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

  public function avatar_path() {
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
  }

}

?>