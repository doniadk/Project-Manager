<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tach $tach
 * @var array $gestionprojets
 * @var array $projectBounds
 */
?>

<script>
// All project bounds, keyed by project ID
const projectBounds = <?= json_encode($projectBounds) ?>;

function updateDateBounds(projectId) {
    const debutInput = document.querySelector('#date-debut');
    const finInput = document.querySelector('#date-fin');

    if (!projectId || !projectBounds[projectId]) {
        // Remove min/max if no project selected
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

    // Clear values outside of bounds
    if (debutInput.value < bounds.min || debutInput.value > bounds.max) debutInput.value = '';
    if (finInput.value < bounds.min || finInput.value > bounds.max) finInput.value = '';
}

// Initialize on page load if a project is pre-selected
document.addEventListener('DOMContentLoaded', () => {
    const selectedProject = document.querySelector('#gestionprojet-id').value;
    if (selectedProject) updateDateBounds(selectedProject);
});
</script>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Taches'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column column-80">
        <div class="taches form content">
            <?= $this->Form->create($tach) ?>
            <fieldset>
                <legend><?= __('Add Tach') ?></legend>

                <?= $this->Form->control('titre') ?>

                <?= $this->Form->control('gestionprojet_id', [
                    'type' => 'select',
                    'options' => $gestionprojets,
                    'empty' => '-- Select a Project --',
                    'id' => 'gestionprojet-id',
                    'onchange' => 'updateDateBounds(this.value)'
                ]) ?>

                <?= $this->Form->control('progres',[
                    'type' => 'select',
                    'options' => ['en_cours' => 'En cours', 'terminee' => 'Terminée'],
                    'label' => 'État'
                ]); ?>



                <?php
                $selectedProjectId = $this->request->getData('gestionprojet_id') ?? null;

                $debutOptions = ['type' => 'date', 'id' => 'date-debut'];
                $finOptions = ['type' => 'date', 'id' => 'date-fin'];

                if ($selectedProjectId && isset($projectBounds[$selectedProjectId])) {
                    $debutOptions['min'] = $projectBounds[$selectedProjectId]['min'];
                    $debutOptions['max'] = $projectBounds[$selectedProjectId]['max'];
                    $finOptions['min'] = $projectBounds[$selectedProjectId]['min'];
                    $finOptions['max'] = $projectBounds[$selectedProjectId]['max'];
                }
                ?>

                <?= $this->Form->control('date_debut', $debutOptions) ?>
                <?= $this->Form->control('date_fin', $finOptions) ?>


            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
