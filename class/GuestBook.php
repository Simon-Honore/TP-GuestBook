<?php
require_once 'Message.php';

class GuestBook
{

  private $filename;

  public function __construct(string $filename)
  {
    $directory = dirname($filename);
    if (!is_dir($directory)) {
      mkdir(directory: $directory, recursive: true);
    }
    if (!file_exists($filename)) {
      touch($filename);
    }
    $this->filename = $filename;
  }

  public function addMessage(Message $message): void
  {
    file_put_contents($this->filename, $message->toJSON() . PHP_EOL, FILE_APPEND);
  }

  public function getMessages(): array
  {
    $messages = [];
    $content = trim(file_get_contents($this->filename));
    $lines = explode(PHP_EOL, $content);
    foreach ($lines as $line) {
      $data = json_decode($line, true);
      $messages[] = new Message($data['username'], $data['message'], new DateTime('@' . $data['date']));
    }
    return $messages;
  }
}
