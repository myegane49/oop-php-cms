<?php 
class Comment extends DbObject {
  protected static $db_table = 'comments';
  protected static $db_table_fields = ['photo_id', 'author', 'body'];
  public $id;
  public $photo_id;
  public $author;
  public $body;

  static function create_comment($photo_id, $author, $body) {
    if (!empty($photo_id) && !empty($author) && !empty($body)) {
      $comment = new Comment();
      $comment->photo_id = (int)$photo_id;
      $comment->author = $author;
      $comment->body = $body;

      return $comment;
    } else {
      return false;
    }
  }

  static function find_the_comments($photo_id) {
    global $database;

    $table = self::$db_table;
    $sql = "SELECT * FROM $table WHERE photo_id = {$database->escape_string($photo_id)} ORDER BY photo_id ASC";
    return self::find_this_query($sql);
  }
}

?>