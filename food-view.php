<?php include('partials-front/menu.php'); ?>

<?php
// Check if ID is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch food details from DB
    $sql = "SELECT * FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        $category_id = $row['category_id'];

        // Optional: Get category name
        $cat_sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $cat_res = mysqli_query($conn, $cat_sql);
        $category_title = ($cat_res && mysqli_num_rows($cat_res) == 1) ? mysqli_fetch_assoc($cat_res)['title'] : "Unknown";

    } else {
        echo "<div class='error text-center'>Food Not Found</div>";
        exit;
    }
} else {
    header('location:' . SITEURL);
    exit;
}
?>

<section class="food-detail-page">
    <div class="container text-center">
        <h2><?php echo $title; ?></h2>
        <br>
        <?php
        if ($image_name != "") {
            ?>
            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" style="max-width: 400px;">
            <?php
        } else {
            echo "<div class='failed'>Image not available</div>";
        }
        ?>
        <br><br>
        <h3>Price: <span><?php echo $price; ?> BDT</span></h3><br>
        <h4>Category: <?php echo $category_title; ?></h4><br>
        <p><?php echo $description; ?></p><br>

        <br>
        <!-- <a href="#" class="btn btn-primary">Order Now</a> -->
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
