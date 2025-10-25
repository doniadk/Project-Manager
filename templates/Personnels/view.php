<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Personnel $personnel
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Personnel'), ['action' => 'edit', $personnel->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Personnel'), ['action' => 'delete', $personnel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personnel->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Personnels'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Personnel'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="personnels view content">
            <h3><?= h($personnel->nom) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($personnel->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($personnel->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Adresse') ?></th>
                    <td><?= h($personnel->adresse) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telephone') ?></th>
                    <td><?= h($personnel->telephone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fonction') ?></th>
                    <td><?= $personnel->hasValue('fonction') ? $this->Html->link($personnel->fonction->nom, ['controller' => 'Fonctions', 'action' => 'view', $personnel->fonction->id], ['class' => 'a_function_color']) : '' ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Gestion Projets') ?></h4>
                <?php if (!empty($personnel->gestion_projets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Personnel') ?></th>
                            <th><?= __('Projet') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($personnel->gestion_projets as $gestionProjet) : ?>
                        <tr>
                            <td>
                            <?php if (!empty($gestionProjet->personnels)) : ?>
                                <?= implode(', ', collection($gestionProjet->personnels)->extract('nom')->toList()) ?>
                            <?php endif; ?>
                            </td>

                            <td><?= $gestionProjet->has('projet') ? h($gestionProjet->projet->nom) : '' ?></td>

                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'GestionProjets', 'action' => 'view', $gestionProjet->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'GestionProjets', 'action' => 'edit', $gestionProjet->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'GestionProjets', 'action' => 'delete', $gestionProjet->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $gestionProjet->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>