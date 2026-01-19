<?php
// Fitxer JSON
define('JSON_FILE', 'usuaris.json');

// Llegir usuaris
function getUsuaris() {
    if (!file_exists(JSON_FILE)) {
        file_put_contents(JSON_FILE, json_encode([]));
    }
    return json_decode(file_get_contents(JSON_FILE), true);
}

// Guardar usuaris
function saveUsuaris($usuaris) {
    file_put_contents(JSON_FILE, json_encode($usuaris, JSON_PRETTY_PRINT));
}

$usuaris = getUsuaris();
$accio = $_GET['accio'] ?? '';
$id = $_GET['id'] ?? null;

// ALTA o MODIFICACIÓ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $data = $_POST['data_alta'];

    if ($_POST['mode'] === 'alta') {
        $usuaris[] = [
            'nom' => $nom,
            'email' => $email,
            'data_alta' => $data
        ];
    } else {
        $usuaris[$_POST['id']] = [
            'nom' => $nom,
            'email' => $email,
            'data_alta' => $data
        ];
    }

    saveUsuaris($usuaris);
    header('Location: index.php');
    exit;
}

// BAIXA
if ($accio === 'baixa' && isset($usuaris[$id])) {
    unset($usuaris[$id]);
    $usuaris = array_values($usuaris);
    saveUsuaris($usuaris);
    header('Location: admin_usuaris.php');
    exit;
}

// Usuari per editar
$usuariEdit = ($accio === 'editar' && isset($usuaris[$id])) ? $usuaris[$id] : null;
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Administració d'usuaris</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #eee; }
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; }
    </style>
</head>
<body>

<h1>Administració d'usuaris</h1>

<h2>Llistat</h2>
<table>
    <tr>
        <th>Nom</th>
        <th>E-mail</th>
        <th>Data d'alta</th>
        <th>Accions</th>
    </tr>
    <?php foreach ($usuaris as $i => $u): ?>
        <tr>
            <td><?= htmlspecialchars($u['nom']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['data_alta']) ?></td>
            <td>
                <a href="?accio=editar&id=<?= $i ?>">Editar</a> |
                <a href="?accio=baixa&id=<?= $i ?>" onclick="return confirm('Segur?')">Baixa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h2><?= $usuariEdit ? 'Modificar usuari' : 'Alta d\'usuari' ?></h2>

<form method="post">
    <input type="hidden" name="mode" value="<?= $usuariEdit ? 'editar' : 'alta' ?>">
    <?php if ($usuariEdit): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>

    <label>Nom
        <input type="text" name="nom" required value="<?= $usuariEdit['nom'] ?? '' ?>">
    </label>

    <label>E-mail
        <input type="email" name="email" required value="<?= $usuariEdit['email'] ?? '' ?>">
    </label>

    <label>Data d'alta
        <input type="date" name="data_alta" required value="<?= $usuariEdit['data_alta'] ?? date('Y-m-d') ?>">
    </label>

    <br><br>
    <button type="submit">Desar</button>
    <?php if ($usuariEdit): ?>
        <a href="admin_usuaris.php">Cancel·lar</a>
    <?php endif; ?>
</form>

</body>
</html>
