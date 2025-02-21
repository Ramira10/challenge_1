<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-header h1 {
            font-size: 24px;
            color: #333;
        }

        .email-body {
            margin-bottom: 20px;
        }

        .email-body p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Confirmación de Reserva</h1>
        </div>
        <div class="email-body">
            <p>Gracias por realizar tu reserva con nosotros, {{ $booking->customer_name }}. A continuación, encontrarás los detalles de tu reserva:</p>

            <p><strong>Tour:</strong> {{ $booking->tour->name }}</p>
            <p><strong>Hotel:</strong> {{ $booking->hotel->name }}</p>
            <p><strong>Fecha de la reserva:</strong> {{ $booking->booking_date }}</p>
            <p><strong>Personas:</strong> {{ $booking->number_of_people }}</p>

            <p>Si tienes alguna duda o necesitas más información, no dudes en contactarnos.</p>
        </div>
        <div class="footer">
            © 2024 Persiscal. Todos los derechos reservados.
        </div>
    </div>
</body>

</html>
