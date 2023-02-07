<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('uk', 'phpmailer/language/');
$mail->IsHTML(true);

/*
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'user@example.com';                     //SMTP username
$mail->Password   = 'secret';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                 
*/

//От кого письмо
$mail->setFrom('sanokgfx@gmail.com', 'КРШ форма'); // Указать нужный E-mail
//Кому отправить
$mail->addAddress('havrylenkosasha@gmail.com'); // Указать нужный E-mail
//Тема письма
$mail->Subject = 'Заявка на рекорд КРШ';

//Тело письма
$body = '<h1>Заявка на рекорд</h1>';

if (trim(!empty($_POST['label']))) {
	$body .= "<p><strong>Номінація рекорду:</strong>" . $_POST['label'] . "</p>";
}
;
if (trim(!empty($_POST['description']))) {
	$body .= "<p><strong>Опис:</strong>" . $_POST['description'] . "</p>";
}
if (trim(!empty($_POST['name']))) {
	$body .= "<p><strong>Ім’я:</strong>" . $_POST['name'] . "</p>";
}
if (trim(!empty($_POST['age']))) {
	$body .= "<p><strong>Вік:</strong>" . $_POST['age'] . "</p>";
}
if (trim(!empty($_POST['grade']))) {
	$body .= "<p><strong>Клас:</strong>" . $_POST['grade'] . "</p>";
}
if (trim(!empty($_POST['num']))) {
	$body .= "<p><strong>Номер:</strong>" . $_POST['num'] . "</p>";
}

/*
//Прикрепить файл
if (!empty($_FILES['image']['tmp_name'])) {
//путь загрузки файла
$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
//грузим файл
if (copy($_FILES['image']['tmp_name'], $filePath)){
$fileAttach = $filePath;
$body.='<p><strong>Фото в приложении</strong>';
$mail->addAttachment($fileAttach);
}
}
*/

$mail->Body = $body;

//Отправляем
if (!$mail->send()) {
	$message = 'Ошибка';
} else {
	$message = 'Данные отправлены!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>