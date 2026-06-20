<?php

/**
 * The WritingStateInterface defines the interface for all writing states.
 */
interface WritingStateInterface
{
    public function write(string $words);
}

/**
 * The UpperCase class represents a writing state where all text is converted to uppercase.
 */
class UpperCase implements WritingStateInterface
{
    public function write(string $words)
    {
        echo strtoupper($words) . "\n";
    }
}

/**
 * The LowerCase class represents a writing state where all text is converted to lowercase.
 */
class LowerCase implements WritingStateInterface
{
    public function write(string $words)
    {
        echo strtolower($words) . "\n";
    }
}

/**
 * The DefaultText class represents the default writing state where text is output as is.
 */
class DefaultText implements WritingStateInterface
{
    public function write(string $words)
    {
        echo $words . "\n";
    }
}

/**
 * The TextEditor class maintains a reference to a writing state and allows changing it at runtime.
 */
class TextEditor
{
    private WritingStateInterface $state;

    public function __construct()
    {
        $this->state = new DefaultText();
    }

    public function setState(WritingStateInterface $state): void
    {
        $this->state = $state;
    }

    public function type(string $words): void
    {
        $this->state->write($words);
    }
}

// Example usage
$editor = new TextEditor();

$editor->type("First line");

$editor->setState(new UpperCase());

$editor->type("Second Line");
$editor->type("Third Line");

$editor->setState(new LowerCase());

$editor->type("Fourth Line");
$editor->type("Fifth Line");

// Output:
// First line
// SECOND LINE
// THIRD LINE
// fourth line
// fifth line

