<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test All Functionalities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #333;
        }
        .section a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }
        .section a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Test All Functionalities</h1>

    <div class="section">
        <h2>Books</h2>
        <a href="addBooks.php">Add Book</a>
        <a href="showBooks.php">Show Books</a>
    </div>
    <div class="section">
        <h2>Books</h2>
        <a href="addAuthor.php">Add Author</a>
        <a href="showAuthors.php">Show Author</a>
    </div>
    <div class="section">
        <h2>Books</h2>
        <a href="addcategory.php">Add category</a>
        <a href="showCategories.php">Show category</a>
    </div>

    <div class="section">
        <h2>Cart</h2>
        <a href="addtToCart.php">Add to Cart</a>
        <a href="showCart.php">Show Cart</a>
    </div>

    <div class="section">
        <h2>Orders</h2>
        <a href="placeOrder.php">Place Order</a>
        <a href="showOrders.php">Show Orders</a>
        <a href="orderDetails.php">Order Details</a>
    </div>

    <div class="section">
        <h2>Reviews</h2>
        <a href="reviews.php">Add Review</a>
        <a href="showReviews.php">Show Reviews</a>
    </div>

</body>
</html>
