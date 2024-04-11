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
}
