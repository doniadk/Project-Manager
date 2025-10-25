<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tach $tach
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tach'), ['action' => 'edit', $tach->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tach'), ['action' => 'delete', $tach->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tach->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Taches'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tach'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column column-80">
        <div class="taches view content">
            <h3><?= h($tach->titre) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td><?= h($tach->titre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Debut') ?></th>
                    <td><?= h($tach->date_debut) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Fin') ?></th>
                    <td><?= h($tach->date_fin) ?></td>
                </tr>
                <tr>
                    <th><?= __('État') ?></th>
                    <td>
                        <?php
                            if ($tach->progres === 'terminee') {
                                echo '<span style="color:green;font-weight:bold;">✅ Terminé</span>';
                            } else {
                                echo '<span style="color:red;font-weight:bold;">⏳ En cours</span>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Projet') ?></th>
                    <td>
                        <?php if (!empty($tach->gestionprojet) && !empty($tach->gestionprojet->projet)): ?>
                            <?= $this->Html->link(
                                h($tach->gestionprojet->projet->nom),
                                ['controller' => 'Projets', 'action' => 'view', $tach->gestionprojet->projet->id],
                                ['class' => 'a_function_color']
                            ) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
