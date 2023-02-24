<?php
session_start();
require_once('functions.php');
$user = null;
if(isset($_GET['id'])) {
    $users = getUser($_GET['id']);
    if(!empty($users)) {
        $user = $users[0];
    }
}
?>

<?php if($user->id === $_SESSION['user']->id): ?>
<h1>Information de l'utilisateur <?= $user->email ?></h1>
<table>
    <tr>
        <td>id</td>
        <td><?= $user->id ?></td>
    </tr>
    <tr>
        <td>username</td>
        <td><?= $user->username ?></td>
    </tr>
    <tr>
        <td>email</td>
        <td><?= $user->email ?></td>
    </tr>
</table>
<?php else: ?>
    L'utilisateur recherché n'existe pas ou vous n'êtes pas autorisé à accéder à ces informations.
<?php endif; ?>
<br/>
<br/>
<a href="index.php">Accueil</a>
