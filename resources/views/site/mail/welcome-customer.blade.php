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
        .mail-box h2,h3,h4,p {
            color: #fff;
        }
        .mail-box p.lara-ecomm {
            float: right;
        }
    </style>
</head>
<body>
    <section id="contact-us">
        <div class="container">
            <div class="row">
                <div class="mail-box">
                    <h2>Congratulation, </h2>
                    <h3>Mr/Miss {{ $customer_info['name'] }}</h3>
                    <h3>Email: {{ $customer_info['email'] }}</h3>
                    <h4>Phone No: {{ $customer_info['phone'] }}</h4>
                    <h4>Verify Code: {{ $customer_info['verify_code'] }}</h4>
                    <p>Your account has been successfully created. Please Verify your account Or Keep Login,,,</p>
                    <p class="lara-ecomm">Thanks for, <br>Lara Ecomm</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
