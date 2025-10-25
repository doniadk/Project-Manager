<div class="gestionProjets index content">
    <?= $this->Html->link(__('New Gestion Projet'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Gestion Projets') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('personnel_id') ?></th>
                    <th><?= $this->Paginator->sort('projet_id') ?></th>
                    <th><?= __('Taches') ?></th> <!-- New column for tasks -->
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gestionProjets as $gestionProjet): ?>
                    <tr>
                        <td>
                            <?= $gestionProjet->hasValue('projet') ? $this->Html->link(
                                $gestionProjet->projet->nom,
                                ['controller' => 'Projets', 'action' => 'view', $gestionProjet->projet->id],
                                ['class'=>'a_function_color']
                            ) : '' ?>
                        </td>
                        
                        <td>
                            <?php if (!empty($gestionProjet->personnels)) : ?>
                                <ul>
                                    <?php foreach ($gestionProjet->personnels as $personnel) : ?>
                                        <li>
                                            <?= $this->Html->link(
                                                h($personnel->nom),
                                                ['controller' => 'Personnels', 'action' => 'view', $personnel->id],
                                                ['class' => 'a_function_color']
                                            ) ?>
                                            <?php if ($personnel !== end($gestionProjet->personnels)) echo ', '; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>


                        <td>
                            <?php if (!empty($gestionProjet->taches)) : ?>
                                <ul>
                                    <?php foreach ($gestionProjet->taches as $tach): ?>
                                        <li>
                                            <?= $this->Html->link(
                                                h($tach->titre),
                                                ['controller' => 'Taches', 'action' => 'view', $tach->id],
                                                ['class'=>'a_function_color']
                                            ) ?>
                                            -
                                            <?php if ($tach->progres === 'terminee'): ?>
                                                <span style="color: green; font-weight: bold;">✅ Terminé</span>
                                            <?php else: ?>
                                                <span style="color: red; font-weight: bold;">⏳ En cours</span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <em>No tasks</em>
                            <?php endif; ?>
                        </td>


                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $gestionProjet->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $gestionProjet->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $gestionProjet->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $gestionProjet->id),
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
