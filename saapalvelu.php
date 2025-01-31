<?php
session_start();
include 'tietokanta.php';
$jsonFilePath = 'saadata.json';
function loadJsonData($jsonFilePath) {
    if (file_exists($jsonFilePath)) {
        return json_decode(file_get_contents($jsonFilePath), true);
    }
    return [];
}

function saveJsonData($jsonFilePath, $data) {
    file_put_contents($jsonFilePath, json_encode($data, JSON_PRETTY_PRINT));
}

$saadata = loadJsonData($jsonFilePath);

function rekisteroiKayttaja($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rekisteroi'])) {
        $nimi = $_POST['nimi'];
        $salasana = password_hash($_POST['salasana'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO kayttajat (nimi, salasana) VALUES (?, ?)");
        $stmt->bind_param("ss", $nimi, $salasana);

        if ($stmt->execute()) {
            echo "<p>Rekisteröinti onnistui.</p>";
        } else {
            echo "<p>Rekisteröinti epäonnistui: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}

function kirjauduKayttaja($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirjaudu'])) {
        $nimi = $_POST['nimi'];
        $salasana = $_POST['salasana'];
        
        if ($nimi === 'admin' && $salasana === 'taitaja2023') {
            $_SESSION['id'] = 0;  
            $_SESSION['nimi'] = 'admin';
            $_SESSION['is_admin'] = true;
            echo "<p>Sisäänkirjautuminen onnistui</p>";
        } else {
            $stmt = $conn->prepare("SELECT * FROM kayttajat WHERE nimi = ?");
            $stmt->bind_param("s", $nimi); 
            $stmt->execute();
            $result = $stmt->get_result();
            $kayttaja = $result->fetch_assoc();

            if ($kayttaja && password_verify($salasana, $kayttaja['salasana'])) {
                $_SESSION['id'] = $kayttaja['id'];
                $_SESSION['nimi'] = $kayttaja['nimi']; 
                $_SESSION['is_admin'] = false;
                echo "<p>Sisäänkirjautuminen onnistui</p>";
            } else {
                echo "<p>Virheellinen käyttäjänimi tai salasana.</p>";
            }
            $stmt->close();
        }
    }
}

function kirjauduUlos() {
    session_unset();
    session_destroy();
    header("Location: saa.php");
    exit();
}

if (isset($_POST['rekisteroi'])) {
    rekisteroiKayttaja($conn);
} elseif (isset($_POST['kirjaudu'])) {
    kirjauduKayttaja($conn);
} elseif (isset($_POST['kirjaudu_ulos'])) {
    kirjauduUlos();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['muokkaa_säädataa'])) {
    foreach ($saadata as $key => $data) {
        if ($data['Vuosi'] == $_POST['Vuosi'] && $data['Kk'] == $_POST['Kk'] && $data['Pv'] == $_POST['Pv']) {
            $saadata[$key]['Sademäärä (mm)'] = $_POST['Sademäärä'];
            $saadata[$key]['Lumensyvyys (cm)'] = $_POST['Lumensyvyys'];
            $saadata[$key]['Ylin lämpötila (degC)'] = $_POST['Ylin_lämpötila'];
            $saadata[$key]['Alin lämpötila (degC)'] = $_POST['Alin_lämpötila'];
            
            $stmt = $conn->prepare("UPDATE saadata SET Sademäärä = ?, Lumensyvyys = ?, Ylin_lämpötila = ?, Alin_lämpötila = ? WHERE Vuosi = ? AND Kk = ? AND Pv = ?");
            $stmt->bind_param("ddddiii", $_POST['Sademäärä'], $_POST['Lumensyvyys'], $_POST['Ylin_lämpötila'], $_POST['Alin_lämpötila'], $_POST['Vuosi'], $_POST['Kk'], $_POST['Pv']);
            $stmt->execute();
            $stmt->close();
        }
    }
    saveJsonData($jsonFilePath, $saadata);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekisteröinti ja Kirjautuminen</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        .container { width: 90%; max-width: 950px; margin: 50px auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2, h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: center; }
        form { margin: 10px 0; }
        input, button { width: 100%; padding: 10px; margin: 5px 0; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        footer { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <?php if (!isset($_SESSION['id'])): ?>
        <h2>Rekisteröidy</h2>
        <form method="POST" action="">
            <input type="text" name="nimi" placeholder="Käyttäjänimi" required><br>
            <input type="password" name="salasana" placeholder="Salasana" required><br>
            <button type="submit" name="rekisteroi">Rekisteröidy</button>
        </form> 

        <h2>Kirjaudu sisään</h2>
        <form method="POST" action="">
            <input type="text" name="nimi" placeholder="Käyttäjänimi" required><br>
            <input type="password" name="salasana" placeholder="Salasana" required><br>
            <button type="submit" name="kirjaudu">Kirjaudu sisään</button>
        </form>
    <?php else: ?>
        <main>
            <h1>Kuopio</h1>
            <p>Säätiedot</p>
            <table>
                <tr>
                    <td>Sademäärä (mm)</td>
                    <?php foreach ($saadata as $day): ?>
                        <td><?php echo $day['Sademäärä (mm)']; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Lumensyvyys (cm)</td>
                    <?php foreach ($saadata as $day): ?>
                        <td><?php echo $day['Lumensyvyys (cm)']; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Ylin lämpötila (°C)</td>
                    <?php foreach ($saadata as $day): ?>
                        <td><?php echo $day['Ylin lämpötila (degC)']; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <td>Alin lämpötila (°C)</td>
                    <?php foreach ($saadata as $day): ?>
                        <td><?php echo $day['Alin lämpötila (degC)']; ?></td>
                    <?php endforeach; ?>
                </tr>
            </table>

            <?php if ($_SESSION['is_admin']): ?>
                <h2>Admin hallinta</h2>
                <form method="POST" action="">
                    <input type="number" name="Vuosi" placeholder="Vuosi" required>
                    <input type="number" name="Kk" placeholder="Kuukausi" required>
                    <input type="number" name="Pv" placeholder="Päivämäärä" required>
                    <input type="number" name="Sademäärä" placeholder="Sademäärä (mm)" required>
                    <input type="number" name="Lumensyvyys" placeholder="Lumensyvyys (cm)" required>
                    <input type="number" name="Ylin_lämpötila" placeholder="Ylin lämpötila (°C)" required>
                    <input type="number" name="Alin_lämpötila" placeholder="Alin lämpötila (°C)" required>
                    <button type="submit" name="muokkaa_säädataa">Muokkaa säätietoja</button>
                </form>
            <?php endif; ?>
        </main>

        <footer>
            <p>Manta Mikkonen | Sakky</p>
            <p>Taitaja 2023</p>
        </footer>
        <header>
            <form method="POST" action="">
                <button type="submit" name="kirjaudu_ulos">Kirjaudu ulos</button>
            </form>
        </header>
    <?php endif; ?>
</div>
</body>
</html>
