<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <style>
        .mail-box {
            width: 50%;
            background: #5a6268;
            border: 1px dashed #2adcb7;
            border-radius: 10px;
            padding: 20px;
        }
        .mail-box h2,p {
            color: #fff;
        }
    </style>
</head>
<body>
    <section id="contact-us">
        <div class="container">
            <div class="row">
                <div class="mail-box">
                    <h2>Name: {{ $contact_us_info_detail['name'] }}</h2>
                    <h3>Email: {{ $contact_us_info_detail['email'] }}</h3>
                    <p>Subject: {{ $contact_us_info_detail['subject'] }}</p>
                    <p>Phone No: {{ $contact_us_info_detail['phone'] }}</p>
                    <p>Message: {{ $contact_us_info_detail['message'] }}</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
