<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GestionProjet $gestionProjet
 * @var \Cake\Collection\CollectionInterface|string[] $personnels
 * @var \Cake\Collection\CollectionInterface|string[] $projets
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Gestion Projets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="gestionProjets form content">
            <?= $this->Form->create($gestionProjet) ?>
            <fieldset>
                <legend><?= __('Add Gestion Projet') ?></legend>
                <?php
                    echo $this->Form->control('projet_id', ['options' => $projets]);
                    
                    echo $this->Form->control('personnels._ids', [
                        'type' => 'select',
                        'multiple' => 'checkbox',
                        'options' => $personnels
                    ]);

                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
