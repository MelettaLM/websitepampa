<?php

require 'config.php';

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $enquiry = trim($_POST['enquiry_type']);
    $message = trim($_POST['message']);

    // Insert into MySQL
    $sql = "INSERT INTO contact_enquiry
            (name,email,phone,enquiry_type,message)
            VALUES(?,?,?,?,?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssss",
        $name,
        $email,
        $phone,
        $enquiry,
        $message
    );

    if($stmt->execute())
    {

        // Send Email

        $mail = new PHPMailer(true);

        try{

            $mail->isSMTP();

            $mail->Host = "smtp.gmail.com";

            $mail->SMTPAuth = true;

            $mail->Username = "melettalizamathew2@gmail.com";

            $mail->Password = "Achuammu@2005";

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port = 587;

            $mail->setFrom("melettalizamathew2@gmail.com","Pampa Fertilizers");

            $mail->addAddress("melettalizamathew2@gmail.com");

            $mail->Subject = "New Contact Enquiry";

            $mail->Body =
            "Name : $name

Email : $email

Phone : $phone

Enquiry : $enquiry

Message :

$message";

            $mail->send();

            header("Location: thanks.html");
            exit();

        }

        catch(Exception $e)
        {
            echo "Mail could not be sent.<br>";
            echo $mail->ErrorInfo;
        }

    }

    else
    {
        echo "Database Error";
    }

    $stmt->close();

}

$conn->close();

?>