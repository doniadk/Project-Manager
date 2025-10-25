<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $projet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $projet->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Projets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="projets form content">
            <?= $this->Form->create($projet) ?>
            <fieldset>
                <legend><?= __('Edit Projet') ?></legend>
                <?php
                    echo $this->Form->control('nom');
                    echo $this->Form->control('description');
                    echo $this->Form->control('date_debut');
                    echo $this->Form->control('date_fin');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
