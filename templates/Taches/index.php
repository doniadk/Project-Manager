<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tach> $taches
 */
?>
<div class="taches index content">
    <?= $this->Html->link(__('New Tach'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tâches') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('titre') ?></th>
                    <th><?= $this->Paginator->sort('date_debut') ?></th>
                    <th><?= $this->Paginator->sort('date_fin') ?></th>
                    <th><?= __('Projet Assigné') ?></th>
                    <th><?= __('État') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($taches as $tach): ?>
                <tr>
                    <td><?= h($tach->titre) ?></td>
                    <td><?= h($tach->date_debut) ?></td>
                    <td><?= h($tach->date_fin) ?></td>
                    <td>
                        <?php if (!empty($tach->gestionprojet) && !empty($tach->gestionprojet->projet)): ?>
                            <?= $this->Html->link(
                                h($tach->gestionprojet->projet->nom),
                                ['controller' => 'Projets', 'action' => 'view', $tach->gestionprojet->projet->id],
                                ['class' => 'a_function_color']
                            ) ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                            if ($tach->progres === 'terminee') {
                                echo '<span style="color:green;font-weight:bold;">✅ Terminé</span>';
                            } else {
                                echo '<span style="color:red;font-weight:bold;">⏳ En cours</span>';
                            }
                        ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tach->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tach->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $tach->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $tach->id),
                            ]
                        ) ?>
                    </td>
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
