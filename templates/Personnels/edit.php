<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Personnel $personnel
 * @var string[]|\Cake\Collection\CollectionInterface $fonctions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personnel->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personnel->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Personnels'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="personnels form content">
            <?= $this->Form->create($personnel) ?>
            <fieldset>
                <legend><?= __('Edit Personnel') ?></legend>
                <?php
                    echo $this->Form->control('nom');
                    echo $this->Form->control('email');
                    echo $this->Form->control('adresse');
                    echo $this->Form->control('telephone');
                    echo $this->Form->control('fonction_id', ['options' => $fonctions]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
