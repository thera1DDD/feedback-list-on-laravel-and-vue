<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Уведомление</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background-color: gray;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        section {
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin: 20px;
            text-align: center;
        }

        h2 {
            color: dimgray;
            margin-bottom: 20px;
        }

        p {
            font-size: 17px;
            margin: 0 0 10px;
        }

        strong {
            font-weight: bold;
        }

        .status {
            font-weight: bold;
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 18px;
        }

        .status-yes {
            color: #4caf50; /* Зеленый цвет для галочки */
            background-color: #e8f5e9; /* Фон для галочки */
        }

        .status-no {
            color: #f44336; /* Красный цвет для крестика */
            background-color: #ffebee; /* Фон для крестика */
        }
    </style>
</head>
<body>
<header>
    <h1>Ответ руководства</h1>
</header>

<section>
    <p><strong>Комментарий: </strong>{{ $data['comment'] }}</p>
    <p><strong>Статус: </strong><span class="status {{ $data['status'] == 'Resolved' ? 'status-yes' : 'status-no' }}">{{ $data['status'] == 'Resolved' ? '✔' : '✗' }}</span></p>
</section>
</body>
</html>
