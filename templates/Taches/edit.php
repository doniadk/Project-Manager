<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tach $tach
 * @var array $gestionprojets
 * @var array $projectBounds
 */
?>
<script>
const projectBounds = <?= json_encode($projectBounds) ?>;

function updateDateBounds(projectId) {
    const debutInput = document.querySelector('#date-debut');
    const finInput = document.querySelector('#date-fin');

    if (!projectId || !projectBounds[projectId]) {
        debutInput.removeAttribute('min');
        debutInput.removeAttribute('max');
        finInput.removeAttribute('min');
        finInput.removeAttribute('max');
        return;
    }

    const bounds = projectBounds[projectId];
    debutInput.min = bounds.min;
    debutInput.max = bounds.max;
    finInput.min = bounds.min;
    finInput.max = bounds.max;

    if (debutInput.value < bounds.min || debutInput.value > bounds.max) debutInput.value = '';
    if (finInput.value < bounds.min || finInput.value > bounds.max) finInput.value = '';
}

// Initialize bounds on page load for the selected project
document.addEventListener('DOMContentLoaded', () => {
    const selectedProject = document.querySelector('#gestionprojet-id').value;
    updateDateBounds(selectedProject);
});
</script>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tach->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tach->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Taches'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="taches form content">
            <?= $this->Form->create($tach) ?>
            <fieldset>
                <legend><?= __('Edit Tach') ?></legend>
                <?= $this->Form->control('titre', ['class' => 'input']) ?>
                <?= $this->Form->control('gestionprojet_id', [
                    'type' => 'select',
                    'options' => $gestionprojets,
                    'empty' => '-- Select a Project --',
                    'label' => 'Assigned to Project',
                    'class' => 'input',
                    'onchange' => 'updateDateBounds(this.value)',
                    'id' => 'gestionprojet-id'
                ]) ?>
                <?= $this->Form->control('date_debut', ['type' => 'date', 'class' => 'input', 'id' => 'date-debut']) ?>
                <?= $this->Form->control('date_fin', ['type' => 'date', 'class' => 'input', 'id' => 'date-fin']) ?>

                 <?= $this->Form->control('progres',[
                    'type' => 'select',
                    'options' => ['en_cours' => 'En cours', 'terminee' => 'Terminée'],
                    'label' => 'État',
                    'value' => $tach->progres,
                ]); ?>

            </fieldset>

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
