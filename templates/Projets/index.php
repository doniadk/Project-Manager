<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Projet> $projets
 */
?>
<div class="projets index content">
    <?php if ($this->Identity->get('role') === 'admin'): ?>
        <?= $this->Html->link(__('New Projet'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?php endif; ?>
    <h3><?= __('Projets') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th><?= $this->Paginator->sort('date_debut') ?></th>
                    <th><?= $this->Paginator->sort('date_fin') ?></th>
                    <?php if ($this->Identity->get('role') === 'admin'): ?>
                        <th class="actions"><?= __('Actions') ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets as $projet): ?>
                <tr>
                    <td><?= h($projet->nom) ?></td>
                    <td><?= h($projet->date_debut) ?></td>
                    <td><?= h($projet->date_fin) ?></td>
                    
                    <?php if ($this->Identity->get('role') === 'admin'): ?>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $projet->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $projet->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $projet->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $projet->id),
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
</div>