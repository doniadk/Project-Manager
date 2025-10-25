<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GestionProjet $gestionProjet
 * @var string[]|\Cake\Collection\CollectionInterface $personnels
 * @var string[]|\Cake\Collection\CollectionInterface $projets
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $gestionProjet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $gestionProjet->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Gestion Projets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="gestionProjets form content">
            <?= $this->Form->create($gestionProjet) ?>
            <fieldset>
                <legend><?= __('Edit Gestion Projet') ?></legend>
                <?php
                    echo $this->Form->control('personnels._ids', ['type' => 'select','multiple' => 'checkbox',
                    'options' => $personnels,'label' => 'Personnel']);
                    echo $this->Form->control('projet_id', ['options' => $projets]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
