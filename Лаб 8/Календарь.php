<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
         table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .weekend {
            color: red;
        }

        .holiday {
            background-color: #FFFF99;
        }
    </style>
</head>
<body>

<?php
function generateCalendar($month = null, $year = null)
{
    if ($month === null || $year === null) {
        $month = date('n');
        $year = date('Y');
    }

    $firstDay = new DateTime("$year-$month-01");
    $lastDay = new DateTime("$year-$month-" . $firstDay->format('t'));

    echo "<h2>" . $firstDay->format("F Y") . "</h2>";

    echo "<table>";
    echo "<tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th class='weekend'>Сб</th><th class='weekend'>Вс</th></tr>";

    $firstDayOfWeek = $firstDay->format('N') - 1;
    echo "<tr>";
    for ($i = 0; $i < $firstDayOfWeek; $i++) {
        echo "<td></td>";
    }

    $currentDay = clone $firstDay;
    while ($currentDay <= $lastDay) {
        if ($currentDay->format('N') == 1) {
            echo "</tr><tr>";
        }

        $class = '';
        if (in_array($currentDay->format("N"), [6, 7])) {
            $class = 'weekend';
        }
        if ($currentDay->format("n") == $month && isHoliday($currentDay)) {
            $class .= ' holiday';
        }

        echo "<td class='$class'>" . $currentDay->format("j") . "</td>";

        $currentDay->add(new DateInterval('P1D'));
    }

    $lastDayOfWeek = $currentDay->format('N') - 1;
    for ($i = 0; $i < (7 - $lastDayOfWeek) % 7; $i++) {
        echo "<td></td>";
    }

    echo "</tr>";
    echo "</table>";
}

function isHoliday(DateTime $date)
{
    $holidays = [
        '01-01', '01-02', '01-03', '01-04', '01-05', '01-06', '01-07',
        '02-23',
        '03-08',
        '05-01', '05-02', '05-03',
        '05-09',
        '06-01',
        '11-06',
        '12-31',
    ];

    return in_array($date->format('m-d'), $holidays);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMonth = $_POST["month"];
    $userYear = $_POST["year"];
    generateCalendar($userMonth, $userYear);
} else {
    generateCalendar();
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="month">Месяц (1-12): </label>
    <input type="number" name="month" min="1" max="12" required>

    <label for="year">Год: </label>
    <input type="number" name="year" required>

    <input type="submit" value="Показать календарь">
</form>

</body>
</html>
