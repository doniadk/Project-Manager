<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Projet'), ['action' => 'edit', $projet->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Projet'), ['action' => 'delete', $projet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projet->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Projets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Projet'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>

    <div class="column column-80">
        <div class="projets view content">
            <h3><?= h($projet->nom) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($projet->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Debut') ?></th>
                    <td><?= h($projet->date_debut) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Fin') ?></th>
                    <td><?= h($projet->date_fin) ?></td>
                </tr>
            </table>

            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($projet->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
