<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button(__('Login')) ?>
<?= $this->Form->end() ?>
<p>
    Don't have an account? <?= $this->Html->link(
        'Sign Up', 
        ['action' => 'signup'], 
        ['class' => 'login_signup']
        ) ?>
</p>
