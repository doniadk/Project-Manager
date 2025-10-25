<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fonction $fonction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Fonction'), ['action' => 'edit', $fonction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Fonction'), ['action' => 'delete', $fonction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fonction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Fonctions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Fonction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="fonctions view content">
            <h3><?= h($fonction->nom) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($fonction->nom) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Personnels') ?></h4>
                <?php if (!empty($fonction->personnels)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Nom') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Adresse') ?></th>
                            <th><?= __('Telephone') ?></th>
                            <th><?= __('Fonction') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($fonction->personnels as $personnel) : ?>
                        <tr>
                            <td><?= h($personnel->nom) ?></td>
                            <td><?= h($personnel->email) ?></td>
                            <td><?= h($personnel->adresse) ?></td>
                            <td><?= h($personnel->telephone) ?></td>
                            <td>
                                <?= $personnel->has('fonction') ? h($personnel->fonction->nom) : '' ?>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Personnels', 'action' => 'view', $personnel->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Personnels', 'action' => 'edit', $personnel->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Personnels', 'action' => 'delete', $personnel->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $personnel->id),
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