<?php
class Photo extends DbObject {
  protected static $db_table = 'photos';
  protected static $db_table_fields = ['title', 'caption', 'alternate_text', 'description', 'filename', 'type', 'size'];
  public $id;
  public $title;
  public $caption;
  public $alternate_text;
  public $description;
  public $filename;
  public $type;
  public $size;

  public $tmp_path;
  public $upload_directory = "images";

  public function save() {
    if ($this->id) {
      $this->update();
    } else {
      if (!empty($this->errors)) {
        return false;
      }

      if (empty($this->filename) || empty($this->tmp_path)) {
        $this->errors[] = "the file was not available";
        return false;
      }

      $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
      // $target_path = "admin/images/{$this->filename}";
      if (file_exists($target_path)) {
        $this->errors[] = "the file {$this->filename} is already uploaded";
        return false;
      }

      if (move_uploaded_file($this->tmp_path, $target_path)) {
        if ($this->create()) {
          unset($this->tmp_path);
          return true;
        }
      } else {
        $this->errors[] = "the file directory doesn't have permission";
        return false;
      }
    }
  }

  public function picture_path() {
    return $this->upload_directory . DS . $this->filename;
  }

  public function delete_photo() {
    if ($this->delete()) {
      $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
      return unlink($target_path) ? true : false;
    } else {
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
      $this->filename = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->size = $file['size'];
      $this->type = $file['type'];
    }
  }
}
?>