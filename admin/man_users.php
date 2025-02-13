<?php
require_once "../includes/db.inc.php";
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (isset($_SESSION["Aemail"])) {
    header("location: admin_menu.php");
}
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* table */
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            font-size: 18px;
            margin-top: 2%;
            align-content: center;
        }

        th {
            border: 1px solid black;
            height: 8vh;
        }

        td {
            padding: 1%;
            text-align: center;
        }

        tr {
            background-color: rgb(183, 180, 133);
        }

        tr:nth-child(even) {
            background-color: var(--primary);
        }

        a {
            text-decoration: none;
        }

        .action-tb {
            display: flex;
            gap: 50px;
            justify-content: space-evenly;
            align-items: center;
        }

        .act-btn {
            /* background-color: #6d3300; */
            padding: 5% 8%;
            margin-left: -20%;
            color: white;
            border-radius: 8px;
            align-items: center;
        }

        .del-btn {
            border: 2px solid rgb(123, 34, 1);
            color: rgb(123, 34, 1);
            padding: 5% 8%;
            margin-left: -20%;
            border-radius: 8px;
            align-items: center;
        }

        .btc-details,
        .bank-details,
        .logout-block {
            color: rgb(252, 241, 224);
            overflow-x: auto;
            scrollbar-width: none;
            font-size: 20px;
        }

        .bank-details span {
            display: block;
        }

        @media (max-width:600px) {
            table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                font-size: 13px;
                margin-top: 2%;
                align-content: center;
            }

            td {
                height: 40px;
                text-align: center;
            }
        }
    </style>
    <title>Document</title>
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
        echo '<table >
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>';

        while ($user = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($user['id']) . '</td>';
            echo '<td>' . htmlspecialchars($user['username']) . '</td>';
            echo '<td>' . htmlspecialchars($user['fullname']) . '</td>';
            echo '<td>' . htmlspecialchars($user['email']) . '</td>';
            echo "<td> <a href=../includes/delUser.php?id=" . $user['id'] . " class=del-btn >Delete</a></td>";
            " </td>";

            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No records found.';
    }
    ?>

</body>

</html>