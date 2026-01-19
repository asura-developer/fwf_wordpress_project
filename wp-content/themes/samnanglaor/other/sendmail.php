<?php
$Username = $_GET['username'];
$Userphone = $_GET['phone'];
$Useremail = $_GET['email'];
$Usersubject = $_GET['subject'];
$Usermessage = $_GET['message'];
 
$to = get_bloginfo('admin_email');
$subject = 'National Concrete - Contact us page';

$body = "Name: " . $Username . '<br>' .
        "Subject: " . $Usersubject . '<br>' . 
        "Email: " . $Useremail . '<br>' .
        "Phone: " . $Userphone . '<br>' .
        "Message: " . $Usermessage ;

$headers = array('Content-Type: text/html; charset=UTF-8');

$sent = false;

if(isset($_GET['submit'])){
        $sent = wp_mail( $to, $subject, $body, $headers ); 
        if($sent === true){
              redirectJs(get_home_url() . '/email-sucess');
        }else{
              redirectJs(get_home_url() . '/email-fail');
        }
}   

  


function redirectJs($theUrl){
?>
    <script> window.location.href = '<?php echo $theUrl ?>'; </script>

<?php
}

