<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GestionProjet $gestionProjet
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Gestion Projet'), ['action' => 'edit', $gestionProjet->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Gestion Projet'), ['action' => 'delete', $gestionProjet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gestionProjet->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Gestion Projets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Gestion Projet'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="gestionProjets view content">
            <table>
                <tr>
                    <th><?= __('Personnels') ?></th>
                    <td>
                        <?php if (!empty($gestionProjet->personnels)) : ?>
                            <ul>
                            <?php foreach ($gestionProjet->personnels as $personnel) : ?>
                                <li>
                                    <?= $this->Html->link(h($personnel->nom),
                                ['controller' => 'Personnels', 'action' => 'view', $personnel->id], ['class' => 'a_function_color']) ?>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                    </td>
                </tr>
                
                <tr>
                    <th><?= __('Projet') ?></th>
                    <td><?= $gestionProjet->hasValue('projet') ? $this->Html->link($gestionProjet->projet->nom, ['controller' => 'Projets', 'action' => 'view', $gestionProjet->projet->id], ['class'=>'a_function_color']) : '' ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Taches') ?></th>
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
                </tr>

                
            </table>
        </div>
    </div>
</div>