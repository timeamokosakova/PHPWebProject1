<!DOCTYPE HTML>
<html>
<head></head>
<body>
    <?php
   // include 'connect.php';

//phpinfo();
//echo "ahoj dusan";
//include 'connect.php';
//$sql = "INSERT INTO myguests (firstname, lastname, email)
//VALUES ('dusan', 'mraz', '1mrazik1@gmail.com')";

$menoErr = $emailErr = $pohlavieErr = $strankaErr = "";
$meno = $email = $pohlavie = $koment = $stranka = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["meno"])) {
    $menoErr = "Meno je potrebn�";
  } else {
    $meno = test_input($_POST["meno"]);
  if (!preg_match("/^[a-zA-Z ]*$/",$meno)) {
      $menoErr = "Povolen� s� len p�smen� a medzery";
    }
  }
 if (empty($_POST["email"])) {
    $emailErr = "Email je potrebn�";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Zl� vlo�en� form�t emailu";
    }
  }
 if (empty($_POST["stranka"])) {
    $stranka = "";
  } else {
    $stranka = test_input($_POST["stranka"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$stranka)) {
      $strankaErr = "Zl� URL";
    }
  }
if (empty($_POST["koment"])) {
    $koment = "";
  } else {
    $koment = test_input($_POST["koment"]);
  }

  if (empty($_POST["pohlavie"])) {
    $pohlavieErr = "Pohlavie je potrebn�";
  } else {
    $pohlavie = test_input($_POST["pohlavie"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//$conn->close();
    ?>
    <h2>Pr�klad valid�cie formul�ra</h2>
    <p>
        <span class="error">* tieto inform�cie s� nutn�.</span>
    </p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Meno:
        <input type="text" name="meno" value="<?php echo $meno;?>" />
        <span class="error">
            * <?php echo $menoErr;?>
        </span>
        <br />
        <br />
        E-mail:
        <input type="text" name="email" value="<?php echo $email;?>" />
        <span class="error">
            * <?php echo $emailErr;?>
        </span>
        <br />
        <br />
        Str�nka:
        <input type="text" name="stranka" value="<?php echo $stranka;?>" />
        <span class="error">
            * <?php echo $strankaErr;?>
        </span>
        <br />
        <br />
        Koment�r:
        <textarea name="koment" rows="5" cols="40">
            <?php echo $koment;?>
        </textarea>
        <br />
        <br />
        Pohlavie:
        <input type="radio" name="pohlavie" <?php if (isset($pohlavie) && $pohlavie=="�ena") echo "checked";?> value="�ena" />�ena
        <input type="radio" name="pohlavie" <?php if (isset($pohlavie) && $pohlavie=="mu�") echo "checked";?> value="mu�" />mu�
        <span class="error">
            * <?php echo $pohlavieErr;?>
        </span>
        <br />
        <br />
        <input type="submit" name="submit" value="Odosla�" />
    </form>
    <?php
echo "<h2>Tvoje vlo�en� inform�cie:</h2>";
if (!preg_match("/^[a-zA-Z ]*$/",$meno)) {
      $menoErr = "Povolen� s� len p�smen� a medzery";
    } else {echo $meno;}
echo "<br>";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Zl� vlo�en� form�t emailu";
    } else {echo $email;}
echo "<br>";
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$stranka)) {
      $strankaErr = "Zl� URL";
    } else {echo $stranka;}
echo "<br>";
echo $koment;
echo "<br>";
echo $pohlavie;
    ?>

</body>
</html>