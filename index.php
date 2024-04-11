<?php
require_once 'class/Message.php';

$errors = null;

if (isset($_POST['username'], $_POST['message'])) {
  $message = new Message($_POST['username'], $_POST['message']);
  if ($message->isValid()) {
  } else {
    $errors = $message->getErrors();
  }
}

$title = "Livre d'or";
require 'elements/header.php';
?>

<div class="container py-3">
  <h1>Livre d'or</h1>

  <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
      Formulaire invalide
    </div>
  <?php endif ?>

  <form action="" method="post">
    <div class="mb-3">
      <label for="username" class="form-label">Pseudo</label>
      <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?> " id="username" name="username" />
      <?php if (isset($errors['username'])) : ?>
        <div class="invalid-feedback">
          <?= $errors['username'] ?>
        </div>
      <?php endif ?>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?> " id="message" name="message"></textarea>
      <?php if (isset($errors['message'])) : ?>
        <div class="invalid-feedback">
          <?= $errors['message'] ?>
        </div>
      <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
  </form>
</div>

<?php require 'elements/footer.php'; ?>