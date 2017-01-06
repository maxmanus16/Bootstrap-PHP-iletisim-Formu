<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bootstrap-PHP İletişim Formu</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="includes/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {padding-top:20px;}
    </style>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <style type="text/css">body { font-family: 'Open Sans', sans-serif; }</style>
    <script src="includes/jquery-1.11.1.min.js"></script>
    <script src="includes/bootstrap.min.js"></script>
</head>
<body>

<?php

/**
 * Class _contact-form-master
 *
 * @author  Fatih Soysal
 * @web     http://www.fatihsoysal.com
 * @mail    fatihsoysal@outlook.com
 */
    
    $error    = '';
    $name   = '';
    $email    = '';
    $subject  = '';
    $comments = '';
    $verify   = '';

    if(isset($_POST['contactus'])) {

    $name   = $_POST['name'];
    $email    = $_POST['email'];
    $subject  = $_POST['subject'];
    $comments = $_POST['comments'];
    $verify   = $_POST['verify'];

    if(trim($name) == '') {
      $error = '<div class="alert alert-danger">Hata! Ad Soyad alanı boş geçilemez!</div>';
    } else if(trim($email) == '') {
      $error = '<div class="alert alert-danger">Hata! E-posta adresinizi kontrol ediniz!</div>';

    } else if(!isEmail($email)) {
      $error = '<div class="alert alert-danger">Hata! E-posta standartlarına uygun bir adres girmediniz.</div>';
    }

    if(trim($subject) == '') {
      $error = '<div class="alert alert-danger">Hata! Konu bilgisi boş geçilemez.</div>';
    } else if(trim($comments) == '') {
      $error = '<div class="alert alert-danger">Hata! Mesaj bilgisi boş geçilemez.</div>';
    } else if(trim($verify) == '') {
      $error = '<div class="alert alert-danger">Hata! Doğrulama kodunu boş geçilemez!</div>';
    } else if(trim($verify) != '4') {
      $error = '<div class="alert alert-danger">Hata! Doğrulama kodunda bir yanlışlık var.</div>';
    }

    if($error == '') {

      if(get_magic_quotes_gpc()) {
        $comments = stripslashes($comments);
      }


    // E-mail almak istediğiniz mail adresini buraya yazalım.
    $address = "fatihsoysal@outlook.com";


    // Şablon değişikliği yapabilirsiniz.

    $e_subject = '' . $name . '. tarafından bir iletişim bilgisi geldi';

    $e_body = "$name <br> $subject\r\n\n";
    $e_content = "\"$comments\"\r\n\n";
    $e_reply = "$name via $email";

    $msg = $e_body . $e_content . $e_reply;

    if(mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n"))
    {
      // Gönderildi mesajımız.

       echo "<div class='alert alert-success'>";
       echo "<h1>Bilgileriniz başarıyla gönderildi.</h1>";
       echo "<p>Teşekkürler. <strong>$name</strong>, mesajınızı başarıyla aldık.</p>";
       echo "</div>";
     } else echo "Hata. Mail gönderilemedi";

    }
  }

    if(!isset($_POST['contactus']) || $error != '') 
    {
?>

<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">
          <form class="form-horizontal" action="" method="post">

          <?php echo $error; ?>
          <fieldset>
            <legend class="text-center">Bootstrap-PHP İletişim Formu</legend>
    
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Ad Soyad</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Ad Soyad" value="<?php echo $name; ?>" class="form-control" required>
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="E-mail" class="form-control" value="<?php echo $email; ?>" required>
              </div>
            </div>

            <!-- Subject input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Konu</label>
              <div class="col-md-9">
                <select name="subject" class="form-control" id="subject">
                  <option value="Support">Öneri</option>
                  <option value="a Sale">Görüş</option>
                  <option value="a Bug fix">Teşekkür</option>
              </select>
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="comments">Mesajınız</label>
              <div class="col-md-9">
                <textarea class="form-control" id="comments" name="comments" <?php echo $comments; ?> placeholder="Lütfen mesajınızı buraya yazınız..." rows="5" required></textarea>
              </div>
            </div>

            <!-- Captcha input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">3 + 1 =</label>
              <div class="col-md-9">
                <input id="verify" name="verify" type="text" placeholder="?" value="<?php echo $verify; ?>" class="form-control" required>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" name="contactus" id="contactus" class="btn btn-primary btn-lg">Gönder</button>
              </div>
            </div>
          </fieldset>

          <?php }

          function isEmail($email) { // Email address verification, do not edit.
          return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
          }
          ?>

          </form>
        </div>
      </div>
	</div>
</div>
</body>
</html>
