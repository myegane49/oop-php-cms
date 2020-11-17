<?php
class Photo extends DbObject {
  protected static $db_table = 'photos';
  protected static $db_table_fields = ['title', 'description', 'filename', 'type', 'size'];
  public $id;
  public $title;
  public $description;
  public $filename;
  public $type;
  public $size;

  public $tmp_path;
  public $upload_directory = "images";
  public $errors = [];
  public $upload_errors_array = [
    UPLOAD_ERR_OK => "there is no error",
    UPLOAD_ERR_INI_SIZE => "the uploaded file exceeds the upload_max_filesize directive",
    UPLOAD_ERR_FORM_SIZE => "the uploaded file exceeds the MAX_FILE_SIZE directive",
    UPLOAD_ERR_PARTIAL => "the uploaded file was only partially uploaded",
    UPLOAD_ERR_NO_FILE => "no file was uploaded",
    UPLOAD_ERR_NO_TMP_DIR => "missing a temporary folder",
    UPLOAD_ERR_CANT_WRITE => "failed to write file to disk",
    UPLOAD_ERR_EXTENSION => "a php extension stopped the file upload"
  ];

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
}
?>