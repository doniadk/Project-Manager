<h1>Sign Up</h1>

<?= $this->Form->create($user) ?>
<fieldset>
    <?= $this->Form->control('name') ?>
    <?= $this->Form->control('email') ?>
    <?= $this->Form->control('password') ?>
    <?= $this->Form->control('role', ['type' => 'hidden', 'value' => 'user']) ?>

</fieldset>
<?= $this->Form->button(__('Register')) ?>
<?= $this->Form->end() ?>

<p>
    Already have an account? <?= $this->Html->link(
        'Login',
        ['action' => 'login'],
        ['class' => 'login_signup']
        ) ?>
</p>
