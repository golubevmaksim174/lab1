<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица умножения</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Таблица умножения от 0 до 10</h2>

    <table>
        <thead>
            <tr>
                <th>Умножить на</th>
                <th>0</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i <= 10; $i++) {
            echo "
            <tr>
                ";
                echo "
                <td><b>$i</b></td>";
                for ($j = 0; $j <= 10; $j++) {
                echo "
                <td>" . ($i * $j) . "</td>"; 
                }
                echo "
            </tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
