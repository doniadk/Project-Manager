<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des projets</title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'custom']) ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar">
            <div class="sidebar-top">
                <h3 class="sidebar-title">
                    <a href="<?= $this->Url->build('/') ?>">Gestion des Projets</a>
                </h3>
                <hr>

                <?php $userRole = $this->Identity->isLoggedIn() ? $this->Identity->get('role') : null;?>

                <ul class="sidebar-menu">
                    <?php if ($userRole === 'admin'): ?>
                        <li><?= $this->Html->link('<i class="fa-solid fa-house"></i> Dashboard', ['controller' => 'MainPage', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-user"></i> Users', ['controller' => 'Users', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-people-group"></i> Personnels', ['controller' => 'Personnels', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-folder-open"></i> Projets', ['controller' => 'Projets', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-wrench"></i> Fonctions', ['controller' => 'Fonctions', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-list-check"></i> GestionProjets', ['controller' => 'GestionProjets', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-check"></i> Taches', ['controller' => 'Taches', 'action' => 'index'], ['escape' => false]) ?></li>

                    <?php elseif ($userRole === 'user'): ?>
                        <li><?= $this->Html->link('<i class="fa-solid fa-house"></i> Dashboard', ['controller' => 'MainPage', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-people-group"></i> Personnels', ['controller' => 'Personnels', 'action' => 'index'], ['escape' => false]) ?></li>
                        <li><?= $this->Html->link('<i class="fa-solid fa-folder-open"></i> Projets', ['controller' => 'Projets', 'action' => 'index'], ['escape' => false]) ?></li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if ($this->Identity->isLoggedIn()): ?>
                <div class="sidebar-bottom">
                    <?= $this->Html->link('<i class="fa-solid fa-arrow-right-from-bracket"></i> Logout', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]) ?>
                </div>
            <?php endif; ?>
        </aside>

        <main class="main">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
    </div>
</body>
</html>
