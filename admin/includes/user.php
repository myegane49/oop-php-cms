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

  public function upload_avatar() {
    if (!empty($this->errors)) {
      return false;
    }

    if (empty($this->user_image) || empty($this->tmp_path)) {
      $this->errors[] = "the file was not available";
      return false;
    }

    $target_path = SITE_ROOT . DS . 'admin' . DS . $this->avatar_path();
    if (file_exists($target_path)) {
      $this->errors[] = "the file {$this->user_image} is already uploaded";
      return false;
    }

    if (move_uploaded_file($this->tmp_path, $target_path)) {
      unset($this->tmp_path);
      return true;
    } else {
      $this->errors[] = "the file directory doesn't have permission";
      return false;
    }
  }

  public function set_file($file) {
    if (empty($file) || !$file || !is_array($file)) {
      $this->errors[] = "there was no file uploaded here";
      return false;
    } else if ($file['error'] != 0) {
      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;
    } else {
      $this->user_image = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->size = $file['size'];
      $this->type = $file['type'];
    }
  }

}

?>