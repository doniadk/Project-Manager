<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Personnel> $personnels
 */
?>
<div class="personnels index content">
    <?php if ($this->Identity->get('role') === 'admin'): ?>
        <?= $this->Html->link(__('New Personnel'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Personnels') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('adresse') ?></th>
                    <th><?= $this->Paginator->sort('telephone') ?></th>
                    <th><?= $this->Paginator->sort('fonction_id') ?></th>
                    <?php if ($this->Identity->get('role') === 'admin'): ?>
                        <th class="actions"><?= __('Actions') ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($personnels as $personnel): ?>
                <tr>
                    <td><?= h($personnel->nom) ?></td>
                    <td><?= h($personnel->email) ?></td>
                    <td><?= h($personnel->adresse) ?></td>
                    <td><?= h($personnel->telephone) ?></td>

                    <!--link to function able only for admin -->
                    <td>
                    <?php if ($personnel->hasValue('fonction')): ?>
                        <?php if ($this->Identity->get('role') === 'admin'): ?>
                            <?= $this->Html->link(
                                $personnel->fonction->nom,
                                ['controller' => 'Fonctions', 'action' => 'view', $personnel->fonction->id],
                                ['class' => 'a_function_color']
                            ) ?>
                        <?php else: ?>
                            <?= h($personnel->fonction->nom) ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    </td>


                    <?php if ($this->Identity->get('role') === 'admin'): ?>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $personnel->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $personnel->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $personnel->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $personnel->id),
                                ]
                            ) ?>
                        </td>
                    <?php endif; ?>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</>