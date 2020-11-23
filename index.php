<?php include("includes/header.php"); ?>

<?php
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 2;
$items_total_count = Photo::count_all();

// $photos = Photo::find_all();
$paginate = new Paginate($page, $items_per_page, $items_total_count);
$sql = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$paginate->skip()}";
// $sql = "SELECT * FROM photos LIMIT {$paginate->skip()}, {$items_per_page}";
$photos = Photo::find_this_query($sql);
?>

<div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <div class="thumbnails row">
            <?php foreach($photos as $photo): ?>
                <div class="col-xs-6 col-md-3">
                    <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">
                        <img class="home_page_photo img-responsive" src="admin/<?php echo $photo->picture_path(); ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <ul class="pager">
                <?php if ($paginate->page_total() > 1): ?>
                    <?php if ($paginate->has_next()): ?>
                        <li class="next"><a href="index.php?page=<?php echo $paginate->next(); ?>">Next</a></li>
                    <?php endif; ?>

                    <?php
                        for ($i = 1; $i <= $paginate->page_total(); $i++) {
                            if ($i == $paginate->current_page) {
                                echo "<li class='active'><a href='index.php?page=$i'>$i</a></li>";
                            } else {
                                echo "<li><a href='index.php?page=$i'>$i</a></li>";
                            }
                        }
                    ?>

                    <?php if ($paginate->has_previous()): ?>
                        <li class="previous"><a href="index.php?page=<?php echo $paginate->previous(); ?>">Previous</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Blog Sidebar Widgets Column -->
    <!-- <div class="col-md-4"> -->
        <?php // include("includes/sidebar.php"); ?>
    <!-- </div> -->

</div>
<!-- /.row -->

<?php include("includes/footer.php"); ?>
