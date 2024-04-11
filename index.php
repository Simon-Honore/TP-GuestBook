<?php
require_once 'class/Message.php';
require_once 'class/GuestBook.php';

$errors = null;
$success = false;
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');

if (isset($_POST['username'], $_POST['message'])) {
  $message = new Message($_POST['username'], $_POST['message']);
  if ($message->isValid()) {
    $guestbook->addMessage($message);
    $success = true;
    $_POST = [];
  } else {
    $errors = $message->getErrors();
  }
}

$messages = $guestbook->getMessages();
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

  <?php if ($success) : ?>
    <div class="alert alert-success">
      Merci pour votre message
    </div>
  <?php endif ?>

  <form action="" method="post">
    <div class="mb-3">
      <label for="username" class="form-label">Pseudo</label>
      <input type="text" value="<?= htmlentities($_POST['username'] ?? '') ?>" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?> " id="username" name="username" />
      <?php if (isset($errors['username'])) : ?>
        <div class="invalid-feedback">
          <?= $errors['username'] ?>
        </div>
      <?php endif ?>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?> " id="message" name="message"><?= htmlentities($_POST['message'] ?? '') ?></textarea>
      <?php if (isset($errors['message'])) : ?>
        <div class="invalid-feedback">
          <?= $errors['message'] ?>
        </div>
      <?php endif ?>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
  </form>

  <?php if (!empty($messages)) : ?>
    <div class="mt-3">
      <h2>Messages</h2>

      <?php foreach ($messages as $message) : ?>
        <?= $message->toHTML(); ?>
      <?php endforeach ?>

    </div>
  <?php endif ?>
</div>

<?php require 'elements/footer.php'; ?>