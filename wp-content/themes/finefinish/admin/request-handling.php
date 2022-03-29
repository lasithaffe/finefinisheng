<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

add_action( 'admin_post_nopriv_career_form', 'ewd_sending_career_mail' );
add_action( 'admin_post_career_form', 'ewd_sending_career_mail' );


function ewd_sending_career_mail() {

    session_start();
    $inputs     = $_POST;
    $to         = 'tauseef@extremewebdesigners.com';
    $toName     = 'Tauseef';
    $subject    = 'Fine Finish - Career Notification';
    $body = '<table width="600px" style="background-color: #f5f5f5; font-family: Arial Hebrew, Arial, sans-serif">
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><h2 style="margin: 0; padding: 10px;">Career Notification</h2></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="600px" style="border: 1px solid #f5f5f5; padding: 15px; font-family: Arial Hebrew, Arial, sans-serif">
                        <tbody>
                            <tr style="font-size: 14px;">
                                <td>
                                    <p>
                                        Dear Admin,
                                    </p>
                                    <p>You have a new career notification from your site Fine Finish. Here are the candidate information</p>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td><h3 style="margin-bottom: 5px;">Candidate details</h3></td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%; border-spacing: 0; font-size: 12px;">
                                        <tbody>
                                         <tr >
                                            <td width="30%" style="padding: 5px;border: 1px solid #e0e0e0;background-color: #f5f5f5;">Name</td>
                                            <td style="padding: 5px;border: 1px solid #e0e0e0;">'.htmlspecialchars($inputs['full_name']).'</td>
                                        </tr>
                                        <tr >
                                            <td width="30%" style="padding: 5px;border: 1px solid #e0e0e0;background-color: #f5f5f5;">Phone</td>
                                            <td style="padding: 5px;border: 1px solid #e0e0e0;">'.htmlspecialchars($inputs['contact_number']).'</td>
                                        </tr>
                                        <tr >
                                            <td width="30%" style="padding: 5px;border: 1px solid #e0e0e0;background-color: #f5f5f5;">Email</td>
                                            <td style="padding: 5px;border: 1px solid #e0e0e0;">'.htmlspecialchars($inputs['email_address']).'</td>
                                        </tr>
                                        <tr >
                                            <td width="30%" style="padding: 5px;border: 1px solid #e0e0e0;background-color: #f5f5f5;">Position</td>
                                            <td style="padding: 5px;border: 1px solid #e0e0e0;">'.htmlspecialchars($inputs['job_position']).'</td>
                                        </tr>
                                        <tr >
                                            <td width="30%" style="padding: 5px;border: 1px solid #e0e0e0;background-color: #f5f5f5;">Message</td>
                                            <td style="padding: 5px;border: 1px solid #e0e0e0;">'.nl2br(htmlspecialchars($inputs['description'])).'</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                </td>
                            </tr>
                            <tr style="font-size: 14px;">
                                <td>
                                    <p>
                                        Thank you,
                                    </p>
                                    <p>Fine Finish</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>';

    $upload_dir = wp_upload_dir();
//    var_dump($upload_dir);
    $target_file = $upload_dir['basedir'].'/resume/'. basename($_FILES["resume"]["name"]);
    move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);

    $mail = new PHPMailer();
    $mail->isMail();
//    $mail->IsSMTP(); // enable SMTP
//    $mail->SMTPAuth = true; // authentication enabled
//    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
//    $mail->Host = "smtp.gmail.com";
//    $mail->Port = 465; // or 587
//    $mail->Username = "tauseef@extremewebdesigners.com";
//    $mail->Password = "tauseef2017";
    //Recipients
    $mail->setFrom('no-reply@finefinish.com', 'Fine Finish');
    $mail->addAddress($to, $toName);     // Add a recipient
    $mail->addReplyTo(htmlspecialchars($inputs['email_address']), htmlspecialchars($inputs['full_name']));
    $mail->addAttachment($target_file);

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;

    if($mail->send()){

        $_SESSION['message'] = 'success';

    }else{

        $_SESSION['message'] = 'failed';
    }

    header("Location: ".site_url('careers'));

}