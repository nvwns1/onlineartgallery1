<?php
session_start();
if ($_SESSION['username'] != 'admin') {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .artist-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .artist-card {
            flex-basis: calc(33.33% - 20px);
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .artist-card:hover {
            transform: translateY(-25px);
        }

        .artist-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .artist-card h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }

        .artist-card p {
            margin: 0;
            color: #666;
            text-align: center;
            font-size: 14px;
        }

        .artist-card a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            margin-top: 10px;
        }

        .artist-card a:hover {
            color: #666;
        }

        .link-container {
            display: flex;
            gap: 10px;
        }
        .edit-link {
            padding: 5px 10px;
            background-color: #eee;
            text-decoration: none;
            color: #333;
        }
        .delete-msg {
            margin-bottom: 10px;
            color: green;
            background-color: red;
        }
        .delete-link {
            padding: 5px 10px;
            background-color: red;
            text-decoration: none;
            color: #fff;
        }
        .artwork-link {
            text-decoration: none;
            color: blue;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Online Art Gallery</h1>
        </div>
        <nav>
            <ul>
                <li><a href="orderAdminAll.php">Order</a></li>
                <li><a href="allArtist.php">All artist</a></li>
                <li><a href="allArtwork.php">All artwork</a></li>
                <li><a href="partials/logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
</body>

</html>