<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS > Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <style>
    .container {
        position: absolute;
        top: 80px;
        right: 1rem;
        left: 15rem;
        max-width: calc(100vw - 16rem) !important;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .header-desc{
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 0 2rem 2rem 0;
    }

    </style>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var options = {
                title: 'Expense Categories',
                is3D: true,
            };

            var data = google.visualization.arrayToDataTable([
                ['Category', 'Total Amount'],
                <?php foreach ($data as $row): ?>
                    ['<?= addslashes($row[0]) ?> - <?= number_format($row[1], 2) ?>', <?= $row[1] ?>],
                <?php endforeach; ?>
            ]);

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>

</head>
<body>
    <x-Navigation/>
        <div class="container">
            <div class="header-desc">
                <p class="mt-auto mb-auto" style="font-size: 20px;">My Expenses</p>
                <p class="mt-auto mb-auto">Dashboard</p>    
            </div>
            <div id="piechart_3d" style="width:900px;height:400px"></div>
        </div>
</body>
</html>
