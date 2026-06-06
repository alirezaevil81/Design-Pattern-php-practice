<?php

// 1. Command Interface
interface Command {
    public function execute(): void;
    public function undo(): void;
}

// 3. Receiver
class TextEditor {
    private string $text = '';

    public function addText(string $textToAdd): void {
        $this->text .= $textToAdd;
        echo "Added: '$textToAdd', Current Text: '{$this->text}'\n";
    }

    public function deleteText(int $length): void {
        $deleted = substr($this->text, -$length);
        $this->text = substr($this->text, 0, -$length);
        echo "Deleted: '$deleted', Current Text: '{$this->text}'\n";
    }

    public function getText(): string {
        return $this->text;
    }
}

// 2. Concrete Commands
class AddTextCommand implements Command {
    private TextEditor $editor;
    private string $textToAdd;
    private string $deletedText = ''; // برای undo

    public function __construct(TextEditor $editor, string $textToAdd) {
        $this->editor = $editor;
        $this->textToAdd = $textToAdd;
    }

    public function execute(): void {
        $this->editor->addText($this->textToAdd);
    }

    public function undo(): void {
        // برای undo کردن addText، باید به اندازه متن اضافه شده، متن رو پاک کنیم.
        $this->deletedText = substr($this->editor->getText(), -strlen($this->textToAdd));
        $this->editor->deleteText(strlen($this->textToAdd));
        echo "Undo add: '{$this->deletedText}', Current Text: '{$this->editor->getText()}'\n";
    }
}

class DeleteTextCommand implements Command {
    private TextEditor $editor;
    private int $lengthToDelete;
    private string $deletedText = ''; // برای undo

    public function __construct(TextEditor $editor, int $lengthToDelete) {
        $this->editor = $editor;
        $this->lengthToDelete = $lengthToDelete;
    }

    public function execute(): void {
        $this->deletedText = substr($this->editor->getText(), -$this->lengthToDelete); // متن رو قبل از پاک کردن ذخیره می‌کنیم
        $this->editor->deleteText($this->lengthToDelete);
    }

    public function undo(): void {
        // برای undo کردن deleteText، باید متن پاک شده رو دوباره اضافه کنیم.
        $this->editor->addText($this->deletedText);
        echo "Undo delete: '{$this->deletedText}', Current Text: '{$this->editor->getText()}'\n";
    }
}

// 4. Invoker
class History {
    private array $commands = [];
    private array $undoneCommands = []; // برای redo

    public function storeCommand(Command $command): void {
        $this->commands[] = $command;
    }

    public function executeCommands(): void {
        foreach ($this->commands as $command) {
            $command->execute();
        }
        $this->commands = []; // بعد از اجرا، پاک میشن تا دوباره اجرا نشن
    }

    public function undoLastCommand(): void {
        if (empty($this->commands)) {
            echo "No commands to undo.\n";
            return;
        }
        $command = array_pop($this->commands);
        $command->undo();
        $this->undoneCommands[] = $command; // ذخیره برای redo
    }

    public function redoLastCommand(): void {
        if (empty($this->undoneCommands)) {
            echo "No commands to redo.\n";
            return;
        }
        $command = array_pop($this->undoneCommands);
        $command->execute();
        $this->commands[] = $command; // برگرداندن به لیست دستورات فعلی
    }
}

// 5. Client
$editor = new TextEditor();
$history = new History();

// دستور اول: اضافه کردن متن
$addCommand1 = new AddTextCommand($editor, "Hello");
$addCommand1->execute();
$history->storeCommand($addCommand1); // دستور رو برای Undo ذخیره می‌کنیم

// دستور دوم: اضافه کردن متن دیگر
$addCommand2 = new AddTextCommand($editor, " World!");
$addCommand2->execute();
$history->storeCommand($addCommand2);

echo "Current text: " . $editor->getText() . "\n"; // Output: Current text: Hello World!

echo "\n--- Undoing last command ---\n";
$history->undoLastCommand(); // undo add "World!"
// Expected Output: Deleted: ' World!', Current Text: 'Hello'
// Expected Output: Undo add: ' World!', Current Text: 'Hello'

echo "\n--- Undoing another command ---\n";
$history->undoLastCommand(); // undo add "Hello"
// Expected Output: Deleted: 'Hello', Current Text: ''
// Expected Output: Undo add: 'Hello', Current Text: ''

echo "\n--- Redoing last command ---\n";
$history->redoLastCommand(); // redo add "Hello"
// Expected Output: Added: 'Hello', Current Text: 'Hello'
// Expected Output: Current Text: Hello

echo "\n--- Redoing another command ---\n";
$history->redoLastCommand(); // redo add "World!"
// Expected Output: Added: ' World!', Current Text: 'Hello World!'
// Expected Output: Current Text: Hello World!

echo "\n--- Final text ---\n";
echo $editor->getText() . "\n"; // Output: Final text: Hello World!

// مثال برای DeleteTextCommand
$editor = new TextEditor();
$history = new History();

$addCommand = new AddTextCommand($editor, "Some text to delete");
$addCommand->execute();
$history->storeCommand($addCommand);

$deleteCommand = new DeleteTextCommand($editor, 6); // پاک کردن 6 کاراکتر آخر
$deleteCommand->execute();
$history->storeCommand($deleteCommand);

echo "Current text after delete: " . $editor->getText() . "\n"; // Output: Current text after delete: Some text to

echo "\n--- Undoing delete command ---\n";
$history->undoLastCommand(); // Undo the delete operation
// Expected Output: Added: 'delete', Current Text: 'Some text to delete'
// Expected Output: Undo delete: 'delete', Current Text: 'Some text to delete'

echo "\n--- Final text ---\n";
echo $editor->getText() . "\n"; // Output: Final text: Some text to delete

?>
